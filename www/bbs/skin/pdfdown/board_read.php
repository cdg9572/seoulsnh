<?
  if($jb_code == "10"){
    $tm_type = "A";
}
else{
    $tm_type = "B";
}
$code_file = $GP->UP_IMG_SMARTEDITOR_URL. "jb_${jb_code}/${ex_jb_file_code[0]}";							

$downlink = "?file=".$code_file . "&name=".$ex_jb_file_name[0];            
?>
<div class="contents">
    <div class="inner">
        <div class="tableType-01 green no-border">
            <table width="100%" class="viewType">
                <caption style="display:none;">공지사항 상세</caption>
                <colgroup>
                    <col width="33.33%">
                    <col width="33.33%">
                    <col width="33.33%">
                </colgroup>
                <tbody>
                    <tr>
                        <th scope="row" colspan="3"><?=$jb_title?></th>
                    </tr>
                    <tr>
                        <td><span class="tit">작성자</span> <strong class="mg-l10"><?=$jb_name?></strong></td>
                        <td><span class="tit">조회수</span> <strong class="mg-l10"><?=$jb_see?></strong></td>
                        <td><span class="tit">작성일</span> <strong class="mg-l10"><?=$jb_reg_date?></strong></td>
                    </tr>
                    <?php if($jb_homepage) {?>
                    <!--tr>
								<td style="text-align:left;" colspan="3">
                                <span class="tit">링크</span> <?=$jb_homepage?>									
								</td>
							</tr-->
                    <?}?>
                    <tr>
                        <td style="text-align:left;" colspan="3">
                            <div class="viewCont">
                                <?=$content?>
                            </div>
                        </td>
                    </tr>

                    <?php if($file_cnt > 0) {?>
                    <tr>
                        <td style="text-align:left;" colspan="3">
                            <div class="viewFile">
                                <?                              
							for($i=0; $i<$file_cnt; $i++)	{
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
                                                echo '<p><img src="/resource/images/down-02.png" alt="">&nbsp;<a class="file" href="#" onclick="$(\'#modal_sub\').show();" >' .$ex_jb_file_name[$i] .'</a></p>';
												//echo "<p><img src='/resource/images/down-02.png' alt=''>&nbsp;<a class='file' href=\"/bbs/download.php?downview=1&file=" . $code_file . "&name=" . $ex_jb_file_name[$i] . " \">$ex_jb_file_name[$i]</a></p>";

											//}
										}	 
									}
							?>
                            </div>
                        </td>
                    </tr>
                    <?}?>

                </tbody>
            </table>
            <div id="btn-box" class="right">
                <a href="<?=$get_par1?>" class="btn bg-gray">이전글</a>
                <a href="<?=$get_par2?>" class="btn bg-black">다음글</a>
                <?if($check_level >= $db_config_data['jba_write_level']) {?>
                <a href="#none" onclick="javascript:location.href='<?=$get_par?>&jb_mode=tdelete'" class="btn bg-gray"
                    title="삭제">삭제</a>
                <a href="#\" onclick="javascript:location.href='<?=$get_par?>&jb_mode=tmodify'" class="btn bg-gray"
                    title="수정">수정</a>
                <?}?>
                <a href="<?=$index_page?>?jb_code=<?=$jb_code?>&<?=$search_key?>&search_keyword=<?=$search_keyword?>&page=<?=$page?>"
                    class="btn bg-black">목록</a>
            </div>

            <div class="viewComment">
                <ul>
                    <?php
					//공지글은 댓글 달수 없게... 2007-07-28
					if($jb_order >= 100 && $db_config_data['jba_comment_use'] == 'Y') {	
							echo "
								<div class=\"viewComment\">
									<ul>
							";
						#댓글 관련 스킨
						include $GP -> INC_PATH . "/action/comment.inc.php";		
							
							echo "</ul></div>";
					} //end_of_if($jb_order >= 100)
					?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- //end #container -->
