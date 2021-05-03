<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>BetterMe-Login or SignUp</title>
	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?= base_url();?>assets/images">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/main.css">
	<link rel="shortcut icon" href="<?= base_url();?>assets/images/Smile.png">
<!--===============================================================================================-->
</head>
<style>
a.design:hover{
	text-decoration: underline;
}

</style>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="<?= base_url();?>assets/images/fitness-girl.jpg" alt="IMG">
				</div>
			
			
				<form class="login100-form validate-form" action="<?= base_url().'user/signUp'?> " method="POST"
				onsubmit="if(document.getElementById('agree').checked) { return true; } else { 
					alert('Please indicate that you have read and agree to our Terms and Conditions.'); 
					return false; }">
					<span class="login100-form-title">
						SignUp
					</span>

					<div class="wrap-input100 validate-input btn-danger rounded">
					<center>
					<?php if ($this->session->flashdata('msgerror')){
					echo $this->session->flashdata('msgerror');
						}?> </center>
						</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid Account type Is Required" >
						<!-- <input class="input100" type="text" name="account_type" placeholder="Username" value="0"> -->
											<select name="account_type" class="input100" name="cars" id="cars">
						<option name="account_type"  value="U" selected>User</option>
						<option name="account_type"  value="M">Mentor</option>
						
					</select>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid Username Is Required">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

                    
					<div class="wrap-input100 validate-input" data-validate = "Confirm Password not Match">
						<input class="input100" type="password" name="confirmpassword" placeholder="Confirm Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<div class="text-center p-t-136">
					<input type="checkbox" name="checkbox" value="check" id="agree"/>
						<a class="txt2" style="font-size: 12px;">
							By clicking Submit, you agree to our </a><br>
						<a class="design" style="font-size: 12px; color: blue;"
						href="<?=base_url()?>">Terms & Conditions.
						</a>
					</div>
					<div class="container-login100-form-btn">
						<input type="submit" name="submit" class="login100-form-btn">
							
					</div>

					<!-- <div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div> -->

					<div class="text-center p-t-136">
						<a class="txt2" href="<?=base_url()?>user/viewLogin">
							Already have account? Sign In
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
						
					</div>
				</form>
			</div>
		</div>
	</div>

	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>