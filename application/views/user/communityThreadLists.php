<?php //print_r($posts)?>
<style>
	.container{
		margin-top: 60px;
		box-shadow: #1F1F1F;
	}
	.row{
		margin: 30px 30px 30px 30px;
	}
</style>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>

<div class="container card shadow">
	<div class="row">
		<div class="col-md-12">
			<div class="table-striped table-responsive">
				<table class="table table-striped " id="posts-table" style=" text-align: center">
					<thead class="" style="background-color: #28A745;color: #dddddd" >
					<th style="text-align: center">List Of Threads</th>
					</thead>
					<tbody>
					<?php if(isset($posts) && !empty($posts) ){
						foreach ($posts as $post){?>
							<tr>
								<td><span class=" badge badge-success">Thread Title</span><br><?=$post->thread_title?> <br> <span class=" badge badge-primary">Post Content </span><br><?=$post->thread_content?> <br><span class=" badge badge-warning"> Link </span> <a href="<?=base_url().'user/view_this_community_post/'.$post->community_id?>" class=""> View </a>
								</td>

							</tr>
						<?php }}?>
					</tbody>
				</table>

			</div>
		</div>
	</div>
</div>










<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="<?= base_url() . '/assets/alertify/alertify.js' ?>"></script>
<script>
	$(document).ready(function () {
		$('#posts-table').DataTable();
	});
</script>
