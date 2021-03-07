
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- <link rel = "stylesheet" type = "text/css" 
   href = "<?php echo base_url(); ?>assets/css/top-nav.css">
   
   <script type = 'text/javascript' src = "<?php echo base_url(); 
   ?>asstes/js/top-nav.js"></script> -->
 <link rel = "stylesheet" type = "text/css" 
 
 href = "<?php echo base_url(); ?>assets/css/bootstrap.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
 
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


	<title><?php if ($page_title){
		echo "$page_title";
	}?>
	</title>
</head>

<body>
<div id="" class="">
    <nav class="navbar navbar-expand-md navbar-light bg-success">
        <a class="navbar-brand" href="<?php echo base_url('admin/homepage') ?>">BetterMe</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav" >
            <ul class="navbar-nav mr-auto">
          
            </ul>
            <?php if (isset($this->session->userdata['id'])){

            ?>
            <div class="dropleft show mr-20">
  <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   <span class="fa fa-caret-down mr-3" aria-hidden="true"> </span>
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">


    <a class="dropdown-item" href="<?php echo base_url('admin/viewDiet') ?>">Review/Manage Diet Plan Posts</a>
    <a class="dropdown-item" href="<?php echo base_url('admin/review_community_thread') ?>">Review Thread Posts</a>
    <a class="dropdown-item" href="<?php echo base_url('admin/viewArchiveDiet') ?>">View Archived Posts</a>
    <a class="dropdown-item" href="<?php echo base_url('admin/viewArchivedCommunityThread') ?>">View Archived Community Thread</a>
    <a class="dropdown-item" href="<?php echo base_url('admin/logout')?>">LogOut</a>
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
                    <a class="nav-link" href="<?php echo base_url('admin/viewLogin') ?>">Login</a>
                </li>
               
            </ul>
          
<?php 
}
?>
           <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href=""></a>
                </li>
                
                <li class="nav-item">
                    <?php if (isset($this->session->userdata['id'])){
                        echo (ucfirst($this->session->userdata['uname']));
                    }else {
                        ?>
                         <a class="nav-link" href="<?php echo base_url('admin/viewSignUp') ?>">Register</a>
                    <?php
                    }?>
                   
                
                
                </li>
               
            </ul>
        </div>
    </nav>
</div>


    <!-- <a href="<?php echo base_url('admin/homepage') ?>">Home</a>

        <div class="nav-item dropdown">
            <button class="nav-link dropdown-toggle">File 
      <i class="fa fa-caret-down"></i>
    </button>
            <div class="nav-item dropdown">
               
                <a href="">Motivational Posts</a>
                <a href="">View Diet Plans</a>
				

              
            </div>
            

		</div>
		<a href="<?php echo base_url('admin/logout') ?>">LogOut</a> -->

	</div>
	
    </head>
	

  
