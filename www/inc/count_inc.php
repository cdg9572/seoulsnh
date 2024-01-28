<?
	include_once $_SERVER['DOCUMENT_ROOT'] ."/_init.php";
	include_once($GP->CLS."class.analytics.php");
	$C_Analytics 	= new Analytics;
	
	//접속로그 체크 및 기록-------------------------------------------------------------------------------------------------------------->
	if(!$_COOKIE['new_connect'])
	{	
		setcookie('new_connect',$_SERVER['REMOTE_ADDR'],time()+86400);
		
		$referer = $_SERVER["HTTP_REFERER"];
		$connect_url = $referer;
		
		if (!$connect_url)
			$connect_url="-";		
		
		$cnt_year = date("Y");
		$cnt_month = date("m");
		$cnt_day = date("d");
		$connect_ip = $_SERVER['REMOTE_ADDR'];
		$connect_agent = $_SERVER['HTTP_USER_AGENT'];		
		
		$browser = $C_Func->ckBrowser();  //브라우저 정보
		$os = $C_Func->ckOs(); //OS 정보
		$bot = $C_Func->ckBot(); 
		$engine = $C_Func->ckEngine(); 
		
		$args = "";
		$args = array("cnt_year" => $cnt_year , "cnt_month" => $cnt_month , "cnt_day" => $cnt_day, "connect_ip" => $connect_ip ) ;  	
		$rst = $C_Analytics->Analytics_Check($args);
		$cnt_connect = $rst['cnt'];
		
		if($cnt_connect <= 0)	{
			$args = array( 
				"s_StatusIP" => $_SERVER['REMOTE_ADDR'],
				"s_StatusURL" => $_SERVER['PHP_SELF'],
				"s_StatusReferer" => $connect_url,
				"s_SearchBot" => $bot,
				"s_SearchEngine" => $engine,
				"s_Browser" => $browser,
				"s_OS" => $os,
				"s_Agent" => $_SERVER['HTTP_USER_AGENT']
			) ;  	
			$rst = $C_Analytics->Analytics_Insert($args);			
		}
	}
?>