<?
	include_once  '../../_init.php';
  include_once($GP -> CLS."/class.content.php");	
	$C_Content 	= new Content;
	
	$args = '';
	$tc_cate = $_POST['tc_cate'];	
	$tc_cate_sub = $_POST['tc_cate_sub'];
	
	$arr_tmp = $GP->PAIN_TYPE_SUB[$tc_cate];		
	foreach ($arr_tmp as $key => $val) {
		if($key == $tc_cate_sub) {
			echo "<option value='" . $key . "' selected>" . $val . "</option>";
		}else{
			echo "<option value='" . $key . "'>" . $val . "</option>";
		}
	}	
	exit();
?>