<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css"

		  href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
		  integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
		  crossorigin="anonymous"/>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
			integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
			crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
			integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
			crossorigin="anonymous"></script>
	<!-- start: META -->

	<!-- end: META -->

	<!-- start: GOOGLE FONTS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/googlefonts.css">
	<link rel="shortcut icon" href="<?= base_url();?>assets/images/Smile.png">
	<!--<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />-->
	<!-- end: GOOGLE FONTS -->
	<!-- start: MAIN CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/themify-icons/themify-icons.min.css">
	<link href="<?= base_url() ?>assets/vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
	<link href="<?= base_url() ?>assets/vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet"
		  media="screen">
	<link href="<?= base_url() ?>assets/vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
	<!-- end: MAIN CSS -->
	<!-- start: CLIP-TWO CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/styles.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/plugins.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/themes/theme-1.css" id="skin_color"/>
	<!-- end: CLIP-TWO CSS -->
	<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
	<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->

	<link href="<?= base_url() ?>assets/vendor/select2/select2.min.css" rel="stylesheet" media="screen">
	<link href="<?= base_url() ?>assets/vendor/DataTables/css/DT_bootstrap.css" rel="stylesheet" media="screen">
	<link href="<?= base_url() ?>assets/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet"
		  media="screen">
	<link href="<?= base_url() ?>assets/vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css"
		  rel="stylesheet" media="screen">
	<link href="<?= base_url() ?>assets/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css"
		  rel="stylesheet" media="screen">
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vendor/iCheck/all.css"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vendor/iCheck/minimal/blue.css"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>front_assets/css/custom.css" media="screen"/>

	<link href="<?= base_url() ?>assets/alertify/alertify.core.css" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url() ?>assets/alertify/alertify.default.css" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url() ?>assets/css/myset.css" rel="stylesheet" type="text/css"/>
	<!-- <link rel="stylesheet" type="text/css" href="assets/toggel/css/on-off-switch.css"/> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="<?= base_url() .'/assets/alertify/alertify.js?v=1' ?>"></script>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
<style>
.btn-group-xs > .btn, .btn-xs {
  padding: .25rem .4rem;
  font-size: .8rem;
  line-height: .5;
  border-radius: .2rem;
}
</style>


	<title><?php if ($page_title){
		echo "$page_title";
	}?>
	</title>
</head>

<body>
<div id="" class="">
    <nav class="navbar navbar-expand-md navbar-light bg-success">
		<a href="<?php echo base_url('mentor/homepage') ?>">
		<img src="<?= base_url()?>uploads/files/logo.png" style="width:200px;height:70px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav" >
            <ul class="navbar-nav mr-auto">
            </ul>
            <?php if (isset($this->session->userdata['id'])){
            ?>
            <ul class="navbar-nav" style="float:right;>
                <li class="nav-item">
                    <a class="nav-link" href=""></a>
                </li>
                
                <li class="nav-item" style="font-weight: bold; font-size: 15px; list-style-type: none; margin-left: 20px">
                    <?php if (isset($this->session->userdata['id'])){
                        echo (ucfirst($this->session->userdata['uname']));
                    }else {
                        ?>
                         <a class="nav-link" href="<?php echo base_url('mentor/viewSignUp') ?>">Register</a>
                    <?php
                    }?>
                </li>
               
            </ul>
            <div class="dropleft show mr-20" style="float:right; padding:3px;" >
            
  <a class=" " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   <span class="fa fa-caret-down mr-3" aria-hidden="true"> </span>
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

    <a class="dropdown-item" style="font-weight: bold;" href="<?php echo base_url('mentor/viewDiet') ?>">Manage My Diet Plan</a>
    <a class="dropdown-item" style="font-weight: bold;" href="<?php echo base_url('mentor/viewMyProfile') ?>">Manage My Info</a>
    <a class="dropdown-item" style="font-weight: bold;" href="<?php echo base_url('mentor/logout')?>">LogOut</a>
  </div>
</div>
<?php
}
else{
?>
    <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href=""></a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link"  style="font-weight: bold; font-size: 15px;" href="<?php echo base_url('mentor/viewLogin') ?>">Login</a>
                </li>
               
            </ul>
<?php 
}
?>
        </div>
    </nav>
</div>

