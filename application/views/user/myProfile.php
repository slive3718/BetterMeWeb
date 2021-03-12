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

<main>
	<div id="device-bar-2">
		<!-- <button></button>
		<button></button>
		<button></button> -->
	</div>
	<header>
		<div class="tb">
			<div>
				<center><a href="<?= base_url() . 'user/homepage/' ?>">Better Me</a></center>
			</div>
			<div class="td" id="search-form" style="float:left;">
				<form method="get" action="#">
					<input type="text" placeholder="Better Me Search">
					<button type="submit"><i class="material-icons">search</i></button>
				</form>
			</div>
			<?php foreach ($user_info
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
			<div class="td" id="f-name-l"><span><a style="color:white" class="btn btn-s btn-success rounded"
												   href="<?= base_url() . 'user/myProfile/' . $id ?>"><?= Ucfirst($firstName) ?></a></span>
			</div>
			<div class="td" id="i-links">
				<div class="tb">
					<div class="td" id="m-td">
						<div class="tb">
							<span class="td"><i class="fa fa-user"></i></span>
							<span class="td"><i class="fa fa-envelope"></i></span>
							<span class="td m-active"><i class="fa fa-bell"></i></span>
						</div>
					</div>
					<div class="td">
						<a href="#" id="p-link">
							<?php if (isset($pic_status)) { ?>
								<img src="<?= base_url() . './uploads/profilepic/profile' . $id ?>.jpg" class=""
									 style="height:35px;width:35px" alt="profile pic">
							<?php } else {
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
					<div class="m-btn"><i class="material-icons">Change Timeline Piture</i><span></span></div>
				</div>
			</div>
		</div>
		<div id="black-grd"></div>
	</div>
	<div id="main-content">
		<div class="tb ">
			<div class="td" id="l-col">
				<div class="l-cnt card Regular shadow">
					<div class="cnt-label ">
						<i class="l-i" id="l-i-i"></i>
						<span>Intro</span>
						<div class="lb-action"><i class="material-icons">edit</i></div>
					</div>
					<div id="i-box">
						<div id="intro-line">Web developer - UI</div>
						<div id="u-occ">Developing awesome UIs at <a href="#">Google LLC</a> Bengaluru and inspiring
							other companies to do so :)
						</div>
						<div id="u-loc"><i class="material-icons">location_on</i><a href="#">Bengaluru</a>, <a href="#">India</a>
						</div>
					</div>
				</div>

				<div class="l-cnt l-mrg card Regular shadow">
					<div class="cnt-label">
						<i class="l-i" id="l-i-p"></i>
						<span>Photos</span>
						<!-- <div class="lb-action" id="b-i"><i class="fa fa-caret-down"></i></div> -->
					</div>
					<div id="photos">
						<div class="container">
							<div>


							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="td" id="m-col">
				<div class="m-mrg card" id="p-tabs">
					<div class="tb">
						<div class="td">
							<div class="tb" id="p-tabs-m">
								<div class="td active"><a href="<?= base_url() . 'user/myProfile' ?>" class=""><i
												class="fa fa-clock-o"></i><span>TIMELINE</span></a></div>
								<div class="td"><a href="<?= base_url() . 'user/following' ?>" class=""><i
												class="fa fa-user-plus"></i><span>Following</span></a></div>
								<div class="td"><a href="<?= base_url() . 'user/followed_user' ?>" class=""><i
												class="fa fa-users"></i><span>Followers</span> </a></div>
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
									rows="5"></textarea>

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
					foreach ($val->getAllProfilePost as $post) {
						$content = $post->content; ?>
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

											<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
												<a class="dropdown-item" href="#">Remove</a>
												<a class="dropdown-item" href="#">Edit</a>
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

															<img src="<?= base_url() . './uploads/posts/' . $each_post_images->image_name ?>">
															<?php
														}
													}
												}

												?>

											</div>
									</div>
									</a>

									<div>
										<div class="p-acts">
											<div class="p-act like"><i class="fa fa-thumbs-up"></i><span>25</span></div>
											<div class="p-act comment btn-click"><i
														class="fa fa-comment"></i><span>1</span></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php }
				} ?>
				<div clas="fa-3x"><i class="fas fa-sync fa-spin"></i></div>
			</div>

		</div>
	</div>
	<?php
	}

	?>
	<div id="device-bar-2"><i class="fab fa-apple"></i></div>
</main>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
	$(document).ready(function () {
		$('.btn-click').on('click', function () {
			alert('hi');
		});
		//     $(".button-post").on("click",function(){


		//       var postContent= $("input.whats-on-ur-mind").val();
		//     // var page_link = $(location).attr('href');

		//     // var page_name = "Sessions";
		//     $.ajax({
		//         url: "<?=base_url()?>user/create_profile_post",
		//         type: "post",
		//         data: {'content': postContent},
		//         dataType: "json",
		//         success: function (data) {
		//             Swal.fire('Post Success').then(function(){
		//                 $('input.whats-on-ur-mind').val("");
		//                 location.reload();
		//             });
		//         }
		//     });
		// });

	});

</script>
