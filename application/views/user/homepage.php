<body style='overflow-x:hidden;' xmlns="http://www.w3.org/1999/html">
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
		margin: 20px auto;
		display: block;
	}

	.table th {
		color: #28A745;
		font-family: monospace, sans-serif;

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
	.class-card{
		width:23rem;
		height:30rem;
	}
	@media screen and (max-width: 1193px) {
		body {


		}

	}
	@media screen and (max-width: 600px) {
		body {
			background-color: olive;
		}
	}
	@media only screen and (max-width: 600px) {
		body {
			background-color: lightblue;
		}
	}

.speech-recognition{
	float: right;
	background-color: #28A745;
}
.col-speech{
	background-color: #28A745;
}

section{

}
	.parallax1 {
		/* The image used */
		background-image: url("<?= base_url()?>uploads/images/home-bg.jpg");

		/* Set a specific height */
		min-height: 500px;
		/* Create the parallax scrolling effect */
		background-attachment: fixed;
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;

	}

</style>
<section class="parallax1">
	<div class="col-12" style="text-align: center">
		<div class="jumbotron">
			<img src="<?= base_url()?>uploads/files/health.jpg" style="width: 100%; height: 70%">
		</div>

		<br><br><br>
		<div class="row">
			<div class="col-md-12 col-speech">
				<div class="speech-recognition">
					<label for="Speech Recognition"><b>Try Our Search Bar </b></label>
					<input type="text" name="" id="speechToText" placeholder="Search Something" class="btn btn-outline-primary" style="background-color: #dddddd;color: #1F1F1F">
					<audio allow="autoplay" id="audio" src="<?= base_url() ?>uploads/notification/swiftly-610.mp3"></audio>
					<button  onclick="record()"  class="btn btn-warning btn-sm">Voice Input</button>
					<button class="btn-search btn btn-primary btn-sm">Search</button>
				</div>
			</div>
		</div>




		<h1 class="jumbotron" style="margin:10px; font-weight: bold; text-align: center; background-color: #28A745">
			Diet Plans and Exercise Routines
		</h1>
		<br><br>

		<br>
	</div>
</div>
	<div class="row">
	<div class="diets col-8">
		<?php
		$current_user = $this->session->userdata('id');
		if (isset($rows)) {
			?>

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

				if (isset($row->getLikeStatus) && !empty($row->getLikeStatus)) {
					foreach ($row->getLikeStatus as $getLike) {
						$like = $getLike->like_status;
					}
				}
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

				<div class="shadow p-3 mb-5" style='float:left;margin-left:10px; margin-bottom:30px; right:20px;background: rgba(255,255,255, 0.8)'>
					<div class="d-flex justify-content-between btn btn-success btn-xs">

						<div style="font-weight: bold;">    <?php if (isset($pic_status)){
							?>
							<img style="width:2rem;height:2rem"
								 src="<?= base_url() . './uploads/profilepic/profile' . $post_user_id ?>.jpg"
								 class="img-circle img-responsive"
								 alt=""/> Posted by: <?= ucfirst($posts_user_name) ?></div>
						<?php
						} ?>
						<div style="font-size: 10px; font-weight: bold;">Date Posted: <?= $date_posted ?></div>
					</div>

					<div class="card responsive class-card">

							<a href="<?= base_url('user/viewFullDiet/' . $post_id) ?>">
								<div class="container" >
									<?php foreach ($row->images as $images) {
										?>
										<img class="image" src="<?= base_url() . 'uploads/posts/' . $images->image_name ?>"
											 alt="Card image" style="max-height:100px;max-width:120px">
									<?php } ?>
								</div>
							</a>

						<div class="card-body" style="">
							<div class="rounded card shadow"
								 style="background-color: #28A745; color:white;text-align: center; height: 100%">
								<div style="margin-left:10px;margin-right: 5px">
									<h5 class="card-title d-flex justify-content-center"><?= $post_title ?></h5>
									<div>
										<?= (isset($type_of_diet) && !empty($type_of_diet) && ($type_of_diet) != "Other Diet") ? '<span style="float:left">Type of Diet: </span><span style="float:right">' . $type_of_diet . '</span><br>' : '' ?>
										<?= (isset($other_diet) && !empty($other_diet)) ? '<span style="float:left">Type of Diet: (Other Diet)</span><span style="float:right">' . $other_diet . '</span><br>' : '' ?>
										<?= ((isset($routine_count) && !empty($routine_count)) && (isset($routine_format) && !empty($routine_format))) ? '<span style="float:left">Routine: </span><span style="float:right">' . $routine_count . ' ' . $routine_format . '</span><br>' : ''; ?>
										<?= ((isset($target_audience) && !empty($target_audience)) && (isset($target_audience) && !empty($target_audience))) ? '<span style="float:left">Suitable For: </span><span style="float:right">'.$target_audience.'</span><br>' : ''; ?>

									</div>
									<p class="card-text ">
										<?php if (strlen($post_content) > 300) {
											$firstdesc = substr($post_content, 0, 150);
											echo $firstdesc . '<a class=" stretched-link" href="' . base_url('user/viewFullDiet/' . $post_id) . '">...see more </a>';
										} else {
											echo $post_content;
										}
										?>
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="row ml-2">
						<div class="like p-2 cursor col-md-6" id="like-id_<?= $post_id ?>"
							 style="cursor: pointer; <?= (isset($like) && !empty($like) == 1) ? 'color:blue' : '' ?>; "
							 data-post_id="<?= $post_id ?>">
							<i class="fa fa-thumbs-o-up"></i>
							<span class="ml-1"> Like</span>
							<span><?= (isset($row->getLikeCount) && ($row->getLikeCount) != 0) ? $row->getLikeCount : '' ?></span>
						</div>
						<div class="comment p-2 cursor col-md-6" id="comment_id_<?= $post_id ?>"
							 style="cursor: pointer;"
							 data-post_id="<?= $post_id ?>">
							<i class="fa fa-comment-o"></i>
							<span class="ml-1"><a href="<?= base_url('user/viewFullDiet/' . $post_id) ?>"> Comments </a> </span> <span><?=(isset($row->getCommentCount) && ($row->getCommentCount)!=0)?$row->getCommentCount:''?></span>
						</div>
					</div>
				</div>
				<?php
			}
		} ?>
	</div>
	<div class="threads col-3" style="float:right; max-width: 100%; ">
		<div class="shadow-lg p-3 mb-5 ml-5 responsive" style="display:inline-block;right:20px;background: rgba(255,255,255, 0.9)" >
				<?php if ($this->session->flashdata('msgsuccess_c')) {
					echo "<div class='btn btn-success'>" . $this->session->flashdata('msgsuccess_c') . '</div>';
				} ?>
			<div style="text-align: center">
				<img class=""  src="<?= base_url(); ?>assets/images/betterMeCommunity.png?>" alt="Card image cap" style="">

			</div>

				<table class="responsive table">
					<div class="border border-success font-header">Most Liked Diets & Exercise</div>
					<thead>
					<th>Diet Title</th>
					<th style="float:right">Like Count</th>
					</thead>
					<tbody>
					<?php if (isset($getTopDiets) && !empty($getTopDiets)) {

						foreach ($getTopDiets as $diets) {
							?>
							<tr>
								<td>
								<span style="float:left !important; font-weight:bold;"><a
											href="<?= base_url() . 'user/viewFullDiet/' . $diets->post_id ?>"><?= $diets->post_title ?></a></span>
								</td>
								<td>
									<span style="float:right !important; font-weight:bold;"><?= $diets->like_sum ?></span>
								</td>
							</tr>
							<?php
						}
					} ?>
					</tbody>
				</table>
				<div class="card-body">
					<div class="font-header">
						THREAD SECTION
					</div>
					<button class="btn btn-primary btn-sm"
							onclick="window.location.href='<?= base_url() . 'user/full_thread_lists' ?>'"
							style="float:left">
						View All Thread
					</button>
					<button class="btn btn-success btn-sm"
							onclick="window.location.href='<?= base_url() . 'user/create_thread' ?>'"
							style="float:right">
						Create a Thread
					</button>
					<br><br>
					<h5 class="card-title d-flex justify-content-center"></h5>
					<p class="card-text ">

					<table class="table responsive">

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
									<span style="float:left; font-weight:bold;"><a
												href="<?= base_url() . 'user/view_this_community_post/' . $community_post_id ?>">
										<?php echo $thread_title ?>
									</a></span>
										<span style="float:left; font-weight:bold;"><a
													href="<?= base_url() . 'user/view_this_community_post/' . $community_post_id ?>">
										<?php
										if (strlen($thread_content) > 30) {
											$thread_content_cut = substr($thread_content, 0, 30);
											echo $thread_content_cut;
										} else {
											echo $thread_content;
										}
										?>
									</a></span>
									</td>

									<td>
										<p style="font-size:80%; font-weight:bold;">
											<?php echo $thread_date ?>
										</p>
									</td>
									<td>
										<p style="font-size:80%; font-weight:bold;">Posted By:
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
				<div style="background-color: #28A745;color: #ffffee; font-weight:bold;" >
				<p style="text-align: center">End of Thread</p>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal-search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Search</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="searching-for"></div>
				<label> Search Results:</label>
				<div class="search-result"></div><br><br>
				<div class=""> <small>Did you find what your looking for ? or Check out our Lists of Posts here <a href="<?=base_url().'user/full_diet_lists'?>"> POST LIST</a></div></small>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

			</div>
		</div>
	</div>
