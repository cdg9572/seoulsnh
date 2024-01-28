<?php 

include $GP -> INC_PATH . "/xssFilter/HTML/Safe.php"; // xss filter을 include
include_once($GP->CLS."class.mail.php");
$C_SendMail	= new SendMail;	

$jb_code = $_GET['jb_code'] ;
$jb_idx = $_GET['jb_idx'] ;
$jbc_name = $_POST['jbc_name'] ;
$jb_email = $_POST['jb_email'] ;
$jbc_content = $_POST['jbc_content'] ;
$jbc_password = $_POST['jbc_password'] ;

//등록관련 정보 확인
if(!$jb_code || !$jb_idx || !$jbc_name || !$jbc_content)
{
	$C_Func->put_msg_and_back("등록관련정보가 부족합니다. 등록정보를 확인해 주세요.");
	die;
}


//자동구문변수처리
$jbc_step=0;
$jbc_reg_date	= date('Y-m-d H:i:s');
$jbc_mod_date	= date('Y-m-d H:i:s');
$jbc_reg_ip	=	$_SERVER['REMOTE_ADDR'];
$jbc_mb_id = $check_id;


//마지막 jb_depth 입력값
$args = "";
$args = array("jb_code" => $jb_code , "jb_idx" => $jb_idx ) ;  
$rst = $C_board->Board_Comment_Depth_Max($args);

/*
//Depth
if($rst['max_depth'] > 0)
	$jbc_depth=($rst['max_depth'] + 10); //답변 9개
else
	$jbc_depth=10;

//Group
$jbc_group=($jbc_depth / 10);
*/

//Group
if($rst['max_group'] > 0)
	$jbc_group=($rst['max_group'] + 1); 
else
	$jbc_group = 1;

//Group
$jbc_depth = '';
//$jbc_group = (($jbc_depth * -1) / 10);

$safe = new HTML_Safe; // xss filter 객체 생성
$input = base64_decode($jbc_content); 
$output = $safe->parse($input); // html 태그를 필터링 하여 $output에 대입
//$output = iconv("UTF-8", "EUC-KR", $output);
$output = addslashes($output);
$jbc_content = htmlspecialchars($output);

$jbc_del_flag = 'N';

//업로드 파일 갯수
$file_cnt = count($_FILES['jbc_file']['tmp_name']); 

for($i=0; $i<$file_cnt; $i++)
{
	 //파일의 확장자 및, 용량체크 - 허용용량을 초과 할 수 있으므로 DB Insert 보다 우선 처리
	if($_FILES['jbc_file']['name'][$i])
		$C_Func->file_ext_check($_FILES['jbc_file']['name'][$i], $_FILES['jbc_file']['size'][$i],"");
		
}
include_once($GP->CLS."class.fileup.php");
//이메일 보내기
if($_POST['jbc_chk']== on){
	$sender_name = $check_name;
	$sender_email = $_SESSION['suseremail'];


	$receive_name = $r_jb_name;
    $receive_email = $jb_email;
    
    $email_subject = $jb_name."메디인사이드 유지보수 게시판에 댓글이 등록 되었습니다.";
	
	include_once($GP -> CLS . "class.mail.php");
	$C_SendMail = new SendMail();
	
	
	$C_SendMail -> setUseSMTPServer(false);  //false가 내부 메일 전송 true는 외부
	$C_SendMail -> setSMTPServer($GP -> SMTP_SERVER, $GP -> SMTP_PORT);
	$C_SendMail -> setSMTPUser($GP -> SMTP_USER);
	$C_SendMail -> setSMTPPasswd($GP -> SMTP_PASS);	

	$contents = "보낸사람 :".$jbc_name."<br>";
	$contents .= "내용 :".$jbc_content."<br>";	

	$C_SendMail -> setSubject($email_subject);
	$C_SendMail -> setMailBody($contents, true);
	$C_SendMail -> setFrom($sender_email, $sender_name);
	$C_SendMail -> addTo($receive_email, $receive_name);
	$sendRst = $C_SendMail->send();  
}
//==============================================================================================
# 자동 DB Insert 구문 생성 Start
//==============================================================================================
$keys="";
$values="";
$rst_board = $C_board->DESC_BOARD_COMMENT();

for($i=0; $i<count($rst_board); $i++) {
    if($rst_board[$i]["Extra"]=="auto_increment") continue;
    if($rst_board[$i]['Field']=="jbc_file_name") continue;
	if($rst_board[$i]['Field']=="jbc_file_code") continue;	
	
    $keys.=$rst_board[$i]['Field'] . ",";	//자동 Key 생성
    $values.="'" . ${$rst_board[$i]['Field']} . "',"; //자동 Value 생성	  
}

//끝부분 "," 제거
$keys=rtrim($keys, ",");
$values=rtrim($values, ",");

//리스트테이블에 기본정보 입력
if($keys && $values)
{
	$args = "";
    $args = array("keys" => $keys , "values" => $values );		
	$result_key = $C_board->BOARD_COMMENT_WRITE($args);		
}
//==================================================================== 자동 DB Insert 구문 생성 End

//다중 파일 업로드
$file_save_path = $GP -> UP_IMG_SMARTEDITOR ."jb_" . $jb_code; //저장될 경로...
$real_file_names="";
$new_file_names="";

$jbc_idx = $result_key;

for($i=0; $i<$file_cnt; $i++) {
	$new_file_name="";
    
   
	//파일업로드	
	if($_FILES['jbc_file']['name'][$i]) {
		$new_file_name = $C_Func->file_upload($_FILES['jbc_file']['tmp_name'][$i], $_FILES['jbc_file']['name'][$i], $_FILES['jbc_file']['size'][$i], $file_save_path, "");
		
		$real_file_names.=$_FILES['jbc_file']['name'][$i] . "|";
		$new_file_names.=$new_file_name . "|";
	}	
}

$args = "";
//첨부파일
if($real_file_names!="" && $new_file_names!="")
{
	$real_file_names = rtrim($real_file_names, "|");
	$new_file_names = rtrim($new_file_names, "|");
	
}

$args = array("jb_code" => $jb_code , "jbc_idx" => $jbc_idx,"jbc_file_name" => $real_file_names , "jbc_file_code" => $new_file_names,"jbc_img_code" => $img_name  );	

$file_update = $C_board->BOARD_Comment_FILE_UPDATE($args);	


//리스트 입력이 완료되면 해당 부모글의 코멘트 수 증가
if($result_key)
{
	$args = "";
    $args = array("jb_code" => $jb_code , "jb_idx" => $jb_idx ) ;  
	$result_key2 = $C_board->BOARD_LIST_COMM_UP($args);	
}


//페이지 이동 관련 변수 설정
$get_par = "${index_page}?jb_code=${jb_code}&jb_mode=tdetail&jb_idx=${jb_idx}&${search_key}&search_keyword=${search_keyword}&page=${page}";

$C_Func->put_msg_and_go("등록되었습니다.", "${get_par}");
?>