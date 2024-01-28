<?php
    //error_reporting(E_ALL);
    //ini_set("display_errors", 1);

	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");
	
	include_once($GP->CLS."class.list.php");
	include_once($GP->CLS."class.multi.php");
	include_once($GP->CLS."class.button.php");
	$C_ListClass 	= new ListClass;
	$C_multi 	= new multi;
    $C_Button 		= new Button;
    
    $excelHanArr = array(
        "이메일" => "tm_content1",
        "비밀번호" => "tm_content2",
        "지역" => "tm_content3",
        "기관" => "tm_content4",
        "기관명" => "tm_content5",
        "담당자" => "tm_content6",
        "사무실" => "tm_content13",
        "휴대폰" => "tm_content7",
        "신청시작기간" => "tm_content8",
        "신청마감기간" => "tm_content9",
        "모집가능인원" => "tm_content10",
        "유/무선인터넷" => "tm_content11",
        "장소 대관" => "tm_content11",
        "상태" => "tm_result",
    );	
	
	
	$args = array( 		
        "tm_menu" => "clinic",	
        "tm_type" => $_GET['tm_type'],	
		"show_row" => 10,
        "pagetype" => "admin",
        "excel" => $excelHanArr
	) ;  
  
	$data = "";
	$data = $C_multi->multi_List(array_merge($_GET,$_POST,$args));
	
	$data_list 		= $data['data'];
	$page_link 		= $data['page_info']['link'];
	$page_search 	= $data['page_info']['search'];
	$totalcount 	= $data['page_info']['total'];
	
	$totalpages 	= $data['page_info']['totalpages'];
	$nowPage 		= $data['page_info']['page'];
	$totalcount_l 	= number_format($totalcount,0);
	
	$data_list_cnt 	= count($data_list);

    $multi_select = $C_Func -> makeSelect_Normal('tm_select', $GP -> multi_TYPE, $tm_select, '', '::선택::');
