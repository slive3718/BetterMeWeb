<?php
if ($posts) {
	foreach ($posts as $post) {
		$post_user_id = $post['post_user_id'];
		$post_title = $post['post_title'];
		$post_content = $post['post_content'];
		$post_type = $post['post_type'];
		$post_id = $post['post_id'];
		$type_of_diet = $post['type_of_diet'];
		$target_audience = $post['target_audience'];
		$routine_count = $post['routine_count'];
		$routine_format = $post['routine_format'];
	}
}
?>

<style>
	.m-indent {
		margin: 20px;
	}

</style>
<div class="container-fluid card shadow" style="width:100vh;margin-top:50px;background-color: lightgray">
	<div class="m-indent" style="">
		<form method="POST" action="<?= base_url() . 'admin/update_diet_plan' ?>" enctype="multipart/form-data">
			<input type="text" name="post_id" value="<?= $post_id ?>" hidden>
			<div class="form-group">
				<label for="thread_type">Thread</label>
				<select name="thread_type" class="form-control">
					<option name="thread_type"
							value="Diet_Plan" <?= (isset($post_type) && ($post_type == "Diet Plan")) ? "selected" : '' ?>>
						Diet Plan
					</option>
					<option name="thread_type"
							value="Exercise" <?= (isset($post_type) && ($post_type == "Exercise")) ? "selected" : '' ?>>
						Exercise
					</option>
				</select>
			</div>

			<div class="form-group">
				<label for="">Post Title</label>
				<input name="post_title" type="text" class="form-control" id="" placeholder=""
					   value="<?= isset($post_title) ? $post_title : '' ?>" required>
			</div>

			<div class="form-group">
				<label for="">Type Of Diet</label>
				<select class="form-control" name="type_of_diet">
					<option value="">No Selection</option>
					<option name="type_of_diet"
							value="Intermittent Fasting" <?= (isset($type_of_diet) && ($type_of_diet == "Intermittent Fasting")) ? "selected" : '' ?>>
						Intermittent Fasting
					</option>
					<option name="type_of_diet"
							value="Zone Diet" <?= (isset($type_of_diet) && ($type_of_diet == "Zone Diet")) ? "selected" : '' ?>>
						Zone Diet
					</option>
					<option name="type_of_diet"
							value="Paleo Diet" <?= (isset($type_of_diet) && ($type_of_diet == "Paleo Diet")) ? "selected" : '' ?>>
						Paleo Diet
					</option>
					<option name="type_of_diet"
							value="Blood Type Diet" <?= (isset($type_of_diet) && ($type_of_diet == "Blood Type Diet")) ? "selected" : '' ?>>
						Blood Type Diet
					</option>
					<option name="type_of_diet"
							value="Vegan Diet" <?= (isset($type_of_diet) && ($type_of_diet == "Vegan Diet")) ? "selected" : '' ?>>
						Vegan Diet
					</option>
					<option name="type_of_diet"
							value="South Beach Diet" <?= (isset($type_of_diet) && ($type_of_diet == "South Beach Diet")) ? "selected" : '' ?>>
						South Beach Diet
					</option>
					<option name="type_of_diet"
							value="Mediterranean Diet" <?= (isset($type_of_diet) && ($type_of_diet == "Mediterranean Diet")) ? "selected" : '' ?>>
						Mediterranean Diet
					</option>
					<option name="type_of_diet"
							value="Food Diet" <?= (isset($type_of_diet) && ($type_of_diet == "Food Diet")) ? "selected" : '' ?>>
						Raw Food Diet
					</option>
				</select>
			</div>

			<div class="form-row">
				<div class="col">
					<label for=""> Plan Track (Optional)</label>
					<select class="form-control" name="routine_format" id="plan_track">
						<option value="">No Selection</option>
						<option name="routine_format"
								value="Day" <?= (isset($routine_format) && ($routine_format == "Day")) ? 'selected' : '' ?>>
							Day
						</option>
						<option name="routine_format"
								value="Month" <?= (isset($routine_format) && ($routine_format == "Month")) ? 'selected' : '' ?>>
							Month
						</option>
						<option name="routine_format"
								value="Year" <?= (isset($routine_format) && ($routine_format == "Year")) ? 'selected' : '' ?>>
							Year
						</option>
					</select>
				</div>
				<div class="col">
					<label for="">Number of: Days|Months|Years</label>
					<input name="routine_count" class="form-control" type="number" class="form-inline" id="num_day"
						   placeholder="" <?= (isset($routine_count) && !empty($routine_count)) ? 'value="' . $routine_count . '"' : '' ?> >
				</div>
				<div class="col">
					<label for="target_audience">Suitable for:</label>
					<select name="target_audience" class="form-control">
						<option value="">No Selection</option>
						<option name="target_audience"
								value="Kids" <?= (isset($target_audience) && ($target_audience == "Kids")) ? "selected" : '' ?>>
							Kids
						</option>
						<option name="target_audience"
								value="Teens" <?= (isset($target_audience) && ($target_audience == "Teens")) ? "selected" : '' ?>>
							Teens
						</option>
						<option name="target_audience"
								value="Adults" <?= (isset($target_audience) && ($target_audience == "Adults")) ? "selected" : '' ?>>
							Adult
						</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="">Post Content</label>
				<textarea name="post_content" rows="10" class="form-control" id=""
						  placeholder=""><?= (isset($post_content) && !empty($post_content)) ? $post_content : '' ?></textarea>
			</div>

			<div class="form-group">
				<label for="userfile">Add Image</label>
				<input type="file" name="userfile[]" size="20"
					   oninput="pic.src=window.URL.createObjectURL(this.files[0])"
					   multiple="multiple"
				/>

			</div>
			<div class="form-group">
				<a data-sessions_id="<?= $post_id ?>" id="manage-image" style="cursor: pointer">Manage Image</a>
			</div>
			<div class="show-image-here" style="width:50px;display: block">
				<p class="image-here">
					<!--					<img src="-->
					<? //= base_url().'uploads/posts/demon-slayers-hashiras-giyu-and-shinobu-wallpaper-1920x1200-42557_62.jpg'?><!--" />-->
				</p>
			</div>
			<div style="float:right">
				<button type="reset" class="btn btn-primary btn-sm">Reset</button>
				<button type="submit" class="btn btn-success btn-sm" id="submit">Submit</button>
			</div>

		</form>
	</div>
</div>
<script>
	$(document).ready(function () {

		$('#manage-image').on('click', function () {
			var postId = $(this).attr('data-sessions_id');
			var base_url = '<?= base_url() . 'admin/getImagesInPost/'?>';
			var delete_image_url = '<?= base_url() . 'admin/removeImageInPost/'?>'
			var base_img_url = '<?= base_url() . 'uploads/posts/'?>';
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
			var base_url = '<?= base_url() . 'admin/getImagesInPost/'?>';
			var delete_image_url = '<?= base_url() . 'admin/removeImageInPost/'?>'
			var base_img_url = '<?= base_url() . 'uploads/posts/'?>';
			var imageId = ($(this).attr('data-image_id'));

			alertify.confirm("Are you sure you want to remove this image?", function (yes) {
				if (yes) {
					$.post(delete_image_url, {'postId': postId, 'imageId': imageId}, function (success) {
						if (success) {
							alertify.success('deleted');
							$('.class_image_id_' + imageId).hide();
							$('#class_image_id_' + imageId).hide();
						}
					});
				}
			});
		});


	});
</script>
