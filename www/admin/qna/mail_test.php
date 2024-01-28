<?php
	include_once("../../_init_.php");
	//include_once($GP -> INC_ADM_PATH."/inc.modal.header.php");		
	include_once($GP->CLS."class.mail.php");
	$C_SendMail	= new SendMail;
	

	$receive_email	= "jhsmhlove@nate.com";
	$receive_name		= "전형";

	$C_SendMail -> setUseSMTPServer(true);
	$C_SendMail -> setSMTPServer($GP -> SMTP_IP, $GP -> SMTP_PORT);
	$C_SendMail -> setSMTPUser($GP -> SMTP_USER);
	$C_SendMail -> setSMTPPasswd($GP -> SMTP_PASS);
	
	$email_subject = "테스트 메일";
	$contents			= "테스트 메일";
	$sender_email = $GP -> Admin_Email;
	$sender_name = $GP -> Admin_Name;

	$C_SendMail -> setSubject($email_subject);
	$C_SendMail -> setMailBody($contents, true);
	$C_SendMail -> setFrom($sender_email, $sender_name);
	$C_SendMail -> addTo($receive_email, $receive_name);

	//$sendRst = $C_SendMail -> send();
	
	print_r($sendRst);

	$C_SendMail = "";
?>