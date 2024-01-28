<?php
	include_once("../../_init.php");
    include_once($GP -> INC_ADM_PATH."/head.php");	
    
    $tm_content1_select = $C_Func -> makeSelect_Normal('tm_content1', $GP -> ORGAN1_TYPE, $tm_content1, '', '::선택::');
    $tm_content2_select = $C_Func -> makeSelect_Normal('tm_content2', $GP -> ORGAN2_TYPE, $tm_content2, '', '::선택::');
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>등록하기</strong></span>
		</div>
		<form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
		<input type="hidden" name="mode" id="mode" value="MULTI_REG" />
        <input type="hidden" name="tm_menu" id="tm_menu" value="organ" />
		<input type="hidden" name="tm_type" id="tm_type" value="<?=$_GET['tm_type']?>" />
		<div class="boxContentBody">			
			<div class="boxMemberInfoTable_layer">				
				<div class="layerTable">
					<table class="table table-bordered">
						<tbody>                        												          														                       							
                            <tr>
								<th><span>*</span>구분</th>
								<td>
                                  <?=$tm_content1_select?>
								</td>
                            </tr>
                            <tr>
								<th><span>*</span>지역</th>
								<td>
                                    <?=$tm_content2_select?>
								</td>
                            </tr>  
                            <tr>
								<th><span>*</span>기관명</th>
								<td>
									<input type="text" class="input_text" size="100" name="tm_content3" id="tm_content3"/>
								</td>
                            </tr>  
							<tr>
								<th><span>*</span>이미지</th>
								<td>								
                                    <input type="file" name="tm_img" id="tm_img" size="30" class="input_text"><span id="size_pc"></span>
								</td>
                            </tr> 
                            <tr>
								<th><span>*</span>기관주소</th>
								<td>
									<input type="text" class="input_text" size="100" name="tm_content4" id="tm_content4"/>
								</td>
                            </tr>                                                                                                   
                            <tr>
								<th><span>*</span>홈페이지</th>
								<td>
									<input type="text" class="input_text" size="100" name="tm_content5" id="tm_content5"/>
								</td>
                            </tr>  
                            <tr>
								<th><span>*</span>노출여부</th>
								<td>
									<label>
										<input type="radio" name="tm_show" id="tm_show" value="Y" checked   /> 노출
									</label>
									<label>
										<input type="radio" name="tm_show" id="tm_show" value="N"  /> 비노출
									</label>
								</td>
							</tr>
						</tbody>
					</table>
				</div>				
				<div class="btnWrap">
					<span class="btnRight">
						<button id="img_submit" class="btnSearch ">등록</button>
						<button id="img_cancel" class="btnSearch ">취소</button>
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

	$(document).ready(function(){	
														 
		$('#img_cancel').click(function(){
				parent.modalclose();				
		});	
		
		$('#tm_type').change(function(){
			size_guide();
		});

		function size_guide(){
			var type = $("#tm_type option:selected").val();
			if (type == 'main') {
				$('#size_pc').text('(1398*600)');
				$('#size_m').text('(720*420)');
				$('#mobile_img').show();
			}else if (type == 'left') {
				$('#size_pc').text('(200*360)');
				$('#size_m').text('(720*180)');
				$('#mobile_img').show();
			}else{
				$('#size_pc').text('(360*200)');
				$('#mobile_img').hide();
			}
		}
		
		$('#img_submit').click(function(){				

			

			$('#base_form').attr('action','./proc/multi_proc.php');
			$('#base_form').submit();
			return false;
		});					
	
	});
</script>