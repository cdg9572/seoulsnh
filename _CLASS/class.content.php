<?
CLASS Content extends Dbconn
{
	private $DB;
	private $GP;
	function __construct($DB = array()) {
		global $C_DB, $GP;
		$this -> DB = (!empty($DB))? $DB : $C_DB;
		$this -> GP = $GP;
	}

	function TC_AUTO_CHAGE($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;		

		$arr_tmp = explode(',',$tmp_id);
		
		for($i=0; $i<count($arr_tmp); $i++) {
			$idx = $arr_tmp[$i];			
			$qry = " update tblContent set tc_desc = '$max_desc' where tc_idx = '$idx'	";			
			$rst =  $this -> DB -> execSqlUpdate($qry);
			$max_desc--; 
		}
		
	}

	/*
	function TC_AUTO_CHAGE($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;		
		
		$arr_tmp = explode('_',$cl_id);
		$arr_tmp1 = explode('_',$ch_id);
		
		$n_idx = $arr_tmp[0];
		$n_desc = $arr_tmp[1];
		
		$a_idx = $arr_tmp1[0];
		$a_desc = $arr_tmp1[1];
		
		$qry = " update tblContent set tc_desc = '$a_desc' where tc_idx = '$n_idx'	";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		
		$qry1 = " update tblContent set tc_desc = '$n_desc' where tc_idx = '$a_idx'	";
		$rst1 =  $this -> DB -> execSqlUpdate($qry1);
		
		return $rst;
	}
	*/
	
	// desc	 : 호 순서 변경
	// auth  : JH 2013-09-16 월요일
	// param
	function TC_DESC_CHAGE($args = '') {		
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		if($type == "asc") {			
			$up_desc = $tc_desc + 1;
			
			$qry = "select tc_idx from tblContent where tc_desc = '$up_desc' ";
			$rst =  $this -> DB -> execSqlOneRow($qry);
			
			$one_twz = $rst['tc_idx'];
			
			$qry = " update tblContent set tc_desc = tc_desc - 1 where tc_idx = '$one_twz' ";					
			$rst =  $this -> DB -> execSqlUpdate($qry);
			
			
			$qry1 = " update tblContent set tc_desc = tc_desc + 1 where tc_idx = '$tc_idx' ";			
			$rst =  $this -> DB -> execSqlUpdate($qry1);
		}
		
		if($type == "desc") {
			
			$dn_desc = $tc_desc - 1;
			
			$qry = "select tc_idx from tblContent where tc_desc = '$dn_desc' ";	
			$rst =  $this -> DB -> execSqlOneRow($qry);
			
			$one_twz = $rst['tc_idx'];
			
			$qry = " update tblContent set tc_desc = tc_desc + 1 where tc_idx = '$one_twz' ";
			$rst =  $this -> DB -> execSqlUpdate($qry);			
			
			$qry1 = " update tblContent set tc_desc = tc_desc - 1 where tc_idx = '$tc_idx' ";
			$rst =  $this -> DB -> execSqlUpdate($qry1);
		}
		
		return $rst;
	}
	
	function Con_Ori_Hit($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			update tblContent set tc_ori_hit = tc_ori_hit +1  where tc_idx = '$tc_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	
	function Con_Hit($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			update tblContent set tc_hit = tc_hit +1  where tc_idx = '$tc_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	function Con_Info_Del($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			delete from tblContent where tc_idx = '$tc_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	
	function Con_Main_List($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$add_Qry = " tc_main_view = 'Y' ";
		if($tc_cate){
			$add_Qry .= " and tc_cate like '%${tc_cate}%'";
		}
		
		// if($tc_cate == "L"){
		// 	$add_Qry .= " and (tc_cate = 'H' or tc_cate ='I' or tc_cate ='K' or tc_cate ='L' or tc_cate ='Z') ";
		// }else{
		// 	if($tc_cate == "") {
		// 		$add_Qry .= " and tc_main_view = 'Y' ";
		// 	}else{
		// 		$add_Qry .= " and (tc_cate like '%${tc_cate}%' or tc_cate like '%Z%') ";
		// 	}
		// }
/*		if($tc_view !=''){
			$add_Qry .= " and tc_view = 'Y' ";
		}
		
*/		

				
		if($search_content) {			
			$add_Qry .= " AND (tc_title LIKE '%${search_content}%' || tc_content LIKE '%${search_content}%')";
			
		}	
		
		$qry = "
			select * from tblContent where $add_Qry order by tc_desc desc
		";

	
        $rst =  $this -> DB -> execSqlList($qry);
		return $rst;
    }
    
    function Con_List2($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$add_Qry = " tc_view = 'Y' ";
		if($tc_cate){
			$add_Qry .= " and tc_cate like '%${tc_cate}%'";
        }
        
        if($search_content) {			
			$add_Qry .= " AND (tc_title LIKE '%${search_content}%' || tc_content LIKE '%${search_content}%')";
			
		}	
		
		// if($tc_cate == "L"){
		// 	$add_Qry .= " and (tc_cate = 'H' or tc_cate ='I' or tc_cate ='K' or tc_cate ='L' or tc_cate ='Z') ";
		// }else{
		// 	if($tc_cate == "") {
		// 		$add_Qry .= " and tc_main_view = 'Y' ";
		// 	}else{
		// 		$add_Qry .= " and (tc_cate like '%${tc_cate}%' or tc_cate like '%Z%') ";
		// 	}
		// }
/*		if($tc_view !=''){
			$add_Qry .= " and tc_view = 'Y' ";
		}
		
*/		

				
		if($search_content) {			
			$add_Qry .= " AND (tc_title LIKE '%${search_content}%' || tc_content LIKE '%${search_content}%')";
			
		}	
		
		$qry = "
			select * from tblContent where $add_Qry order by tc_desc desc
		";

	
		$rst =  $this -> DB -> execSqlList($qry);
		return $rst;
    }
    
    function Con_count($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$add_Qry = " tc_view = 'Y' ";
		if($tc_cate){
			$add_Qry .= " and tc_cate like '%${tc_cate}%' and tc_cate_sub like '%${tc_cate_sub}%' ";
		}
		


				
		if($search_content) {			
			$add_Qry .= " AND (tc_title LIKE '%${search_content}%' || tc_content LIKE '%${search_content}%')";
			
		}	
		
		$qry = "
			select * from tblContent where $add_Qry order by tc_desc desc 
		";

	
		$rst =  $this -> DB -> execSqlList($qry);
		return $rst;
	}
	
	// desc	 : 컨텐츠 정보
	// auth  : JH 2013-09-16 월요일
	// param
	function Con_Info_B_A($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$arr_tmp = array();
		
		$addQry = "";
		
		if($tc_cate != '') {
			$addQry = " AND tc_cate='$tc_cate' ";
		}
		
		//이전글
		$qry = "
			select * from tblContent where tc_idx < '$tc_idx' $addQry order by tc_idx desc limit 0 , 1
		";
		$arr_tmp[0] = $this -> DB -> execSqlOneRow($qry);
		
		//다음글
		$qry1 = "
			select * from tblContent where tc_idx > '$tc_idx' $addQry order by tc_idx asc limit 0 , 1
		";
		$arr_tmp[1] = $this -> DB -> execSqlOneRow($qry1);
		return $arr_tmp;
	}
	
	// desc	 : 컨텐츠 정보
	// auth  : JH 2013-09-16 월요일
	// param
	function Con_Info($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			select * from tblContent where tc_idx = '$tc_idx'
		";
		$rst =  $this -> DB -> execSqlOneRow($qry);
		return $rst;
	}
	
	// desc	 : 컨텐츠 수정
	// auth  : JH 2013-09-13
	// param 
	function Con_Info_Modify($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			Update
				tblContent
			set			
				tc_cate = '$tc_cate',
				tc_cate_sub = '$tc_cate_sub',
				tc_user = '$tc_user',
				tc_auth = '$tc_auth',
				tc_size = '$tc_size',
				tc_s_size = '$tc_s_size',
				tc_noti = '$tc_noti',
				tc_main_view = '$tc_main_view',
                tc_title = '$tc_title',
                tc_subtitle = '$tc_subtitle',
				tc_summary = '$tc_summary',
				tc_content = '$tc_content',
				tc_hashtag = '$tc_hashtag',
				tc_link = '$tc_link',
				tc_file_code = '$tc_file_code',
				tc_file_code2 = '$tc_file_code2',
				tc_view = '$tc_view',
				tc_editor_img = '$tc_editor_img',
				tc_login = '$tc_login',
				tc_vd_view = '$tc_vd_view'
			where
				tc_idx='$tc_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	// desc	 : 컨텐츠 첨부 이미지 삭제
	// auth  : JH 2013-09-16 월요일
	// param
	function Con_ImgUpdate($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			Update
				tblContent
			set
				tc_file_code = ''
			where 
				tc_idx = '$tc_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}

	function Con_ImgUpdate2($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "
			Update
				tblContent
			set
				tc_file_code2 = ''
			where 
				tc_idx = '$tc_idx'
		";
		$rst =  $this -> DB -> execSqlUpdate($qry);
		return $rst;
	}
	
	// desc	 : 컨텐츠 등록
	// auth  : JH 2013-09-13
	// param 
	function Con_Reg($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$qry = "select tc_desc  from tblContent order by tc_desc desc limit 0, 1";
		$rst = $this -> DB -> execSqlOneRow($qry);		
		if($rst) {
			$tc_desc = $rst['tc_desc'] + 1;
		}else{
			$tc_desc = 1;
		}
		
		$qry = "
			INSERT INTO
				tblContent
				(
					tc_idx,
					tc_cate,
					tc_cate_sub,
					tc_user,
					tc_auth,
					tc_size,
					tc_s_size,
					tc_noti,
					tc_main_view,
                    tc_title,
                    tc_subtitle,
					tc_summary,
					tc_content,
					tc_hashtag,
					tc_link,
					tc_file_code,
					tc_file_code2,
					tc_desc,
					tc_editor_img,
					tc_view,
					tc_regdate,
					tc_login,
					tc_vd_view
				)
				VALUES
				(
					''
					, '$tc_cate'
					, '$tc_cate_sub'
					, '$tc_user'
					, '$tc_auth'
					, '$tc_size'
					, '$tc_s_size'
					, '$tc_noti'
					, '$tc_main_view'
                    , '$tc_title'
                    , '$tc_subtitle'
					, '$tc_summary'
					, '$tc_content'
					, '$tc_hashtag'
					, '$tc_link'
					, '$tc_file_code'		
					, '$tc_file_code2'		
					, '$tc_desc'
					, '$tc_editor_img'
					, '$tc_view'
					,  NOW()
					, '$tc_login'
					, '$tc_vd_view'
				)
            ";
            
            // echo "echo:" . $qry . "<br>" ;
            // exit;
		$rst =  $this -> DB -> execSqlInsert($qry);
		return $rst;
	}
	
	
	
	
	// desc	 : 컨텐츠 리스트
	// auth  : JH 2013-04-26
	// param 
	function Con_List($args) {
		global $C_Func;
		global $C_ListClass;

		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$tail = " ";
		
        //검색 기본 조건 설정 - 게시판 구분 코드
        if($tc_view == "Y"){
            $addQry = " 1 = 1  ";
        }
        else{
            $addQry = " tc_view = 'Y'  ";    
        }
		

		if($tc_cate != '') {
			$addQry .= " and tc_cate = '$tc_cate' ";
        }	
        if($tc_cate_sub != '') {
			$addQry .= " and tc_cate_sub = '$tc_cate_sub' ";
		}	
        
        if($search_content) {			
            $addQry .= " AND (tc_title LIKE '%${search_content}%' || tc_content LIKE '%${search_content}%')";
            //$addQry .= " AND (replace(tc_title,' ','') LIKE '%${search_content}%' || replace(tc_content,' ','')  LIKE '%${search_content}%')";
			
		}			
				
		if($search_key && $search_content) {
            $addQry .= " AND ${search_key} LIKE '%${search_content}%'";
            //$addQry .= " AND replace(${search_key},' ','')   LIKE '%${search_content}%'";
        }	
        
       	$args['search']			= array();
		$args['show_row']		= $show_row;
		$args['show_page']  	= 10;
		$args['q_idx']			= "tc_idx";
		$args['q_col']			= " * ";
		$args['q_table']		= "tblContent";
		$args['q_where']		= $addQry;
		$args['q_order'] 		= "tc_desc desc";
		$args['q_group']		= "";
		$args['tail']				= $tail;
        $args['q_see']			= "";
		return $C_ListClass -> listInfo($args);		
	}
	
	function Con_VD_List($args) {
		if (is_array($args)) foreach ($args as $k => $v) ${$k} = $v;
		
		$add_Qry = " tc_vd_view = 'Y' ";
	
		$qry = "
			select * from tblContent where $add_Qry order by tc_noti desc, tc_desc desc limit 0,1
		";
		
		$rst =  $this -> DB -> execSqlList($qry);
		return $rst;
	}
	
	
}
?>