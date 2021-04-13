<?php $post_type = "DietPlan";

?>
<center>
	<?php if ($this->session->flashdata('msgsuccess')) {
		echo ' <div class="btn success"> ' . $this->session->flashdata('msgsuccess') . ' <div class="btn success"> ';
	} ?>


	<?php if ($this->session->flashdata('msgwarn')) {
		?>
		<div class="btn success"> <?php echo ' <div class="btn btn-warning">' . $this->session->flashdata('msgsuccess');
			echo $this->session->flashdata('msgwarn');
			?>    </div> <?php } ?>
	</div>
</center>


<?php
if (isset($rows)) {

foreach ($rows as $row){
//	echo "<pre>";
//print_r($row);
$post_id = $row->post_id;
$post_title = $row->post_title;
$post_content = $row->post_content;
$date_posted = $row->date_posted;
$routine_count = $row->routine_count;
$routine_format = $row->routine_format;
$post_user_id = $row->post_user_id;
$post_type = $row->post_type;

$target_audience = $row->target_audience;
$post_from = ucfirst($row->first_name) . ' ' . ucfirst($row->last_name);

$type_of_diet = $row->type_of_diet;

$current_user = $this->session->userdata('id');

?>

<center>
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

	<div class="mt-5">
		<div class="card" style="width: 50rem; max-width: 100%;">

			<?php foreach ($row->images as $images) {
				?>
				<img class="" src="<?= base_url() . 'uploads/posts/' . $images->image_name ?>"
					 alt="Card image cap" style="">
			<?php } ?>
			<div class="card-body">
				<span style="" class="btn btn-success form-control"><span style="float:left">
						<h6 class="card-title"> <?= (isset($post_from) && !empty($post_from))?'Posted by: '.$post_from:''?></h6>
					</span><span style="float:right"><?= (isset($date_posted) && !empty($date_posted))?'Date: '.$date_posted:''?> </span>
				</span><br>

				<div class="card shadow border border-success">
				<h5 class="card-title"><?= $post_title ?></h5>
					<p> <?= (isset($routine_count,$routine_format) && !empty($routine_count) && !empty($routine_format))?'<span style="float: left">' .'<strong> Routine: </strong>'.$routine_count.' '.$routine_format.'</span>':'' ; ?>
					<?= (isset($target_audience) && !empty($target_audience))? '<span style="float: right"> <strong>Suitable for: </strong>'.$target_audience.'</span>':''?></p>
					<p class="card-text"><?php if (isset($post_content)) {
						echo $post_content;
					}

					if ($post_user_id == $current_user){

					?>

				<div class="mr-5 d-flex justify-content-end">
					<a href="<?= base_url() . 'user/edit_Diet/' . $post_id ?>" class="btn  btn-sm btn-primary">Edit</a>
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal">
						Delete
					</button>
				</div>


				<?php } ?>
					<div class="d-flex">
						<div class="like p-2 cursor col-md-2" id="like-id_<?= $post_id ?>"
							 style="cursor: pointer; <?= (isset($like) && !empty($like) == 1) ? 'color:blue' : '' ?>; "
							 data-post_id="<?= $post_id ?>">
							<i class="fa fa-thumbs-o-up"></i>
							<span class="ml-1"> Like</span>
							<span><?= (isset($row->getLikeCount) && ($row->getLikeCount) != 0) ? $row->getLikeCount : '' ?></span>
						</div>
						<div>
							<div class="bg-white p-2">
								<!--fetch COMMENT -->

								<?php if (isset($comments) && !empty($comments)){
								foreach($comments as $comment){
								$comment_id=$comment['id'];
								$user_comments=$comment['comment'];
								$user_comments_post_id=$comment['post_id'];
								$user_comments_date=$comment['date'];
								$comment_user_id=$comment['user_id'];
								$comment_user_name=$comment['username'];
								$comment_date=$comment['date'];
								if ($post_id==$user_comments_post_id){
								?>
								<div>
									<div class="bg-light p-2 comment-class_<?=$comment_id?>">
										<div class="d-flex justify-content-between">
											<div>
												<?=  $comment_user_name ?>
											</div>
											<div>
												<?= $comment_date ?>
											</div>
											<div class="comment">
												<?php if($comment_user_id==$current_user){
													?>
													<a
															class="like p-2 cursor action-collapse"
															data-comment_id="<?=$comment_id?>"
															data-comment_content="<?=$user_comments ?>"
															data-comment_post_id ="<?=$post_id?>"
															id="edit-comment"
															data-toggle="collapse"
															aria-expanded="true"
															aria-controls="collapse-2"
															href="#collapse-2">
														<span class="ml-1 btn btn-info btn-xs fa fa-edit" style="cursor:pointer; font-weight: bold;" ></span></a>
												<a class="btn btn-danger btn-xs fas fa-trash-alt  fa-xs" style="cursor:pointer;"  id="delete-comment" data-delete_comment_id="<?=$comment_id?>"></a><?php
												}?>
											</div>
										</div>
										<div class="d-flex flex-row align-items-start">
											<?php if (isset($pic_status) ){
												?>
												<img
														class="rounded-circle"
														src="<?=base_url().'./uploads/profilepic/profile'.$comment_user_id?>.jpg"
														width="40"
														height="40px">
												<?php
											} else{
												?>
												<img class="fa fa-user">
											<?php }?>

											<textarea
													class="form-control ml-1 shadow-none textarea" wrap="hard" rows="" cols="70"
													name="community_comment"
													readonly="readonly"><?= $user_comments?></textarea>
										</div>
									</div>
									<?php
									}
									?>
									<?php
									}
									} ?>
									<div class="div-write-comment">
								<div class="d-flex flex-row fs-12">
									<div
											class="like p-2 cursor action-collapse"
											id="write-comment"
											data-toggle="collapse"
											aria-expanded="true"
											aria-controls="collapse-1"
											href="#collapse-1">
										<i class="fa fa-commenting-o" style="cursor:pointer"></i>
										<span class="ml-1" style="cursor:pointer; font-weight: bold;">Write a Comment Here</span></div>
								</div>
							</div>
							<div id="collapse-1" class="bg-light p-2 collapse" data-parent="#myGroup">
								<div class="d-flex flex-row align-items-start">
									<?php if (isset($pic_status) ){
										?>
										<img
												class="rounded-circle"
												src="<?=base_url().'./uploads/profilepic/profile'.$current_user?>.jpg"
												width="40"
												height="40px">
										<?php
									} else{
										?>
										<img class="fa fa-user">
									<?php }?>
									<textarea
											class="form-control ml-1 shadow-none textarea comment-message" wrap="hard" rows="3" cols="100"
											name="community_comment"  required></textarea>

								</div>

								<div class="mt-2 text-right">
									<button class="btn btn-primary btn-sm shadow-none btn-comment-post" type="submit" data-post_id="<?=$post_id?>" >Post comment</button>
									<button class="btn btn-outline-primary btn-sm ml-1 shadow-none"
											data-toggle="collapse"
											aria-expanded="true"
											aria-controls="collapse-1"
											href="#collapse-1" type="button">Cancel</button>
								</div>
							</div>

								</div>
											<!-- ################# This is collapse 2 . collapse Update########################## -->


								<div id="collapse-2" class="bg-light p-2 collapse" data-parent="#myGroup2">
									<div class="d-flex flex-row align-items-start">
										<?php if (isset($pic_status) ){
											?>
											<img
													class="rounded-circle"
													src="<?=base_url().'./uploads/profilepic/profile'.$current_user?>.jpg"
													width="40"
													height="40px">
											<?php
										} else{
											?>
											<img class="fa fa-user">
										<?php }?>
										<textarea
												class="form-control ml-1 shadow-none textarea comment-message-update" wrap="hard" rows="3" cols="100"
												name="community_comment"  required></textarea>

									</div>

									<div class="mt-2 text-right update-here">

										<button class="btn btn-outline-primary btn-sm ml-1 shadow-none"
												data-toggle="collapse"
												aria-expanded="true"
												aria-controls="collapse-1"
												href="#collapse-1" type="button">Cancel</button>
									</div>
								</div>
						</div>
					</div>

					</p>
				</div>
				<!-- Modal -->

			</div>


		</div>

	</div>


	<?php
	}
	} ?>

	<!-- <div class="card border-danger" style="width: 18rem;"> <img
	class="card-img-top" src="..." alt="Card image cap"> <div class="card-body"> <h5
	class="card-title">Card title</h5> <p class="card-text">Some quick example text
	to build on the card title and make up the bulk of the card's content.</p> <a
	href="#" class="btn btn-primary">Go somewhere</a> </div> </div> -->
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

			$('.btn-comment-post').on('click',function(){
				var comment = $('.comment-message').val();
				var comment_url = "<?= base_url().'user/addCommentHomepage'?>";
				var postId = $(this).attr('data-post_id');


				$.post(comment_url,{'comment':comment, 'postId':postId},function(success){
					console.log(success);
					if (success){
						alertify.success('Comment Saved')
						location.reload();
					}
				});
			});

			$('.comment').on('click','#delete-comment',function(){
				var comment_id = $(this).attr('data-delete_comment_id');
				var delete_url = "<?= base_url().'user/deleteMyCommentHomepage'?>";
				console.log(comment_id);
				Swal.fire({
					title: 'Notice',
					text: "Delete Comment",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, Continue.'
				}).then((result) => {
					if (result.isConfirmed) {

						$.post(delete_url,{'commentId':comment_id},function(success){
							if(success){
								Swal.fire({
									icon: 'success',
									title: 'Thank you for confirmation.',
									text: 'Deleted!',
								});
								$('.comment-class_'+comment_id).hide();
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
				});


			});

			$('.comment').on('click','#edit-comment',function(){


				var commentContent = $(this).attr('data-comment_content');
				var comment_post_id = $(this).attr('data-comment_post_id');
				var comment_id = $(this).attr('data-comment_id');

				$('.comment-message-update').html(commentContent);
				$('.update-here').html('<button class="btn btn-primary btn-sm shadow-none btn-comment-update" type="submit" data-post_id="'+comment_post_id+'" data-comment_id="'+comment_id+'" >Update comment</button>')

			});


			$('.update-here').on('click','.btn-comment-update',function(){
				var comment = $('.comment-message-update').val();
				var comment_url = "<?= base_url().'user/updateCommentHomepage'?>";
				var postId = $(this).attr('data-post_id');
				var commentId = $(this).attr('data-comment_id');
				console.log(comment);
				$.post(comment_url,{'comment':comment, 'postId':postId, 'commentId':commentId},function(success){
					console.log(success);
					if (success){
						alertify.success('Comment Saved')
						location.reload();
					}
				});
			});
		});
	</script>
