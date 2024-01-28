<?php
	include_once("../../_init.php");
	include_once($GP -> INC_ADM_PATH."/head.php");
?>
<body class="loginWrap">
<link rel="stylesheet" type="text/css" href="/admin/css/util.css">
<link rel="stylesheet" type="text/css" href="/admin/css/main.css">
<script type="text/javascript" src="/admin/js/jquery.validate.js"></script>
<script type="text/javascript" src="/admin/js/login.check.js"></script>
<script type='text/javascript' src='/admin/js/jquery.alphanumeric.js'></script>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
            <form name="base_form" id="base_form" method="POST" action="?">
				<input type="hidden" name="bakurl" value="<?=$_GET['bakurl']?>">
				<input type="hidden" name="mode" id="mode" value="login" />
					<span class="login100-form-title p-b-26">
						Welcome
					</span>
					<span class="login100-form-title p-b-48">
						<i class="zmdi zmdi-font"></i>
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
                    ID<input class="input100" type="text" name="loginAdminId" id="loginAdminId">
						<span class="focus-input100" data-placeholder=""></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						PW<input class="input100" type="password" name="loginAdminpw" id="loginAdminpw">
						<span class="focus-input100" data-placeholder=""></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn">
								Login
							</button>
						</div>
					</div>
                    </form>

					<div class="text-center p-t-115">
						<span class="txt1">
							선진정공(주)
						</span>

						<!--a class="txt2" href="#">
							Sign Up
						</a-->
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>

</body>
</html>