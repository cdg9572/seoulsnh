<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");	
	$slide_select = $C_Func -> makeSelect_Normal('ts_lang', $GP -> SLIDE_LANG, $ts_lang, '', '::선택::');	
?>
<body>
<div class="Wrap_layer"><!--// 전체를 감싸는 Wrap -->
	<div class="boxContent_layer">
		<div class="boxContentHeader">
			<span class="boxTopNav"><strong>슬라이드 등록</strong></span>
		</div>
		<form name="base_form" id="base_form" method="POST" action="?" enctype="multipart/form-data">
        <input type="hidden" name="mode" id="mode" value="SLIDE_REG" />
        <input type="hidden" name="ts_type" id="ts_type" value="<?=$_GET['ts_type']?>" />
		<div class="boxContentBody">			
			<div class="boxMemberInfoTable_layer">				
				<div class="layerTable">
					<table class="table table-bordered">
						<tbody>	
                              <!--tr>
								<th><span>*</span>분류</th>
								<td>
									<?=$slide_select?>
								</td>
							</tr--> 				                    												          							
							<tr>
								<th><span>*</span>제목</th>
								<td>
									<input type="text" class="input_text" size="70" name="ts_title" id="ts_title" />
								</td>
                            </tr>
                            <tr>
								<th><span>*</span>내용</th>
								<td>
									<textarea name="ts_content" id="ts_content" style="width:98%; height:100px;  overflow:auto;" ></textarea>
								</td>
							</tr>
							<!-- <tr>
								<th><span>*</span>설명</th>
								<td>
									<input type="text" class="input_text" size="70" name="ts_descrition" id="ts_descrition"/>
								</td>
							</tr> -->
							<?if ($_GET['ts_type'] == "B") {?>
                             <tr>
								<th><span>*</span>링크</th>
								<td>
									<input type="text" class="input_text" size="70" name="ts_link" id="ts_link" />
								</td>
                            </tr> 
                            <?}?> 
                            <?if ($_GET['ts_type'] == "A") {?>
                                <tr>
								<th><span>*</span>이미지</th>
								<td>
									<input type="file" name="ts_img" id="ts_img" size="30" class="input_text"><span id="size_pc"></span> 
								</td>
                            </tr>							
                                <?}?>   
                           
                            <!-- <tr id="mobile_img">
								<th><span>*</span>모바일 이미지</th>
								<td>
									<input type="file" name="ts_m_img" id="ts_m_img" size="30" class="input_text"><span id="size_m"></span>
								</td>
							</tr>    
                            <tr>
							<th><span>*</span>게시기간</th>
							<td>
								<input type="text" class="inputSearch" size="15" name="ts_start_date" id="ts_start_date" />
								 ~ 
								<input type="text" class="inputSearch" size="15" name="ts_end_date" id="ts_end_date" />
							</td>
						</tr> -->
                            <tr>
								<th><span>*</span>노출여부</th>
								<td>
									<label>
										<input type="radio" name="ts_show" id="ts_show" value="Y" checked/> 노출
									</label>
									<label>
										<input type="radio" name="ts_show" id="ts_show" value="N" /> 비노출
									</label>
								</td>
							</tr>
														
							<!--tr>
								<th><span>*</span>새창여부</th>
								<td>
									<label>
										<input type="checkbox" name="ts_type" id="ts_type" value="Y"/> 새창
									</label>
								</td>
                            </tr> 
                                            
                        -->
							
							
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

        var type = "<?=$_GET['ts_type']?>";
        if (type == 'A') {
            $('#size_pc').text('(811x432)');
            $('#size_m').text('');
            $('#mobile_img').show();
        }else if (type == 'B') {
            $('#size_pc').text('');
            $('#size_m').text('');
            $('#mobile_img').hide();
        }
		
		$('#img_submit').click(function(){			
			
			/*
			if($('#ts_descrition').val() == '') {
				alert('소제목을 입력하세요');
				$('#ts_descrition').focus();
				return false;
			}		
			
			if($('#ts_title').val() == '') {
				alert('제목을 입력하세요');
				$('#ts_title').focus();
				return false;
			}	
			
			if($('#ts_content').val() == '') {
				alert('내용을 입력하세요');
				$('#ts_content').focus();
				return false;
			}
			*/
			
			// if($('#ts_img').val() == '') {
			// 	alert('이미지를 선택하세요');
			// 	$('#ts_img').focus();
			// 	return false;
			// }

			if($('#ts_start_date').val() == '') {
				alert("게시기간을 입력하세요");
				$('#ts_start_date').focus();
				return false;
			}
			
			if($('#ts_end_date').val() == '') {
				alert("게시기간을 입력하세요");
				$('#ts_end_date').focus();
				return false;
			}
			
			
			$('#base_form').attr('action','./proc/slide_proc.php');
			$('#base_form').submit();
			return false;
		});					
	
	});
</script>

<script type="text/javascript">
	$(function() {
		callDatePick('ts_start_date');
		callDatePick('ts_end_date');
	});

	function callDatePick (id) {	
		var dates = $( "#" + id ).datepicker({
			prevText: '이전 달',
			nextText: '다음 달',
			monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
			dayNames: ['일','월','화','수','목','금','토'],
			dayNamesShort: ['일','월','화','수','목','금','토'],
			dayNamesMin: ['일','월','화','수','목','금','토'],
			dateFormat: 'yy-mm-dd',
			showMonthAfterYear: true,
			yearSuffix: '년'	  
		});
	}
	


</script>
