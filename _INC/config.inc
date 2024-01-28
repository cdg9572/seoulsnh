<?php
// HEADER
@header("Content-Type: text/html; charset=utf-8");
@header("Cache-Control: no-cache, must-revalidate");
@header("Pragma: no-cache");
@header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');
//@Header("Access-Control-Allow-Origin: [http://www.seoulsnh.mediinside.net]");
@Header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
@header("Access-Control-Allow-Headers: X-Requested-With, X-Prototype-Version");
@session_start();



@ini_set("session.cache_expire",86400);
@ini_set("session.gc_maxlifetime",86400);


class BaseObject {};
$GP = new BaseObject;

////////////////////////////////////////////////////////////////
//# Path config
////////////////////////////////////////////////////////////////
// default include path
$GP -> DOCROOT	= $_DEF_PATH;
$GP -> WEBROOT 		= '/';
$GP -> ROOT 		= $GP -> DOCROOT . $GP -> WEBROOT;

$GP -> CLS			= $GP -> ROOT . '_CLASS/';
$GP -> INC			= $GP -> ROOT . '_INC/';
$GP -> COM			= $GP -> ROOT . '_COMMON/';
$GP -> HOME		= $GP -> ROOT . 'www/';

$GP -> IP				= $_SERVER['SERVER_ADDR'];
$GP -> DOMAIN			= $_SERVER['HTTP_HOST'];
$GP -> SERVICE_DOMAIN		= 'http://seoulsnh.mediinside.net/';
$GP -> HTTPS			= 'http://seoulsnh.mediinside.net/';
$GP -> HTTP			= 'http://' . $GP -> DOMAIN;
$GP -> HTTPS_PORT		= 46541;

$GP -> QUERY_STRING = $_SERVER['QUERY_STRING'];
$GP -> SELFPAGE 		= $_SERVER['PHP_SELF'];
$GP -> NOWPAGE 		= $GP -> SELFPAGE . '?' . $_SERVER['QUERY_STRING'];
$GP -> NOWPAGE_ENC 	= urlencode($GP -> NOWPAGE);

$GP -> INC_ADM = $GP -> HOME ."admin/";
$GP -> INC_ADM_PATH = $GP -> HOME ."admin/inc/";



$GP -> INC_WWW	= $GP -> HOME ."inc";
$GP -> INC_PATH = $GP -> HOME . "bbs";
$GP -> IMG_PATH = $GP -> HTTP . "/bbs";
$GP -> IMGS_PATH = $GP -> HTTPS . "/bbs";
$GP -> JS_SMART_PATH = $GP -> HTTP . "/bbs/smarteditor/js";
$GP -> JS_PATH = $GP -> HTTP . "/js";
$GP -> INC_JS_PATH = $GP -> HTTP ."/admin/js";

## 스마트에디터 업로드 경로
$GP -> UP_IMG_SMARTEDITOR = $GP -> HOME . 'bbs/files/';
$GP -> UP_IMG_SMARTEDITOR_URL = $GP -> HTTP . '/bbs/files/';

## 팝업 링크
$GP -> UP_POPUP					= $GP -> HOME . 'common/popup/';
$GP -> UP_POPUP_URL			= $GP -> HTTP . '/common/popup/';

## 파트너사 링크
$GP -> UP_PARTNER					= $GP -> HOME . 'common/partner/';
$GP -> UP_PARTNER_URL			= $GP -> HTTP . '/common/partner/';


## 의료진 관련
$GP -> UP_DOCTOR			= $GP -> HOME . 'common/doctor/';
$GP -> UP_DOCTOR_URL			= $GP -> HTTP . '/common/doctor/';

## 의료진 관련
$GP -> UP_CLINIC			= $GP -> HOME . 'common/clinic/';
$GP -> UP_CLINIC_URL			= $GP -> HTTP . '/common/clinic/';


