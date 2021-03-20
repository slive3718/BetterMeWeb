<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>

<div class="container-fluid border card shadow"
	 style="width:80%;margin-top:30px;padding-top:20px;padding-bottom: 20px;">
	<div class="row">
		<div class="col-md-12 table-responsive">

			<hr style="width:4px;background-color: green">
			<div class="row">
				<?php
				if (isset($rows)) {
					foreach ($rows as $row) {
						$post_id = $row['post_id'];

						$post_type = $row['post_type'];
					}
				}
				?>
			</div>
			<table id="myTable" class="table table-bordered table-striped text-center">
				<thead>
				<tr>
					<th scope="col"></th>
					<th scope="col">Thread Title</th>
					<th scope="col">Thread Starter</th>
					<th scope="col">Thread Date</th>
					<th scope="col">Thread Content</th>
					<th scope="col">Thread Image</th>
					<th scope="col">Option</th>
				</tr>
				</thead>
				<tbody>
				<?php
				if (isset($community_posts)) {
					$a = 0;
					foreach ($community_posts as $field) {
						$a++;
						$threadTitle = $field['thread_title'];
						$threadContent = $field['thread_content'];
						$threadDate = $field['thread_date'];
						$threadStarter = $field['username'];
						$threadImage = $field['thread_image_name'];
						$threadId = $field['community_id'];
						?>
						<tr>
							<th scope="row"><?= $a ?></th>
							<td><?= $threadTitle ?></td>
							<td><?= $threadStarter ?></td>
							<td><?= $threadDate ?></td>
							<td><?= $threadContent ?></td>
							<td><?= $threadImage ?></td>
							<td>
								<a data-sessions-id="<?=$threadId ?>"class="restore-thread btn btn-primary btn-sm" >Restore</a></td>
						</tr>
						<?php
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
		$('#myTable').on('click', '.restore-thread', function () {
			var sessionId = $(this).data('sessions-id');
			console.log(sessionId);
			alertify.confirm("Are you sure you want to restore this Diet Plan?", function (e) {
				if (e) {
					$.post("<?=base_url()?>admin/restoreCommunityThread/", {"sessionId": sessionId}, function (response) {
						if (response == "success") {
							alertify.success('Thread Restored!');
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

<?php
$warning_message = "Warning This Post contains information against our rules and standard";
$under_review_message = "Warning This Post is under review by the admin";
$archive_message = "This post is unavailable or deleted due to contents against our rules and standard";

?>





