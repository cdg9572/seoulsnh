<?php
	include_once("../../_init.php");
    include_once($GP -> INC_ADM_PATH."/head.php");	
    
    if($_GET['tc_cate'] == "A"){
        $select_type = $GP -> CONTENT_TYPE1 ;
    }
    else if($_GET['tc_cate'] == "B"){
        $select_type = $GP -> CONTENT_TYPE2 ;
    }
    else if($_GET['tc_cate'] == "C"){
        $select_type = $GP -> CONTENT_TYPE3 ;
    }
	
	$cate1_select = $C_Func -> makeSelect_Normal('tc_cate_sub',$select_type, $tc_cate_sub, '', '::선택::');
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>컨텐츠 등록</strong></span>
		</div>
		<form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
		<input type="hidden" name="mode" id="mode" value="CON_REG" />
        <input type="hidden" name="tc_cate" id="tc_cate" value="<?=$_GET['tc_cate']?>" />
		<div class="boxContentBody">			
			<div class="boxMemberInfoTable_layer">				
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th width="15%"><span>*</span>카테고리</th>
							<td width="85%">
								<?=$cate1_select?>
							</td>
						</tr> 	
						<tr>
							<th><span>*</span>제목</th>
							<td>
								<input type="text" class="input_text" size="70" name="tc_title" id="tc_title" />
							</td>
						</tr>
                        <tr>
							<th><span>*</span>중간 제목</th>
							<td>
								<input type="text" class="input_text" size="70" name="tc_subtitle" id="tc_subtitle" />
							</td>
						</tr>
                        <tr>
							<th><span>*</span>영상 제목</th>
							<td>
								<input type="text" class="input_text" size="70" name="tc_noti" id="tc_noti" />
							</td>
						</tr>
						<tr>
							<th><span>*</span>요약글</th>
							<td>								
								<textarea name="tc_summary" id="tc_summary" style="width:100%; height:80px; "></textarea>
							</td>
						</tr>
						<tr>
							<th><span>*</span>유튜브 링크</th>
								<td>
									<input type="text" class="input_text" title="링크 입력" id="tc_link" name="tc_link" />
									<br>ex) https://youtu.be/sdYUbha
								</td>
							</tr>
						<tr>
						<tr>
							<th><span>*</span>내용</th>
							<td>                          
								<textarea name="tc_content" id="tc_content" style="display:none"></textarea>
								<textarea name="ir1" id="ir1" style="width:100%; height:300px; min-width:280px; display:none;"></textarea>      
							</td>
						</tr>
						<tr>
							<th><span>*</span>썸네일 이미지</th>
							<td>
								<input type="file" name="tc_file_code" id="tc_file_code" size="30" class="input_text">
							</td>
						</tr>	
						<tr>
							<th><span>*</span>작성자</th>
							<td>
								<input type="text" class="input_text" size="70" name="tc_user" id="tc_user" value="<?=$_SESSION['susername']?>"  />
							</td>
						</tr>	
						<tr>
							<th><span>*</span>콘텐츠 노출여부</th>
							<td>
								<input type="radio" name="tc_view" value="Y" checked/>노출
								<input type="radio" name="tc_view" value="N"  />미노출
							</td>
						</tr>  
						<tr>
							<th><span>*</span>메인영상노출여부</th>
							<td>
								<input type="radio" name="tc_main_view" value="Y" />노출
								<input type="radio" name="tc_main_view" value="N" checked />미노출
							</td>
						</tr>				  
						<!-- <tr>
							<th scope="row">해시태그</th>
							<td><input type="text" class="input_text" title="해시태그 입력" placeholder="해시태그를 입력해 주세요."id="tc_hashtag" name="tc_hashtag"  />
									ex) #웨딩검진 #산전검진
							</td>
						</tr>   	 -->
						
						<!-- <tr>
							<th><span>*</span>썸네일 이미지</th>
							<td>
								<input type="file" name="tc_file_code2" id="tc_file_code2" size="30" class="input_text">
							</td>
						</tr>							 -->
					      
						<!-- <tr>
							<th><span>*</span>메인노출여부</th>
							<td>
								<input type="radio" name="tc_main_view" value="Y" />노출
								<input type="radio" name="tc_main_view" value="N" checked />미노출
							</td>
						</tr> -->					
                       						                      
                        <!-- <tr>
							<th><span>*</span>로그인 호출 여부</th>
							<td>
								<input type="radio" name="tc_login" value="Y" />로그인
								<input type="radio" name="tc_login" value="N" checked />비로그인
							</td>
						</tr>						 -->
					</tbody>
				</table>				
				<div style="margin-top:5px; text-align:center;">
				<button id="img_submit" class="btnSearch ">등록</button>
				<button id="img_cancel" class="btnSearch ">취소</button>
				</div>
			</div>
		</div>
    <input type="hidden" name="img_full_name" id="img_full_name" value="<?=$tc_editor_img?>" />  
  	<input type="hidden" name="upfolder" id="upfolder" value="../../contents/upfile" />
		</form>
	</div>
</div>
</body>
</html>
<script type="text/javascript" src="<?=$GP -> JS_PATH?>/jquery.alphanumeric.js"></script>
<script type="text/javascript" src="<?=$GP -> JS_PATH?>/jquery.validate.js"></script>
<script type="text/javascript" src="<?=$GP -> JS_SMART_PATH?>/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=$GP -> JS_PATH?>/jquery.base64.js"></script>
<script type="text/javascript">

	var oEditors = [];
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: "ir1",
		sSkinURI: "/bbs/smarteditor/SmartEditor2Skin.html",
		htParams : {
			bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
			bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
			bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
			//aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
			fOnBeforeUnload : function(){
				//alert("완료!");
			}
		}, //boolean
		fOnAppLoad : function(){
			//예제 코드
			//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
		},
		fCreator: "createSEditor2"
	});
	
	function insertIMG(filename){
		var tname = document.getElementById('img_full_name').value;

		if(tname != "")
		{
			document.getElementById('img_full_name').value = tname + "," + filename;
		}
		else
		{
			document.getElementById('img_full_name').value = filename;
		}
	}

	$(document).ready(function(){	
														 
		$('#img_cancel').click(function(){
				parent.modalclose();				
		});	
		
		$('#tc_cate').change(function(){
				var val = $(this).val();
				
				if(val != '') {
						$.ajax({
							type: "POST",
							url: "cate.php",
							data: "tc_cate=" + val,
							dataType: "text",
							success: function(data) {
								$('#tc_cate_sub').empty();
								$('#tc_cate_sub').append(data);
							},
							error: function(xhr, status, error) { alert(error); }
						});	
				}
		});
		
		$('#img_submit').click(function(){
			
			if($('#tc_cate option:selected').val() == '') {
				alert("카테고리를 선택하세요");
				return false;
			}
			
			oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);
			
			var con	= $('#ir1').val();
			$('#tc_content').val(con);		
	
			if($('#tc_content').val() == '') {
				alert('내용을 입력하세요');
				return false;
			}		
			
			
			$('#base_form').attr('action','./proc/con_proc.php');
			$('#base_form').submit();
			return false;
		});					
	
	});
</script>