## 저서 및 논문
$GP -> UP_BOOK				= $GP -> HOME . 'common/book/';
$GP -> UP_BOOK_URL			= $GP -> HTTP . '/common/book/';


##
$GP -> UP_TREAT				= $GP -> HOME . 'common/treat/';
$GP -> UP_TREAT_URL			= $GP -> HTTP . '/common/treat/';

##  슬라이드
$GP -> UP_SLIDE				= $GP -> HOME . 'common/slide/';
$GP -> UP_SLIDE_URL			= $GP -> HTTP . '/common/slide/';


##  입사지원
$GP -> UP_RECRUIT				= $GP -> HOME . 'common/recruit/';
$GP -> UP_RECRUIT_URL			= $GP -> HTTP . '/common/recruit/';

## 상담신청
$GP -> UP_CS = $GP -> HOME . 'common/customer/';
$GP -> UP_CS_URL = $GP -> HTTP . '/common/customer/';

## 고충처리
$GP -> UP_CS_GR = $GP -> HOME . 'common/grievance/';
$GP -> UP_CS_GR_URL = $GP -> HTTP . '/common/grievance/';

##  협력기관
$GP -> UP_cooperative				= $GP -> HOME . 'common/cooperative/';
$GP -> UP_cooperative_URL			= $GP -> HTTP . '/common/cooperative/';

## 후원신청
$GP -> UP_donation				= $GP -> HOME . 'common/donation/';
$GP -> UP_donation_URL			= $GP -> HTTP . '/common/donation/';

##  멀티게시판
$GP -> UP_multi				= $GP -> HOME . 'common/multi/';
$GP -> UP_multi_URL			= $GP -> HTTP . '/common/multi/';

## 온라인문의 관련 업로드 폴더
$GP -> UP_ONLINE			= $GP -> HOME . 'common/online/';
$GP -> UP_ONLINE_URL		= $GP -> HTTP . '/common/online/';

$GP->DB_TABLE = "domain";


////////////////////////////////////////////////////////////////
//# Load class
////////////////////////////////////////////////////////////////
// 기본 함수
include_once $GP -> CLS . 'class.func.php';
$C_Func 		= new Func;

////////////////////////////////////////////////////////////////
//# Database config
////////////////////////////////////////////////////////////////
include_once $GP -> INC . 'db.inc';


////////////////////////////////////////////////////////////////
//# sms config
////////////////////////////////////////////////////////////////
$GP -> SMS_ID = 'otta';
$GP -> SMS_AUTH_KEY ='ee966b7c67a48f2727d502d1fcd16d4c';


////////////////////////////////////////////////////////////////
//# Admin config
////////////////////////////////////////////////////////////////
$GP -> Admin_Email = "domainpex@gmail.com";
$GP -> Admin_Phone = "02-1111-2222";
$GP -> Admin_Name = "관리자";
$GP -> Admin_HP_NAME = "서남병원";
$GP -> Admin_HP_NAME1 = "서남병원";
$GP -> Admin_BizNum = "02-1111-2222";
$GP -> SMS_HP1 = "010"; //병원 번호로 변경해야함.
$GP -> SMS_HP2 = "1111";
$GP -> SMS_HP3 = "2222";

$GP -> HOME_MAIN_ADDRESS = " 서울특별시";

////////////////////////////////////////////////////////////////
//# SMTP config
////////////////////////////////////////////////////////////////
$GP -> SMTP_USE 		= true;
$GP -> SMTP_SERVER  	= 'mail.mediinside.com';
$GP -> SMTP_IP			= '211.115.222.194';
$GP -> SMTP_PORT		= '25';
$GP -> SMTP_USER		= 'mediinside@mediinside.com';
$GP -> SMTP_PASS		= '10#MEdi20!^';

////////////////////////////////////////////////////////////////
//# Pass config
////////////////////////////////////////////////////////////////
$GP -> PASS = 'ka-100';