<div class="report-modal-wrap" id="modal_sub">
    <form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
        <input type="hidden" name="mode" id="mode" value="MULTI_REG" />
        <input type="hidden" name="tm_menu" id="tm_menu" value="pdfdown" />
        <input type="hidden" name="tm_type" id="tm_type" value="<?=$tm_type?>" />
        <input type="hidden" name="tm_content4" id="tm_content4" value="<?=$jb_title?>" />
        <input type="hidden" name="downlink" id="downlink" value="<?=$downlink?>" />
        <input type="hidden" name="file_code" id="file_code" value="<?=$code_file?>" />
        <input type="hidden" name="file_name" id="file_name" value="<?=$ex_jb_file_name[0]?>" />
        <input type="hidden" name="code_name" id="code_name" value="<?=$code_name?>" />
        <div class="report-modal">
            <h5 class="modal-head">본 보고서의 다운로드 목적을 체크해주세요.</h5>
            <div class="modal-body">
                <div class="body-form">
                    <p><span>01</span>본 보고서의 활용 목적은 무엇입니까?</p>
                    <div class="check-group">
                        <div class="check-list">
                            <input type="radio" name="tm_content1" id="ch0101" value="연구 참고용">
                            <label for="ch0101">연구 참고용</label>
                        </div>
                        <div class="check-list">
                            <input type="radio" name="tm_content1" id="ch0102" value="정책 개발용">
                            <label for="ch0102">정책 개발용</label>
                        </div>
                        <div class="check-list">
                            <input type="radio" name="tm_content1" id="ch0103" value="교육 자료용">
                            <label for="ch0103">교육 자료용</label>
                        </div>
                        <div class="check-list">
                            <input type="radio" name="tm_content1" id="ch0104" value="기타용도">
                            <label for="ch0104">기타용도</label>
                        </div>
                    </div>
                </div>
                <div class="body-form">
                    <p><span>02</span>본 보고서를 이용하시는 분의 소속은 어디입니까?</p>
                    <div class="check-group">
                        <div class="check-list">
                            <input type="radio" name="tm_content2" id="ch0201" value="개인">
                            <label for="ch0201">개인</label>
                        </div>
                        <div class="check-list">
                            <input type="radio" name="tm_content2" id="ch0202" value="연구기관">
                            <label for="ch0202">연구기관</label>
                        </div>
                        <div class="check-list">
                            <input type="radio" name="tm_content2" id="ch0203" value="행정기관">
                            <label for="ch0203">행정기관</label>
                        </div>
                        <div class="check-list">
                            <input type="radio" name="tm_content2" id="ch0204" value="교육기관">
                            <label for="ch0204">교육기관</label>
                        </div>
                        <div class="check-list">
                            <input type="radio" name="tm_content2" id="ch0205" value="보건의료기관">
                            <label for="ch0205">보건의료기관</label>
                        </div>
                        <div class="check-list">
                            <input type="radio" name="tm_content2" id="ch0206" value="기타">
                            <label for="ch0206">기타</label>
                        </div>
                    </div>
                    <div class="check-group-name">
                        <input type="text" placeholder="소속 기관명" name="tm_content3">
                    </div>
                </div>
                <div id="btn-group" class="center">
                    <a href="<?=$code_file?>" class="btn bg-black" id="img_submit"
                        download>&nbsp;&nbsp;완료&nbsp;&nbsp;</a>
                </div>
            </div>
            <a href="#none" class="close" onclick="$('#modal_sub').hide();"><img
                    src="/resource/images/modal-close.png" alt="닫기"></a>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function () {


        $("#img_submit").click(function () {

            if ($("input:radio[name=tm_content1]").is(":checked") == false) {
                alert("1번 질문을 선택해주세요.");
                return false;
            }

            if ($("input:radio[name=tm_content2]").is(":checked") == false) {
                alert("2번 질문을 선택해주세요.");
                return false;
            }

            $("#base_form").attr("action", "/admin/survey/proc/multi_proc.php");
            $("#base_form").submit();

            return false;
        });

    });
</script>