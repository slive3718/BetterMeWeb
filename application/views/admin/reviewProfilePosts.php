
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
<style>
	h2 {
		color: #008000;
		font-family: 'Raleway', sans-serif;
		font-size: 40px;
		font-weight: 800;
		line-height: 72px;
		margin: 0 0 24px;
		text-align: center;
		text-transform: uppercase;
	}
	.jumbotron{
		padding-bottom: 20px;
	}
</style>
<div class="container-fluid border card shadow" style="width:80%;margin-top:30px;padding-top:20px;padding-bottom: 20px;">
	<div class="jumbotron text-center">
		<?= ($this->session->flashdata('msgsuccess'))?'<div class="btn btn-success">'.($this->session->flashdata('msgsuccess')).'</div>':''?>
		<?= ($this->session->flashdata('msgwarn'))?'<div class="btn btn-warning"> '.($this->session->flashdata('msgwarn')).'</div>':''?>
		<h2>Review Profile Posts</h2>
	</div>
	<div class="row">
		<div class="col-md-12 table-responsive">
			<table id="myTable" class="table table-bordered table-striped text-center">
				<thead>
				<tr>
					<th>#</th>
					<th>Date</th>
					<th>Content</th>
					<th>Status</th>
					<th>Images</th>
					<th>Option</th>
				</tr>
				</thead>
				<tbody>
				<?php if (isset($all_profile_posts) && !empty($all_profile_posts)): ?>
					<?php foreach ($all_profile_posts as $profile_post): ?>
						<tr>
							<td><?= $profile_post->post_id ?></td>
							<td><?= $profile_post->date ?></td>
							<td><?= $profile_post->content ?></td>
							<td><?= (isset($profile_post->archive_status) && ($profile_post->archive_status)!=0)?'Archived':'Showed'?></td>
							<td><?php
								if (isset($profile_post->get_post_images) && !empty($profile_post->get_post_images)){
								foreach($profile_post->get_post_images as  $images){
									?>
									<img src="<?= base_url().'./uploads/profile_posts/'.$images->image_name;?>" style="width:20px;height:20px">
									<?php
								}
								}
								?>
							</td>
							<td>
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

			alertify.confirm("Are you sure you want to delete this Profile Post?", function (e) {
				if (e)
				{
					$.post("<?=base_url()?>admin/archiveProfilePost/",{"sessionId":sessionId},function (response){
						if(response=="success"){
							alertify.success('Post Archived!');
							window.setTimeout(function(){location.reload()},2000)
						}
					});
				}
			});
		})
	});

	$(document).ready(function(){
		$('#myTable').on('click','#allow',function(){
			var sessionId=$(this).data('sessions-id');
			console.log(sessionId);

			alertify.confirm("Are you sure you want to restore this Profile Post?", function (e) {
				if (e)
				{
					$.post("<?=base_url()?>admin/allowProfilePost/",{"sessionId":sessionId},function (response){
						if(response=="success"){
							alertify.success('Post Restored!');
							window.setTimeout(function(){location.reload()},2000)
						}
					});
				}
			});
		})
	});
</script>


