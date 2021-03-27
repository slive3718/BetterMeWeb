<style>
	.m-indent {
		margin: 20px;
	}
</style>
<?php
if (isset($gotMyProfilePost) && !empty($gotMyProfilePost)) {
	foreach ($gotMyProfilePost as $post) {
		$id = $this->session->userdata('id');
		$content = $post->content;
		$post_id = $post->post_id;
		$pic_status = $post->user_picture_status;
	}
}
?>

<div class="container-fluid card shadow" style="width:100vh;margin-top: 50px">
	<div class="m-mrg" style="padding: 30px 5px 90px 5px" id="composer">

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
				<br>
				<div id="c-tabs-cvr">
					<div class="tb" id="c-tabs">
						<div class="td"><i class="material-icons">Whats Up?</i><span></span></div>
					</div>
				</div>
				<br>
				<form
					method="post"
					action="<?= base_url().'user/update_profilePost/'.$post_id ?>"
					enctype="multipart/form-data">
					<div class="Small" id="c-inp">
                            <textarea
								name="content"
								placeholder="What's on your mind?"
								class="whats-on-ur-mind border border-primary rounded"
								cols="100"
								rows="5"><?=(isset($content) && !empty($content))?$content:''?></textarea>
					</div>
			</div>
		</div>
		</hr>
		<div class="col-sm-12">
			<input
				class="btn btn-primary btn-sm col-md-4"
				style="left:20px;"
				type="file"
				name="userfile[]"
				size="20"
				multiple="multiple"/>

			<input type="submit" value="Post" class="btn btn-primary" style="right:0px;float:right"/>

		</div>
		<!-- -->
		<br>
		<a data-sessions_id="<?= $post_id ?>" id="manage-image" style="cursor: pointer">Manage Image</a>
	</div>
	<div class="show-image-here" style="width:50px;display: block">
		<p class="image-here">

	</div>
</div>
<script>
	$(document).ready(function () {

		$('#manage-image').on('click', function () {
			var postId = $(this).attr('data-sessions_id');
			var base_url = '<?= base_url() . 'user/getImagesInPost/'?>';
			var delete_image_url = '<?= base_url() . 'user/removeImageInPost/'?>'
			var base_img_url = '<?= base_url() . 'uploads/profile_posts/'?>';
			$.post(base_url, {'postId': postId}, {})
				.done(function (data) {
					data = JSON.parse(data);
					$.each(data, function (index, value) {
						$('.image-here').append(
							"<img class='class_image_id_" + value.image_id + "' style='width:120px' src=" + base_img_url + value.image_name + " >" +
							"<a class='btn btn-warning btn-sm remove-this-image' id='class_image_id_" + value.image_id + "' style='cursor: pointer' id='remove-image' data-image_id='" + value.image_id + "' data-post_id='" + value.post_id + "'>Remove</a>"
						);
					});
				});
		});
		$('.image-here').on('click', '.remove-this-image', function () {
			var postId = $(this).attr('data-post_id');
			var base_url = '<?= base_url() . 'user/getImagesInPost/'?>';
			var delete_image_url = '<?= base_url() . 'user/removeImageInPost/'?>'
			var base_img_url = '<?= base_url() . 'uploads/profile_posts/'?>';
			var imageId = ($(this).attr('data-image_id'));

			$.post(delete_image_url, {'postId': postId, 'imageId': imageId}, function (success) {
				if (success) {
					alertify.success('deleted');
					$('.class_image_id_' + imageId).hide();
					$('#class_image_id_' + imageId).hide();
				}
			});
		});


	});
</script>

