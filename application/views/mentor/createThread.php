
<!------ Include the above in your HEAD tag ---------->
<style>
	body{
		align-content: center;
	}
	.font-header{
		color: #FFFFFF;
		font-family: 'Raleway', sans-serif;
		font-size: 30px;
		font-weight: 800;
		line-height: 72px;
		/*margin: 0 0 24px;*/
		text-align: center;
		text-transform: uppercase;
		background-color: #28A745;
		border-radius: 5px;
	}
</style>

<div >
<div class="container">
<div class="row">
	    <div class="col-md-11 col-md-offset-4 card shadow" style="margin-top:50px">
		<div class="jumbotron" style="margin-top: 20px;">
			<div class="font-header table-responsive" >
				CREATE A THREAD
			</div>
		</div>

    		<form action="<?= base_url().'mentor/post_thread' ?>" method="POST">
    		    <div class="form-group">
					<label for="title"><b>Title</b></label>
    		        <input type="text" class="form-control" name="title" required />
    		    </div>
    		    <div class="form-group">
    		        <label for="description"><b>Description</b></label>
    		        <textarea rows="5" class="form-control" name="description" required></textarea>
    		    </div>
    		    <div class="form-group">
    		        <button type="submit" class="btn btn-primary">
    		            Create
    		        </button>
    		        <button href="<?php echo base_url('mentor/homepage')?>">
    		            Cancel
    		        </button>
    		    </div>
    		    
    		</form>
		</div>
		
	</div>
</div>
</div>