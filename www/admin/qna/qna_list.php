<?php
    include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");
	
	include_once($GP->CLS."class.list.php");
	include_once($GP->CLS."class.multi.php");
    include_once($GP->CLS."class.button.php");
    include_once($GP->CLS."class.online.php");
	$C_ListClass 	= new ListClass;
	$C_multi 	= new multi;
	$C_Button 		= new Button;
	$C_Online 	= new Online;
	
	$args = array();
	$args['show_row'] = 10;
	$data = "";
	$data = $C_Online->Online_E_List(array_merge($_GET,$_POST,$args));
	
	$data_list 		= $data['data'];
	$page_link 		= $data['page_info']['link'];
	$page_search 	= $data['page_info']['search'];
	$totalcount 	= $data['page_info']['total'];
	
	$totalpages 	= $data['page_info']['totalpages'];
	$nowPage 		= $data['page_info']['page'];
	$totalcount_l 	= number_format($totalcount,0);
	
	$data_list_cnt 	= count($data_list);
?>
<script type="text/javascript">

	$(document).ready(function(){

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

    function qna_delete(toq_idx)
    {
		if(!confirm("삭제하시겠습니까?")) return;

		$.ajax({
			type: "POST",
			url: "./proc/qna_proc.php",
			data: "mode=QNADEL&toq_idx=" + toq_idx,
			dataType: "text",
			success: function(msg) {

				if($.trim(msg) == "true") {
					alert("삭제되었습니다");
					window.location.reload();
					return false;
				}else{
                    alert(msg);
					alert('삭제에 실패하였습니다.');
					return;
				}
			},
			error: function(xhr, status, error) { alert(error); }
		});

	}
</script>
<body>
<div class="Wrap"><!--// 전체를 감싸는 Wrap -->
		<? include_once($GP -> INC_ADM_PATH."/header.php"); ?>
		<div class="boxContentBody" style="display: none;">
			<div class="boxSearch">
			<? include_once($GP -> INC_ADM_PATH."/inc.mem_search.php"); ?>										
			<form name="base_form" id="base_form" method="GET">
			<ul>				
				<li>
					<strong class="tit">등록일</strong>
					<span><input type="text" name="tm_date" id="tm_date" value="<?=$_GET['tm_date']?>" class="input_text" size="13"></span>
					<span>~</span>
					<span><input type="text" name="e_date" id="e_date" value="<?=$_GET['e_date']?>" class="input_text" size="13" /></span>
				</li>	      
                 <li>
					<strong class="tit">노출여부</strong>
					<span>
						<label><input type="radio" name="tm_show" id="tm_show" value="Y" <? if($_GET['tm_show'] == "Y") { echo "checked"; }?> /> 노출</label>
						<label><input type="radio" name="tm_show" id="tm_show" value="N" <? if($_GET['tm_show'] == "N") { echo "checked"; }?> /> 비노출</label>
					</span>
				</li>				
				<li>
					<strong class="tit">검색조건</strong>
					<span>
					<select name="searctm_key" id="searctm_key">
						<option value="">:: 선택 ::</option>
						<option value="tt_tag_name" <? if($_GET['searctm_key'] == "tt_tag_name"){ echo "selected";}?> >태그명</option>
					</select>
					</span>
					<span><input type="text" name="searctm_content" id="searctm_content" value="<?=$_GET['searctm_content']?>" class="input_text" size="17" /></span>
					<span><button id="searctm_submit" class="btnSearch ">검색</button></span>
				</li>
			</ul>
			</form>
			</div>
		</div>		
		<div id="BoardHead" class="boxBoardHead">				
				<div class="boxMemberBoard">
    <table class="tbl_type" border="1" cellspacing="0" summary="게시판의 글제목 리스트" >
      <caption>
      게시판 리스트
      </caption>
      <colgroup>
      <col width="60px"></col>      
      <col width="120px"></col> 
      <col width="120px"></col>    
      <col width="120px"></col> 
      <col width="120px"></col>   
      <col width="*"></col>    
      <col width="120px"></col>   
      <col width="120px"></col>      
      <col width="120px"></col>      
      </colgroup>
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">타입</th>
          <th scope="col">병원명</th>
          <th scope="col">담당자</th>
          <th scope="col">연락처</th>
          <th scope="col">이메일</th>
          <th scope="col">처리여부</th>
          <th scope="col">등록일</th>
          <th scope="col">수정/삭제</th>
        </tr>
      </thead>
      <tbody>
        <?
						$dummy = 1;
						for ($i = 0 ; $i < $data_list_cnt ; $i++) {
							$toq_type 		= $GP -> QNA_TYOE[$data_list[$i]['toq_type']];
							$toq_hospital	= $data_list[$i]['toq_hospital'];
							$toq_idx 		= $data_list[$i]['toq_idx'];
							$toq_charger	= $data_list[$i]['toq_charger'];
							$toq_phone 	= $data_list[$i]['toq_phone'];
							$toq_email 	= $data_list[$i]['toq_email'];
							$toq_result 	= $GP -> QNA_RESULT[$data_list[$i]['toq_result']];
							$toq_regdate 	= $data_list[$i]['toq_regdate'];	
							
							
							$edit_btn = $C_Button -> getButtonDesign('type2','관리',0,"layerPop('ifm_reg','./qna_edit.php?toq_idx=" . $toq_idx. "', '100%', 800)", 50,'');	
							$edit_btn .= $C_Button -> getButtonDesign('type2','삭제',0,"qna_delete('" . $toq_idx. "')", 50,'');
							
						?>
        <tr>
          <td><?=$data['page_info']['start_num']--?></td>
          <td><?=$toq_type?></td>
          <td><?=$toq_hospital?></td>
          <td><?=$toq_charger?></td>
          <td><?=$toq_phone?></td>
          <td><?=$toq_email?></td>
          <td><?=$toq_result?></td>
          <td><?=$toq_regdate?></td>
          <td><?=$edit_btn?></td>
        </tr>
        <?
				$dummy++;
			}
			?>
      </tbody>
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
	$(function() {
		callDatePick('s_date');
		callDatePick('e_date');
	});
</script>

