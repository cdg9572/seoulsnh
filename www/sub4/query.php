<?php
include ($_SERVER['DOCUMENT_ROOT'] . "/_init.php");

$jb_code = $_GET["jb_code"];

switch ($jb_code)
{		
	case "30" :
		$index_page = "page01.html";  	//공지사항
		break;	
	default :
		$index_page = "page01.html";
		break;
}

$query_page = "query.php";

include $GP -> INC_PATH . "/board_insert.php";
?>