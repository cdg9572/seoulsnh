<?php 
include_once($GP -> CLS."class.jhboard.php");
include_once($GP -> CLS."class.list.php");

$C_board = new JHBoard();
$C_ListClass 	= new ListClass();

$key="";
$value="";
//magic_quotes_gpc 설정이 ON이 아닐경우만 addslashes 처리
//extract()는 반복적으로 변수를 가공하기에 적합하지 않아서 사용안함
// if(__MAGIC_QUOTES_GPC__ != 1) {
// 	foreach($_GET as $key => $value) { $$key=stripslashes(trim($value)); }
// 	foreach($_POST as $key => $value)	{ $$key=stripslashes(trim($value));}
// } else {
// 	foreach($_GET as $key => $value) { $$key=trim($value); }	
// 	foreach($_POST as $key => $value) {	$$key=trim($value);	}
// }
unset($key, $value);

($jb_mode) ?  $jb_mode : $jb_mode = $_GET['jb_mode'] ;  
($jb_idx) ?  $jb_idx : $jb_idx = $_GET['jb_idx'] ;  
($jbc_idx) ?  $jbc_idx : $jbc_idx = $_GET['jbc_idx'] ;  
# 게시판설정정보...
include $GP -> INC_PATH . "/board_config.php";

# 검색키워드 설정
//$search_key['jb_name'] = $_GET['search_key']['jb_name'];
//$search_key['jb_title'] = $_GET['search_key']['jb_title'];
//$search_key['jb_content'] = $_GET['search_key']['jb_content'];
//$search_key="search_key[jb_name]=${search_key[jb_name]}&search_key[jb_title]=$search_key[jb_title]&search_key[jb_content]=$search_key[jb_content]";
$search_key = "search_key=" . $_GET['search_key'];

# 목록보기 (상세보기 코드가 없거나 상세보기페이지에 리스트를 보여줄 경우)
# 아래 프로그램은 게시판스킨의 페이지수, 총게시물수 표기를 위해 list.inc.php include전에 선처리 해야함
if (!$jb_idx || $db_config_data['jba_list_use'] == "Y") {
	//==============================================================================================
	# 검색 조건 설정
	//==============================================================================================
	
	
	$args							= array();
	if($_SESSION['suserlevel']== 5 && ($jb_code == 60 or $jb_code == 70) ){
        if($_GET['page_row'] != '') {		
            $args = array("show_row" => $_GET['page_row'],"show_page" => $db_config_data['jba_page_scale'] , "jb_code" => $jb_code, "jb_name" =>  $_SESSION['susername'] );
        }else{		
            $args = array("show_row" =>  $db_config_data['jba_list_scale'],"show_page" => $db_config_data['jba_page_scale'] , "jb_code" => $jb_code, "jb_name" =>  $_SESSION['susername']  );
        }
    }
    else{
        if($_GET['page_row'] != '') {		
            $args = array("show_row" => $_GET['page_row'],"show_page" => $db_config_data['jba_page_scale'] , "jb_code" => $jb_code);
        }else{		
            $args = array("show_row" =>  $db_config_data['jba_list_scale'],"show_page" => $db_config_data['jba_page_scale'] , "jb_code" => $jb_code);
        }
    }  
	
	if($mypage_id != '') {		
		$args = array("my_mb_id" =>  $mypage_id);	
	}
	if($jb_code >= 200 ){
		if($_SESSION['suserlevel'] < 9){			
			$args = array("jb_etc3" =>  'A');	
		}
    }	
   
    $data = "";
	$data = $C_board -> Board_List(array_merge($_GET,$_POST,$args));
	
	$data_list 			= $data['data'];
	$page_link 			= $data['page_info']['link'];
	$page_search 		= $data['page_info']['search'];
	$totalcount 		= $data['page_info']['total'];
	$totalpages 		= $data['page_info']['totalpages'];
	$nowPage 			= $data['page_info']['page'];	
	$num_idx			= $data['page_info']['start_num'];
	
	$totalcount_l 	= number_format($totalcount,0);
	$data_list_cnt 	= count($data_list);
	
    #리스트 처리 루틴 및 스킨
	
}

