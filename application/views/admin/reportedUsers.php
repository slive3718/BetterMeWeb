<?php //echo "<pre>";print_r($reports);exit;?>
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
		<h2>Manage Users</h2>
	</div>
	<div class="row">
		<div class="col-md-12 table-responsive">
			<table id="myTable" class="table table-bordered table-striped text-center">
				<thead>
				<tr>
					<th>Date Reported</th>
					<th>Reported User</th>
					<th>Number of Users Reporting</th>
					<th>Report Count</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
				<?php if (isset($reports) && !empty($reports)): ?>
					<?php foreach ($reports as $report): ?>
					cou
				<?php $count=0;
						foreach ($report->reporting_user as $reporting_user){
							$reporting_user_count = $count+1;
						} ?>


						<tr>
							<td><?=$report->date_time?></td>
							<td><?=$report->first_name.' '.$report->last_name?></td>
							<td><?= $report->get_reporting_count?></td>
							<td><?= $report->get_all_reports ?></td>
							<td>
								<a class="btn btn-primary btn-sm" href="">View Reports Info</a><br>
								<a class="btn btn-danger btn-sm disable-user disable<?=$report->user_id?>" style="display: <?=($report->disabled=='0')?'block':'none' ?>" data-user_id="<?= $report->user_id ?>">Click to Disable</a>
								<a class="btn btn-success btn-sm enable-user enable<?=$report->user_id?>"  style="display: <?=($report->disabled=='1')?'block':'none' ?>" data-user_id="<?= $report->user_id ?>">Click to Enable</a>
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
		$('#myTable').on('click','.disable-user',function(e){
			e.preventDefault();
			var disabling_id = $(this).attr('data-user_id');
			var url = "<?=base_url().'admin/disable_user'?>";
			$.post(url, {'userId':disabling_id}, function(data){
					if (data.status=="success"){
						$('.disable'+disabling_id).toggle();
						$('.enable'+disabling_id).toggle();
					}
			},'json');
		});

		$('#myTable').on('click','.enable-user',function(e){
			e.preventDefault();
			var disabling_id = $(this).attr('data-user_id');
			var url = "<?=base_url().'admin/enable_user'?>";
			$.post(url, {'userId':disabling_id}, function(data){
				if (data.status=="success"){
					$('.disable'+disabling_id).toggle();
					$('.enable'+disabling_id).toggle();
				}
			},'json');
		});


	});
</script>


