<div class="inner">
<div id="container-box" class="sub">
	<section class="container">
		<div id="member-box" >
			<h3 class="mem-tit">
				<span>비밀번호를 입력해주세요!</span>
			</h3>
			<form name="frm_pass" id="frm_pass" action="<?=$get_par;?>" method="post">
				<p class="passSection">
					<input class="form-control" type="password" name="input_passd" id="input_passd" size=25 maxlength=30 placeholder="비밀번호 입력">
				</p>
                <div id="btn-box" class="center">
					<a href="javascript:;" id="pass_submit" class="btn bg-gray">확인</a>
					<a href="javascript:history.go(-1);"  class="btn bg-black">취소</a>
				</div>
			</form>
		</div>
		<!-- //end #member-box -->
	</section>	
</div>
</div>
<style>
    .mem-tit {
		vertical-align: middle;
        text-align: center;
	}
	.passSection {
		margin-top:30px;
	}
	.form-control {
		display: block;
		width: 100%;
		max-width:610px;
		height: 70px;
		margin:0 auto 8px;
		padding: 5px 15px;
		font-size: 20px;
		line-height: 1.5;
		text-align: left;
		color: #444;
		background-image: none;
		border: 1px solid #ccc;
		outline: none;
		box-sizing: border-box;
		box-shadow: none;
		-webkit-transition: border-color ease-in-out 0.15s, -webkit-box-shadow ease-in-out 0.15s;
		-o-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
		transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
		vertical-align: middle;
	}
</style>
<script type="text/javascript">
	
	$(document).ready(function(){
		
		$('#pass_submit').click(function(){
			
			if($('#input_passd').val() == '') {
				alert("비밀번호를 입력하세요");
				$('#input_passd').focus();
				return false;
			}
			
			$('#frm_pass').submit();
			return false;
		});		
	});
	
</script>