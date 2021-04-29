<?php //echo "<pre>";print_r($reports);exit;?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
		<h2>Manage Reported Users</h2>
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
								<a class="btn btn-primary btn-sm report-info" data-user_id = "<?=$report->user_id?>">View Reports Info</a><br>
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

<!-- Modal -->
<div class="modal fade" id="modal-report-info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Report Information</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		
			</div>
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

		$('#myTable').on('click','.report-info',function(e){
			e.preventDefault();
			Swal.fire('Fetching Information')
			Swal.showLoading()
			var userId = $(this).attr('data-user_id');
			var url = "<?=base_url().'admin/get_user_reports_info'?>";
			$.post(url, {'userId':userId}, function(success){
			}).done(function(datas){
				$('#modal-report-info').modal('show');
				$('#modal-report-info .modal-body').html("");
				datas = JSON.parse(datas);
				$.each(datas, function (index, data){
					swal.close();
					if(data.post_id==null){
						data.post_id="";
					}
					if(data.post_type==null){
						data.post_type="";
					}
					if(data.post_type == "Community_post"){
						redirect="<?=base_url().'admin/view_this_community_post/'?>";
					}
					if(data.post_type == "Diet_plan"){
						redirect="<?=base_url().'admin/viewFullDiet/'?>";
					}
					$('#modal-report-info .modal-body').append('<div class="card" style="background-color:lightgray;text-align:center"><label>Report from: </label><b>'+data.first_name+' '+data.last_name+'</b><br><span class="badge badge-info">Reason</span><br>'+data.reason+'<br><small style="text-align: center">'+data.date_time+'</small><br><div><a href="'+redirect+data.post_id+'">'+data.post_type+data.post_id+'</a></div><br>');
				});
			});
		});

	});
</script>


