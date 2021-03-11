<?php
if (isset($myThread)) {
	foreach ($myThread as $thread) {
		$thread_id = $thread['community_id'];
		$thread_user_id = $thread['thread_user_id'];
		$thread_content = $thread['thread_content'];
		$thread_title = $thread['thread_title'];


	}
	?>

	<div>
		<div class="container">
			<div class="row">

				<div class="col-md-8 col-md-offset-2">

					<h1>Create a Thread</h1>

					<form action="<?= base_url() . 'user/updateMyThread/', $thread_id ?>" method="POST">


						<div class="form-group">
							<label for="title">Title <span class="require">*</span></label>
							<input type="text" class="form-control" name="title" value="<?= $thread_title ?>"/>
						</div>

						<div class="form-group">
							<label for="description">Description</label>
							<textarea rows="5" class="form-control"
									  name="description"><?php if (isset($thread_content)) {
									echo $thread_content;
								} ?></textarea>
						</div>


						<div class="form-group">
							<button type="submit" class="btn btn-primary">
								Update
							</button>
							<a href="<?= base_url() . 'user/view_this_community_post/', $thread_id ?>"
							   class="btn btn-default">
								Cancel
							</a>
						</div>

					</form>
				</div>

			</div>
		</div>
	</div>
<?php } ?>

<!------ Include the above in your HEAD tag ---------->
