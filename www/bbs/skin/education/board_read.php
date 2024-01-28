<?php
	// include_once $_SERVER['DOCUMENT_ROOT'] . '/_init.php';
    // include $_SERVER["DOCUMENT_ROOT"]."/inc/head.php";
    // $sel_email = $C_Func->makeSelect('email_sel', $GP -> EMAIL , $mb_email2, "class='form-control w20p'",'::::선택::::');
?>
<style>
	.noticeTable {border-width: 2px;}
	.noticeTable table tbody td {padding-left:30px;}
	.viewTable {border: 1px solid #e1e1e1;}
	.form-label {width: 150px;}
	@media screen and (max-width:720px) {
		#btn-group .btn.w15p {
			width: 200px !important;
		}
	}
</style>
			<div class="contents half-pad">
				<div class="inner">
					<div class="sub-tit bar center">
						<h3>교육행사 신청</h3>
					</div>
					<div class="noticeTable eduViewTable">
						<table>
							<colgroup>
								<col style="width: 216px;">
								<col style="">
								<col style="width: 216px;">
								<col style="">
							</colgroup>
							<tbody>
								<tr>
									<th>교육/행사명</th>
									<td><?=$jb_title?></td>
									<th>교육/행사 일시</th>
									<td>
										<?=$jb_etc7?> <?=$jb_etc8?>:<?=$jb_etc9?> -
										<?=$jb_etc10?> <?=$jb_etc11?>:<?=$jb_etc12?>
									</td>
								</tr>
								<tr>
									<th>신청기간</th>
									<td>
                                        <?=$jb_etc1?> <?=$jb_etc2?>:<?=$jb_etc3?> -
										<?=$jb_etc4?> <?=$jb_etc5?>:<?=$jb_etc6?>
									</td>
									<th>장소</th>
									<td><?=$jb_etc13?></td>
								</tr>
								<tr>
									<th>모집인원</th>
									<td><?=$jb_etc14?>명</td>
									<th>담당자/문의</th>
									<td><?=$jb_etc15?></td>
								</tr>
                                <tr>
                                    <th>분류</th>
									<td><?=$GP -> jb_TYPE[$jb_type]?></td>
                                    <th></th>
									<td></td>									
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="contents no-pad">
				<div class="inner">
					<div class="viewTable">
						<div class="viewTable_cont">
                             <?=$content?>
						</div>
					</div>					
                    <?                              
							for($i=0; $i<$file_cnt; $i++)	{
                                echo '<ul class="viewTable_file">';
										if($ex_jb_file_name[$i]) {
                                            //파일의 확장자
                                         
											
											$file_ext = substr( strrchr($ex_jb_file_name[$i], "."),1); 
											$file_ext = strtolower($file_ext);	//확장자를 소문자로...                                               	
											
											/*if ($file_ext=="gif" || $file_ext=="jpg" || $file_ext=="png" || $file_ext=="bmp") {	
																			
												echo "<a  class='file'  href='" . $GP->UP_IMG_SMARTEDITOR_URL ."jb_${jb_code}/${ex_jb_file_code[$i]}' target='_blank'>";
												echo "<img src=\"" . $GP->UP_IMG_SMARTEDITOR_URL ."jb_" . $jb_code . "/" . $ex_jb_file_code[$i] ."\" class='imgResponsive'>";
												echo "</a>";
											}
											else{*/
												$code_file = $GP->UP_IMG_SMARTEDITOR. "jb_${jb_code}/${ex_jb_file_code[$i]}";
												echo "<li><img src='/resource/images/down-02.png' alt=''>&nbsp;<a class='file' href=\"/bbs/download.php?downview=1&file=" . $code_file . "&name=" . $ex_jb_file_name[$i] . " \">$ex_jb_file_name[$i]</a></li>";

											//}
                                        }	 
                                        echo '</ul>';
									}
							?>
					
				</div>
			</div>
			<div class="contents half-top-pad">
				<div class="inner">
					<div id="btn-group" class="center no-pad">
                        <?if($jb_etc16 =="A") {?>
						<a href="#none" class="btn bg-blue w15p" onclick="$('.cooperation-modal-wrap').show()">신청하기</a>
                        <?}?>
						<!-- <a href="" class="btn bg-green w15p">단체신청</a> -->
						<a href="<?=$index_page?>?jb_code=<?=$jb_code?>&<?=$search_key?>&search_keyword=<?=$search_keyword?>&page=<?=$page?>" class="btn bg-black w15p">목록</a>
                        <?if($check_level >= $db_config_data['jba_write_level']) {?>
						<a href="#none" onclick="javascript:location.href='<?=$get_par?>&jb_mode=tdelete'"  class="btn bg-blue w15p" title="삭제">삭제</a>
						<a href="#\" onclick="javascript:location.href='<?=$get_par?>&jb_mode=tmodify'"  class="btn bg-black w15p" title="수정">수정</a>
						<?}?>
					</div>
				</div>
			</div>

			<!-- 
				신청 모달
			 -->
             <form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
                <input type="hidden" name="mode" id="mode" value="MULTI_REG" />
                <input type="hidden" name="jb_idx" id="jb_idx" value="<?=$jb_idx?>" />
                <input type="hidden" name="tm_menu" id="tm_menu" value="education" />
                <input type="hidden" name="tm_content20" id="tm_content20" value="A" />
                <input type="hidden" name="tm_content1" id="tm_content1" value="<?=$jb_title?>" />
                <input type="hidden" name="page_link" id="page_link" value="/sub3/page01.html" />
			<div class="cooperation-modal-wrap">
				<div class="cooperation-modal-cont">
					<div class="cooperation-modal">
						<h5 class="modal-head">
							교육행사 신청하기 <img src="/resource/images/cooperation-icon.png" alt="">
						</h5>
						<div class="modal-body">
							<h6 class="modal-sub-head"><span class="text-point">●</span> 비회원 신청</h6>
							<div class="form">
								<label for="" class="form-label">신청자명 <small class="text-point">(필수)</small></label>
								<input type="text" class="form-control" id="tm_content2" name="tm_content2">
							</div>
							<div class="form">
								<label for="" class="form-label">신청자연락처<small class="text-point">(필수)</small></label>
								<input type="text" class="form-control w10p" id="tm_content3_1" name="tm_content3_1" value="">
								<span class="form-bar">-</span>
								<input type="text" class="form-control w10p" id="tm_content3_2" name="tm_content3_2" value="">
								<span class="form-bar">-</span>
								<input type="text" class="form-control w10p" id="tm_content3_3" name="tm_content3_3" value=""> 
							</div>
							<div class="form">
								<label for="" class="form-label">기관명 <small class="text-point">(필수)</small></label>
								<input type="text" class="form-control" id="tm_content4" name="tm_content4">
							</div>
							<!-- 23-01-05 추가 -->
							<div class="form">
								<label for="" class="form-label">직종 <small class="text-point">(필수)</small></label>
								<input type="text" class="form-control w33p" id="tm_content8" name="tm_content8">
							</div>
							<!-- //end 23-01-05 추가 -->
							<div class="form">
								<label for="" class="form-label">인원수 <small class="text-point">(필수)</small></label>
								<input type="text" class="form-control w15p" id="tm_content5" name="tm_content5">
								<span class="form-bar">명</span>
							</div>
							<div class="form">
								<label for="" class="form-label">이메일<small class="text-point">(필수)</small></label>
								<input type="text" class="form-control w20p" id="tm_content6_1" name="tm_content6_1">
								<span class="form-bar">@</span>
								<input type="text" class="form-control w20p" id="tm_content6_2" name="tm_content6_2">&nbsp;
								<?=$sel_email?>							
							</div>
							<div class="form">
								<label for="" class="form-label">비밀번호<small class="text-point">(필수)</small></label>
								<input type="password" class="form-control w33p" id="tm_content7" name="tm_content7">
							</div>

							<h6 class="modal-sub-head"><span class="text-point">●</span> 개인정보 수집&middot;이용동의</h6>
							<div class="agree-wrap">
								<div class="agree-box">
									<p class="agree-box-text">서울특별시 서남병원은 프로그램 제공에 필요한 개인정보를 아래와 같이 수집 및 이용하고 있습니다. 아래의 사항을 충분히 읽어 보신 후 동의여부를 확인하여 주시기 바랍니다. 단, 14세 미만 아동의 경우 신청이 불가능합니다.</p>
									<div class="noticeTable">
										<table>
											<caption style="opacity: 0;height: 0;overflow: hidden;">개인정보 수집·이용 동의에 대한 표로 수집목적, 수집항목, 보유기간, 동의거부 시 불이익에 대한 정보 제공</caption>
											<colgroup>
												<col style="width:30%">
												<col style="width:auto">
											</colgroup>
											<tbody>
												<tr>
													<th scope="row">수집목적</th>
													<td class="tl" style="font-size:1.056em;font-weight:500">교육·행사연계 신청 내역에 대한 접수 및 운영</td>
												</tr>
												<tr>
													<th scope="row">수집항목</th>
													<td class="tl">[필수] 이름, 비밀번호, 연락처, 기관명, 인원수, 이메일</td>
												</tr>
												<tr>
													<th scope="row">보유기간</th>
													<td class="tl" style="font-size:1.056em;font-weight:500">3년</td>
												</tr>
												<tr>
													<th scope="row">동의거부 시 불이익</th>
													<td class="tl">귀하는 동의를 거부할 권리가 있습니다. 그러나 개인정보 수집에 동의하지 않으실 경우 교육·행사연계 신청을 하실 수 없습니다. </td>
												</tr>
											</tbody>
										</table>
									</div>							
								</div>
								<p class="agree-box-text">위와 같이 개인정보를 수집·이용하는 것에 동의하십니까?</p>
								<div class="check-group">
									<div class="check-list">
										<input type="radio" id="radio1" name="agreeChk" value="Y">
										<label for="radio1">동의함</label>
									</div>
									<div class="check-list">
										<input type="radio" id="radio2" name="agreeChk" value="N">
										<label for="radio2">동의안함</label>
									</div>
								</div>
							</div>
						</div>
						<div id="btn-group" class="center">
							<button type="submit" class="btn put" id="img_submit">신청하기 <img src="/resource/images/put-arrow.png" alt=""></button>
						</div>
					</div>	
					<a href="#none" class="close" onclick="$('.cooperation-modal-wrap').hide(); $(':text').val('');$(':password').val('');document.querySelectorAll('input[type=radio]').forEach(radio => radio.checked = false);$('select').val(null).trigger('chosen:updated');"><img src="/resource/images/modal-close.png" alt="닫기"></a>
				</div>
				
			</div>
            </form>
    <script>		
        $('#email_sel').change(function(){
			var val = $(this).val();

			if(val == "") {
				$('#tm_content6_2').val('');
			}else{
				$('#tm_content6_2').val(val);
			}
		});
        $("#img_submit").click(function(){
            if($('#tm_content2').val() == '')	{
                alert('신청자명을 정확히 입력하세요');
                $('#tm_content2').focus();
			return false;
            }	 
            
            if($('#tm_content3_1').val() == '' || $('#tm_content3_2').val() == '' || $('#tm_content3_3').val() == '')	{
                alert('연락처를 정확히 입력하세요');
                $('#tm_content3_1').focus();
                return false;
            }	

            if($('#tm_content4').val() == '')	{
                alert('기관명을 정확히 입력하세요');
                $('#tm_content4').focus();
			return false;
            }	

            if($('#tm_content8').val() == '')	{
                alert('직종을 정확히 입력하세요');
                $('#tm_content8').focus();
			return false;
            }	

            if($('#tm_content5').val() == '')	{
                alert('인원수를 정확히 입력하세요');
                $('#tm_content5').focus();
			return false;
            }	
           
            if($('#tm_content6_1').val() == '')	{
                alert('이메일을 정확히 입력하세요');
                $('#tm_content6_1').focus();
			return false;
	    	}	 

            if($('#tm_content7').val() == '')	{
                alert('비밀번호를 정확히 입력하세요');
                $('#tm_content7').focus();
			return false;
	    	}	 
         

            if ($('input:radio[name="agreeChk"]:checked').val() == undefined || $('input:radio[name="agreeChk"]:checked').val() == "N") {
                alert("개인정보 취급 방침에 동의해 주세요.");
                return false;
            } 
          
            $("#base_form").attr("action","/admin/education/proc/multi_proc.php");
            $("#base_form").submit();                 
            
            return false;
        });			
	</script>
</body>
</html>