<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");	
	
	include_once($GP -> CLS."/class.hastag.php");	
	$C_hastag 	= new hastag;
	
	$args = array(
        "tc_idx" => $_GET['tc_idx']
    ) ; 
	$rst = $C_hastag ->Has_Info($args);
	
	if($rst) {
		extract($rst);
		$tc_content  = $C_Func->dec_contents_edit($tc_content);		
		
		$cate1_select = $C_Func -> makeSelect_Normal('tc_cate', $GP -> PAIN_TYPE, $tc_cate, '', '::선택::');
	}
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>해시태그 수정</strong></span>
		</div>
		<form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
		<input type="hidden" name="mode" id="mode" value="HAS_MODI" />
		<input type="hidden" name="tc_idx" id="tc_idx" value="<?=$_GET['tc_idx']?>" />
		<input type="hidden" name="before_image_main" id="before_image_main" value="<?=$tc_file_code?>" />
		<div class="boxContentBody">			
			<div class="boxMemberInfoTable_layer">				
				<table class="table table-bordered">
					<tbody>										
						<tr>
							<th><span>*</span>해시태그</th>
							<td>								
								<textarea name="tc_hashtag" id="tc_hashtag" style="width:100%; height:200px; "><?=$tc_hashtag?></textarea>
								ex) #서울대항유외과의원 #항문클리닉
							</td>
						</tr>						
					</tbody>
				</table>				
				<div style="margin-top:5px; text-align:center;">
				<button id="img_submit" class="btnSearch ">수정</button>
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

	$(document).ready(function(){	

        $('#img_cancel').click(function(){
				parent.modalclose();				
		});	
														 
			
		
		$('#img_submit').click(function(){		

			
			$('#base_form').attr('action','./proc/hastag_proc.php');
			$('#base_form').submit();
			return false;
		});					
	
	});
</script>