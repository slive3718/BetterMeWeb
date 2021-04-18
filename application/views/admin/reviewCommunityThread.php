
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

<div class="container-fluid border card shadow" 
style="width:80%;margin-top:30px;padding-top:20px;padding-bottom: 20px; max-width: 100%;">
	<div class="jumbotron text-center">
		<?= ($this->session->flashdata('msgsuccess'))?'<div class="btn btn-success">'.($this->session->flashdata('msgsuccess')).'</div>':''?>
		<?= ($this->session->flashdata('msgwarn'))?'<div class="btn btn-warning"> '.($this->session->flashdata('msgwarn')).'</div>':''?>
		<h2>Manage Community Thread Posts</h2>
	</div>
	<div class="row">
		<div class="col-md-12 table-responsive">
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
				if (isset($community_posts)){
				$a=0;
				foreach($community_posts as $field){
				$a++;
				$threadTitle = $field['thread_title'];
				$threadContent = $field['thread_content'];
				$threadDate = $field['thread_date'];
				$threadStarter = $field['username'];
				$threadImage = $field['thread_image_name'];
				$threadId = $field['community_id'];
				?>
				<tr>

					<td><?= $a?></td>
					<td><?= $threadTitle ?></td>
					<td><?=$threadStarter?></td>
					<td><?= $threadDate ?></td>
					<td><?= $threadContent ?></td>
					<td><?= $threadImage ?></td>
					<td>
					<button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="fas fa-cog"></span>
					</button>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="">Warning</a>
						<a class="dropdown-item" href="">Under Review</a>
						<a class="dropdown-item" href="<?=base_url().'admin/archive_community_thread/',$threadId?>">Archive</a>
					</td>
				</tr>
<?php }}?>
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
			alertify.confirm("Are you sure you want to delete this Thread ?", function (e) {
				if (e)
				{
					$.post("<?=base_url()?>admin/archiveProfilePost/",{"sessionId":sessionId},function (response){
						if(response=="success"){
							alertify.success('Thread Archived!');
							window.setTimeout(function(){location.reload()},2000)
						}
					});
				}
			});
		})
	});
</script>
