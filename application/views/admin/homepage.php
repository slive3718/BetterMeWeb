<style>

	.container {
		display: flex;
		flex-wrap: wrap;
		align-items: center;
	}

	.container .image {
		width: 50%;


	}

	.container img {
		width: calc(100% - (150px * 2));
		margin: 20px;
		margin-left: auto;
		margin-right: auto;
		display: block;
	}
	.table th{
		color: #28A745;
		font-family: monospace,sans-serif;
	}
	.font-header{
		color: #FFFFFF;
		font-family: 'Raleway', sans-serif;
		font-size: 30px;
		font-weight: 800;
		line-height: 72px;
		margin: 0 0 24px;
		text-align: center;
		text-transform: uppercase;
		background-color: #28A745;

	}
</style>
<div style="width:70%;padding-right:30px;" class="">
	<?php
	$current_user = $this->session->userdata('id');

	if (isset($rows)) {
		?>
		<h1 class="d-flex justify-content-center">
			Diet Plans
		</h1>
		<?php
		foreach ($rows as $row) {

			$post_id = $row->post_id;
			$post_title = $row->post_title;
			$post_content = $row->post_content;
			$date_posted = $row->date_posted;
			$routine_count = $row->routine_count;
			$routine_format = $row->routine_format;
			$post_user_id = $row->post_user_id;
			$post_type = $row->post_type;
			$type_of_diet = $row->type_of_diet;
			$posts_user_name = $row->username;
			$pic_status = $row->user_picture_status;
			$target_audience = $row->target_audience;
			?>

			<?php
			if ($this->session->flashdata('msgsuccess')) {
				echo $this->session->flashdata('msgsuccess');
			}

			if ($this->session->flashdata('msgwarn')) {
				echo $this->session->flashdata('msgwarn');
			}
			if ($this->session->flashdata('msgerror')) {
				echo $this->session->flashdata('msgerror');
			} ?>

			<div
					class="shadow p-3 mb-5"
					style='float:left;margin-left:65px;margin-bottom:30px;'>
				<div class="d-flex justify-content-between btn btn-success btn-xs">

					<div>    <?php if (isset($pic_status)){
						?>
						<img style="width:2rem;height:2rem" ;
							 src="<?= base_url() . './uploads/profilepic/profile' . $post_user_id ?>.jpg"
							 class="img-circle img-responsive"
							 alt=""/> Posted by: <?= ucfirst($posts_user_name) ?></div>
					<?php
					} ?>
					<div>Date Posted: <?= $date_posted ?></div>
				</div>
				<div class="card" style="width:30rem;height:35rem">
					<div style="width:30rem;height:30rem">
					<a href="<?= base_url('admin/viewFullDiet/' . $post_id)?>">
					<div class="container" >
						<?php foreach ($row->images as $images) {
							?>
							<img class="" src="<?= base_url() . 'uploads/posts/' . $images->image_name ?>"
								 alt="Card image cap" style="">
						<?php } ?>
					</div>
					</a>
				</div>
					<div class="card-body">
						<div class="rounded card shadow"style="background-color: #28A745; color:white;text-align: center; width:28rem;height:15rem"">
							<div style="margin-left:10px;margin-right: 5px">
							<h5 class="card-title d-flex justify-content-center"><?= $post_title ?></h5>
							<div>
								<?= (isset($type_of_diet) && !empty($type_of_diet) && ($type_of_diet)!="Other Diet") ? '<span style="float:left">Type of Diet: </span><span style="float:right">'.$type_of_diet.'</span><br>':''?>
								<?= (isset($other_diet) && !empty($other_diet))? '<span style="float:left">Type of Diet: (Other Diet)</span><span style="float:right">'.$other_diet.'</span><br>':''?>
								<?= ((isset($routine_count) && !empty($routine_count)) && (isset($routine_format) && !empty($routine_format)))? '<span style="float:left">Routine: </span><span style="float:right">'.$routine_count.' '.$routine_format.'</span><br>':'';?>
								<?= ((isset($target_audience) && !empty($target_audience)) && (isset($target_audience) && !empty($target_audience)))? '<span style="float:left">Good For: </span><span style="float:right">'.$target_audience.' </span><br>':'';?>
							</div><br>
							<p class="card-text ">
								<?php if (strlen($post_content) > 300) {
										$firstdesc = substr($post_content, 0, 150);
									echo $firstdesc . '<a class=" stretched-link" href="' . base_url('admin/viewFullDiet/' . $post_id) . '">...see more </a>';
								} else {
									echo $post_content;
								}
								?>
							</p>
						</div>

						</div>

					</div>
				</div>
			</div>
			<?php
		}
	} ?>

<div>
	<div class="shadow-lg p-3 mb-5 ml-5 responsive" style="display:inline-block;">
		<div class="card" style="">
			<?php if ($this->session->flashdata('msgsuccess_c')) {
				echo "<div class='btn btn-success'>" . $this->session->flashdata('msgsuccess_c') . '</div>';
			} ?>
			<img
					class="card-img-top"
					src="<?= base_url(); ?>assets/images/betterMeCommunity.png?>"
					alt="Card image cap"
					style="width:300px;height:120px;margin:auto">

			<table class="responsive table">
				<div class="border border-success font-header" >Top 10 Most Likes Diet</div>
				<thead>
				<th>Diet Title</th>
				<th style="float:right">Like Count</th>
				</thead>
				<tbody>
				<?php if(isset($getTopDiets) && !empty($getTopDiets)){

					foreach ($getTopDiets as $diets){
						?>
						<tr>
							<td>
								<span style="float:left !important;"><a href="<?= base_url().'admin/viewFullDiet/'.$diets->post_id?>"><?=$diets->post_title?></a></span>
							</td>
							<td>
								<span style="float:right !important;"><?=$diets->like_sum?></span>
							</td>
						</tr>
						<?php
					}} ?>
				</tbody>
			</table>
			<div class="card-body">
				<button class="btn btn-success btn-sm"
						onclick="window.location.href='<?= base_url() . 'admin/create_thread' ?>'"  style="float:right"> Create a Thread
				</button>
				<h5 class="card-title d-flex justify-content-center"></h5>
				<p class="card-text ">

				<table>

					<?php
					if (isset($community_posts)) {
//    print_r($community_posts);
						foreach ($community_posts as $community_post) {

							$community_post_id = $community_post['community_id'];
							$thread_title = $community_post['thread_title'];
							$thread_content = $community_post['thread_content'];
							$thread_date = $community_post['thread_date'];
							$thread_user_id = $community_post['thread_user_id'];
							$thread_user_name = $community_post['username'];

							?>
							<tr>
								<td>
									<a href="<?= base_url() . 'admin/view_this_community_post/' . $community_post_id ?>">
										<?php echo $thread_title ?>
									</a>

								<th>
									<a href="<?= base_url() . 'admin/view_this_community_post/' . $community_post_id ?>">
										<?php
										if (strlen($thread_content) > 30) {
											$thread_content_cut = substr($thread_content, 0, 30);
											echo $thread_content_cut;
										} else {
											echo $thread_content;
										}
										?>
									</a>
								</td>
								<td>
									<p style="font-size:50%;">
										<?php echo $thread_date ?>
									</p>
								</td>
								<td>

									<p style="font-size:70%;">Post Author:
										<?php echo $thread_user_name ?>
									</p>
								</td>
							</tr>
							<?php
						}
					} ?>

				</table>


				</p>
			</div>
		</div>

	</div>
</div>
