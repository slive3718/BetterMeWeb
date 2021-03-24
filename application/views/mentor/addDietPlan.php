
<style>
	.m-indent {
		margin: 20px;
	}
</style>
<div class="container-fluid card shadow" style="width:100vh">
	<div class="m-indent" style="">
		<form method="POST" action="<?= base_url().'mentor/add_new_plan'?>" enctype="multipart/form-data">

			<div class="form-group">
				<label for="thread_type">Thread</label>
				<select name="thread_type" class="form-control">
					<option name="thread_type" value="Diet_Plan">Diet Plan</option>
					<option name="thread_type" value="Exercise">Exercise</option>
				</select>
			</div>

			<div class="form-group">
				<label for="">Post Title</label>
				<input name="post_title" type="text" class="form-control" id="" placeholder="" required>
			</div>

			<div class="form-group">
				<label for="">Type Of Diet</label>
				<select class="form-control" name="type_of_diet">
					<option value="">No Selection</option>
					<option name="type_of_diet" value="Intermittent Fasting">Intermittent Fasting</option>
					<option name="type_of_diet" value="Zone Diet">Zone Diet</option>
					<option name="type_of_diet" value="Paleo Diet">Paleo Diet</option>
					<option name="type_of_diet" value="Paleo Diet">Paleo Diet</option>
					<option name="type_of_diet" value="Blood Type Diet">Blood Type Diet</option>
					<option name="type_of_diet" value="Vegan Diet">Vegan Diet</option>
					<option name="type_of_diet" value="South Beach Diet">South Beach Diet</option>
					<option name="type_of_diet" value="Mediterranean Diet">Mediterranean Diet</option>
					<option name="type_of_diet" value="Food Diet">Raw Food Diet</option>
				</select>
			</div>

			<div class="form-row">
				<div class="col">
					<label for=""> Plan Track (Optional)</label>
					<select class="form-control" name="routine_format" id="plan_track">
						<option value="">No Selection</option>
						<option name="routine_format" value="Day">Day</option>
						<option name="routine_format" value="Month">Month</option>
						<option name="routine_format" value="Year">Year</option>
					</select>
				</div>
				<div class="col">
					<label for="">Number of: Days|Months|Years</label>
					<input name="routine_count" class="form-control" type="number" class="form-inline" id="num_day"
						   placeholder="">
				</div>
				<div class="col">
					<label for="target_audience">Suitable for:</label>
					<select name="target_audience" class="form-control">
						<option value="">No Selection</option>
						<option name="target_audience" value="Kids">Kids</option>
						<option name="target_audience" value="Adult">Teens</option>
						<option name="target_audience" value="Adult">Adult</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="">Post Content</label>
				<textarea name="post_content" rows="10" class="form-control" id="" placeholder=""></textarea>
			</div>

			<div class="form-group">
				<label for="userfile">Select Image</label>
				<input type="file" name="userfile[]" size="20"
					   oninput="pic.src=window.URL.createObjectURL(this.files[0])"
					   multiple="multiple"
				/>
				<img id="pic" style="width:150px;height:150px"/>
			</div>
			<div style="float:right">
				<button type="reset" class="btn btn-primary btn-sm">Reset</button>
				<button type="submit" class="btn btn-success btn-sm" id="submit">Submit</button>
			</div>

		</form>
	</div>
</div>
<script>

</script>
