
<script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"
			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			  crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/css/myProfile.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/js/myProfile.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/myProfile.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
	  integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
	  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
		integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
		crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
		crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="node_modules/font-awesome-animation.min.css">
<body style='overflow-x:hidden;'>


<main>

        <header>
            <div class="tb"> 
            <div><a href="<?php echo base_url('user/homepage') ?>">
			<img src="<?= base_url()?>uploads/files/logo.png" style="width:200px;height:70px;"></a></div>
                <?php foreach ($user_info as $val){
                  
            $id=$this->session->userdata('id');
            $username=$val->username;
            $firstName=$val->first_name;
            $middleName=$val->middle_name;
            $lastName=$val->last_name;
            $email=$val->email;
            $dob=$val->dob;
            $pic_status=$val->user_picture_status;
            $sex=$val->sex;

                 ?>
                <div class="td" id="f-name-l"><a style="font-weight: bold" class="btn btn-s btn-success rounded"
				href="<?= base_url() . 'user/myProfile/' . $id ?>"><?= Ucfirst($firstName) ?></a></div>
                <div class="td" id="i-links">
                    <div class="tb">
                        <div class="td">
                            <a href="#" id="p-link">
                           <?php  if (isset($pic_status)&& !empty($pic_status)){ ?>
                                    <img src="<?=base_url().'./uploads/profilepic/profile'.$id?>.jpg" class="" 
                                    style="height:35px;width:35px">
                            <?php }else{
                                ?>
                                    <img src="https://www.linkpicture.com/q/avatarprofile.png" 
                                    class="avatar img-circle img-thumbnail" style="height:35px;width:35px">
                                <?php
                            }?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div id="profile-upper">
            <div id="profile-banner-image">
                <img src="https://imagizer.imageshack.com/img924/8210/3cMvFg.jpg" alt="Banner image">
            </div>
            <div id="profile-d">
                <div id="profile-pic" class="card Regular shadow">
                <?php
                if (isset($pic_status)&& !empty($pic_status)){ ?>
                     <img src="<?=base_url().'./uploads/profilepic/profile'.$id?>.jpg" class="avatar img-circle img-thumbnail" style="height:225px;width:225px">
               <?php }else{
                   ?>
                    <img src="https://www.linkpicture.com/q/avatarprofile.png" class="avatar img-circle img-thumbnail" style="height:225px;width:225px">
                   <?php
               }?>
                </div>
                <div id="u-name"><?= Ucfirst($firstName),' ',Ucfirst($lastName)?></div>
                <div class="tb" id="m-btns">
                    <div class="td">
                        <!--<div class="m-btn"><i class="material-icons">Change Timeline Piture</i><span></span></div>-->
                    </div>
                </div>
            </div>
            <div id="black-grd"></div>
        </div>
        <div id="main-content">
            <div class="tb ">
                <div class="td" id="l-col">                   
                <div class="m-mrg card Regular shadow" id="composer"  style='right:20px'>
                        <div id="c-tabs-cvr">
                            <div class="tb" id="c-tabs">
                                <div class="td"><h3>People that will inspire you</h3></div>
                            </div>
                                <table class="table table-bordered border-success table-striped text-center" >
                               <thead>
							   <th>Name of User</th>
							   <th>Option</th>
							   </thead>
									<tbody>
                                <?php if (isset($val->getAllusersToFollow) && !empty($val->getAllusersToFollow)){
                                    foreach ($val->getAllusersToFollow as $user){
                                                foreach($val->getFollowtbl as $folloStat){
                                                        if ($folloStat->following_id == $user->userId){
                                                            // echo $user->userId,$folloStat->subscribe;
                                                           $subs=$folloStat->following_id;
                                                           $status = $folloStat->subscribe;
                                                        }
                                                }
                                        ?>
                                        <tr>
                                        <td class="" style="text-align: left"><?=(isset($user->first_name,$user->last_name) && !empty($user->first_name)&& !empty($user->last_name))?Ucfirst($user->first_name):Ucfirst($user->username),' ',ucfirst($user->last_name),' ',(isset($user->account_type)&&($user->account_type)=='M')?'<a class="text-primary" title="Our Mentor is a professional teacher that may gives help and advice">(Mentor)</a>':''?></td>
                                        <td class=""> <!-- --> <?php if (isset($subs) && $subs==$user->userId && $status=='1'){
                                        ?><a data-session-id="<?= $user->userId ?>" class="button-unfollow" style="cursor: pointer;" title="Unfollow"><span id ="button-unfollow" class="fa fa-check btn btn-danger btn-sm"></span></a> <?php
                                        }else{
                                            ?> <a data-session-id="<?= $user->userId ?>" class="button-follow" style="cursor: pointer;" title="Follow"><span class="fa fa-plus btn btn-success btn-sm"></span></a> <?php
                                        }?>
                                         <!-- --> <a href="<?=base_url().'user/visit_profile/'.$user->userId?>" class="button-visit" title="Visit Profile" ><span class="fa fa-user btn-primary btn-sm"></span></a></td>
                                        </tr>
                                       
                                        
                                        <?php
                                    }
                                }?>
									</tbody>
                                 </table>
                             
                            </div>
                        </div>
         
            </div>
        </div>
        <?php           
                } 
                
          ?>
        </div>
        <div id="device-bar-2"><i class=""></i></div>
    </main>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
    <!--  -->
<script type="text/javascript">
	$(document).ready(function () {
		$('.table').DataTable({
			"language": {
				"info": "Number of People _START_ to _END_ of _TOTAL_ entries",
				"search": "Looking for someone ? <b> Search here",
				"lengthMenu":     "Show _MENU_ People",
			}
		});

	});

	$(document).ready(function () {

		$('.table').on('click', '.button-unfollow',function () {

			var userId = $(this).data("session-id");
			let href = $(this).attr('href-url');
			$.post("<?= base_url() ?>user/follow_user_Jquery/", {"userId": userId}, function (response) {
				if (response == "success") {
					alert('unfollowed');
					$('#button-unfollow').toggleClass('fa fa-plus btn btn-success btn-sm');
					location.reload();
				}
			});

		});
	});
	$(document).ready(function () {
		$('.table').on('click','.button-follow', function () {

			var userId = $(this).data("session-id");
			let href = $(this).attr('href-url');
			$.post("<?= base_url() ?>user/follow_user_Jquery/", {"userId": userId}, function (response) {
				if (response == "success") {
					alert('Followed');
					$('#button-unfollow').toggleClass('fa fa-check btn btn-danger btn-sm');
					location.reload();
				}
			});

		});
	});
</script>
