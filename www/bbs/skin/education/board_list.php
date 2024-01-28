<?
    $jb_select = $C_Func -> makeSelect_Normal('jb_type', $GP -> jb_TYPE, $_GET['jb_type'], 'class="form-control"' , '','');
    $jb_sub_select = $C_Func -> makeSelect_Normal('jb_sub_type', $GP -> jb_sub_TYPE, $_GET['jb_sub_type'], 'class="form-control"', '');    
    $jb_etc16_select = $C_Func -> makeSelect_Normal('jb_etc16', $GP -> jb_etc16_TYPE, $_GET['jb_etc16'], 'class="form-control"', '');    
?>  
<div class="contents half-top-pad">
				<div class="inner">
					<div class="sub-tit bar center">
						<h3>교육행사 신청</h3>
					</div>
                    <div class="contents-filter">
						<h3 class="caption">상세검색</h3>                       
                        <form id="search_form" name="search_form" method="get" action="?">
                            <input type="hidden" name="jb_code" id="jb_code" value="<?=$jb_code?>" />
						<div class="filter-wrap">                      
							<div class="filter class">
								<label for="">분류</label>
								<?=$jb_select?>
							</div>
							<div class="filter division">
								<label for="">구분</label>
								<?=$jb_sub_select?>
							</div>
							<div class="filter date">
								<label for="">신청기간</label>
								<input type="text" id="datepicker" class="form-control" name="s_date" value="<?=$_GET['s_date']?>" readonly="">
								<span>-</span>
								<input type="text" id="datepicker2" class="form-control" name="e_date" value="<?=$_GET['e_date']?>" readonly="">
							</div>  
							<div class="filter ing">
								<label for="">상태</label>
							    	<?=$jb_etc16_select?>
							</div>    
							<div class="filter search">
								<label for="">검색</label>
								<div class="search-wrap">
									<input type="text" class="form-control" name="" value="">
									<button type="submit" name="search_keyword" id="search_keyword" value="<?=$_GET['search_keyword']?>"><img src="/resource/images/gray-search.png" alt="검색"></button>
								</div>
							</div>   
						</div>   
                        </form>                     
					</div>
        <?php
            if($_GET['search_key'] && $_GET['search_keyword']) {
                echo "<a href=\"javascript:;\" class=\"btn bg-black\" onclick=\"javascript:location.href='${index_page}?jb_code=${jb_code}'\" title='목록'><span>목록</span></a>";
            }       
            //쓰기권한
            if($check_level >= $db_config_data['jba_write_level']) {
               echo' <div id="btn-box" class="right">';
               echo "<a class='btn bg-black' href=\"#\" onclick=\"javascript:location.href='${index_page}?jb_code=${jb_code}&jb_mode=twrite'\" title='글쓰기'><span>글쓰기</span></a>";
               echo' </div>';
            } else {
            //	echo "<a class='btn btn_middle' id='twrite_btn' title='글쓰기'><strong>글쓰기</strong></a>";
            }
        ?>

                    <div class="noticeTable text-center eduTable">
						<table>
							<colgroup>
								<col style="width: 90px;">
								<col style="width: 150px;">
								<col style="">
								<col style="width: 215px;">
								<col style="width: 215px;">
								<col style="width: 120px;">
							</colgroup>
							<thead>
								<tr>
									<th>번호</th>
									<th>분류</th>
									<th>교육&middot;행사명[장소]</th>
									<th>신청기간</th>
									<th>교육&middot;행사일정</th>
									<th>상태</th>
								</tr>
							</thead>
							<tbody>
                    <?php include $GP -> INC_PATH . "/${skin_dir}/board_list_inc.php";	?>
                </tbody>
            </table>
        </div>
        <!-- //end tableType -->
        <div class="pagination">
            <?=$page_link?>
        </div>
    </div>
</div>
</div>
<!-- //end #container -->


<script type="text/javascript">
    $(document).ready(function () {
        $('#search_submit').click(function () {
            $('#search_form').submit();
            return false;
        });

        $('#page_row').change(function () {
            var val = $(this).val();
            location.href =
                "?dep1=<?=$_GET['dep1']?>&dep2=<?=$_GET['dep2']?>&search_key=<?=$_GET['search_key']?>&search_keyword=<?=$_GET['search_keyword']?>&page=<?=$_GET['page']?>&page_row=" +
                val;
        });

        $('#twrite_btn').click(function () {
            alert("로그인 후 이용가능 합니다.");
            location.href = '/member/login.html?reurl=/community/page03.html';
        });
    });
</script>