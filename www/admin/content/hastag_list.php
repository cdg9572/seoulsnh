<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");
	
	include_once($GP->CLS."class.list.php");
	include_once($GP -> CLS."/class.hastag.php");	
	include_once($GP->CLS."class.button.php");
	$C_ListClass 	= new ListClass;
	$C_hastag 	= new hastag;
	$C_Button 		= new Button;
	
	$args = array();
	$args['show_row'] = 100;
	$args['pagetype'] = "admin";
	$data = "";
	$data = $C_hastag->Has_List(array_merge($_GET,$_POST,$args));

	$data_list 		= $data['data'];
	$page_link 		= $data['page_info']['link'];
	$page_search 	= $data['page_info']['search'];
	$totalcount 	= $data['page_info']['total'];
	
	$totalpages 	= $data['page_info']['totalpages'];
	$nowPage 		= $data['page_info']['page'];
	$totalcount_l 	= number_format($totalcount,0);
	
	$data_list_cnt 	= count($data_list);
	
	$cate1_select = $C_Func -> makeSelect_Normal('tc_cate', $GP -> PAIN_TYPE, $tc_cate, '', '::선택::');
?>
<body>
<div class="Wrap"><!--// 전체를 감싸는 Wrap -->
		<? include_once($GP -> INC_ADM_PATH."/header.php"); ?>	
		
		<div id="BoardHead" class="boxBoardHead">				
				<div class="boxMemberBoard">
					<table>
						<thead>
							<tr>
								<th>No</th>
								<th>메뉴</th>		
                                <th>2차메뉴</th>						
								<th>해시태그</th>                 								
								<th>등록일</th>								
								<th>수정</th>
							</tr>
						</thead>
						<tbody>
							<input type="hidden" name="max_desc" id="max_desc" value="<?=$data_list[0]['tc_desc']?>" />
							<?
								$dummy = 1;
								for ($i = 0 ; $i < $data_list_cnt ; $i++) {
									$tc_idx 		= $data_list[$i]['tc_idx'];
                                    $tc_cate	= $data_list[$i]['tc_cate'];				
                                    $tc_cate_sub	= $data_list[$i]['tc_cate_sub'];					
									$tc_hastag		= $data_list[$i]['tc_hashtag'];							
                                    $tc_regdate	= date("Y.m.d", strtotime($data_list[$i]['tc_regdate']));
                                    
                                    if($tc_cate == "A"){
                                        $select_type = $GP -> CONTENT_TYPE1 ;
                                    }
                                    else if($tc_cate == "B"){
                                        $select_type = $GP -> CONTENT_TYPE2 ;
                                    }
                                    else if($tc_cate == "C"){
                                        $select_type = $GP -> CONTENT_TYPE3 ;
                                    }
																		
									$edit_btn = $C_Button -> getButtonDesign('type2','수정',0,"layerPop('ifm_reg','./hastag_edit.php?tc_idx=" . $tc_idx. "', 1520, 400)", 50,'');	
									//$edit_btn .= $C_Button -> getButtonDesign('type2','삭제',0,"content_delete('" . $tc_idx. "')", 50,'');							
								?>
										<tr id="<?=$tc_idx?>">
											<td><?=$data['page_info']['start_num']--?></td>
											<td><?=$GP -> PAIN_TYPE[$tc_cate]?></a></td>
                                            <td><?=$select_type[$tc_cate_sub]?></a></td>										
											<td><?=$tc_hastag?></td>  																		
											<td><?=$tc_regdate?></td>
											<td><?=$edit_btn?></td>
										</tr>
										<?
										$dummy++;
									}
							?>						
						</tbody>
					</table>
				</div>			
			</div>
			<ul class="boxBoardPaging">
				<?=$page_link?>
			</ul>
		</div>
		<? include_once($GP -> INC_ADM_PATH."/footer.php"); ?>
	</div>
</div><!-- 전체를 감싸는 Wrap //-->
</body>
</html>
<script type="text/javascript">

	$(document).ready(function(){
		
		var fixHelper = function(e, ui) {
			ui.children().each(function() {
				$(this).width($(this).width());
			});
			return ui;
		};
		
		var cl_id = "";
		var ch_id = "";
		$(".boxMemberBoard tbody").sortable({
			helper: fixHelper,
			start: function( event, ui ) {
				cl_id = ui.item.attr('id');
			},	
			stop: function( event, ui ) {
				/*
				var tot_num = ui.item.parent().find('tr').length - 1;
				var now_num = ui.item.index();				
				
				if(now_num == tot_num) {
					fd_num = now_num - 1;					
					ch_id = ui.item.parent().find("tr:eq(" + fd_num + ")").attr('id');					
				}else {
					fd_num = now_num + 1;					
					ch_id = ui.item.parent().find("tr:eq(" + fd_num + ")").attr('id');					
				}
				*/
				
				var tot_num = ui.item.parent().find('tr').length;
				var tmp_id = "";
				for(i=0;  i< tot_num; i++){
					var val = ui.item.parent().find("tr:eq(" + i + ")").attr('id');
					tmp_id += val + ",";
				 }
				 tmp_id = tmp_id.slice(0,-1);

				 var max_desc = $('#max_desc').val();
				 console.log(tmp_id);
				 console.log(max_desc);
				
				
				$.ajax({
					type: "POST",
					url: "./proc/con_proc.php",
					data: "mode=TC_AUTO_CH&tmp_id=" + tmp_id + "&max_desc=" + max_desc,
					dataType: "text",
					success: function(msg) {
		
						if($.trim(msg) == "true") {
							alert("변경되었습니다.");
							window.location.reload();
							return false;
						}else{
							alert('변경에 실패하였습니다.');
							return;
						}
					},
					error: function(xhr, status, error) { alert(error); }
				});
				
			},	
			
			
		}).disableSelection();
	
		callDatePick('s_date');
		callDatePick('e_date');

		$('#search_submit').click(function(){																			 

			if($.trim($('#search_content').val()) != '')
			{
				if($('#search_key option:selected').val() == '')
				{
					alert('검색조건을 선택하세요');
					return false;
				}
			}

			if($('#search_key option:selected').val() != '')
			{
				if($.trim($('#search_content').val()) == '')
				{
					alert('검색내용을 입력하세요');
					$('#search_content').focus();
					return false;
				}
			}


			$('#base_form').submit();
			return false;
		});

	});

	function content_delete(tc_idx)
	{
		if(!confirm("삭제하시겠습니까?")) return;

		$.ajax({
			type: "POST",
			url: "./proc/con_proc.php",
			data: "mode=CON_DEL&tc_idx=" + tc_idx,
			dataType: "text",
			success: function(msg) {
				
				if($.trim(msg) == "true") {
					alert("삭제되었습니다");
					window.location.reload();
					return false;
				}else{
					alert('삭제에 실패하였습니다.');
					return;
				}				
			},
			error: function(xhr, status, error) { alert(error); }
		});
	}

	function desc_idx(type, idx, num) {
		
		$.ajax({
			type: "POST",
			url: "./proc/con_proc.php",
			data: "mode=CON_DESC&type=" + type + "&tc_idx=" + idx+ "&desc=" + num,
			dataType: "text",
			success: function(msg) {

				if($.trim(msg) == "true") {
					alert("변경되었습니다.");
					window.location.reload();
					return false;
				}else{
					alert('변경에 실패하였습니다.');
					return;
				}
			},
			error: function(xhr, status, error) { alert(error); }
		});
	}
</script>