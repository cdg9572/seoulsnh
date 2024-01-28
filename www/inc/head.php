<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="Title" content="서남동행 - 서울특별시 서남병원 공공의료본부">
	<!-- <meta name="Subject" content=""> -->
	<!-- <meta name="description" content=""> -->
	<title>서남동행 - 서울특별시 서남병원 공공의료본부</title>
	<!-- meta -->
	<meta property="og:url" content="https://phs.seoulsnh.or.kr/">
	<meta property="og:title" content="서남동행 - 서울특별시 서남병원 공공의료본부">
	<meta property="og:type" content="website">
	<meta property="og:image" content="/resource/images/link-img.jpg?v=0.1">
	<!-- <meta property="og:description" content=""> -->
	<link rel="stylesheet" href="/resource/css/reset.css?v=0.0">
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"> -->
	<link rel="stylesheet" type="text/css" href="/resource/css/jquery_ui.css" media="all" />
	<link rel="stylesheet" href="/resource/css/style.css?v=0.0">
	<link rel="stylesheet" href="/resource/css/board.css">
	<link rel="stylesheet" href="/resource/css/board_v2.css">
	<?php
		$mobile_agent = "/(iPod|iPhone|Android|BlackBerry|SymbianOS|SCH-M\d+|Opera Mini|Windows CE|Nokia|SonyEricsson|webOS|PalmOS)/";
		if(preg_match($mobile_agent, $_SERVER['HTTP_USER_AGENT'])){
	?>
		<link rel="stylesheet" href="/resource/css/mobile.css?v=0.0">
		<meta name="viewport" content="width=720px">
	<?php
		}else{
	?>
		<meta name="viewport" content="width=1024px">
	<?php
		};
	?>
	<link rel="stylesheet" href="/resource/css/swiper.min.css">
	<script src="/resource/js/jquery-1.12.2.min.js"></script>
	<script src="/resource/js/jquery-ui-1.10.3.js"></script>
	<script src="/resource/js/function.js"></script>
	<script src="/resource/js/swiper.min.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
</head>