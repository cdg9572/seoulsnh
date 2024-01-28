<?php

include_once("../../../_init.php");
include_once($GP -> CLS."/class.login.php");
$C_Login = new Login();

ini_set("session.cache_expire",86400);
ini_set("session.gc_maxlifetime",86400);


if($_GET['mode'] == "logout"){	
	$_SESSION['adminid'] = "";
	$_SESSION['suserid'] = "";
	$_SESSION['susername'] = "";
	$_SESSION['suserphone'] = "";
	$_SESSION['suseremail'] = "";
	$_SESSION['suserlevel'] = "";
	$_SESSION['adminhpidx'] = "";
	$C_Func->go_replace("/admin/login/");
	exit();
}


switch($_POST['mode']){
	case 'login':
		$args = "";		
        $args = array("adm_mem_id" => $_POST['loginAdminId'] , "adm_mem_pwd" => $C_Func -> encrypt_md5($_POST['loginAdminpw'],  $GP -> PASS) ) ;  	
        $rst = $C_Login -> AdminLoginInfoCheck($args);
       
		if($rst){
			$_SESSION['adminid']         = $rst['mb_id'];
			$_SESSION['suserid']         = $rst['mb_id'];
			$_SESSION['susername']       = $rst['mb_name'];
			$_SESSION['suserphone']      = $rst['mb_phone'];
			$_SESSION['suseremail']      = $rst['mb_email'];
			$_SESSION['suserlevel']      = $rst['mb_level'];
			$_SESSION['mb_branch']       = $rst['mb_branch'];
			$_SESSION['adminfld']        = $rst['tl_folder'];
			$_SESSION['adminfldsub']     = $rst['tl_folder_sub'];
			$_SESSION['adminbbs']        = $rst['tl_bbs'];
			//영문
			$_SESSION['adminfld_eng']    = $rst['tl_folder_eng'];
			$_SESSION['adminfldsub_eng'] = $rst['tl_folder_sub_eng'];
			$_SESSION['adminbbs_eng']    = $rst['tl_bbs_eng'];
			//러시아
			$_SESSION['adminfld_ru']     = $rst['tl_folder_ru'];
			$_SESSION['adminfldsub_ru']  = $rst['tl_folder_sub_ru'];
            $_SESSION['adminbbs_ru']     = $rst['tl_bbs_ru'];	           
			
			//마지막 로그인 날짜, 마지막 로그인 아이피, 로그인 누적횟수 수정
			$args = '';			
            $args = array("mb_email" => $_POST['login_id'] , "mb_lastlogin_date" =>  date('Y-m-d H:i:s'), "mb_lastlogin_ip" => $_SERVER['REMOTE_ADDR']) ;  
			$result = $C_Login -> Mem_Login_history($args);
		
			if(strlen($_POST['bakurl']) > 5){		
				$C_Func->go_replace(urldecode($_POST['bakurl']));
			}else{
				$C_Func->go_replace("/admin/bbs/bbs_list.php?m_tab=2");
			}
		}else{
			$C_Func->put_msg_and_back("아이디나 패스워드를 확인해주세요");
			exit();
		}		
	break;
}

?>
