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
		<h2>Archived Diet Plans</h2>
	</div>
	<div class="row">
		<div class="col-md-12 table-responsive">

			<table id="myTable" class="table table-bordered table-striped text-center">
				<thead>
				<tr>
					<th scope="col"> Title </th>
					<th scope="col"> Post Content</th>
					<th scope="col"> Date Posted </th>
					<th scope="col"> Image </th>
					<th scope="col"> Option</th>
				</tr>
				</thead>
				<tbody>

				<?php

				if (isset($rows)) {
				foreach($rows as $row){

				$post_id = $row->post_id;
				$post_title = $row->post_title;
				$post_content = $row->post_content;
				$date_posted = $row->date_posted;
				$routine_count = $row->routine_count;
				$routine_format = $row->routine_format;
				$post_user_id = $row->post_user_id;
				$post_type = $row->post_type;

				$type_of_diet = $row->type_of_diet;
				?>
				<tr>
					<td class="font-weight-bold"> <?=$post_title ?></td>
					<td><?php if(strlen($post_content)>50) {
							$firstdesc=substr($post_content, 0, 150);
							echo $firstdesc.'<a href="'.base_url('admin/viewFullDiet/'.$post_id).'">...see more </a>';
						}else { echo $post_content;}?>
					</td>
					<td><?= $date_posted ?></td>
					<td>

						<?php foreach ($row->images as $images) {
							?>
							<img class="" src="<?= base_url() . 'uploads/posts/' . $images->image_name ?>"
								 alt="Card image cap" style="width:40px;height:40px">
						<?php } ?>

					</td>
					<td> <a data-sessions-id="<?= $post_id?>" class="restore-post btn btn-sm btn-success" >Restore</a>
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
		$('#myTable').on('click','.restore-post',function(){
			var sessionId=$(this).data('sessions-id');
			console.log(sessionId);
			alertify.confirm("Are you sure you want to restore this Diet Plan?", function (e) {
				if (e)
				{
					$.post("<?=base_url()?>admin/restore_post/",{"sessionId":sessionId},function (response){
						if(response=="success"){
							alertify.success('Diet Plan Restored!');
							window.setTimeout(function(){location.reload()},2000)
						}
					});
				}
			});
		})
	});
</script>
