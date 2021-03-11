<script type="text/javascript" src="<?=base_url()?>/assets/js/myProfile.js"></script>
<link
		rel="stylesheet"
		type="text/css"
		href="<?=base_url()?>/assets/css/myProfile.css">
<link
		rel="stylesheet"
		href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
		integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
		crossorigin="anonymous">
<link
		rel="stylesheet"
		href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
		crossorigin="anonymous">
<script
		src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
		integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
		crossorigin="anonymous"></script>
<script
		src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
		crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="node_modules/font-awesome-animation.min.css">

<main>
	<div id="device-bar-2">
		<!-- <button></button> <button></button> <button></button> -->
	</div>
	<div class="tb card">
		<?php
		if(isset($followedUsersDatas) && !empty($followedUsersDatas)){
			foreach($followedUsersDatas as $val){
				// print_r($val->followingUsers);\
				foreach($val->followingUsers as $users){
					$userId=$users->user_id;
					$firstName=$users->first_name;
					$lastName=$users->last_name;
					$content=$users->content;
					?>

					<div class="post card Regular shadow">
						<div class="tb">
							<a href="#" class="td p-p-pic"><?php
								if (isset($pic_status)){ ?>
									<img src="<?=base_url().'./uploads/profilepic/profile'.$userId?>.jpg" class="" style="height:50px;width:50px"  alt="profile pic">
								<?php }else{
									?>
									<img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" style="height:50px;width:50px"  alt="profile pic">
									<?php
								}?></a>
							<div class="td p-r-hdr">
								<div class="p-u-info">
									<a href="#"><?= Ucfirst($firstName)," ",Ucfirst($lastName)?></a> shared a post <a href="#">Himalaya Singh</a>
								</div>
								<div class="p-dt">
									<i class="fa fa-calendar"></i>
									<span>Date</span>
								</div>

							</div>
							<div class="dropdown dropleft">
								<a class=" btn-m fa fa-cogs" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								</a>

								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									<a class="dropdown-item" href="#">Remove</a>
									<a class="dropdown-item" href="#">Edit</a>
								</div>

							</div>
						</div>
						<label class="tb " readonly><center><?=$content?></center></label>
						<div class="d-flex justify-content-center">

							<a href="#" class="">
								<div class="container" >
									<div class="row">
										<?php
										?>


									</div>
								</div>
						</div>
						</a>
						<div>
							<div class="p-acts">
								<div class="p-act like"><i class="fa fa-thumbs-up"></i><span>25</span></div>
								<div class="p-act comment btn-click"><i class="fa fa-comment"></i><span>1</span></div>
							</div>
						</div>
					</div>

					<?php
				}

			}
		}
		?>
	</div>
	<div id="device-bar-2">
		<!-- <button></button> <button></button> <button></button> -->
	</div>
</main>

</script>
