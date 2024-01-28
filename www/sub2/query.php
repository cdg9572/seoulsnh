<?php
include ($_SERVER['DOCUMENT_ROOT'] . "/_init.php");

$jb_code = $_GET["jb_code"];

switch ($jb_code)
{		
	case "10" :
		$index_page = "page04-01.html";  	//공지사항
		break;
		
	case "20" :
		$index_page = "page04-02.html";  	//전문의상담
		break;
	
	default :
		$index_page = "page04-01.html";	// 
		break;
}

$query_page = "query.php";

include $GP -> INC_PATH . "/board_insert.php";
?>