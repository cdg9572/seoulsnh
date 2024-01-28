<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");		
	include_once($GP->CLS."class.online.php");
	$C_Online 	= new Online;

    $args = "";
    $args = array("toq_idx" => $_GET['toq_idx'] );	
	$data = $C_Online->Online_Info($args);
	
	if($data) {
		extract($data);
		
		$content = $C_Func->dec_contents_edit($toq_content);
		
		$file_msg = "";
		if($toq_file != "") {
			$code_file = $GP -> UP_ONLINE . $toq_file;
			
			$file_msg .= $toq_file ."<br>";
			$file_msg .= "<a href=\"/bbs/download.php?downview=1&file=" . $code_file . "&name=" . $toq_file . " \">다운로드</a>";
		}else{
			$file_msg .= "NONE";
		}
	}
	
	$sel_type = $C_Func ->makeSelect("toq_type", $GP -> QNA_TYOE, $toq_type, "class='select_type1'", "::: 선택 :::");	
	$sel_result = $C_Func ->makeSelect("toq_result", $GP -> QNA_RESULT, $toq_result , "class='select_type1'", "::: 선택 :::");		
?>

<body>
    <div class="Wrap_layer">
        <!--// 전체를 감싸는 Wrap -->
        <div class="boxContent_layer">
            <div class="boxContentHeader">
                <span class="boxTopNav"><strong>견적문의 수정</strong></span>
            </div>
            <form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
                <input type="hidden" name="mode" id="mode" value="QNA_MODI" />
                <input type="hidden" name="toq_idx" id="toq_idx" value="<?=$_GET['toq_idx']?>" />
                <div class="boxContentBody">
                    <div class="boxMemberInfoTable_layer">
                        <div class="layerTable">
                            <table class="table table-bordered">

                                <tbody>
                                    <tr class="first">
                                        <th scope="row"><span class="star">*</span>타입</th>
                                        <td><?=$sel_type?></td>
                                    </tr>
                                    <tr class="row">
                                        <th scope="row"><span class="star">*</span>병원명</th>
                                        <td><input type="text" class="input_text" size="30" name="toq_hospital"
                                                id="toq_hospital" value="<?=$toq_hospital?>" /></td>
                                    </tr>
                                    <tr class="row">
                                        <th scope="row"><span class="star">*</span>담당자</th>
                                        <td><input type="text" class="input_text" size="30" name="toq_charger"
                                                id="toq_charger" value="<?=$toq_charger?>" /></td>
                                    </tr>
                                    <tr class="row">
                                        <th scope="row"><span class="star">*</span>연락처</th>
                                        <td><input type="text" class="input_text" size="30" name="toq_phone"
                                                id="toq_phone" value="<?=$toq_phone?>" /></td>
                                    </tr>
                                    <tr class="row">
                                        <th scope="row"><span class="star">*</span>이메일</th>
                                        <td><input type="text" class="input_text" size="30" name="toq_email"
                                                id="toq_email" value="<?=$toq_email?>" /></td>
                                    </tr>
                                    <tr class="row">
                                        <th scope="row"><span class="star">*</span>현재 사이트</th>
                                        <td><input type="text" class="input_text" size="40" name="toq_site_now"
                                                id="toq_site_now" value="<?=$toq_site_now?>" /></td>
                                    </tr>
                                    <tr class="row">
                                        <th scope="row"><span class="star">*</span>참조 사이트1</th>
                                        <td><input type="text" class="input_text" size="40" name="toq_site_refer1"
                                                id="toq_site_refer1" value="<?=$toq_site_refer1?>" /></td>
                                    </tr>
                                    <tr class="row">
                                        <th scope="row"><span class="star">*</span>참조 사이트2</th>
                                        <td><input type="text" class="input_text" size="40" name="toq_site_refer2"
                                                id="toq_site_refer2" value="<?=$toq_site_refer2?>" /></td>
                                    </tr>
                                    <tr class="row">
                                        <th scope="row"><span class="star">*</span>예상페이지수</th>
                                        <td><input type="text" class="input_text" size="90" name="toq_pg_num"
                                                id="toq_pg_num" value="<?=$toq_pg_num?>" /></td>
                                    </tr>
                                    <tr class="row">
                                        <th scope="row"><span class="star">*</span>예상작업예산</th>
                                        <td><input type="text" class="input_text" size="90" name="toq_budget"
                                                id="toq_budget" value="<?=$toq_budget?>" /></td>
                                    </tr>
                                    <tr class="row">
                                        <th scope="row"><span class="star">*</span>홈페이지 방문경로</th>
                                        <td><input type="text" class="input_text" name="toq_home" id="toq_home"
                                                value="<?=$toq_home?>" /></td>
                                    </tr>
                                    <tr class="row">
                                        <th scope="row"><span class="star">*</span>첨부파일</th>
                                        <td><?=$file_msg?></td>
                                    </tr>
                                    <tr class="row">
                                        <th scope="row"><span class="star">*</span>문의내용</th>
                                        <td><textarea class="input_text" name="toq_content" id="toq_content"
                                                style="height:150px;"><?=$content?></textarea></td>
                                    </tr>
                                    <tr class="row">
                                        <th scope="row"><span class="star">*</span>신청일자</th>
                                        <td><input type="text" class="input_text" size="20" name="toq_regdate"
                                                id="toq_regdate" value="<?=$toq_regdate?>" /></td>
                                    </tr>

                                    <tr class="row">
                                        <th scope="row"><span class="star">*</span>처리상태</th>
                                        <td><?=$sel_result?></td>
                                    </tr>
                                    <tr class="row">
                                        <th scope="row"><span class="star">*</span>처리내용</th>
                                        <td><textarea class="input_text" name="toq_result_content"
                                                id="toq_result_content"
                                                style="height:150px;"><?=$toq_result_content ?></textarea></td>
                                    </tr>
                                    <tr class="row">
                                        <th scope="row"><span class="star">*</span>처리일자</th>
                                        <td><input type="text" class="input_text" size="20" name="toq_result_date"
                                                id="toq_result_date" value="<?=$toq_result_date?>" /></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="btnWrap">
                                <span class="btnRight">
                                    <!-- <button id="img_submit" class="btnSearch ">수정</button> -->
                                    <button id="img_cancel" class="btnSearch ">취소</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<?
include_once($GP -> INC_ADM_PATH."/footer.php");
?>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript">
    $(function () {
        callDatePick('toq_regdate');
        callDatePick('toq_result_date');
    });

    $(document).ready(function () {

        $('#img_cancel').click(function(){
				parent.modalclose();				
		});	

        $('#img_submit').click(function () {
            $('#base_form').submit();
        });

        $('#base_form').validate({
            rules: {
                toq_result: {
                    required: true
                },
                toq_result_content: {
                    required: true
                },
                toq_result_date: {
                    required: true
                }
            },
            messages: {
                toq_result: {
                    required: "처리상태를 선택하세요"
                },
                toq_result_content: {
                    required: "처리내용을 입력하세요"
                },
                toq_result_date: {
                    required: "처리일자를 입력하세요"
                }
            },
            errorPlacement: function (error, element) {
                var er = element.attr("name");
                error.insertAfter(element);
            },
            submitHandler: function (frm) {
                if (!confirm("수정하시겠습니까?")) return false;
                frm.action = './proc/qna_proc.php';
                frm.submit(); //통과시 전송
                return true;
            },

            success: function (element) {
                //
            }

        });

    });
</script>
