<?php
// Dedc : admin 메뉴 Array
// Writer :
$GP -> MENU_ADMIN = array(
		array("tab"=>"1",			"folder"=>"main", 			"name"=>"관리자정보",			"link"=> "/admin/main/adm_info.php?m_tab=1"),
        array("tab"=>"2",			"folder"=>"bbs", 			"name"=>"게시판관리",			"link"=> "/admin/bbs/bbs_list.php?m_tab=2"),        
        array("tab"=>"3",			"folder"=>"survey", 		"name"=>"기초조사 수행",			"link"=> "/admin/survey/survey_list.php?tm_type=A&m_tab=3"),       
        array("tab"=>"4",			"folder"=>"cooperation", 		"name"=>"협력연계",			"link"=> "/admin/cooperation/cooperation_list.php?tm_menu=clinic&m_tab=4"),       
        array("tab"=>"5",			"folder"=>"education", 		"name"=>"교육행사",			"link"=> "/admin/education/education_list.php?tm_menu=education&m_tab=5"),       
        array("tab"=>"6",			"folder"=>"organ", 		"name"=>"연계사이트",			"link"=> "/admin/organ/organ_list.php?tm_menu=organ&m_tab=6"),       
        array("tab"=>"7",			"folder"=>"slide", 			"name"=>"메인관리",			"link"=> "/admin/slide/slide_list.php?ts_type=A&m_tab=7"),
        array("tab"=>"8",			"folder"=>"popup", 			"name"=>"팝업관리",				"link"=> "/admin/popup/popup_list.php?m_tab=8"),          
        array("tab"=>"10",			"folder"=>"analytics", 		"name"=>"통계관리",				"link"=> "/admin/analytics/day_visit.php?m_tab=10")
		// array("tab"=>"3",			"folder"=>"doctor", 		"name"=>"의료진관리",			"link"=> "/admin/doctor/dr_list.php?m_tab=3"),			
		// array("tab"=>"4",			"folder"=>"member", 		"name"=>"회원관리",				"link"=> "/admin/member/mem_list.php?m_tab=4"),		
		// array("tab"=>"5",			"folder"=>"nonpay", 		"name"=>"비급여관리",			"link"=> "/admin/nonpay/nonpay_list.php?m_tab=5"),					
		//	array("tab"=>"8",			"folder"=>"online", 		"name"=>"예약관리",				"link"=> "/admin/online/online_reserve_list.php?m_tab=8"),
		// array("tab"=>"6",			"folder"=>"slide", 			"name"=>"슬라이드관리",			"link"=> "/admin/slide/slide_list.php?m_tab=6"),
		//	array("tab"=>"7",			"folder"=>"phone", 			"name"=>"간편예약관리",			"link"=> "/admin/phone/phone_list.php?m_tab=7"),
		//	array("tab"=>"9",			"folder"=>"sms", 			"name"=>"SMS관리",				"link"=> "/admin/sms/sms_send.php?m_tab=9"),
         
        
        // array("tab"=>"11",			"folder"=>"conversion", 	"name"=>"전환율",				"link"=> "/admin/conversion/location.php?m_tab=11")
);


$GP -> MENU_SUB_ADMIN = array();

$GP -> MENU_SUB_ADMIN['main'] = array(
	"시스템관리"   => array(
		array("tab"=>"1",		"title"=>"main1",		"name"=>"관리자 정보",		"link"=>  "/admin/main/adm_info.php"),
		array("tab"=>"2",		"title"=>"main2",		"name"=>"권한 정보",			"link"=>  "/admin/main/adm_auth.php"),
	)
);

$GP -> MENU_SUB_ADMIN['bbs'] = array(
	"게시판관리"   => array(
		array("tab"=>"1",		"title"=>"bbs1",		"name"=>"게시판 리스트",				"link"=>  "/admin/bbs/bbs_list.php"),
	)
);

$GP -> MENU_SUB_ADMIN['doctor'] = array(
	"의료진관리"   => array(
		array("tab"=>"1",	"title"=>"doctor1", "name"=>"의료진 정보",			"link"=>  "/admin/doctor/dr_list.php"),
	)
);

$GP -> MENU_SUB_ADMIN['member'] = array(
	"회원관리"   => array(
		array("tab"=>"1",	"title"=>"member1",		"name"=>"회원 리스트",							"link"=>  "/admin/member/mem_list.php"),
		array("tab"=>"2",	"title"=>"member2",		"name"=>"탈퇴회원 리스트",						"link"=>  "/admin/member/mem_out_list.php"),
			array("tab"=>"3",	"title"=>"member3",		"name"=>"휴면계정 발송전 리스트",				"link"=>  "/admin/member/mem_hu_list.php"),
		array("tab"=>"4",	"title"=>"member4",		"name"=>"휴면계정 발송후 리스트",				"link"=>  "/admin/member/mem_hu_end_list.php"),

	)
);

$GP -> MENU_SUB_ADMIN['survey'] = array(
	"기초조사 수행"   => array(
        array("tab"=>"1",	"title"=>"survey1", "name"=>"연도별 연구보고서 신청",			"link"=>  "/admin/survey/survey_list.php?tm_type=A"),   
        array("tab"=>"2",	"title"=>"survey2", "name"=>"정기 간행물",		"link"=>  "/admin/survey/survey_list.php?tm_type=B"),   
	)
);

