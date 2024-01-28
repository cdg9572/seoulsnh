<?php
include_once("../../../_init.php");
include_once($GP -> CLS."/class.doctor.php");
$C_Doctor 	= new Doctor;

//error_reporting(E_ALL);
//@ini_set("display_errors", 1);
	
switch($_POST['mode']){
	
		case 'DT_AUTO_CH':
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
			
			$args = array(
                "tmp_id" => $tmp_id , 
                "max_desc" => $max_desc           
            ) ;  
			$rst = $C_Doctor->DT_AUTO_CHAGE($args);
			
			echo "true";
			exit();
		break;
		
	
		case 'DT_DESC':
            if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
            
            $args = array(
                "type" => $type , 
                "dr_idx" => $dr_idx,
                "dr_desc" => $desc           
            ) ;  
		
			$rst = $C_Doctor->DT_DESC_CHAGE($args);
			
			echo "true";
			exit();
		break;
	
	
		case "BOOK_MODI":
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
			
			include_once($GP->CLS."class.fileup.php");
			
			//메인페이지 이미지 업로드
			$file_orName			= "tb_file";
			$is_fileName			= $_FILES[$file_orName]['name'];
			$insertFileCheck	= false;
			if ($is_fileName) {
                $args_f = array("forder" => $GP -> UP_BOOK , "files" => $_FILES[$file_orName], "max_file_size" => 1024 * 5000, "able_file" => array() );	
					
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
            
            $args = array(
                "tb_idx" 			=> $tb_idx,
                "dr_idx" 			=> $dr_idx,
                "tb_title" 			=> $tb_type,
                "tb_title" 			=> $C_Func->enc_contents($tb_title),		
                "tb_content" 		=> $C_Func->enc_contents($tb_content),
                "tb_file_code" 	=> $image_main,
                "tb_editor_code" => $img_name               
            ) ; 

			$rst = $C_Doctor -> Book_Modi($args);	

			$C_Func->put_msg_and_modalclose("수정 되었습니다");
			exit();
		break;
	
	
		case "BOOK_IMGDEL":
            if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
            
            $args = array(               
                "tb_idx" => $tb_idx           
            ) ;
		
			$rst = $C_Doctor -> Book_ImgUpdate($args);
	
			@unlink($GP -> UP_BOOK . $tb_file);
	
			echo "true";
			exit();
		break;
	
		case "BOOK_DEL":
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
			
			$args = array(               
                "tb_idx" => $tb_idx           
            ) ;
			$rst = $C_Doctor -> Book_Del($args);
	
			echo "true";
			exit();
		break;
	
		case "BOOK_REG" :
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
			
			include_once($GP->CLS."class.fileup.php");
			
			//메인페이지 이미지 업로드
			$file_orName			= "tb_file";
			$is_fileName			= $_FILES[$file_orName]['name'];
			$insertFileCheck	= false;
			if ($is_fileName) {
				$args_f = array("forder" => $GP -> UP_BOOK , "files" => $_FILES[$file_orName], "max_file_size" => 1024 * 5000, "able_file" => array() );	
				$C_Fileup = new Fileup($args_f);
				$updata		= $C_Fileup -> fileUpload();
	
				if ($updata['error']) 
					$insertFileCheck = true;
				$image_main = $updata['new_file_name'];	//변경된 파일명
			}
			
			if($insertFileCheck) {
				$C_Func->put_msg_and_modalclose($updata['error']);
            }		
            
            $args = array(
                "dr_idx"				=> $dr_idx,
                "tb_type"				=> $tb_type,
                "tb_title"			=> $C_Func->enc_contents($tb_title),		
                "tb_content"		=> $C_Func->enc_contents($tb_content),
                "tb_file_code"	=> $image_main
            ) ; 			
			$rst = $C_Doctor -> Book_Reg($args);
	
			if($rst) {
				$C_Func->put_msg_and_modalclose("등록 되었습니다");
			}else{
				$C_Func->put_msg_and_modalclose("등록에 실패하였습니다");
			}
	break;
	
	case "DOCTOR_DEL" :
        if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
        
        $args = array(               
            "dr_idx" => $dr_idx           
        ) ;
		
		$rst = $C_Doctor -> Doctor_Del($args);

		echo "true";
		exit();
	break;
	
	case "DOCTOR_MODI" :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		//직책
		$dr_ps = "";
		if (is_array($dr_position)) {
			foreach ($dr_position as $k => $v) {
				$dr_ps .= $v . ",";
			}
        }
	
		include_once($GP->CLS."class.fileup.php");
		
		//사진 업로드	
		$file_orName			= "dr_face_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
            $args_f = array("forder" => $GP -> UP_DOCTOR , "files" => $_FILES[$file_orName], "max_file_size" => 1024 * 5000, "able_file" => array("jpg","gif","png","bmp"), "image_w" => "280", "image_h" => "300" );	           

			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();

			if ($updata['error']) $insertFileCheck = true;
				$image_main = $updata['new_file_name'];	//변경된 파일명
		}else {
			$image_main				= $before_image_main;
		}	
		
		//사진 업로드
		$file_orName			= "dr_list_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
            $args_f = array("forder" => $GP -> UP_DOCTOR , "files" => $_FILES[$file_orName], "max_file_size" => 1024 * 5000, "able_file" => array("jpg","gif","png","bmp"), "image_w" => "210", "image_h" => "210" );	
			
			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();			

			if ($updata['error']) $insertFileCheck = true;			
				$image_list = $updata['new_file_name'];	//변경된 파일명
		}else {
			$image_list				= $before_image_list;
        }
        
        $args = array(
            "dr_idx" => $dr_idx           ,
            "dr_position" 	=> $dr_ps,
            "dr_name" 		=> $dr_name,
            "dr_eng_name" 	=> $dr_eng_name,
            "dr_clinic" 		=> $dr_clinic,
            "dr_center" 		=> $dr_center,
            "dr_thesis" 		=> $dr_thesis,
            "dr_choice" 		=> $dr_choice,
            "dr_special" 	=> $dr_special,

            "dr_m_sd" => $dr_m_sd1 . "|" . $dr_m_sd2 . "|" . $dr_m_sd3 . "|" . $dr_m_sd4 . "|" . $dr_m_sd5 . "|" . $dr_m_sd6 . "|" . $dr_m_sd7,
            "dr_a_sd" => $dr_a_sd1 . "|" . $dr_a_sd2 . "|" . $dr_a_sd3 . "|" . $dr_a_sd4 . "|" . $dr_a_sd5 . "|" . $dr_a_sd6 . "|" . $dr_a_sd7,
            "dr_n_sd" => $dr_n_sd1 . "|" . $dr_n_sd2 . "|" . $dr_n_sd3 . "|" . $dr_n_sd4 . "|" . $dr_n_sd5. "|" . $dr_n_sd6. "|" . $dr_n_sd7,
            
            "dr_face_img" 	=> $image_main,	
            "dr_list_img" 	=> $image_list,	
            "dr_main_view" 	=> $dr_main_view,	
            "dr_lang" 	=> $dr_lang,	
            "dr_history" 	=> $C_Func->enc_contents_edit($dr_history),		
            "dr_history1" 	=> $C_Func->enc_contents_edit($dr_history1),		
            "dr_history2" 	=> $C_Func->enc_contents_edit($dr_history2),		
            "dr_history3" 	=> $C_Func->enc_contents_edit($dr_history3),		
            "dr_history4" 	=> $C_Func->enc_contents_edit($dr_history4),		
            "dr_history5" 	=> $C_Func->enc_contents_edit($dr_history5),		
            "dr_history6" 	=> $C_Func->enc_contents_edit($dr_history6),		
            "dr_history7" 	=> $C_Func->enc_contents_edit($dr_history7),		
            "dr_treat" 		=> $C_Func->enc_contents_edit($dr_treat)
        ) ; 
		
		$rst = $C_Doctor -> Doctor_Modi($args);
		
		$C_Func->put_msg_and_modalclose("수정 되었습니다");
		exit();
		
	break;
	
	
	case "DOCTOR_IMGDEL" :
        if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
        
        $args = array(               
            "dr_idx" => $dr_idx  ,
            "type" => $type  
        ) ;
		
		$rst = $C_Doctor -> Doctor_ImgUpdate($args);

		@unlink($GP -> UP_DOCTOR . $file);

		echo "true";
		exit();
	break;
	
	
	case "DOCTOR_REG":
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;			

				
		//직책
		$dr_ps = "";
		if (is_array($dr_position)) {
			foreach ($dr_position as $k => $v) {
				$dr_ps .= $v . ",";
			}
		}       
       		
		include_once($GP->CLS."class.fileup.php");
		
		//사진 업로드
		$file_orName			= "dr_face_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
            $args_f = array("forder" => $GP -> UP_DOCTOR , "files" => $_FILES[$file_orName], "max_file_size" => 1024 * 5000, "able_file" => array("jpg","gif","png","bmp"), "image_w" => "280", "image_h" => "400" );	
			
			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();			

			if ($updata['error']) $insertFileCheck = true;			
				$image_main = $updata['new_file_name'];	//변경된 파일명
		}
		
		//사진 업로드
		$file_orName			= "dr_list_img";
		$is_fileName			= $_FILES[$file_orName]['name'];
		$insertFileCheck	= false;
		if ($is_fileName) {
            $args_f = array("forder" => $GP -> UP_DOCTOR , "files" => $_FILES[$file_orName], "max_file_size" => 1024 * 5000, "able_file" => array("jpg","gif","png","bmp"), "image_w" => "210", "image_h" => "210" );	
			
			$C_Fileup = new Fileup($args_f);
			$updata		= $C_Fileup -> fileUpload();			

			if ($updata['error']) $insertFileCheck = true;			
				$image_list = $updata['new_file_name'];	//변경된 파일명
        }
        
        $args = array(
            "dr_position" 	=> $dr_ps,
            "dr_name" 			=> $dr_name,
            "dr_eng_name" 	=> $dr_eng_name,
            "dr_clinic" 		=> $dr_clinic,
            "dr_center" 		=> $dr_center,
            "dr_thesis" 		=> $dr_thesis,
            "dr_choice" 		=> $dr_choice,
            "dr_special" 	=> $dr_special,

            "dr_m_sd" => $dr_m_sd1 . "|" . $dr_m_sd2 . "|" . $dr_m_sd3 . "|" . $dr_m_sd4 . "|" . $dr_m_sd5 . "|" . $dr_m_sd6 . "|" . $dr_m_sd7,
            "dr_a_sd" => $dr_a_sd1 . "|" . $dr_a_sd2 . "|" . $dr_a_sd3 . "|" . $dr_a_sd4 . "|" . $dr_a_sd5 . "|" . $dr_a_sd6 . "|" . $dr_a_sd7,
            "dr_n_sd" => $dr_n_sd1 . "|" . $dr_n_sd2 . "|" . $dr_n_sd3 . "|" . $dr_n_sd4 . "|" . $dr_n_sd5. "|" . $dr_n_sd6. "|" . $dr_n_sd7,
            
            "dr_face_img" 	=> $image_main,	
            "dr_list_img" 	=> $image_list,	
            "dr_main_view" 	=> $dr_main_view,	
            "dr_lang" 	=> $dr_lang,	
            "dr_history" 	=> $C_Func->enc_contents_edit($dr_history),		
            "dr_history1" 	=> $C_Func->enc_contents_edit($dr_history1),		
            "dr_history2" 	=> $C_Func->enc_contents_edit($dr_history2),		
            "dr_history3" 	=> $C_Func->enc_contents_edit($dr_history3),		
            "dr_history4" 	=> $C_Func->enc_contents_edit($dr_history4),		
            "dr_history5" 	=> $C_Func->enc_contents_edit($dr_history5),		
            "dr_history6" 	=> $C_Func->enc_contents_edit($dr_history6),		
            "dr_history7" 	=> $C_Func->enc_contents_edit($dr_history7),		
            "dr_treat" 		=> $C_Func->enc_contents_edit($dr_treat)
        ) ; 
		$rst = $C_Doctor -> Doctor_Reg($args);
		
		
		if($rst) {
			$C_Func->put_msg_and_modalclose("등록 되었습니다");
		}else{
			$C_Func->put_msg_and_modalclose("등록에 실패하였습니다");
		}
	break;

	
}
?>