////////////////////////////////////////////////////////////////
//# NAVER config
////////////////////////////////////////////////////////////////
$GP -> NAVER_CLIENT_ID = 'NAVER_CLIENT_ID';
$GP -> NAVER_CLIENT_SECRET = 'NAVER_CLIENT_SECRET';
$GP -> NAVER_RETURN_URL = 'http://seoulsnh.mediinside.net/member/proc/login_proc.html?mode=naver';

////////////////////////////////////////////////////////////////
//# 권한 설정
////////////////////////////////////////////////////////////////
$GP -> AUTH_LEVEL	 = array(
						"9" => "최고 관리자"
						, "8" => "테스트"
						, "7" => "관리자"
						, "6" => "총무과"
						, "5" => "매니져"
					);

$GP -> BOARD_CONFIG_LEVEL	 = array(
						"0" => "비회원"
						, "3" => "회원"
						, "5" => "매니져"
						, "7" => "관리자"
						, "9" => "최고 관리자"
					);
$GP -> BOARD_TYPE	 = array(
						  "160" => "논문"
						//, "170" => "출판논문"
						, "50" => "학회활동"
					);

$GP -> MEMBER_CONFIG_LEVEL	 = array(
						 "3" => "회원"
						, "5" => "병원관계자"
					);

$GP -> MEM_SEX	 = array(
						"M" => "남"
						, "F" => "여"
					);

$GP -> RESERVE_CL_TYPE	 = array(
						"1" => "초진"
						, "2" => "재진"
					);


$GP -> QNA_RESULT	 = array(
						"N" => "미처리"
						, "M" => "처리중"
						, "Y" => "처리완료"
					);

$GP -> QNA_USER_TYPE	 = array(
						"M" => "회원"
						, "G" => "비회원"
					);

$GP -> RESERVE_RESULT	 = array(
						"N" => "예약신청"
						, "M" => "처리중"
						, "Y" => "예약완료"
						, "C" => "예약취소"
						, "P" => "(전화)부재중"
					);

$GP -> RESULT_TYPE	 = array(
						"A" => "접수"
						, "B" => "확인중"
						, "C" => "완료"
					);

$GP -> ORGAN1_TYPE	 = array(
						"의료기관" => "의료기관"
						, "국가기관" => "국가기관"
						, "사회복지기관" => "사회복지기관"
                        , "장애인복지시설" => "장애인복지시설"
                        , "공립특수학교" => "공립특수학교"
                        , "지역장애인보건의료센터" => "지역장애인보건의료센터"
					);
$GP -> ORGAN2_TYPE	 = array(
						"양천구" => "양천구"
                        , "강서구" => "강서구"
                        , "구로구" => "구로구"						
						, "금천구" => "금천구"
                        , "영등포구" => "영등포구"                        
                        , "기타" => "기타"
					);                    
//진료과목
$GP -> CENTER_TYPE = array(
				'A' => '건강검진센터',
				'B' => '소화기내시경센터',
				'H' => '산부인과',

			);

//진료과
$GP -> CLINIC_TYPE = array(
				'A' => '산부인과',
				'B' => '외과',
				'C' => '가정의학과',
				'D' => '비뇨의학과',
				'E' => '영상의학과',
				'F' => '소화기내과',
				'G' => '성형외과',
				'H' => '헬시에이징',
				'I' => '건강검진센터',
				'J' => '소화기내시경센터',
			);

//의료진 직책
$GP -> DOCTOR_POSITION = array(
				'A' => '병원장',
				'B' => '부원장',
				'C' => '진료부장',
				'D' => '진료과장',
			);

//의료진 학위
$GP -> DOCTOR_THESIS = array(
				'A' => '의학석사',
				'B' => '의학박사',
				'C' => '교수',
			);

//슬라이드 타입
$GP -> SLIDE_position = array(
				'L' => '왼쪽 슬라이드',
				'R' => '오른쪽 슬라이드',
                'C' => '메인 슬라이드',
                'B' => '메인 탑 배너',
                'E' => '국제협력사업',
                'Q' => '퀵배너',
			);


