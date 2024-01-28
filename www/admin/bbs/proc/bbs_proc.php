<?php
include_once("../../../_init.php");
include_once($GP -> INC_ADM_PATH_NEW."inc.adm_auth.php");
include_once($GP -> CLS."/class.jhboard.php");
$C_board 	= new JHBoard;


switch($_POST['mode']){
	
	case 'BBS_MODI':
		if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
		
		$args = "";		
        $args = array(
                        "jb_code" => $jb_code , 
                        "jba_title" => $jba_title ,
                        "jba_read_level" => $jba_read_level ,
                        "jba_write_level" => $jba_write_level ,
                        "jba_reply_level" => $jba_reply_level ,
                        "jba_comment_level" => $jba_comment_level ,
                        "jba_comment_use" => $jba_comment_use ,
                        "jba_list_use" => $jba_list_use ,
                        "jba_list_scale" => $jba_list_scale ,
                        "jba_skin_dir" => $jba_skin_dir 
                    );	                   
		$rst = $C_board -> BBS_Info_Modify($args);
		
		$C_Func->put_msg_and_modalclose("수정 되었습니다");		
		exit();
	break;
}
?>