</div>

</section>
</body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
	$(document).ready(function () {
		$('.like').on('click', function () {
			var postId = $(this).attr('data-post_id');
			console.log(postId);
			var base_url = "<?= base_url() . 'user/likeHomepagePost'?>";

			$.post(base_url, {'postId': postId}, function (response) {
				if (response == "like") {

					$('#like-id_' + postId).css('color', 'blue');
				} else if (response == "unlike") {
					$('#like-id_' + postId).css('color', 'black');
				} else {

				}
			});
		});


	});

	function record() {
		$(document).ready(function(){
			var recognition = new webkitSpeechRecognition();
			recognition.lang = "en-GB";

			recognition.onresult = function(event) {
				// console.log(event);
				document.getElementById('speechToText').value = event.results[0][0].transcript;
			}
			alertify.success('Speak now');
			play_music();
			recognition.start();


			function play_music() {
				var audio = document.getElementById("audio");
				audio.play();
			}
		});
	}

	$(document).ready(function(){

		$('.btn-search').on('click',function(){
			var count_result = "";
			var search = $('#speechToText').val();
			var url = "<?=base_url().'user/search_json'?>";
			var url_fulldiet = "<?=base_url().'user/viewFullDiet'?>";

			Swal.fire('Please wait')
			Swal.showLoading()
			$.post(url,{'search':search},function(success){
				$('#modal-search .searching-for').html('Searching for: <b>'+search+'</b>');
				$('#modal-search').modal('show');

			}).done(function(datas){
				swal.close()
				datas= JSON.parse(datas);
				$('#modal-search .search-result').html('');
				$.each(datas, function(index, data){
							if(data.post_title ==undefined) {
								return false;
							}else{
								$('#modal-search .search-result').append('<b><span class=""><a href="' + url_fulldiet + '/' + data.post_id + '">' +data.post_title + '</a></span></b><br>');
							}
				});
			});


	});
	});
</script>
