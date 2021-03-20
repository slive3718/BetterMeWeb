<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>

<div class="container-fluid border card shadow"
	 style="width:80%;margin-top:30px;padding-top:20px;padding-bottom: 20px;">
	<div class="card container-fluid border shadow " style="background-color: green;color:white;text-align:center">
	<h4> Manage My Diet Plans</h4>
	</div><br>
	<div class="row">
		<a href="<?= base_url() . 'mentor/addDietPlan/' ?>" class="btn btn-success btn-sm" style="float:left;margin-left: 20px">Add Diet Plan</a>
		<div class="col-md-12 table-responsive">

			<hr style="height:4px;background-color: green">
			<div class="row">
			</div>
			<table id="myTable" class="table table-bordered table-striped text-center">
				<thead>
				<tr>
					<th scope="col"> Title</th>
					<th scope="col"> Post Content</th>
					<th scope="col"> Date Posted</th>
					<th scope="col"> Image</th>
					<th scope="col" colspan="2"> Option</th>
				</tr>
				</thead>
				<tbody>

				<?php

				if (isset($rows)) {
					foreach ($rows as $row) {
						$image_name = $row['post_image_name'];
						$post_id = $row['post_id'];
						$post_title = $row['post_title'];
						$post_content = $row['post_content'];
						$date_posted = $row['date_posted'];
						$routine_count = $row['routine_count'];
						$routine_format = $row['routine_format'];
						$post_user_id = $row['post_user_id'];
						$post_type = $row['post_type'];
						$image_id = $row['image_id'];
						$type_of_diet = $row['type_of_diet'];

						$current_id = $this->session->userdata('id');
						if ($post_user_id == $current_id) {
							?>

							<tr>
								<td class="font-weight-bold"> <?= $post_title ?></td>
								<td><?php if (strlen($post_content) > 50) {
										$firstdesc = substr($post_content, 0, 150);
										echo $firstdesc . '<a href="' . base_url('mentor/viewFullDiet/' . $post_id) . '">...see more </a>';
									} else {
										echo $post_content;
									} ?>
								</td>
								<td><?= $date_posted ?></td>
								<td>
									<img style="width:100px;height:100px;" class="img-thumbnail"
										 src="<?= base_url() . 'uploads/images/' . $image_name ?>">
								</td>
								<td><a href="<?= base_url() . 'mentor/edit_Diet/' . $post_id ?>"
									   class="btn  btn-sm btn-primary">Edit</a></td>
								<td>
									<button data-post-id="<?=$post_id?>" type="button" class="btn btn-sm btn-danger delete-post">
										Delete
									</button>
								</td>

							</tr>
							<?php
						}
					}
				}
				?>

				</tbody>
			</table>
		</div>
	</div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="<?= base_url() . '/assets/alertify/alertify.js' ?>"></script>
<script>
	$(document).ready(function () {
		$('.table').DataTable();
	});

	$(document).ready(function () {
		$('#myTable').on('click', '.delete-post', function () {
			var postId = $(this).data('post-id');
			console.log(postId);
			alertify.confirm("Are you sure you want to delete this Diet Plan?", function (e) {
				if (e) {
					$.post("<?= base_url() .'mentor/archive_post/'?>", {"postId": postId}, function (response) {
						if (response == "success") {
							alertify.success('Post Deleted!');
							window.setTimeout(function () {
								location.reload()
							}, 2000)
						}
					});
				}
			});
		})
	});
</script>


