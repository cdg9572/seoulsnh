$(function(){
	//TOP버튼 이벤트
	$("#quick-wrap .top").on("click",function(){
		$("html,body").animate({
			scrollTop:0
		},400);
	});
	// 퀵 이벤트
	$("#quick-wrap .quick-more").on("click",function(){
		$(".quick").slideToggle(200);
	});

	// 헤더 마우스온 이벤트
	var menuOn ='false';
	$("nav").on("mouseenter",function(){
		if($(window).width() >= 1330 && menuOn == 'false'){
			$("header").addClass('on');
			$(this).find('.snb').stop().slideDown(200, function(){
				if($(window).width()>1600){
					$(this).css('height','calc(100% - 86px)');
				}else{
					$(this).css('height','calc(100% - 56px)');
				}
			});
			menuOn = 'true';
		};
	});
	$("nav").on("mouseleave",function(){
		if($(window).width() >= 1330 && menuOn == 'true'){
			$("header").removeClass('on');
			$(this).find('.snb').stop().slideUp(200);
			menuOn = 'false';
		};
	});
	$("header #gnb>li>span").on("mouseenter",function(){
		if($(window).width() <= 1329){
			$(this).siblings().show();
			$(this).parents('li').siblings().find('.snb').hide();
		};
	});
	$("header #gnb>li").on("mouseleave",function(){
		if($(window).width() <= 1329){
			$(this).find('.snb').hide();
		};
	});
	$("header #gnb>li>span>a").on("click",function(){
		return false;
	});
	$("header .ham").on("click",function(){
		$("nav").addClass("on");
	});
	$("header .menu-close").on("click",function(){
		$("nav").removeClass("on");
	});

	// 하단 사이트맵 클론
	$(".footSitemap ul").append(
		$("#gnb > li").clone()
	);

	// 메인 뉴스 슬라이드
	var swiper = new Swiper('#main-news .swiper-container', {
		loop: true,
		pagination: {
			el: '#main-news .swiper-pagination'
		},
		speed: 1000,
		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
		},
		slidesPerView: 1,
		spaceBetween: 50,
		navigation: {
			nextEl: '#main-news .swiper-button-next',
			prevEl: '#main-news .swiper-button-prev',
		},
	});

	// 연혁 이미지 슬라이드
	var swiper = new Swiper('#history .slide1 .swiper-container', {
		loop: true,
		speed: 1000,
		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
		},
		slidesPerView: 1,
		spaceBetween: 20,
		pagination: {
			el: '#history .slide1 .swiper-container .swiper-pagination'
		},
	});
	var swiper = new Swiper('#history .slide2 .swiper-container', {
		loop: true,
		speed: 1000,
		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
		},
		slidesPerView: 1,
		spaceBetween: 20,
		pagination: {
			el: '#history .slide2 .swiper-container .swiper-pagination'
		},
	});
	var swiper = new Swiper('#history .slide3 .swiper-container', {
		loop: true,
		speed: 1000,
		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
		},
		slidesPerView: 1,
		spaceBetween: 20,
		pagination: {
			el: '#history .slide3 .swiper-container .swiper-pagination'
		},
	});
	var swiper = new Swiper('#history .slide4 .swiper-container', {
		loop: true,
		speed: 1000,
		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
		},
		slidesPerView: 1,
		spaceBetween: 20,
		pagination: {
			el: '#history .slide4 .swiper-container .swiper-pagination'
		},
	});
	var swiper = new Swiper('#history .slide5 .swiper-container', {
		loop: true,
		speed: 1000,
		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
		},
		slidesPerView: 1,
		spaceBetween: 20,
		pagination: {
			el: '#history .slide5 .swiper-container .swiper-pagination'
		},
	});


	// 로케이션
	var dep1Idx = $('body').data('dep1');
    var dep2Idx = $('body').data('dep2');
  
	if ($('#location').length > 0) {
		var dep1btn = $("#gnb > li").eq(dep1Idx).find('>span a').text();
		var dep2btn = $("#gnb > li").eq(dep1Idx).find('.snb>li').eq(dep2Idx).find('>a').text();
		var dep1menu = $("#gnb > li").clone();
		var dep2menu = $("#gnb > li").eq(dep1Idx).find('.snb > li').clone();
		$('#location .locDepth1 button').text(dep1btn);
		$('#location .locDepth1 ul').append(dep1menu);
		$('#location .locDepth2 button').text(dep2btn);
		$('#location .locDepth2 ul').append(dep2menu);
		$('#location .locDepth1 ul .snb').remove();
		$('#location .locDepth2 ul .snb-menu').remove();

		// $('#sub-menu' + dep2Idx).addClass('on').find('li').eq(dep3Idx).addClass('on');
	};

	//질문답변
	$(".accordion .item").on("click", function () {
		 if ($(this).hasClass("active")) {
			 $(this).removeClass("active").find('.collapsed').attr('title', '열기');
			 $(this).find('.collapse').slideUp(300);
		 } else {
			 $(this).addClass("active").siblings().removeClass("active").find('.collapse').slideUp(300);
			 $(this).find('.collapsed').attr('title', '닫기');
			 $(this).find('.collapse').slideDown(300);
		 }
     });

	// 모바일 비쥬얼배너
	if($(window).width()<=720){
		var subBnnrSrc = $("#sub-bnnr img").attr('src');
		var subBnnrSrcM= subBnnrSrc.replace(".jpg","-m.jpg");
		$("#sub-bnnr img").attr('src',subBnnrSrcM);
	}

	// 아이프레임 높이 조정
	var $iframe_h = $('.tableType-01 iframe, .tableType-01 video').width() * 0.562;
					$('.tableType-01 iframe, .tableType-01 video').height($iframe_h);
});