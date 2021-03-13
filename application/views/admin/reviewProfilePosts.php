<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script
	src="https://code.jquery.com/jquery-3.6.0.min.js"
	integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
	crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
	  integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
		integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
		crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"
		integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf"
		crossorigin="anonymous"></script>


<div class="col-md-12 table-responsive">
	<table id="table_id" class="table table-bordered table-striped text-center">
		<thead>
		<tr>
			<th>#</th>
			<th>Date</th>
			<th>Content</th>
			<th>Option</th>
		</tr>
		</thead>
		<tbody>
		<?php if (isset($all_profile_posts) && !empty($all_profile_posts)): ?>
			<?php foreach ($all_profile_posts as $profile_post): ?>

				<tr>
					<td><?= $profile_post->post_id ?>></td>
					<td><?= $profile_post->date ?></td>
					<td><?= $profile_post->content ?></td>
					<td></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
		</tbody>
	</table>
</div>


<script>
	$(document).ready(function () {
	$('#myTable').DataTable(); });

</script>


