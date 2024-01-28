<?php
	include_once("../../../_init.php");
	include_once $GP -> CLS . 'class.online.php';
	$C_Online = new Online();

	switch($_POST['mode']){		
		
		//전화 상담 삭제
		case "Phone_DEL":
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;				
			
			$args = array(
                "tfc_idx" => $tfc_idx 
            ) ;  
			$rst = $C_Online -> Phone_Consel_Del($args);
			
			echo "true";
			exit();
		break;
		
		//전화 상담 처리
		case "Phone_MODI":
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;				
			
			include $GP -> INC_PATH . "/xssFilter/HTML/Safe.php"; // xss filter을 include
			
			$safe = new HTML_Safe; // xss filter 객체 생성
			$input = base64_decode($tfc_result_con); 
			$output = $safe->parse($input); // html 태그를 필터링 하여 $output에 대입			
			$tfc_result_con = $C_Func->enc_contents($output);			

			$args = array(
                "tfc_idx" => $tfc_idx ,
				"tfc_result" => $tfc_result , 
				"tfc_rt_date" => $tfc_rt_date , 
				"tfc_result_con" => $tfc_result_con
            ) ;  
			$rst = $C_Online -> Phone_Consel_Result($args);		

			$C_Func->put_msg_and_modalclose("처리 되었습니다");		
			exit();
		break;

		case "PS_REG":
			if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;	
      
		//	include $GP -> INC_PATH .'/zmSpamFree/zmSpamFree.php';
			include $GP -> INC_PATH . "/xssFilter/HTML/Safe.php"; // xss filter을 include
			
			//스팸방지
		//	if ( !zsfCheck( $_POST['zsfCode'] ) ) {
		//		$C_Func->put_msg_and_back("스팸차단코드가 틀렸습니다.");
		//		die;	
		//	}               

			
            $args = array(
                "tfc_type" => $tfc_type , 
                "mb_code" =>$_SESSION['susercode'] ,
                "tfc_name" => $tfc_name , 
                "tfc_con" => $tfc_con , 
                "tfc_email" => $tfc_email , 
                "tfc_mobile" => $tfc_mobile1 . "-" . $tfc_mobile2 . "-" . $tfc_mobile3
            ) ;  
			$rst1 = $C_Online -> Phone_Chk_List($args);

			// if($rst1) {
			// 	$check_date = $rst1['tfc_regdate'];
			// 	$time_go =  $C_Func->datetimediff($check_date, null, "min");

			// 	if($time_go < 30) {
			// 	  $C_Func->put_msg_and_back("상담 요청을 하신지 30분이 지나지 않았습니다. 기다려주시거나 30분후에 재문의 해주세요");
			// 	  exit();
			// 	}
			// }

			$rst = $C_Online -> Phone_Counsel_Reg($args); 

			if($rst) {
                $mobile_agent = "/(iPod|iPhone|Android|BlackBerry|SymbianOS|SCH-M\d+|Opera Mini|Windows CE|Nokia|SonyEricsson|webOS|PalmOS)/";
            	
                $msg = "[".$GP -> COUNSEL_TPYE[$tfc_type]."]".$mb_name."님(".$tfc_mobile.")이 등록 되었습니다.";
    			
    			// 담당자 문자 간편 예약 문자전송
                /*$send_mobile = ""; //010-1234-1234
                $send_num = "1";
                
                $args = '';
                $args['message'] 	= $msg;
                $args['rphone'] 	= $send_mobile;
               // $args['rphone'] 	= ""; //010-1234-1234
                $args['sphone1'] 	= "031";
                $args['sphone2'] 	= "240";
                $args['sphone3'] 	= "6000";
                $args['rdate'] = '';
                $args['rtime'] = '';
                $args['returnurl'] = '';
                $args['testflag'] = 'N';
                $args['destination'] = '';
                $args['repeatFlag'] = '';
                $args['repeatNum'] = '1';
                $args['repeatTime'] = '15';
                $args['send_num'] = 1;	
                
                $rst1 = $C_Api -> Api_Sms_Send($args);	
                        
                $args['result'] = $rst1;				
                $args['ssa_idx'] = '9999';			
                SMS_send_history($args);	//발송기록 데이터베이스에 기록	 */
                
                $C_Func->put_msg_and_go("구독 신청이 완료 되었습니다.", "/");
				exit();
			}else{
				$C_Func->put_msg_and_go("구독 신청에 실패하였습니다", "/");
				exit();
			} 
    	break;
	}
?>