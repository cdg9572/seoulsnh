<?php
include_once("../../../_init.php");
include_once($GP->CLS."class.online.php");
$C_Online 	= new Online;

switch($_POST['mode']){    	
	case "QNADEL" :	
        if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
        
        	
		$args = array("toq_idx" => $toq_idx ) ;  
		$rst = $C_Online -> Online_Info_Del($args);
		
		echo "true";
        exit();
    break;

	case 'QNA_MODI' :
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;		
        
        $args = array(
            "toq_idx" => $toq_idx ,
            "toq_result" => $toq_result ,
            "toq_result_date" => $toq_result_date ,
            "toq_result_content" => $toq_result_date 
        ) ;  
			
		$rst = $C_Online -> Online_Info_Modify($args);
		
	/*	
		if($toq_result == "Y") {
			include_once($GP->CLS."class.mail.php");
			$C_SendMail	= new SendMail;			
		
			$receive_email	= $toq_email;			
			$receive_name		= $toq_charger;
		
			$C_SendMail -> setUseSMTPServer(true);
			$C_SendMail -> setSMTPServer($GP -> SMTP_IP, $GP -> SMTP_PORT);
			$C_SendMail -> setSMTPUser($GP -> SMTP_USER);
			$C_SendMail -> setSMTPPasswd($GP -> SMTP_PASS);
			
			$email_subject = "유지보수 처리가 완료되었습니다";
			$contents			= $toq_result_content;
		
			$sender_email = "info@mediinside.co.kr";
			$sender_name = "메디인사이드";			
		
			$C_SendMail -> setSubject($email_subject);
			$C_SendMail -> setMailBody($contents, true);
			$C_SendMail -> setFrom($sender_email, $sender_name);
			$C_SendMail -> addTo($receive_email, $receive_name);
			
			$sendRst = $C_SendMail -> send();		
			
			$C_SendMail = "";
		}
	*/
		$C_Func->put_msg_and_modalclose("수정 되었습니다");		
		exit();
	break;
	
}
?>