$GP -> MENU_SUB_ADMIN['cooperation'] = array(
	"협력연계"   => array(
        array("tab"=>"1",	"title"=>"cooperation1", "name"=>"서남동행진료 신청",			"link"=>  "/admin/cooperation/cooperation_list.php?tm_menu=clinic"),   
        array("tab"=>"2",	"title"=>"cooperation2", "name"=>"감염관리 컨설팅 신청",		"link"=>  "/admin/cooperation/consulting_list.php?tm_menu=consulting"),   
	)
);

$GP -> MENU_SUB_ADMIN['education'] = array(
	"교육행사"   => array(
        array("tab"=>"1",	"title"=>"education1", "name"=>"교육행사 신청",			"link"=>  "/admin/education/education_list.php?tm_menu=education"),   
	)
);

$GP -> MENU_SUB_ADMIN['organ'] = array(
	"연계사이트"   => array(
        array("tab"=>"1",	"title"=>"organ1", "name"=>"협력기관",			"link"=>  "/admin/organ/organ_list.php?tm_menu=organ"),   
	)
);

$GP -> MENU_SUB_ADMIN['slide'] = array(
	"메인관리"   => array(
        array("tab"=>"1",	"title"=>"slide1",		"name"=>"news",			"link"=>  "/admin/slide/slide_list.php?ts_type=A"),     
        array("tab"=>"2",	"title"=>"slide2",		"name"=>"병원소식",			"link"=>  "/admin/slide/slide_list.php?ts_type=B"),
	)
);

$GP -> MENU_SUB_ADMIN['nonpay'] = array(
	"비급여관리"   => array(
	  array("tab"=>"1",		"title"=>"nonpay1",		"name"=>"비급여 리스트",			"link"=>  "/admin/nonpay/nonpay_list.php"),		
	)
);

$GP -> MENU_SUB_ADMIN['online'] = array(
	"예약관리"   => array(		
			array("tab"=>"1",	"title"=>"online1",		"name"=>"예약 리스트",				"link"=>  "/admin/online/online_reserve_list.php"),
		array("tab"=>"2",	"title"=>"online2",		"name"=>"전체 일정",				"link"=>  "/admin/online/m_sch_list.php"),
		array("tab"=>"3",	"title"=>"online3",		"name"=>"일일 일정",				"link"=>  "/admin/online/d_sch_list.php"),
		array("tab"=>"4",	"title"=>"online4",		"name"=>"휴무일관리",			"link"=>  "/admin/online/holiday_list.php"),
	)
);

$GP -> MENU_SUB_ADMIN['phone'] = array(
	"간편예약관리"   => array(
		array("tab"=>"1",	"title"=>"phone1",	"name"=>"간편예약",			"link"=>  "/admin/phone/phone_list.php"),
	)
);

$GP -> MENU_SUB_ADMIN['popup'] = array(
	"팝업관리"   => array(
		array("tab"=>"1",	"title"=>"popup1",		"name"=>"팝업 리스트",				"link"=>  "/admin/popup/popup_list.php"),
		array("tab"=>"2",	"title"=>"popup2",		"name"=>"팝업 정렬",				"link"=>  "/admin/popup/popup_order.php"),        
	)
);

$GP -> MENU_SUB_ADMIN['sms'] = array(
	"SMS관리"   => array(
		array("tab"=>"1",	"title"=>"sms1",	"name"=>"SMS 발송",					"link"=>  "/admin/sms/sms_send.php"),										 	
		array("tab"=>"3",	"title"=>"sms3",	"name"=>"SMS 발송리스트",		"link"=>  "/admin/sms/sms_send_list.php"),
	)
);


$GP -> MENU_SUB_ADMIN['analytics'] = array(
	"통계관리"   => array(	
		array("tab"=>"1",	"title"=>"analytics2",	"name"=>"일별 통계",				"link"=>  "/admin/analytics/day_visit.php"),
		array("tab"=>"2",	"title"=>"analytics3",	"name"=>"월별 통계",				"link"=>  "/admin/analytics/month_visit.php"),
		array("tab"=>"3",	"title"=>"analytics4",	"name"=>"년별 통계",				"link"=>  "/admin/analytics/year_visit.php"),		
		array("tab"=>"4",	"title"=>"analytics5",	"name"=>"Agent 통계",				"link"=>  "/admin/analytics/Agent.php"),
		array("tab"=>"5",	"title"=>"analytics6",	"name"=>"기타 통계",				"link"=>  "/admin/analytics/OS.php"),
	)
);

$GP -> MENU_SUB_ADMIN['conversion'] = array(
	"전환율"   => array(	
		array("tab"=>"1",	"title"=>"conversion1",	"name"=>"찾아오시는 길",				"link"=>  "/admin/conversion/location.php"),
		array("tab"=>"2",	"title"=>"conversion2",	"name"=>"전화 연결",				"link"=>  "/admin/conversion/call.php"),
		array("tab"=>"3",	"title"=>"conversion3",	"name"=>"카카오톡 연결",				"link"=>  "/admin/conversion/kakao.php"),		
		array("tab"=>"4",	"title"=>"conversion4",	"name"=>"월별통계",				"link"=>  "/admin/conversion/conversion_month.php"),	
        array("tab"=>"5",	"title"=>"conversion5",	"name"=>"년별통계",				"link"=>  "/admin/conversion/conversion_year.php"),			
	
	)
);


?>