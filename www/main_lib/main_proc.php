<?
    include_once($GP -> CLS."class.jhboard.php");
    include_once($GP -> CLS."class.slide.php");
    include_once($GP -> CLS."class.multi.php");
    $C_JHBoard = new JHBoard();
    $C_Slide = new Slide();
    $C_Multi = new Multi();


    //Check Mobile
    $mAgent = array("iPhone","iPod","Android","Blackberry",
    "Opera Mini", "Windows ce", "Nokia", "sony" );
    $chkMobile = "PC";
    for($i=0; $i<sizeof($mAgent); $i++){
    if(stripos( $_SERVER['HTTP_USER_AGENT'], $mAgent[$i] )){
        $chkMobile = "mobile";
        break;
        }
    }

    
	// 공지사항/언론보도/채용정보
	function Main_Notice($jb_code) {
		global $GP, $C_JHBoard, $C_Func;

        $args = '';
        $args = array("jb_code" => $jb_code , "limit" => "limit 0,4 ");	    		
		$rst = $C_JHBoard->Board_Main_Data($args);
		$GP -> MEMBER_CONFIG_LEVEL[$mb_level];
		$args['mb_level'] = "5";

		$str = "";
		for($i=0; $i<count($rst); $i++) {
			$jb_idx					= $rst[$i]['jb_idx'];
			$jb_code				= $rst[$i]['jb_code'];
			$jb_title 			= $C_Func->strcut_utf8($rst[$i]['jb_title'], 100, true);
			$jb_reg_date 		= date("Y.m.d", strtotime($rst[$i]['jb_reg_date']));
            $jb_etc2 		= date("Y.m.d", strtotime($rst[$i]['jb_etc2']));
            $jb_etc3				= $rst[$i]['jb_etc3'];
            $jb_content			= $C_Func->dec_contents_edit($rst[$i]['jb_content']);
            $jb_content         = str_replace("&nbsp;"," ",$jb_content); 
            $jb_content			= trim(strip_tags($jb_content));
            $jb_content 		= $C_Func->strcut_utf8($jb_content, 230, true, "..");
            
            $url = "/notice/page.php?&jb_mode=tdetail&jb_code=" . $jb_code . "&jb_idx=" . $jb_idx;


			$str .= '
            <li>
                <a href="'.$url.'">' . $jb_title .'</a>
                <span class="date">'.$jb_reg_date  .'</span>
            </li>		
			';
		}
		return $str;
    }
    
    //메인 슬라이드
	function Main_Slide($type,$chkMobile,$lang) {
		global $GP, $C_Slide, $C_Func;

        $args = '';
        $args = array("order" => 'ts_idx asc', "ts_type" => $type, "limit" => "limit 0,4 ");	   
	
		$rst = $C_Slide->Main_Slide_Show($args);


		for($i=0; $i<count($rst); $i++) {
			$ts_title      = nl2Br($rst[$i]['ts_title']);
			$ts_descrition = $rst[$i]['ts_descrition'];
            $ts_link       = $rst[$i]['ts_link'];
            $ts_idx       = $rst[$i]['ts_idx'];
			$ts_content    = nl2Br($rst[$i]['ts_content']);
			$ts_img        = $rst[$i]['ts_img'];
			$ts_m_img      = $rst[$i]['ts_m_img'];
            $ts_type       = $rst[$i]['ts_type'];
            $ts_regdate       = date("Y.m.d", strtotime($rst[$i]['ts_regdate']));
            
            
			$b_img = '';
           
            // if($chkMobile == "PC"){$c_img = $GP -> UP_SLIDE_URL . $ts_img;}
            // else{$c_img = $GP -> UP_SLIDE_URL . $ts_m_img;}

            $b_img = $GP -> UP_SLIDE_URL . $ts_img;

            if (!$ts_link) {
                $ts_link =  '<a href="#none">';
            }
            else{
                $ts_link =  '<a href=" '.  $ts_link .'" target="_blank">';
            }

            if($ts_type == "A"){
                $str .= '      
                    <li class="swiper-slide">
                        <a href="#none">
                        
                            <div class="text">
                                <span>News</span>
                                <h2>
                                '.  $ts_title .'
                                </h2>
                                <p>
                                '.  $ts_content .'
                                </p>
                            </div>
                            <div class="img"><img src="'.  $b_img .'" alt=""></div>
                        </a>
                    </li>
                    ';
            }
            else if($ts_type == "B"){
                $str .= '      
                    '.  $ts_link .'
                        <p>
                        '.  $ts_title .'
                        </p>
                        <span>
                        '.  $ts_content .'
                        </span>                       
                    </a>
                    ';

            }
           
		}
		return $str;
	}



    //메인 슬라이드
	function Multi_Slide($tm_menu,$tm_type) {
		global $GP, $C_Multi, $C_Func;
      
        $args = array("tm_menu" => $tm_menu,"tm_type" => $tm_type);	  
        $rst = $C_Multi->Main_Multi_Show($args);
        
       	for($i=0; $i<count($rst); $i++) {
			$tm_title      = nl2Br($rst[$i]['tm_title']);			
            $tm_idx       = $rst[$i]['tm_idx'];
            $tm_type       = $rst[$i]['tm_type'];
            $tm_content1    = nl2Br($rst[$i]['tm_content1']);
            $tm_content2    = nl2Br($rst[$i]['tm_content2']);
			 $tm_img        = $rst[$i]['tm_img'];
			// $tm_m_img      = $rst[$i]['tm_m_img'];
			
			$b_img = '';                  

            $b_img = $GP -> UP_multi_URL . $tm_img;            

            $str .= '      
                    <li>
						<div>
							<img src="'.  $b_img .'" alt="">
							<a href="'.  $tm_content2 .'" class="text" target="_blank">
								<div>
									<p>Renewal Project</p>
									<h3>
                                      '.  $tm_content1 .'
									</h3>
									<span>Web / Media / On-Off MKT / Photography</span>
								</div>
							</a>
						</div>
					</li>
                    ';
		}
		return $str;
	}




	// 재활치료 영상
	function Main_news($jb_code,$chkMobile) {
		global $GP, $C_JHBoard, $C_Func;

		$args = '';       
        $args = array("jb_code" => $jb_code , "limit" => "limit 0,4 ");	   

		$rst = $C_JHBoard->Board_Main_Data($args);
		$GP -> MEMBER_CONFIG_LEVEL[$mb_level];
		$args['mb_level'] = "5";


		$str = "";
		for($i=0; $i<count($rst); $i++) {
			$jb_idx					= $rst[$i]['jb_idx'];
			$jb_code				= $rst[$i]['jb_code'];
            $jb_etc1				= $rst[$i]['jb_etc1'];
            $jb_etc2				= $rst[$i]['jb_etc2'];
			$jb_type				= $rst[$i]['jb_type'];
			$jb_title 			= $C_Func->strcut_utf8($rst[$i]['jb_title'], 100, true);
			$jb_reg_date 		= date("Y.m.d", strtotime($rst[$i]['jb_reg_date']));
            $jb_content			= $C_Func->dec_contents_edit($rst[$i]['jb_content']);
            $jb_content         = str_replace("&nbsp;"," ",$jb_content); 
            $jb_content			= trim(strip_tags($jb_content));
            $jb_content 		= $C_Func->strcut_utf8($jb_content, 230, true, "..");
			$jb_file_code 		= $rst[$i]['jb_file_code'];
			$arr_tmp = explode('#',$jb_etc1);
			$jb_hash = "";
			for ($j=1; $j<count($arr_tmp); $j++ ) {
				$jb_hash  .=  "<span>" . $arr_tmp[$j]. "</span>" ;
            }
            
            if($chkMobile == "PC"){
                $jb_title 			= $C_Func->strcut_utf8($rst[$i]['jb_title'], 80, true, "..");
            }
            else{
                $jb_title 			= $C_Func->strcut_utf8($rst[$i]['jb_title'], 50, true, "..");
            }
            
            $jb_content 		= $C_Func->strcut_utf8($jb_content, 100, true, "...");	//제목 (길이, HTML TAG제한여부 처리)


            $url = "/notice/notice.php?&jb_mode=tdetail&jb_code=" . $jb_code . "&jb_idx=" . $jb_idx;

            if($jb_type == "A"){$class = "youtube";}
            elseif($jb_type == "B"){$class = "instargram";}
            elseif($jb_type == "C"){$class = "face";}
            elseif($jb_type == "D"){$class = "twitter";}
            elseif($jb_type == "E"){$class = "blog";}

            $jb_type = $GP -> SNS_TYPE[$jb_type];


            $img_src = '';
			if($jb_file_code != '') {
				$code_file = $GP->UP_IMG_SMARTEDITOR_URL. "/jb_${jb_code}/${jb_file_code}";
				$img_src = "<img src='" . $code_file. "' >";
			}else{
				$img_src = "<img src='/public/images/default.jpg' alt='이미지 없음'  >";
            }

            if($jb_code == "80"){
                $str .= '<li class="swiper-slide ani-a02" style="min-height:415px;">
                            <a href="'.  $url .'" class="dec">
                                <div class="img">
                                '.  $img_src .'
                                </div>
                                <span class="txt">
                                    <b>
                                        <small>'.  $jb_title .'</small>
                                        '.  $jb_etc1 .'
                                    </b>
                                    <p>
                                        '.  $jb_content .'
                                    </p>
                                </span>
                            </a>
                            <ul class="dec-foot">
                                <li class="view">
                                    <a href="'.  $url .'">
                                            <span>More Views</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        ';
            }
            elseif($jb_code == "20"){
                $str .= ' <li class="swiper-slide">
                <a href="'.  $jb_etc2 .'" target="_blank">
                <div href="'.$url.'" class="dec">
                    <div class="img">
                    '. $img_src .'
                    </div>
                    <span class="txt">
                        <b>
                            '.  $jb_title .'
                        </b>
                    </span>
                </div>
                </a>
                <ul class="dec-foot">
                    <li class="view">
                    '.  $jb_type .'
                    </li>
                    <li class=" '.  $class .' ani-a02">
                        <a class="on" href="#none">블로그 보기</a>
                    </li>
                </ul>
				<div class="dec-tag">
					'. $jb_hash .'
				</div>
                <a href="'.$jb_etc2.'" class="dec-more ani-a02">
                    <span>자세히보기</span>
                </a>
            </li>
        ';

            }

		}
		return $str;
	}

    
?>
