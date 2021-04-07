
<!------ Include the above in your HEAD tag ---------->
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
    		        <label for="title">Title <span class="require">*</span></label>
    		        <input type="text" class="form-control" name="title" />
    		    </div>
    		    
    		    <div class="form-group">
    		        <label for="description">Description</label>
    		        <textarea rows="5" class="form-control" name="description" ></textarea>
    		    </div>
    		    
    		
    		    
    		    <div class="form-group">
    		        <button type="submit" class="btn btn-primary">
    		            Create
    		        </button>
    		        <button class="btn btn-default">
    		            Cancel
    		        </button>
    		    </div>
    		    
    		</form>
		</div>
		
	</div>
</div>
</div>