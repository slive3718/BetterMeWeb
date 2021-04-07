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
	<div id="device-bar-2" style="max-width: 100%;">
	</div>
	<header>
		<div class="tb">
			<div><a href="<?php echo base_url('user/homepage') ?>">
			<img src="<?= base_url()?>uploads/files/logo.png" style="width:200px;height:70px;"></a></div>
			<?php
			if (isset($user_info) && !empty($user_info)){

			foreach ($user_info

			as $val){
			//   print($val->getAllProfilePost->post_images->result());exit;
			$id = $this->session->userdata('id');
			$username = $val->username;
			$firstName = $val->first_name;
			$middleName = $val->middle_name;
			$lastName = $val->last_name;
			$email = $val->email;
			$dob = $val->dob;
			$pic_status = $val->user_picture_status;
			$sex = $val->sex;
			?>
			<div class="td" id="f-name-l"><a style="font-weight: bold" class="btn btn-s btn-success rounded"
				href="<?= base_url() . 'user/myProfile/' . $id ?>"><?= Ucfirst($firstName) ?></a></div>
                <div class="td" id="i-links">
                    <div class="tb">
                        <div class="td">
                            <a href="#" id="p-link">
                           <?php  if (isset($pic_status)){ ?>
                                    <img src="<?=base_url().'./uploads/profilepic/profile'.$id?>.jpg" class="" 
                                    style="height:35px;width:35px"  alt="profile pic">
                            <?php }else{
                                ?>
                                    <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" 
                                    class="avatar img-circle img-thumbnail" style="height:35px;width:35px"  
                                    alt="profile pic">
								<?php
							} ?>
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
				if (isset($pic_status)) { ?>
					<img src="<?= base_url() . './uploads/profilepic/profile' . $id ?>.jpg"
						 class="avatar img-circle img-thumbnail" style="height:225px;width:225px" alt="avatar">
				<?php } else {
					?>
					<img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail"
						 style="height:225px;width:225px" alt="avatar">
					<?php
				} ?>
			</div>
			<div id="u-name"><?= Ucfirst($firstName), ' ', Ucfirst($lastName) ?></div>
			<div class="tb" id="m-btns">
				<div class="td">
					<!--<div class="m-btn"><i class="material-icons">Change Timeline Piture</i><span></span></div>-->
				</div>
			</div>
		</div>
		<div id="black-grd"></div>
	</div>
		<div class="td" style="float: center;">
				<div class="m-mrg card" id="p-tabs">
					<div class="tb">
						<div class="td">
							<div class="tb" id="p-tabs-m">
								<div class="td active"><a href="<?= base_url() . 'user/myProfile' ?>" class=""><i
												class="fa fa-clock-o"></i><span>TIMELINE</span></a></div>
								<div class="td"><a href="<?= base_url() . 'user/following' ?>" class=""><i
												class="fa fa-user-plus"></i><span>Following</span></a></div>
								<div class="td"><a href="<?= base_url() . 'user/followed_user' ?>" class=""><i
												class="fa fa-users"></i><span>Followed Users</span> </a></div>
							</div>
						</div>
						<!-- <div class="td" id="p-tab-m"><i class="material-icons">keyboard_arrow_down</i></div> -->
					</div>
				</div>
				<div class="m-mrg card Regular shadow" id="composer">
					<div id="c-tabs-cvr">
						<div class="tb" id="c-tabs">
							<div class="td"><i class="material-icons">Whats Up?</i><span></span></div>
						</div>
					</div>
					<div id="c-c-main">
						<div class="tb">
							<div class="td" id="p-c-i"> <?php
								if (isset($pic_status)) { ?>
									<img src="<?= base_url() . './uploads/profilepic/profile' . $id ?>.jpg"
										 class="td p-p-pic" style="height:50px;width:50px" alt="profile pic">
								<?php } else {
									?>
									<img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png"
										 class="avatar img-circle img-thumbnail" style="height:50px;width:50px"
										 alt="profile pic">
									<?php
								} ?></div>
							<form
									method="post"
									action="<?= base_url() ?>user/add_new_post"
									enctype="multipart/form-data">
								<div class="Small" id="c-inp">
                            <textarea
									name="content"
									placeholder="What's on your mind?"
									class="whats-on-ur-mind border border-primary rounded"
									cols="100"
									rows="5" required></textarea>

								</div>
						</div>

						<!-- <div id="insert_emoji"><a class="btn btn-primary btn-sm
						button-post">Post</a></div> -->
					</div>
					</hr>
					<div class="col-sm-12">
						<input
								class="btn btn-primary btn-sm col-md-4"
								style="left:70px"
								type="file"
								name="userfile[]"
								size="20"
								multiple="multiple"/>
						<input
								type="submit"
								value="Post"
								class="btn btn-primary"
								style="right:0px;float:right"/>
					</div>
					<!-- -->
				</div>

				<?php

				if (isset($val->getAllProfilePost) && !empty($val->getAllProfilePost)) {
//					print_r($val->getAllProfilePost);exit;
					foreach ($val->getAllProfilePost as $post) {
						$content = $post->content;
						$my_post_id=($post->post_id);

//						print_r($post->getArchiveStatus);
						$archived=0;
//						print_r($post->getArchiveStatus);
						if(isset($post->getArchiveStatus) && !empty($post->getArchiveStatus)) {
							foreach ($post->getArchiveStatus as $archiveStatus)
								$archived = $archiveStatus->archive_status;
								$confirmed = $archiveStatus->user_confirm_action;
						}

//						print_r($archived);
//
//						?>

						<!--									Archive Checking Start-->
						<?php if($archived!=="1" ){

						?>
						<div class="m-mrg card Regular shadow" id="">
							<div>
								<div class="post card Regular shadow">
									<div class="tb">
										<a href="#" class="td p-p-pic"><?php
											if (isset($pic_status)) { ?>
												<img src="<?= base_url() . './uploads/profilepic/profile' . $id ?>.jpg"
													 class="" style="height:50px;width:50px" alt="profile pic">
											<?php } else {
												?>
												<img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png"
													 class="avatar img-circle img-thumbnail"
													 style="height:50px;width:50px" alt="profile pic">
												<?php
											} ?></a>
										<div class="td p-r-hdr">
											<div class="p-u-info">
												<a href="#"><?= Ucfirst($firstName), " ", Ucfirst($lastName) ?></a>

											</div>
											<div class="p-dt">
												<i class="fa fa-calendar"></i>
												<span>Date</span>
											</div>
										</div>
										<div class="dropdown dropleft">
											<a class=" btn-m fa fa-cogs" href="#" role="button" id="dropdownMenuLink"
											   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											</a>

											<div class="dropdown-menu align-content-center" aria-labelledby="dropdownMenuLink" >
												<a class="dropdown-item" href="<?= base_url().'user/remove_myProfilePost/'.$my_post_id?>">Remove</a>
												<a class="dropdown-item" href="<?= base_url().'user/edit_myProfilePost/'.$my_post_id?>">Edit</a>

											</div>

										</div>
									</div>


									<label class="tb " readonly>
										<center><?= $content ?></center>
									</label>
									<div class="d-flex justify-content-center">

										<a href="#" class="">
											<div class="container">

												<?php
												foreach ($val->getAllProfilePost as $pp) {
													foreach ($pp->post_images as $each_post_images) {
														if ($each_post_images->post_id == $post->post_id) { ?>

															<img src="<?= base_url() . './uploads/profile_posts/' . $each_post_images->image_name ?>">
															<?php
														}
													}
												}

												?>

											</div>
									</div>
									</a>
								</div>
							</div>

						</div>
						<?php }else if ($confirmed !== "1"){
						?>

							<div class="m-mrg card Regular shadow" id="archived-section_<?=$my_post_id?>" class="">
								<div>
									<div class="post card Regular shadow">
										<div class="tb">
											<div style="text-align: center; font-weight: bold; font-size: 25px"> Sorry, This content isn't available right now:<br><a style="font-size: 15px;">"When this happens, it's usually the post is unavailable or deleted due to contents against our rules and standard. "</a></div><span class="mark-read-warning" style="cursor: pointer;color: blue; font-weight: bold; font-size: 12px;" data-post_id="<?=$my_post_id?>">Ok! Mark as read</span>
										</div>
									</div>
								</div>
							</div>

						<?php } ?>
						<!--									End of archive checking -->
					<?php }
				} ?>
				<div clas="fa-3x"><i class="fas fa-sync fa-spin"></i></div>
			</div>
		</div>
	</div>
	<?php
	}
	}
	?>
	<div id="device-bar-2"><i class="fab fa-apple"></i></div>
</main>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
	$(document).ready(function(){

		$('.mark-read-warning').on('click',function(){
			var postId=$(this).attr('data-post_id');
			var confirm_read_url = "<?= base_url().'user/confirm_read_archived_post/'?>";
			// console.log(confirm_read_url);return false;
			Swal.fire({
				title: 'Notice',
				text: "This post will be remain hidden until Admin's approval.",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ok, Continue.'
			}).then((result) => {
				if (result.isConfirmed) {
					$.post(confirm_read_url+postId,{ 'postId':postId },function(success){
						if(success==success){
							Swal.fire({
										icon: 'success',
										title: 'Thank you for confirmation.',
										text: 'Confirmed!',
									});
							$('#archived-section_'+postId).hide();
						}else{
							Swal.fire(
									{
										icon: 'error',
										title: 'Something went wrong',
										text: 'Error',
									});

						}
					});
				}
			})
		})
	});

</script>
