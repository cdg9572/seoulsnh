<?php
	include_once("../../_init.php");
	
	
	include_once($GP->CLS."class.list.php");
	include_once($GP->CLS."class.analytics.php");
    include_once($GP->CLS."class.button.php");    
    include_once($GP->CLS."class.conversion.php");

	$C_Conversion 	= new Conversion;
	$C_ListClass 	= new ListClass;
	$C_Analytics 	= new Analytics;
	$C_Button 		= new Button;	
	
	
	//년월이 관련 변수 설정
	$Year = ($_GET['Year']) ? $_GET['Year'] : date("Y");
	$Month = ($_GET['Month']) ? $_GET['Month'] : date("m");
	$Day = ($_GET['Day']) ? $_GET['Day'] : date("d");		
		
	
	$excelHanArr = array(
		"접속일" => "StatusDay",
		"접속수" => "cnt"
	);
		
	
	$args = array( 	
		"Year" => $Year,
		"Month" => $Month,
		"Day" => $Day,
		"excel_file"		=> $_GET['excel_file'],
		"excel"				=> $excelHanArr,
		"show_row" => 31,
		"pagetype" => "admin"
	) ; 
	$data = "";
	$data = $C_Analytics->Analytics_Year_List(array_merge($_GET,$_POST,$args));
	
	$data_list 		= $data['data'];
	$page_link 		= $data['page_info']['link'];
	$page_search 	= $data['page_info']['search'];
	$totalcount 	= $data['page_info']['total'];
	
	$totalpages 	= $data['page_info']['totalpages'];
	$nowPage 		= $data['page_info']['page'];
	$totalcount_l 	= number_format($totalcount,0);
	
	$data_list_cnt 	= count($data_list);
	
	
	$arr_tmp = $C_Analytics->Analytics_Total($args);
	
	$totalCount = 0;
	for ($i = 0 ; $i < $data_list_cnt ; $i++) {	
		$totalCount = $totalCount + $data_list[$i]['cnt'];
    }    
    
    $args = array( 	
		"Year" => $Year,
		"Month" => $Month,
		"Day" => $Day,
		"excel_file"		=> $_GET['excel_file'],
		"excel"				=> $excelHanArr,
		"show_row" => 31,
		"pagetype" => "admin",
		"cv_type" => "location"
	) ; 
    $data2 = $C_Conversion->conversion_Year_List(array_merge($_GET,$_POST,$args));    
    $data_list2 		= $data2['data'];
    $data_list_cnt2 	= count($data_list2);

    $args['cv_type'] = "call";	
    $data3 = $C_Conversion->conversion_Year_List(array_merge($_GET,$_POST,$args));    
    $data_list3 		= $data3['data'];
    $data_list_cnt3 	= count($data_list3);

    $args['cv_type'] = "kakao";	
    $data4 = $C_Conversion->conversion_Year_List(array_merge($_GET,$_POST,$args));    
    $data_list4 		= $data4['data'];
    $data_list_cnt4 	= count($data_list4);
  
    for ($i = 0 ; $i < $data_list_cnt ; $i++) {    
        
        for ($j = 0 ; $j < $data_list_cnt2 ; $j++) {                                            
            if($data_list[$i]['StatusMonth'] == $data_list2[$j]['StatusMonth']){
                $loaction_sum += $data_list2[$j]['cnt'];
             }
        }   

        for ($j = 0 ; $j < $data_list_cnt3 ; $j++) {                                            
            if($data_list[$i]['StatusMonth'] == $data_list3[$j]['StatusMonth']){
                $call_sum += $data_list3[$j]['cnt'];	
             }
        }   

        for ($j = 0 ; $j < $data_list_cnt4 ; $j++) {                                            
            if($data_list[$i]['StatusMonth'] == $data_list4[$j]['StatusMonth']){
                $kakao_sum += $data_list4[$j]['cnt'];		
             }
        } 
    } 
    		
	include_once($GP -> INC_ADM_PATH."/head.php");
