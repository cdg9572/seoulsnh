<script type="text/javascript" src="/bbs/smarteditor/js/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript" src="/admin/js/jquery.base64.js"></script>
<form name="frm_Board" id="frm_Board" action="<?=$get_par?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="jb_password" value="<?=$input_passd;?>">
    <input type="hidden" name="upfolder" id="upfolder" value="jb_<?=$jb_code?>" />
    <div class="contents">                
                <div class="inner">
                <div class="sub-tit bar center">
						<h3>교육행사 신청</h3>
					</div>
            <div class="tableType-01 green">
                <table width="100%" class="writeType">
                    <colgroup>
                        <col width="15%">
                        <col width="*">
                    </colgroup>
                    <tbody>
                    <tr>
                            <th scope="row">작성자</th>
                            <td>
                                <input type="text" class="txtInput" style="width:100%;" id="jb_name"
                                    value="<?=$check_name?>" name="jb_name">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">이메일</th>
                            <td>
                                <input type="text" class="txtInput" id="jb_email" name="jb_email"
                                    value="<?=$_SESSION['suseremail']?>" style="width:100%;">
                            </td>
                        </tr>                        
                        <tr>
                            <th scope="row">분류</th>
                            <td>
                                 <? echo $news_select = $C_Func -> makeSelect_Normal('jb_type', $GP -> jb_TYPE, $jb_type, 'class="txtInput"', '');?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">구분</th>
                            <td>
                                 <? echo $news_select = $C_Func -> makeSelect_Normal('jb_sub_type', $GP -> jb_sub_TYPE, $jb_sub_type, 'class="txtInput"', '');?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">교육·행사명</th>
                            <td><input type="text" class="txtInput" style="width:100%;" id="jb_title" name="jb_title" value="<?=$jb_title?>">
                            </td>
                        </tr>                        
                        <tr>
                            <th>신청기간</th>
                            <td>
                                <input type="text" class="txtInput" size="15" name="jb_etc1" id="datepicker" value="<?=$jb_etc1?>"/>
                                <? echo $news_select = $C_Func -> makeSelect_Normal('jb_etc2', $GP -> hour_TYPE, $jb_etc2, 'class="txtInput"', '');?>시
                                <? echo $news_select = $C_Func -> makeSelect_Normal('jb_etc3', $GP -> minute_TYPE, $jb_etc3, 'class="txtInput"', '');?>분
                                ~
                                <input type="text" class="txtInput" size="15" name="jb_etc4" id="datepicker2" value="<?=$jb_etc4?>"/> 
                                <? echo $news_select = $C_Func -> makeSelect_Normal('jb_etc5', $GP -> hour_TYPE,  $jb_etc5, 'class="txtInput"', '');?>시
                                <? echo $news_select = $C_Func -> makeSelect_Normal('jb_etc6', $GP -> minute_TYPE, $jb_etc6, 'class="txtInput"', '');?>분
                            </td> 
                        </tr>
                        <tr>
                            <th>교육·행사일정</th>
                            <td>
                                <input type="text" class="txtInput" size="15" name="jb_etc7" id="datepicker3" value="<?=$jb_etc7?>"/>
                                <? echo $news_select = $C_Func -> makeSelect_Normal('jb_etc8', $GP -> hour_TYPE, $jb_etc8, 'class="txtInput"', '');?>시
                                <? echo $news_select = $C_Func -> makeSelect_Normal('jb_etc9', $GP -> minute_TYPE, $jb_etc9, 'class="txtInput"', '');?>분
                                ~
                                <input type="text" class="txtInput" size="15" name="jb_etc10" id="datepicker4" value="<?=$jb_etc10?>"/> 
                                <? echo $news_select = $C_Func -> makeSelect_Normal('jb_etc11', $GP -> hour_TYPE,  $jb_etc11, 'class="txtInput"', '');?>시
                                <? echo $news_select = $C_Func -> makeSelect_Normal('jb_etc12', $GP -> minute_TYPE, $jb_etc12, 'class="txtInput"', '');?>분
                            </td> 
                        </tr>
                        <tr>
                            <th scope="row">장소</th>
                            <td><input type="text" class="txtInput" style="width:100%;" id="jb_etc13" name="jb_etc13" value="<?=$jb_etc13?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">모집인원</th>
                            <td><input type="text" class="txtInput" style="width:100%;" id="jb_etc14" name="jb_etc14" value="<?=$jb_etc14?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">담당자/문의</th>
                            <td><input type="text" class="txtInput" style="width:100%;" id="jb_etc15" name="jb_etc15" value="<?=$jb_etc15?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">상태</th>
                            <td>
                                <? echo $news_select = $C_Func -> makeSelect_Normal('jb_etc16', $GP -> jb_etc16_TYPE, $jb_etc16, 'class="txtInput"', '');?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">첨부파일</th>
                            <td class="files">
                                <?php
                        //첨부파일의 숫자는 $i의 범위로 조정하면 된다.
                        for($i=0; $i<2; $i++) {
                        ?>
                                <span class="inputFile">
                                    <!-- <input type="text" class="txt" placeholder="첨부파일" readonly /> -->
                                    <span class="fileBtn">
                                        <input class="txtInput" type="file" title="파일선택" name="jb_file[]" />
                                        <!-- <span class="btnT btnFile">파일선택</span> -->
                                    </span>
                                </span>
                                <?php
                            if($ex_jb_file_name[$i]){
                                $code_file = $GP->UP_IMG_SMARTEDITOR. "/jb_${jb_code}/${ex_jb_file_code[$i]}";
                                echo "<a href=\"/bbs/download.php?downview=1&file=" . $code_file . "&name=" . $ex_jb_file_name[$i] . " \">$ex_jb_file_name[$i]</a>";
                                echo " <input type=\"checkbox\" name=\"del_file[${i}]\" value=\"Y\"> <-(체크 후 수정 버튼 누르면 삭제 됩니다.)<br>";
                            }
                            ?>
                                <?
                        }
                        ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">본문</th>
                            <td>
                                <textarea name="jb_content" id="jb_content" style="display:none"></textarea>
                                <textarea name="ir1" id="ir1"
                                    style="width:100%; height:300px; min-width:280px; display:none;"><?=$jb_content;?></textarea>
                            </td>
                        </tr>
                        <? if($check_level < 9 ){ ?>
                        <tr>
                            <th scope="row">자동입력방지</th>
                            <td>
                                <strong class="mobTh">자동입력방지</strong>
                                <img src="<?=$GP -> IMG_PATH?>/zmSpamFree/zmSpamFree.php?zsfimg=<?php echo time();?>"
                                    id="zsfImg" alt="아래 새로고침을 클릭해 주세요." style="vertical-align:middle;" />
                                <input type="text" class="txt" title="자동입력방지 숫자 입력" style="width:60px;" name="zsfCode"
                                    id="zsfCode" />
                                <a href="#;" class="btnType1 btnGray1"
                                    onclick="document.getElementById('zsfImg').src='<?=$GP -> IMG_PATH?>/zmSpamFree/zmSpamFree.php?re&zsfimg=' + new Date().getTime(); return false;">새로고침</a>
                            </td>
                        </tr>
                        <?}?>
                    </tbody>
                </table>
                <div id="btn-box" class="center">
                    <a href="#none" class="btn bg-green" id="img_submit">수정</a>
                    <a href="javascript:history.go(-1);" class="btn bg-puple">취소</a>
                </div>
            </div>
