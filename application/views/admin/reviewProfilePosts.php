
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>

<div class="container-fluid border card shadow" style="width:80%;margin-top:30px;padding-top:20px;padding-bottom: 20px;">
	<div class="row">
		<div class="col-md-12 table-responsive">
			<table id="myTable" class="table table-bordered table-striped text-center">
				<thead>
				<tr>
					<th>#</th>
					<th>Date</th>
					<th>Content</th>
					<th>Status</th>
					<th>Option</th>
				</tr>
				</thead>
				<tbody>
				<?php if (isset($all_profile_posts) && !empty($all_profile_posts)): ?>
<!--					--><?php //echo "<pre>";
//					print_r($all_profile_posts);
//					echo "</pre>";?>
					<?php foreach ($all_profile_posts as $profile_post): ?>


						<tr>
							<td><?= $profile_post->post_id ?></td>
							<td><?= $profile_post->date ?></td>
							<td><?= $profile_post->content ?></td>
							<td><?= (isset($profile_post->archive_status) && ($profile_post->archive_status)!=0)?'Archived':'Showed'?></td>
							<td>
								<a data-sessions-id="<?=$profile_post->post_id;?>" class="btn btn-primary btn-sm">Edit</a>
								<?php if(($profile_post->archive_status)!=0):?>
									<a data-sessions-id="<?=$profile_post->post_id?>" class="btn btn-success btn-sm" id="allow"><span class="fa fa-check"></span>Allow</a>
								<?php else: ?>
									<a data-sessions-id="<?=$profile_post->post_id?>" class="btn btn-danger btn-sm" id="archive"><span class="fa fa-times"></span>Archive</a>
								<?php endif; ?>

							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="<?= base_url().'/assets/alertify/alertify.js'?>"></script>
<script>
	$(document).ready(function () {
		$('.table').DataTable();
	});

	$(document).ready(function(){
		$('#myTable').on('click','#archive',function(){
			var sessionId=$(this).data('sessions-id');
			console.log(sessionId);
			alertify.confirm("Are you sure you want to delete this session?", function (e) {
				if (e)
				{
					$.post("<?=base_url()?>admin/archiveProfilePost/",{"sessionId":sessionId},function (response){
						if(response=="success"){
							alertify.success('Post Archived!');
							location.reload('3000');
						}
					});
				}
			});
		})
	});
</script>