?>
<body>
<div class="Wrap"><!--// 전체를 감싸는 Wrap -->
        <? include_once($GP -> INC_ADM_PATH."/header.php"); ?>
		<div class="boxContentBody">
			<div class="boxSearch">
                <form name="base_form" id="base_form" method="GET">
                <span><input type="button" id="excel_btn" value="엑셀 다운로드" /></span>			
                </form>
			</div>
		</div>
		<div style="margin-top:5px; text-align:right;">	
		<!-- <button onClick="layerPop('ifm_reg','./cooperation_reg.php?tm_type=<?=$_GET['tm_type']?>', '100%', 650)"; class="btnSearch">등록</button> -->
		</div>
        <form name="frm" action="proc/multi_proc.php?mode=AllDEL" method="post">
        <input type="button" name="" id="" value="전체삭제" onClick="javascript:Alldelete();">
        <input type="hidden" name="tm_menu" id="tm_menu" value="clinic" />
		<div id="BoardHead" class="boxBoardHead">				
				<div class="boxMemberBoard">
					<table>
						<colgroup>
							<col />				
                            <col />				
							<col />
							<col />
                            <col />
                            <col style="width:200px;"/>
						</colgroup>
						<thead>
							<tr>
                                <th><input type="checkbox" name="chkAll" onClick="javascript:checkAll();" /></th>
								<th>No</th>                                    
                                <th>기관명</th>                                                          
                                <th>담당자</th>
								<th>휴대폰</th>
                                <th>이메일</th>		
                                <th>상태</th>	
                                <th>등록일</th>								
								<th>보기/삭제</th>
							</tr>
						</thead>
						<tbody>
                        <input type="hidden" name="max_desc" id="max_desc" value="<?=$data_list[0]['tm_desc']?>" />
							<?
								$dummy = 1;
								if($data_list_cnt > 0 ) {
									for ($i = 0 ; $i < $data_list_cnt ; $i++) {
										$tm_idx        = $data_list[$i]['tm_idx'];                                        
                                        $tm_content1      = $data_list[$i]['tm_content1'];
                                        $tm_content2      = $data_list[$i]['tm_content2'];
                                        $tm_content3      = $data_list[$i]['tm_content3'];
                                        $tm_content4      = $data_list[$i]['tm_content4'];
                                        $tm_content5      = $data_list[$i]['tm_content5'];
                                        $tm_content6      = $data_list[$i]['tm_content6'];
                                        $tm_content7      = $data_list[$i]['tm_content7'];
                                        $tm_content20      = $data_list[$i]['tm_content20'];
										$tm_type       = $data_list[$i]['tm_type'];										
										$tm_show       = $data_list[$i]['tm_show'];										
										$tm_regdate    = $data_list[$i]['tm_regdate'];	
										$tm_img        = $data_list[$i]['tm_img'];
                                        $tm_m_img      = $data_list[$i]['tm_m_img'];   
                                        $tm_content16      = $data_list[$i]['tm_content16'];
                                        $tm_content3 	= $C_Func->strcut_utf8($tm_content3, 100, true, "...");	     
                                        
										$b_img = '';
										if($tm_img !=  '') {
											$b_img = "<img src='" . $GP -> UP_multi_URL . $tm_img . "' width='100px' />";
										}else {
											$b_img = "<img src='/images/no_image.jpg' width='100px' />";
										}
																		
																				
										$edit_btn = $C_Button -> getButtonDesign('type2','보기',0,"layerPop('ifm_reg','./cooperation_edit.php?tm_idx=" . $tm_idx. "', '100%', 650)", 50,'');	
										$edit_btn .= $C_Button -> getButtonDesign('type2','삭제',0,"multi_delete('" . $tm_idx. "')", 50,'');
							?>
									<tr id="<?=$tm_idx?>">
                                        <td><input type="checkbox" name="checkbox[]" id="checkbox" value="<?=$tm_idx?>" /></td>
                                        <td><?=$data['page_info']['start_num']--?></td>
                                        <td><?=$tm_content5?></td>								
                                        <td><?=$tm_content6?></td>								
                                        <td><?=$tm_content7?></td>		
                                        <td><?=$tm_content1?></td>							
                                        <td><?=$GP -> RESULT_TYPE[$tm_content20]?></td>							
										<td><?=$tm_regdate?></td>										
										<td><?=$edit_btn?></td>
									</tr>
									<?
										$dummy++;
									}
								}else{
									echo "<tr><td colspan='7' align='center'>데이터가 없습니다.</td></tr>";
								}
							?>							
						</tbody>
					</table>
                    </form>
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
   function checkAll() {
    var obj = document.frm;
    if (obj.checkbox.length) {
        for (var i = 0; i < obj.checkbox.length; i++) {
        obj.checkbox[i].checked = obj.chkAll.checked;
        }
    } else {
        // obj.checkbox가 배열이 아닌 경우 단일 체크박스이므로 바로 체크 처리
        obj.checkbox.checked = obj.chkAll.checked;
    }
    }

    function Alldelete()
	{
        if (confirm("정말 삭제하시겠습니까??") == true){
         document.frm.submit();
         }

    }

	$(document).ready(function(){	
         //엑셀 출력
		$('#excel_btn').click(function(){
				var string = $("#base_form").serialize();
				location.href = "?excel_file=cooperation_list" + "&" + string;
				return false;
		});													 
	
		callDatePick('tm_date');
		callDatePick('e_date');

		$('#searctm_submit').click(function(){																			 

			if($.trim($('#searctm_content').val()) != '')
			{
				if($('#searctm_key option:selected').val() == '')
				{
					alert('검색조건을 선택하세요');
					return false;
				}
			}

			if($('#searctm_key option:selected').val() != '')
			{
				if($.trim($('#searctm_content').val()) == '')
				{
					alert('검색내용을 입력하세요');
					$('#searctm_content').focus();
					return false;
				}
			}


			$('#base_form').submit();
			return false;
        });

        var fixHelper = function(e, ui) {
			ui.children().each(function() {
				$(this).width($(this).width());
			});
			return ui;
		};
        
        var cl_id = "";
		var ch_id = "";
		// $(".boxMemberBoard tbody").sortable({
		// 	helper: fixHelper,
		// 	start: function( event, ui ) {
		// 		cl_id = ui.item.attr('id');
		// 	},	
		// 	stop: function( event, ui ) {
								
		// 		var tot_num = ui.item.parent().find('tr').length;
		// 		var tmp_id = "";
		// 		for(i=0;  i< tot_num; i++){
		// 			var val = ui.item.parent().find("tr:eq(" + i + ")").attr('id');
		// 			tmp_id += val + ",";
		// 		 }
		// 		 tmp_id = tmp_id.slice(0,-1);

		// 		 var max_desc = $('#max_desc').val();
		// 		// console.log(tmp_id);
		// 		 console.log(max_desc);
				
				
		// 		$.ajax({
		// 			type: "POST",
		// 			url: "./proc/multi_proc.php",
		// 			data: "mode=TO_AUTO_CH&tmp_id=" + tmp_id + "&max_desc=" + max_desc,
		// 			dataType: "text",
		// 			success: function(msg) {
		
		// 				if($.trim(msg) == "true") {
		// 					alert("변경되었습니다.");
		// 					window.location.reload();
		// 					return false;
		// 				}else{
		// 					alert(msg);
		// 					return;
		// 				}
		// 			},
		// 			error:function(request, status, error){

        //             alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);

        //             }

		// 		});
				
		// 	},	
			
			
		// }).disableSelection();

	});

	function multi_delete(tm_idx)
	{
		if(!confirm("삭제하시겠습니까?")) return;

		$.ajax({
			type: "POST",
			url: "./proc/multi_proc.php",
			data: "mode=MULTI_DEL&tm_idx=" + tm_idx,
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
</script>