</form>
</div>
</section>
<!-- //end #container -->

<script type="text/javascript">
    var oEditors = [];
    nhn.husky.EZCreator.createInIFrame({
        oAppRef: oEditors,
        elPlaceHolder: "ir1",
        sSkinURI: "/bbs/smarteditor/SmartEditor2Skin.html",
        htParams: {
            bUseToolbar: true, // 툴바 사용 여부 (true:사용/ false:사용하지 않음)
            bUseVerticalResizer: true, // 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
            bUseModeChanger: true, // 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
            //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
            fOnBeforeUnload: function () {
                //alert("완료!");
            }
        }, //boolean
        fOnAppLoad: function () {
            //예제 코드
            //oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
        },
        fCreator: "createSEditor2"
    });

    $('#img_submit').click(function () {

        if ($('#jb_title').val() == '') {
            alert('제목을 입력하세요');
            $('#jb_title').focus();
            return false;
        }

        if ($('#jb_name').val() == '') {
            alert('작성자를 입력하세요');
            $('#jb_name').focus();
            return false;
        }

        if ($('#jb_password').val() == '') {
            alert('비밀번호를 입력하세요');
            $('#jb_password').focus();
            return false;
        }

        /*if($('#jb_email').val() == '' || !CheckEmail($('#jb_email').val()))	{
            alert('이메일을 정확히 입력하세요');
            $('#jb_email').focus();
            return false;
        }*/


        if ($('#zsfCode').val() == '') {
            alert('자동방지 입력키를 입력하세요');
            $('#zsfCode').focus();
            return false;
        }

        oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);


        var con = $('#ir1').val();
        $('#jb_content').val(con);

        if ($('#jb_content').val() == '') {
            alert('내용을 입력하세요');
            return false;
        }

        var t = $.base64Encode($('#ir1').val());
        $('#jb_content').val(t);

        $('#frm_Board').submit();
        return false;

    });

    function CheckEmail(str) {
        var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
        if (filter.test(str)) {
            return true;
        } else {
            return false;
        }
    }

    function insertIMG(filename) {
        var tname = document.getElementById('img_full_name').value;

        if (tname != "") {
            document.getElementById('img_full_name').value = tname + "," + filename;
        } else {
            document.getElementById('img_full_name').value = filename;
        }
    }
</script>