$GP -> DOCTOR_SCH = array(
				'1' => '외래진료',
				'2' => '특수클리닉',
			);

$GP -> DOCTOR_SCH_SHOW = array(
				'1' => '<span class="diag">외래진료</span>',
				'2' => '<span class="diag">특수클리닉</span>',
			);

$GP -> DOCTOR_SCH_SHOW1 = array(
				'1' => '<span class="sc1">진료</span>',
				'2' => '<span></span>',
				'3' => '<span class="sc2">시술</span>',
				'4' => '<span class="sc3">검진</span>',
				'5' => '<span class="sc4">수술</span>',
				'' => '<span></span>',
			);
$GP -> DOCTOR_SCH_SHOW2 = array(
				'1' => '진료',
				'2' => '-',
				'3' => '시술',
				'4' => '검진',
				'5' => '수술',
			);

$GP -> donation_TYPE = array(
				'A' => '수입',
				'B' => '지출',
			);
$GP -> donation_TYPE2 = array(
				'A' => '유튜브',
				'B' => '왼쪽배너',
                'C' => '오른쪽배너',
			);
$GP -> donation_TYPE3 = array(
				'A' => '개인',
				'B' => '기업/단체',
                'C' => '물품',
			);
//방송, 저서, 논문
$GP -> DOCTOR_PUBLISH = array(
				'A' => '방송출연 및 자문',
				'B' => '저서',
				'C' => '논문'
			);


//공지사항타입
$GP -> NOTICE_TYPE = array(
				'A' => '병원소식',
				'B' => '연구활동',
				'C' => '이벤트',
			);
$GP -> SNS_TYPE = array(
				'A' => '유튜브',
				'B' => '인스타그램',
				'C' => '페이스북',
                'D' => '트위터',
                'E' => '블로그',
			);

$GP -> CUSTOMER_TYPE = array(
				'A' => '칭찬',
				'B' => '민원',

			);

$GP -> employment_TYPE = array(
				'A' => '채용중',
				'B' => '채용마감',

			);
$GP -> jb_TYPE = array(
                '' => '전체',
				'A' => '보건의료기관 종사자',
				'B' => '환자 · 보호자',
                'C' => '공통',
                'D' => '기타',
			);       
$GP -> jb_sub_TYPE = array(
                '' => '전체',
				'A' => '교육',
				'B' => '행사',
			);       
$GP -> hour_TYPE = array(
                '00' => '00',
				'09' => '09',
                '10' => '10',
                '11' => '11',
                '12' => '12',
                '13' => '13',
                '14' => '14',
                '15' => '15',
                '16' => '16',
                '17' => '17',
                '18' => '18',
                '19' => '19',
                '20' => '20',
                '21' => '21',
                '22' => '22',
                '23' => '23',
                '24' => '24',
			);  
$GP -> minute_TYPE = array(
				'00' => '00',
                '10' => '10',
                '20' => '20',
                '30' => '30',
                '40' => '40',
                '50' => '50',

			);  
$GP -> jb_etc16_TYPE = array(
                '' => '전체',
			    'A' => '신청가능',
				'B' => '신청마감',
                'C' => '종료',               

			);                          
//공지사항타입
$GP -> TIME_TYPE = array(
				'AM' => '오전',
				'PM' => '오후',
			);

//FAQ
$GP -> FAQ_TYPE = array(
				'' => 'ALL',
				'A' => '척추',
				'B' => '관절',
				'C' => '기타'
			);

//이용문의 신청
$GP -> COUNSEL_TPYE = array(
				'A' => '메인',
				'B' => '모바일',
			);




//요일 정보
$GP -> GL_WEEK_INFO = array (
    			"sun" => "일",
                        "mon" => "월",
                        "tue" => "화",
                        "wed" => "수",
                        "thu" => "목",
                        "fri" => "금",
                        "sat" => "토"
                    );

