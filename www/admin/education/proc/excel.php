<?php	
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");
	$title = "이미지 업로드";
	

	if (is_array($_GET)) foreach ($_GET as $k => $v) ${$k} = $v;
	if (is_array($_POST)) foreach ($_POST as $k => $v) ${$k} = $v;
?>

<body>
    <div class="Wrap_layer">
        <!--// 전체를 감싸는 Wrap -->
        <div class="boxContent_layer">
            <div class="boxContentHeader">
                <span class="boxTopNav"><strong>엑셀 업로드</strong></span>
            </div>
            <form id="frm_image" name="frm_image" action="?" method="post" enctype="multipart/form-data">
                <input type="hidden" name="mode" id="mode" value="receipt" />
                <div class="boxContentBody">
                    <div class="boxMemberInfoTable_layer">
                        <div class="layerTable">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th></th>
                                        <td width="580">
                                        <h2> 
                                            <input type="file" class="inputTxt" name="up_file" id="up_file" />
                                            <input type="submit" id="img_submit" value="올리기" class="btnExcel">
                                            </h2>
                                        </td>
                                        <td>
                                            <h2> * 안내사항 <br />
                                            <?=date("Y")-1 ?>년 데이터만 업로드 가능합니다.<br />
                                            타입 => 자동이체 : AUTO /  지로용지 : GIRO<br />
                                            업로드 파일 인코딩 형식은 UTF8로 되어 있어야 한글이 깨지지 않습니다.
                                                
                                            </h2>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="btnWrap">
                            <span class="btnRight">
                                <button id="img_cancel" class="btnSearch ">뒤로가기</button>
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
    $(document).ready(function () {
        $('#img_cancel').click(function () {
            parent.modalclose();
        });

        //엔터키 막기
        $("*").keypress(function (e) {
            if (e.keyCode == 13) {
                $('#serach_submit').click();
                return false;
            } else {
                return true;
            }
        });


        $('#img_submit').click(function () {

            if ($('#up_file').val() == '') {
                alert("첨부파일을 선택하세요");
                return false;
            }

            $('#frm_image').attr('action', './proc/excel_proc.php');
            $('#frm_image').submit();
            return false;

        });

    });
</script>
</body>

</html>
