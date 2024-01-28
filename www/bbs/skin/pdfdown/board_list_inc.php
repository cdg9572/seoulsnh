<?php
//==============================================================================================
# 검색 조건 설정,
# 총게시물수,
# 페이징,
# 게시물의 나열번호 관련 프로그램은
# /board/action/default.inc.php 참조
//==============================================================================================

$dummy = 1;
if($data_list_cnt > 0) {
	for ($i=0; $i<$data_list_cnt; $i++ ) {		
			$jb_reg_date 				= date("Y.m.d", strtotime($data_list[$i]['jb_reg_date']));							//등록일
			$jb_mod_date 				= date("Y.m.d", strtotime($data_list[$i]['jb_mod_date']));							//수정일		
			$jb_see 					= $C_Func->num_f($data_list[$i]['jb_see']);									//조회수 (3자리 단위 ',' 처리)
			$jb_comment_count 			= $C_Func->num_f($data_list[$i]['jb_comment_count']);  			//코멘트 수 (3자리 단위 ',' 처리)		
			$jb_name 					= $data_list[$i]['jb_name'];
			
			
			//echo strlen($jb_name);
			if(strlen($jb_name) > 6) {
				$jb_name 				=  $C_Func->blindInfo($jb_name, 3);
			}else{
				$jb_name 				=  $C_Func->blindInfo($jb_name, 6);	
			}
			
            $jb_file_code				= $data_list[$i]['jb_file_code'];
            $jb_file_name				= $data_list[$i]['jb_file_name'];
			$jb_mb_id					= $data_list[$i]['jb_mb_id'];
			$jb_type					= $data_list[$i]['jb_type'];
			$jb_show					= $data_list[$i]['jb_show'];			
			$jb_mb_level				= $data_list[$i]['jb_mb_level'];
			$jb_secret_check			= $data_list[$i]['jb_secret_check'];
			$jb_email					= $data_list[$i]['jb_email'];
			$jb_group					= $data_list[$i]['jb_group'];
			$jb_code					= $data_list[$i]['jb_code'];
			$jb_homepage				= $data_list[$i]['jb_homepage'];		
			$jb_order					= $data_list[$i]['jb_order'];
			$jb_idx						= $data_list[$i]['jb_idx'];
			$jb_step					= $data_list[$i]['jb_step'];
            $jb_etc1					= $data_list[$i]['jb_etc1'];
            $jb_front_image					= $data_list[$i]['jb_front_image'];
			$jb_title 					= $C_Func->strcut_utf8($data_list[$i]['jb_title'], 100, true, "...");	//제목 (길이, HTML TAG제한여부 처리)
			$jb_content					= $C_Func->dec_contents_view($data_list[$i]['jb_content']);
			$jb_content					= trim(strip_tags($jb_content));
			$jb_content 				= $C_Func->strcut_utf8($jb_content, 100, true, "...");	//제목 (길이, HTML TAG제한여부 처리)
			
			if($jb_email != "") { $jb_email = $C_Func->auto_link($jb_email); } 						//이메일 (이메일 자동 링크 처리, 폼메일 또는 아웃룩)
			if($jb_homepage != "") { $jb_homepage = $C_Func->auto_link($jb_homepage); }		//홈페이지 (URL 자동 링크 처리)
	
			//답글처리
			if($jb_step > 0)
				$depth_icon = $C_Func->reply_depth($jb_step, "");
			else
				$depth_icon = ""; //매 글마다 초기화를 해 주어야 한다.
				
			//타이틀이미지
			$new_image = '<span class="new"></span>';
			$new_icon = $C_Func->new_icon(1, $data_list[$i]['jb_reg_date'], $new_image);
			//파일 이미지
			$new_file = "<i class='fa fa-paperclip' aria-hidden='true'></i>";
		
			//비밀글이미지
			//$secret_icon = " <img src=\"" . $GP -> IMG_PATH . "/". $skin_dir . "/image/ticon_key.gif\" border='0' align='middle'> ";	
			
			
			
			//비밀글 일 경우 읽기권한 처리 루틴 - 관리자가 아닐 경우만 체크
			//echo $check_level."<".$db_config_data['jba_reply_level']."&&".$data_list[$i]['jb_secret_check'];
			if($check_level < $db_config_data['jba_reply_level']  && $data_list[$i]['jb_secret_check'] == "Y")
			{
				
				//비회원이 작성한 비밀글일 경우
				if($jb_mb_id == "") {
					//비밀번호 입력페이지로 이동
					$get_par = "${index_page}?jb_code=${jb_code}&jb_mode=tdetail&jb_idx=${jb_idx}";
					$get_par.= "&search_key=" . $_GET['search_key'] . "&search_keyword=${search_keyword}&page=${page}&dep1=${dep1}&dep2=${dep2}";
					$get_par.= "&jb_mode=tsecret";				
				} else { //회원이 작성한 비밀글일 경우
				
					//작성자 아이디와 로그인 아이디 비교
					if($check_id != $jb_mb_id) {
						
						//비밀글의 경우 회원도 자신이 쓴 글에대한 답변만 볼 수 있다.
						$args = "";
						$args['jb_code'] = $jb_code;
						$args['jb_group'] = $jb_group;
						$rst = $C_JHBoard -> MEM_SECRET_CHECK($args);		
				
						if (trim($check_id) == "") {
							$get_par = "${index_page}?jb_code=${jb_code}&jb_mode=tdetail&jb_idx=${jb_idx}";
							$get_par.="&search_key=" . $_GET['search_key'] . "&search_keyword=${search_keyword}&page=${page}";
							$get_par.= "&jb_mode=tsecret";
						}else if (trim($check_id) == trim($rst['jb_mb_id'])) {
							$get_par = "${index_page}?jb_code=${jb_code}&jb_mode=tdetail&jb_idx=${jb_idx}";
							$get_par.="&search_key=" . $_GET['search_key'] . "&search_keyword=${search_keyword}&page=${page}&dep1=${dep1}&dep2=${dep2}";
						} else {						
							$get_par ="javascript:alert('작성회원만 읽을 수 있습니다.');";
						}					
					} else {
						$get_par = "${index_page}?jb_code=${jb_code}&jb_mode=tdetail&jb_idx=${jb_idx}";
						$get_par.="&search_key=" . $_GET['search_key'] . "&search_keyword=${search_keyword}&page=${page}&dep1=${dep1}&dep2=${dep2}";
					}				
				}						
			}
			else{		
				$get_par = "${index_page}?jb_code=${jb_code}&jb_mode=tdetail&jb_idx=${jb_idx}";
				$get_par.="&search_key=" . $_GET['search_key'] . "&search_keyword=${search_keyword}&page=${page}&dep1=${dep1}&dep2=${dep2}";
			}
			
			//상세보기 링크생성
			//$jb_title = "<a href=\"".$get_par."\">" . $jb_title . "</a>";
			
			//비밀글 이미지
			if($jb_secret_check == "Y") {
				$jb_title = $jb_title . $secret_icon;		//비밀글이미지...
			}			
			
			
			$jb_title = $depth_icon . $jb_title . $comment_count . $new_icon; //이미지타이틀 처리
		
			
			if($jb_show =="A"){
			$jb_no ="<td align='center' class='no'>숨김</td>";
            }

            $img_src = '';
			if($jb_front_image != '') {
				$code_file = $GP->UP_IMG_SMARTEDITOR_URL. "/jb_${jb_code}/${jb_front_image}";
				$img_src = "<img src='" . $code_file. "' alt='" . $jb_title_ori . "'  class='block' >";
			}else{			
				$img_src = "<img src='/public/images/main_logo.jpg' alt='이미지 없음' class='block' >";
			}

            // if($check_level >= 9 || $check_id == $jb_mb_id){
            //     $link = "/sub2/" .$get_par ;
            // }          
            // else{
            //     $link = "#";
            // }

            $ex_jb_file_name = explode("|", $jb_file_name);
            $ex_jb_file_code = explode("|", $jb_file_code);

            $code_name = "";
            $code_file = $GP->UP_IMG_SMARTEDITOR_URL. "jb_${jb_code}/${ex_jb_file_code[0]}";							
            $code_file2 = $GP->UP_IMG_SMARTEDITOR. "jb_${jb_code}/${ex_jb_file_code[0]}";							
            $code_name ="/bbs/download.php?downview=1&file=" . $code_file2 . "&name=" . $ex_jb_file_name[0] ;

            $downlink = "?file=".$code_file . "&name=".$ex_jb_file_name[0];            

            if($jb_code == "10"){
                $tm_menu = "pdfdown1";
                $tm_type = "A";   
                $etc_name  = "연구저자";             
            }
            else{
                $tm_menu = "pdfdown2";
                $tm_type = "B";
                $etc_name  = "발행인";
            }

             echo ('
                     <li>
                        <div class="img">
                        <a href="'.$get_par.'">' . $img_src .'</a>
                        </div>
                        <div class="text">
                            <a href="'.$get_par.'">
                            <h4>' . $jb_title .'</h4>
                                <p>
                                    <span class="name"> ' . $etc_name .' : ' . $jb_etc1 .'</span>
                                    <span class="date">등록일 ' . $jb_reg_date .'</span>
                                    <span class="view">조회수 ' . $jb_see .'</span>
                                </p>
                            </a>
                        </div>
                        <div class="files">
                            <a href="#none" onclick="$(\'#modal' . $i .'\').show();"><span>PDF</span> 다운로드</a>
                        </div>
                    </li>

                    <div class="report-modal-wrap" id="modal' . $i .'">
                    <form name="base_form" id="base_form' . $i .'" method="POST" action="?" enctype="multipart/form-data">
                    <input type="hidden" name="mode" id="mode" value="MULTI_REG" />
                    <input type="hidden" name="tm_menu" id="tm_menu" value="pdfdown" />
                    <input type="hidden" name="tm_type" id="tm_type" value="' . $tm_type .'" />
                    <input type="hidden" name="tm_content4" id="tm_content4" value="' . $jb_title .'" />
                    <input type="hidden" name="downlink" id="downlink" value="' . $downlink .'" />
                    <input type="hidden" name="file_code" id="file_code" value="' . $code_file .'" />
                    <input type="hidden" name="code_name" id="code_name" value="' . $code_name .'" />
                    <input type="hidden" name="file_name" id="file_name" value="' . $ex_jb_file_name[0] .'" />
                        <div class="report-modal">
                            <h5 class="modal-head">본 보고서의 다운로드 목적을 체크해주세요.</h5>
                            <div class="modal-body">
                                <div class="body-form">
                                    <p><span>01</span>본 보고서의 활용 목적은 무엇입니까?</p>
                                    <div class="check-group">
                                        <div class="check-list">
                                            <input type="radio" name="tm_content1" id="ch0101' . $i .'" value="연구 참고용">
                                            <label for="ch0101' . $i .'">연구 참고용</label>
                                        </div>
                                        <div class="check-list">
                                            <input type="radio" name="tm_content1" id="ch0102' . $i .'" value="정책 개발용">
                                            <label for="ch0102' . $i .'">정책 개발용</label>
                                        </div>
                                        <div class="check-list">
                                            <input type="radio" name="tm_content1" id="ch0103' . $i .'" value="교육 자료용">
                                            <label for="ch0103' . $i .'">교육 자료용</label>
                                        </div>
                                        <div class="check-list">
                                            <input type="radio" name="tm_content1" id="ch0104' . $i .'" value="기타용도">
                                            <label for="ch0104' . $i .'">기타용도</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="body-form">
                                    <p><span>02</span>본 보고서를 이용하시는 분의 소속은 어디입니까?</p>
                                    <div class="check-group">
                                        <div class="check-list">
                                            <input type="radio" name="tm_content2" id="ch0201' . $i .'" value="개인">
                                            <label for="ch0201' . $i .'">개인</label>
                                        </div>
                                        <div class="check-list">
                                            <input type="radio" name="tm_content2" id="ch0202' . $i .'" value="연구기관">
                                            <label for="ch0202' . $i .'">연구기관</label>
                                        </div>
                                        <div class="check-list">
                                            <input type="radio" name="tm_content2" id="ch0203' . $i .'" value="행정기관">
                                            <label for="ch0203' . $i .'">행정기관</label>
                                        </div>
                                        <div class="check-list">
                                            <input type="radio" name="tm_content2" id="ch0204' . $i .'" value="교육기관">
                                            <label for="ch0204' . $i .'">교육기관</label>
                                        </div>
                                        <div class="check-list">
                                            <input type="radio" name="tm_content2" id="ch0205' . $i .'" value="보건의료기관">
                                            <label for="ch0205' . $i .'">보건의료기관</label>
                                        </div>
                                        <div class="check-list">
                                            <input type="radio" name="tm_content2" id="ch0206' . $i .'" value="기타">
                                            <label for="ch0206' . $i .'">기타</label>
                                        </div>
                                    </div>
                                    <div class="check-group-name">
                                        <input type="text" placeholder="소속 기관명" name="tm_content3">
                                    </div>
                                </div>
                                <div id="btn-group" class="center">
                                    <a href ="' . $code_file .'" class="btn bg-black" id="img_submit' . $i .'" download >&nbsp;&nbsp;완료&nbsp;&nbsp;</a>
                                </div>
                            </div>
                            <a href="#none" class="close" onclick="$(\'#modal' . $i .'\').hide();"><img
                                    src="/resource/images/modal-close.png" alt="닫기"></a>
                        </div>
                        </form>
                    </div> 

                    <script type="text/javascript">
                    $(document).ready(function(){	
                        
                                                                                
                        $("#img_submit' . $i .'").click(function(){	 
                          
                            if ($("input:radio[name=tm_content1]").is(":checked") == false) {
                                alert("1번 질문을 선택해주세요.");
                                return false;
                            }

                            if ($("input:radio[name=tm_content2]").is(":checked") == false) {
                                alert("2번 질문을 선택해주세요.");
                                return false;
                            }                           
                                                        
                            $("#base_form' . $i .'").attr("action","/admin/survey/proc/multi_proc.php");
                            $("#base_form' . $i .'").submit();                 
                           
                            return false;
                        });					
                    
                    });
                    
                    </script>
				');

     				
			$dummy++;
	}
}else{
    echo ("	
    <li>
         등록된 데이터가 없습니다.
     </li>
					
		");
}
?>


                                