//전화번호 기본 입력(휴대폰만)
$GP -> MOBILE =
		array(
			"010" => "010"
			, "011" => "011"
			, "016" => "016"
			, "017" => "017"
			, "018" => "018"
			, "019" => "019"
		);

//전화번호 기본 입력(휴대폰포함)
$GP -> TELEPHONE =
			array(
				"02" => "02"
				, "031" => "031"
				, "032" => "032"
				, "033" => "033"
				, "041" => "041"
				, "042" => "042"
				, "043" => "043"
				, "051" => "051"
				, "052" => "052"
				, "053" => "053"
				, "054" => "054"
				, "055" => "055"
				, "061" => "061"
				, "062" => "062"
				, "063" => "063"
				, "064" => "064"
				, "070" => "070"
				, "080" => "080"
				, "0505" => "0505"
				, "1544" => "1544"
				, "1566" => "1566"
				, "1577" => "1577"
				, "1588" => "1588"
				, "1599" => "1599"
				, "1577" => "1577"
			);


/************************************************/
/*          이메일 정보                         */
/************************************************/
$GP -> EMAIL =
		array (
				'hanmail.net' => '다음(한메일)'
				, 'naver.com' => '네이버'
				, 'nate.com' => '네이트'			
				, 'hotmail.com' => '핫메일'
				, 'gmail.com' => '구글'
				, 'msn.com' => 'MSN'
		);



//대분류
$GP -> CATE_TYPE1 = array(
				'' => '전체',
				'A' => '검사',
				'B' => '서류비용',
				'C' => '선택료',
				'D' => '약제',
				'E' => '예방접종',
				'F' => '입원/병실',
				'G' => '처치 및 수술',
				'H' => '체열진단',
				'I' => '초음파',
				'J' => '치료재료',
				'K' => 'MRI',
			);


// 예약간격 구분
$GP -> RESERVE_INTERVAL_TYPE	 = array(
						// "15" => "15분",
						"30" => "30분",
						"60" => "1시간"
					);


//페이지통계 잡을 곳
$GP->PAGE_TYPE = array(
				'/doctor/doctor_list.html' => array(
										'0' => 'DL',
										'1'=>'의료진소개'
									),
				'/hosp/hosp01.html' => array(
									'0' => 'RS',
									'1'=>'온라인예약'
									),
			);



//대분류
$GP -> NONPAY_CATE_TYPE1 = array(
				'1' => '행위',
				'2' => '치료재료',
				'3' => '약제',
				'4' => '제증명수수료',
				// '5' => '선택진료료(비율)',
				// '6' => '선택진료료(비용예시)'
			);

//중분류
$GP -> NONPAY_CATE_TYPE1_1 = array(
				'1' => '제1장 기본진료료',
				'2' => '      1-1장 상급병실료 차액',
				'3' => '제2장 검사료',
				'4' => '      2-1장 초음파검사료',
				'5' => '제3장 영상진단 및 방사선 치료료',
				'6' => '    3-1장 초음파 영상료',
				'7' => '    3-2장 자기공명영상진단료(MRI)',
				'8' => '    3-3장 양전자단층촬영료(PET) ',
				'9' => '제5장 주사료',
				'10' => '제6장 마취료',
				'11' => '제7장 이학요법료(물리치료료)',
				'12' => '제8장 정신요법료',
				'13' => '제9장 처치 및 수술료 등',
				'99' => '기타',
			);
//포함 여부
$GP -> NONPAY_YN = array(
				'Y' => '포함',
				'N' => '미포함',
				// '5' => '선택진료료(비율)',
				// '6' => '선택진료료(비용예시)'
			);


$GP-> WEB_TITLE = "서남병원";
$GP-> ADM_TITLE = "서남병원 관리자 페이지";

$GP->FACE_CAPTION = "서남병원";

?>
