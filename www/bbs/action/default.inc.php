<?php 
# �󼼺���
if($jb_idx) {	
    # �󼼺��� ó�� ��ƾ �� ��Ų
    
	include $GP -> INC_PATH . "/action/tdetail.inc.php";
} 


# ��Ϻ��� (�󼼺��� �ڵ尡 ���ų� �󼼺����������� ����Ʈ�� ������ ���)
# �Ʒ� ���α׷��� �Խ��ǽ�Ų�� ��������, �ѰԽù��� ǥ�⸦ ���� list.inc.php include���� ��ó�� �ؾ���
if (!$jb_idx || $db_config_data['jba_list_use'] == "Y") {
	//==============================================================================================
	# �˻� ���� ����
	//==============================================================================================
	
	
	$args							= array();
	
	if($_GET['page_row'] != '') {
		$args['show_row'] = $_GET['page_row'];	
	}else{
		$args['show_row'] = $db_config_data['jba_list_scale'];	
	}
	
	$args['show_page'] = $db_config_data['jba_page_scale'];	 
	$args['jb_code']  = $jb_code;	

	if($mypage_id != '') {
		$args['my_mb_id']  = $mypage_id;	
	}
	if($jb_code >= 200 ){
		if($_SESSION['suserlevel'] < 9){
			$args['jb_etc3'] = 'A';	
		}
	}
	
	$data = "";
	$data = $C_board -> Board_List(array_merge($_GET,$_POST,$args));
	
	$data_list 			= $data['data'];
	$page_link 			= $data['page_info']['link'];
	$page_search 		= $data['page_info']['search'];
	$totalcount 		= $data['page_info']['total'];
	$totalpages 		= $data['page_info']['totalpages'];
	$nowPage 				= $data['page_info']['page'];	
	$num_idx				= $data['page_info']['start_num'];
	
	$totalcount_l 	= number_format($totalcount,0);
	$data_list_cnt 	= count($data_list);
	
	#����Ʈ ó�� ��ƾ �� ��Ų
	include $GP -> INC_PATH . "/${skin_dir}/board_list.php";	
}
?>