//게시판 제어 모듈
switch($jb_mode) {
    # 상세보기
    case("tdetail") :
        # 상세보기 처리 루틴 및 스킨
        include $GP -> INC_PATH . "/action/tdetail.inc.php";
        include $GP -> INC_PATH . "/${skin_dir}/board_read.php";		
        break;   
        
	
	#  읽기와 글 리스트
    case("tlist") :

		include $GP -> INC_PATH . "/${skin_dir}/board_list.php";			
		break;


	# 글쓰기
	case("twrite") :
		include $GP -> INC_PATH . "/action/twrite.inc.php";		
		include $GP -> INC_PATH . "/$skin_dir/board_write.php"; //입력폼 스킨...		
		break;


	# 수정
	case("tmodify") :
	
        //회원 또는 관리자의 경우 비밀번호		
        $input_passd = ($_POST['input_passd']) ? $_POST['input_passd'] : $_GET['input_passd'];      	
		if(isset($check_id) && empty($input_passd)) {
			$args = '';			
			$args = array("jb_code" => $jb_code , "jb_idx" => $jb_idx, "check_level" => $check_level, "check_id" => $check_id );	
			$rst = $C_board->Board_Detail($args);			
			$input_passd = $rst['jb_password'];						
		}			
		
			if(empty($input_passd)) //비밀번호 입력 체크
			{
				
				$get_par = "${index_page}?jb_code=${jb_code}&jb_idx=${jb_idx}";
				$get_par .= "&search_key=${search_key}&search_keyword=${search_keyword}&page=${page}&jb_mode=tmodify";
				
				//$C_Func->put_msg_and_back("수정 권한이 없습니다.");					
				//die;
				include $GP -> INC_PATH . "/${skin_dir}/input_passd.php"; //비밀번호 입력폼 스킨...
			}
			else
			{	
				include $GP -> INC_PATH . "/action/tmodify.inc.php";
				include $GP -> INC_PATH . "/$skin_dir/board_modify.php"; //수정폼 스킨...
			}
		break;


	# 답글
	case("treply") :

		include $GP -> INC_PATH . "/action/treply.inc.php";
		include $GP -> INC_PATH . "/$skin_dir/board_reply.php"; //답변폼 스킨...
		break;


	# 해당글 삭제시 비밀번호입력폼
	case("tdelete") :			
	
		//회원 또는 관리자의 경우 비밀번호
		if(isset($check_id) && empty($input_passd)) {
			$args = '';			
			$args = array("jb_code" => $jb_code , "jb_idx" => $jb_idx, "check_level" => $check_level, "check_id" => $check_id );			
			$rst = $C_board->Board_Detail($args);		
		
			$input_passd = $rst['jb_password'];
		}
		
		$get_par = "${query_page}?jb_code=${jb_code}&jb_idx=${jb_idx}";
		$get_par .= "&search_key=${search_key}&search_keyword=${search_keyword}&page=${page}&jb_mode=tdelete";
	
	
		if(empty($input_passd)) //비밀번호 입력 체크
		{
			//$C_Func->put_msg_and_back("삭제 권한이 없습니다.");					
			//die;			
			include $GP -> INC_PATH . "/${skin_dir}/input_passd.php"; //비밀번호 입력폼 스킨...
		}
		else
		{
			$get_par.="&input_passd=${input_passd}";
			
			//게시물 삭제 페이지로 이동			
			echo ("	<script language='javascript'>
							if(confirm('해당게시물과 관련된 모든정보가 삭제됩니다.\\n\\n삭제하시겠습니까?'))\n
								document.location.href = '${get_par}';\n
							else\n
								history.go(-1);\n
						</script>\n
			");
		}
		break;


	# 비밀글열람시 비밀번호 입력폼
	case("tsecret") :		

		$get_par = "${index_page}?jb_code=${jb_code}&jb_idx=${jb_idx}&jb_mode=tdetail";
		$get_par.= "&search_key=${search_key}&search_keyword=${search_keyword}&page=${page}";
	
		include $GP -> INC_PATH . "/${skin_dir}/input_passd.php"; //비밀번호 입력폼 스킨...
		break;


	# 댓글삭제시 비밀번호입력폼
	case("comment_delete") :
	
        //회원 또는 관리자의 경우 비밀번호
        
		if(isset($check_id) && empty($input_passd)) {
			$args = '';			
            $args = array("jb_code" => $jb_code , "jb_idx" => $jb_idx, "jbc_idx" => $jbc_idx, "check_level" => $check_level, "check_id" => $check_id );	
			$rst = $C_board->Board_Comment_Detail($args);
			$input_passd = $rst['jbc_password'];
		}
	
		$get_par = "${query_page}?jb_code=${jb_code}&jb_idx=${jb_idx}&jbc_idx=${jbc_idx}";
		$get_par .= "&search_key=${search_key}&search_keyword=${search_keyword}&page=${page}&jb_mode=comment_delete";
		
		if(empty($input_passd)) { //비밀번호 입력 체크
			//$C_Func->put_msg_and_back("삭제 권한이 없습니다.");					
			//die;
			include $GP -> INC_PATH . "/${skin_dir}/input_passd.php"; //비밀번호 입력폼 스킨...			
		} else {
			$get_par.="&input_passd=${input_passd}";
			
			//게시물 삭제 페이지로 이동			
			echo ("	<script language='javascript'>
							if(confirm('해당코멘트와 관련된 모든정보가 삭제됩니다.\\n\\n삭제하시겠습니까?'))\n
								document.location.href = '${get_par}';\n
							else\n
								history.go(-1);\n
						</script>\n
			");
		}
        break;
    case("comment_modify") :
        include $GP -> INC_PATH . "/action/tdetail.inc.php";
        include $GP -> INC_PATH . "/${skin_dir}/board_read.php";		
        include $GP -> INC_PATH . "/action/comment_modify.inc.php";
	    include $GP -> INC_PATH . "/${skin_dir}/comment_modify.php";	
        break;
		        
        # Default(글 읽기와 글 리스트)
    default :	
    include $GP -> INC_PATH . "/${skin_dir}/board_list.php";	


}

?>