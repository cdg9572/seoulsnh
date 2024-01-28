<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");	
	
	include_once($GP -> CLS."/class.multi.php");
	$C_multi 	= new multi;
	
	$args = array("tm_idx" => $_GET['tm_idx'] );	    
    $rst = $C_multi ->MULTI_Info($args);
	
	if($rst) {
		extract($rst);		
    }	

    $MULTI_select = $C_Func -> makeSelect_Normal('tm_select', $GP -> MULTI_TYPE, $tm_select, '', '::선택::');
    $result_select = $C_Func -> makeSelect_Normal('tm_content20', $GP -> RESULT_TYPE, $tm_content20, '', '');
    
?>

<body>
    <div class="Wrap_layer">
        <!--// 전체를 감싸는 Wrap -->
        <div class="boxContent_layer">
            <div class="boxContentHeader">
                <span class="boxTopNav"><strong>상세보기</strong></span>
            </div>
            <form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
                <input type="hidden" name="mode" id="mode" value="MULTI_MODI" />
                <input type="hidden" name="tm_idx" id="tm_idx" value="<?=$_GET['tm_idx']?>" />
                <input type="hidden" name="tm_type" id="tm_type" value="<?=$tm_type?>" />
                <input type="hidden" name="before_image_main" id="before_image_main" value="<?=$tm_img?>" />
                <input type="hidden" name="before_image_main_m" id="before_image_main_m" value="<?=$tm_m_img?>" />
                <div class="boxContentBody">
                    <div class="boxMemberInfoTable_layer">
                        <div class="layerTable">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th colspan="5">*신청기관 정보</th>
                                    </tr>
                                    <tr>
                                        <th>기관명</th>
                                        <td>
                                            <input type="text" class="input_text" size="50" name="tm_content5"
                                                id="tm_content5" value="<?=$tm_content5?>" readonly />
                                        </td>
                                        <th>기관주소</th>
                                        <td>
                                            <input type="text" class="input_text" size="50" name="tm_content17"
                                                id="tm_content17"
                                                value="<?=$tm_content17?> <?=$tm_content3?> <?=$tm_content4?>"
                                                readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>병상수</th>
                                        <td>
                                            <input type="text" class="input_text" size="50" name="tm_content16"
                                                id="tm_content16" value="<?=$tm_content16?>" readonly />병상
                                        </td>
                                        <th>감염관리실 운영 유무</th>
                                        <td>
                                            <input type="text" class="input_text" size="50" name="tm_content6"
                                                id="tm_content6" value="<?=$tm_content6?>" readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>감염관리 전담인력 수</th>
                                        <td>
                                            <input type="text" class="input_text" size="50" name="tm_content12"
                                                id="tm_content12" value="<?=$tm_content12?>" readonly />명
                                        </td>
                                        <th>감염관리 겸임인력 수</th>
                                        <td>
                                            <input type="text" class="input_text" size="50" name="tm_content8"
                                                id="tm_content8" value="<?=$tm_content8?>" readonly />명
                                        </td>
                                    </tr>
                                    <tr>
                                    <tr>
                                        <th colspan="5">*감염병 전담기관 정보</th>
                                    </tr>
                                    <th>전담기관 운영 개시일</th>
                                    <td>
                                        <input type="text" class="input_text" size="50" name="tm_content9"
                                            id="tm_content9" value="<?=$tm_content9?>" readonly />
                                    </td>
                                    <th>전담기관 운영 시 가동 병상 수</th>
                                    <td>
                                        <input type="text" class="input_text" size="50" name="tm_content10"
                                            id="tm_content10" value="<?=$tm_content10?>" readonly />병상
                                    </td>
                                    </tr>
                                    <tr>
                                        <th colspan="5">*신청인 정보</th>
                                    </tr>
                                    <tr>
                                        <th>이름</th>
                                        <td>
                                            <input type="text" class="input_text" size="50" name="tm_content11"
                                                id="tm_content11" value="<?=$tm_content11?>" readonly />
                                        </td>
                                        <th>근무부서</th>
                                        <td>
                                            <input type="text" class="input_text" size="50" name="tm_content12"
                                                id="tm_content12" value="<?=$tm_content12?>" readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>감염관리실 근무 형태</th>
                                        <td>
                                            <input type="text" class="input_text" size="50" name="tm_content13"
                                                id="tm_content13" value="<?=$tm_content13?>" readonly />
                                        </td>
                                        <th>직위</th>
                                        <td>
                                            <input type="text" class="input_text" size="50" name="tm_content18"
                                                id="tm_content18" value="<?=$tm_content18?>" readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>전화번호(사무실))</th>
                                        <td>
                                            <input type="text" class="input_text" size="50" name="tm_content14"
                                                id="tm_content14" value="<?=$tm_content14?>" readonly />
                                        </td>
                                        <th>전화번호(휴대폰)</th>
                                        <td>
                                            <input type="text" class="input_text" size="50" name="tm_content7"
                                                id="tm_content7" value="<?=$tm_content7?>" readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>이메일</th>
                                        <td>
                                            <input type="text" class="input_text" size="50" name="tm_content1"
                                                id="tm_content1" value="<?=$tm_content1?>" readonly />
                                        </td>
                                        <th>비밀번호</th>
                                        <td>
                                            <input type="text" class="input_text" size="50" name="tm_content2"
                                                id="tm_content2" value="<?=$tm_content2?>" readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>상태</th>
                                        <td><?=$result_select?></td>
                                        </td>
                                        <th></th>
                                        <td>
                                        </td>
                                    </tr>

                                    <!-- <tr>
                                <th>이미지</th>
                                <td>
                                    <input type="file" name="tm_img" id="`tm_`img" size="30">
                                    <?
                                        if($tm_img != "") {
                                            echo  "<br>" . $tm_img;
                                    ?>
                                        <a href="#" onClick="img_del('<?=$tm_img;?>','<?=$_GET['tm_idx']?>','W')">(X)</a>
                                    <? } ?>
                                </td>
                            </tr>                                                                  
							<tr>
								<th>노출여부</th>
								<td>
									<input type="radio" name="tm_show" id="tm_show" value="Y" <? if($tm_show == "Y"){ echo "checked";}?> />노출
									<input type="radio" name="tm_show" id="tm_show" value="N" <? if($tm_show == "N"){ echo "checked";}?> />비노출
								</td>
							</tr>								 -->
                                </tbody>
                            </table>
                        </div>
                        <div class="btnWrap">
                            <span class="btnRight">
                                <button id="img_submit" class="btnSearch ">상태변경</button> 
                                <button id="img_cancel" class="btnSearch ">닫기</button>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<script type="text/javascript">
    function img_del(image, idx, type) {
        if (!confirm("삭제하시겠습니까?")) return;

        $.ajax({
            type: "POST",
            url: "./proc/MULTI_proc.php",
            data: "mode=MULTI2_IMGDEL&tm_idx=" + idx + "&file=" + image + "&type=" + type,
            dataType: "text",
            success: function (msg) {

                if ($.trim(msg) == "true") {
                    alert("삭제되었습니다");
                    window.location.reload();
                    return false;
                } else {
                    alert('삭제에 실패하였습니다.');
                    return;
                }
            },
            error: function (xhr, status, error) {
                alert(error);
            }
        });
    }

    $(document).ready(function () {
        size_guide();
        $('#img_cancel').click(function () {
            parent.modalclose();
        });

        $('#tm_type').change(function () {
            size_guide();
        });

        function size_guide() {
            var type = $("#tm_type option:selected").val();
            if (type == 'main') {
                $('#size_pc').text('(1398*600)');
                $('#size_m').text('(720*420)');
                $('#mobile_img').show();
            } else if (type == 'left') {
                $('#size_pc').text('(200*360)');
                $('#size_m').text('(720*180)');
                $('#mobile_img').show();
            } else {
                $('#size_pc').text('(360*200)');
                $('#mobile_img').hide();
            }
        }

        $('#img_submit').click(function () {
            /*
            if($('#tm_descrition').val() == '') {
            	alert('소제목을 입력하세요');
            	$('#tm_descrition').focus();
            	return false;
            }		
            
            if($('#tm_title').val() == '') {
            	alert('제목을 입력하세요');
            	$('#tm_title').focus();
            	return false;
            }	
            
            if($('#tm_content').val() == '') {
            	alert('내용을 입력하세요');
            	$('#tm_content').focus();
            	return false;
            }
            */

            $('#base_form').attr('action', './proc/multi_proc.php');
            $('#base_form').submit();
            return false;
        });

    });
</script>