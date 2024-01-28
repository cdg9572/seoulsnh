<?php
include_once("../../../_init.php");
include_once($GP -> CLS."/class.slide.php");
$C_Slide 	= new Slide;

//error_reporting(E_ALL);
//@ini_set("display_errors", 1);


switch($_POST['mode']){	

    case 'TO_AUTO_CH':
        if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
        
        $args = array(
            "tmp_id" => $tmp_id , 
            "max_desc" => $max_desc           
        ) ;
        $rst = $C_Slide->TO_AUTO_CHAGE($args);
        
        echo "true";
        exit();
    break;	
	
	case 'SLIDE_MODI':
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		include_once($GP->CLS."class.fileup.php");
			
		//메인페이지 이미지 업로드
		$file_orName			= "ts_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
            $args_f = array("forder" => $GP -> UP_SLIDE , "files" => $_FILES[$file_orName], "max_file_size" => 1024 * 5000, "able_file" => array() );	
			
			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) 
				$insertFileCheck = true;
			$image_main = $updata['new_file_name'];	//변경된 파일명
		}else{
			$image_main = $before_image_main;
		}
		
		if($insertFileCheck) {
			$C_Func->put_msg_and_modalclose($updata['error']);
		}

		//메인페이지 이미지 업로드
		$file_orName			= "ts_m_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = array("forder" => $GP -> UP_SLIDE , "files" => $_FILES[$file_orName], "max_file_size" => 1024 * 5000, "able_file" => array() );	
			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) 
				$insertFileCheck = true;
			$image_main_m = $updata['new_file_name'];	//변경된 파일명
		}else{
			$image_main_m = $before_image_main_m;
		}
		
		if($insertFileCheck) {
			$C_Func->put_msg_and_modalclose($updata['error']);
        }
        
        $args = array(
            "ts_idx" 					=> $ts_idx,
            "ts_title" 				=> addslashes($ts_title),
            "ts_link" 				=> $ts_link,
            "ts_descrition" 		=> addslashes($ts_descrition),
            "ts_content" 			=> $C_Func->enc_contents($ts_content),
            "ts_img" 					=> $image_main,
            "ts_m_img" 					=> $image_main_m,
            "ts_show" 					=> $ts_show,
            "ts_lang" 					=> $ts_lang,
            "ts_start_date" 		=> $ts_start_date,
            "ts_end_date" 			=> $ts_end_date,
            "ts_type"					=> $ts_type
        ) ;

		$rst = $C_Slide -> Slide_Modi($args);

		$C_Func->put_msg_and_modalclose("수정 되었습니다");		
		exit();
	break;


	case "SLIDE_IMGDEL":
            if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
            
            $args = array(
                "ts_idx" => $ts_idx , 
                "type" => $type           
            ) ;			
			
			$rst = $C_Slide -> Slide_ImgUpdate($args);
	
			@unlink($GP -> UP_SLIDE . $file);
	
			echo "true";
			exit();
		break;


	case 'SLIDE_DEL' :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;		
		
        $args = array(
            "ts_idx" => $ts_idx 
        ) ;	
		$result = $C_Slide ->Slide_Info($args);
		
		if($result) {			
			$ts_img = $result['ts_img'];
			$ts_m_img = $result['ts_m_img'];
			
			if($ts_img != '') {			
				@unlink($GP -> UP_SLIDE.$ts_img);
			}					
			
			if($ts_m_img != '') {			
				@unlink($GP -> UP_SLIDE.$ts_m_img);
			}
			$rst = $C_Slide -> Slide_Del($args);
		}		
		echo "true";
		exit();
	
	break;

	
	case 'SLIDE_REG':
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		include_once($GP->CLS."class.fileup.php");
			
		//메인페이지 이미지 업로드
		$file_orName			= "ts_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
            $args_f = array("forder" => $GP -> UP_SLIDE , "files" => $_FILES[$file_orName], "max_file_size" => 1024 * 5000, "able_file" => array() );	
			
			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) 
				$insertFileCheck = true;
			$image_main = $updata['new_file_name'];	//변경된 파일명
		}else{
			$image_main = $before_image_main;
		}
		
		if($insertFileCheck) {
			$C_Func->put_msg_and_modalclose($updata['error']);
		}

		//메인페이지 이미지 업로드
		$file_orName			= "ts_m_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
			$args_f = array("forder" => $GP -> UP_SLIDE , "files" => $_FILES[$file_orName], "max_file_size" => 1024 * 5000, "able_file" => array() );	

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) 
				$insertFileCheck = true;
			$image_main_m = $updata['new_file_name'];	//변경된 파일명
		}else{
			$image_main_m = $before_image_main_m;
		}
		
		if($insertFileCheck) {
			$C_Func->put_msg_and_modalclose($updata['error']);
        }
        
        $args = array(
            "ts_title" 				=> addslashes($ts_title),
            "ts_link" 				=> $ts_link,
            "ts_descrition" 		=> addslashes($ts_descrition),
            "ts_content" 			=> $C_Func->enc_contents($ts_content),
            "ts_img" 					=> $image_main,
            "ts_m_img" 					=> $image_main_m,
            "ts_show" 					=> $ts_show,
            "ts_lang" 					=> $ts_lang,
            "ts_start_date" 		=> $ts_start_date,
            "ts_end_date" 			=> $ts_end_date,
            "ts_type"					=> $ts_type
        ) ;

		$rst = $C_Slide -> Slide_Reg($args);

		if($rst) {
			$C_Func->put_msg_and_modalclose("등록 되었습니다");
		}else{
			$C_Func->put_msg_and_modalclose("등록에 실패하였습니다");
		}
		exit();
	break;
	
}
?>