?>
<body>
<div class="Wrap"><!--// 전체를 감싸는 Wrap -->
		<? include_once($GP -> INC_ADM_PATH."/header.php"); ?>
		<div class="boxContentBody">
			<div class="boxSearch">
			<!--? include_once($GP -> INC_ADM_PATH."/inc.mem_search.php"); ?-->											
			<form name="base_form" id="base_form" method="GET">
			<ul>				
				
					<strong class="tit">날짜</strong>
					<span>
						<select name="Year" class="input" onChange="document.base_form.submit();">
						<?php
						$s_year = date('Y') - 5;
						$e_year = date('Y');												
						for ($i=$s_year;$i<=$e_year;$i++) {
							echo "<option value=".$i;
							if(!$Year) {
								if ($i == date("Y")) echo " selected";
							} else {
								if ($i == "$Year") echo " selected";
							}
							echo ">".$i."</option>";								
						}							
						?>
						</select>년
						<select name="Month" class="input" onChange="document.base_form.submit();">
						<?php
						for ($i=1;$i<=12;$i++) {
							if($i < 10) $num_i = "0".$i;
							else		$num_i = $i;
							echo "<option value=".$num_i;
							if(!$Month) {
								if ($i == date("m")) echo " selected";
							} else {
								if ($i == "$Month") echo " selected";
							}
							echo ">".$i."</option>";								
						}							
						?>
						</select>월													
					</span>
          <span><input type="button" id="excel_btn" value="EXCEL" /></span>	
											
			</ul>
			</form>
			</div>
		</div>	
	
		<div id="BoardHead" class="boxBoardHead">				
				<div class="boxMemberBoard">
					 <ul class="analysis_tot">
					 	<li>전체접속수 : <span><?=$arr_tmp[0];?></span></li>
					 </ul>
						<table>
							<colgroup>
							<col width="70px"></col>     
							<col width="120px"></col>    
                            <col width="120px"></col>    
                            <col width="120px"></col>    
							<col width="120px"></col>  
                            <col width="120px"></col>    
                            <col width="120px"></col>      
                            <col width="120px"></col>    
							<!-- <col width="*"></col>   -->
							</colgroup>
							<thead>
								<tr>
									<th>접속일</th>
									<th>접속수</th>
                                    <th>찾아오시는 길</th>
                                    <th>찾아오시는 길<br/> 접속비율</th>
                                    <th>전화 연결</th>
                                    <th>전화 연결<br/> 접속비율</th>
                                    <th>카카오톡 연결</th>
                                    <th>카카오톡<br/> 연결 접속비율</th>
									<!-- <th>그래프</th> -->
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>합계</td>
									<td><?=$arr_tmp[0]?></td>
                                    <td><?=$loaction_sum?></td>
                                    <td><?=substr((($loaction_sum / $arr_tmp[0]) * 100),0,4);?>%</td>
                                    <td><?=$call_sum?></td>
                                    <td><?=substr((($call_sum / $arr_tmp[0]) * 100),0,4);?>%</td>
                                    <td><?=$kakao_sum?></td>
                                    <td><?=substr((($kakao_sum / $arr_tmp[0]) * 100),0,4);?>%</td>									
								</tr>
								<?
										$dummy = 1;
										for ($i = 0 ; $i < $data_list_cnt ; $i++) {
											$StatusMonth 		= $data_list[$i]['StatusMonth'];
											$StatusCnt 		= $data_list[$i]['cnt'];	
                                            $loaction 		= $data_list2[$i]['cnt'];	    
                                            $call 		= $data_list3[$i]['cnt'];	                                                    
                                            $kakao   		= $data_list4[$i]['cnt'];

                                            $loaction = "";
                                            $call = "";
                                            $kakao = "";
                                            
                                            for ($j = 0 ; $j < $data_list_cnt2 ; $j++) {                                            
                                                if($data_list[$i]['StatusMonth'] == $data_list2[$j]['StatusMonth']){
                                                    $loaction 	    	= $data_list2[$j]['cnt'];		
                                                 }
                                            }   

                                            for ($j = 0 ; $j < $data_list_cnt3 ; $j++) {                                            
                                                if($data_list[$i]['StatusMonth'] == $data_list3[$j]['StatusMonth']){
                                                    $call 	    	= $data_list3[$j]['cnt'];		
                                                 }
                                            }   

                                            for ($j = 0 ; $j < $data_list_cnt4 ; $j++) {                                            
                                                if($data_list[$i]['StatusMonth'] == $data_list4[$j]['StatusMonth']){
                                                    $kakao 	    	= $data_list4[$j]['cnt'];		
                                                 }
                                            }   
								?>
								<tr>
									<td><?=$StatusMonth?></td>
									<td><?=$StatusCnt?></td>
                                    <td><?=$loaction?></td>
                                    <td><?=substr((($loaction / $StatusCnt) * 100),0,4);?>%</td>
                                    <td><?=$call?></td>
                                    <td><?=substr((($call / $StatusCnt) * 100),0,4);?>%</td>
                                    <td><?=$kakao?></td>
                                    <td><?=substr((($kakao / $StatusCnt) * 100),0,4);?>%</td>									
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
<script type="text/javascript">

	$(document).ready(function(){	
		
		//엑셀 출력
		$('#excel_btn').click(function(){
				var string = $("#base_form").serialize();
				location.href = "?excel_file=월별통계" + "&" + string;
				return false;
		});

	});
</script>
</body>
</html>