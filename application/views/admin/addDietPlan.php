
<style>
	.m-indent {
		margin: 20px;
	}
</style>
<div class="container-fluid card shadow" style="width:100vh; max-width: 100%;">
	<div class="m-indent" style="">
		<form method="POST" action="<?= base_url().'admin/add_new_plan'?>" enctype="multipart/form-data">

			<div class="form-group">
				<label for="thread_type">Thread</label>
				<select name="thread_type" class="form-control" id ="thread-type">
					<option name="thread_type" value="Diet_Plan" id="dietPlan">Diet Plan </option>
					<option name="thread_type" value="Exercise" id="dietPlan" >Exercise</option>
				</select>
			</div>

			<div class="form-group">
				<label for="">Post Title</label>
				<input name="post_title" type="text" class="form-control" id="" placeholder="" required>
			</div>


			<?php if(! isset($exercise) && empty($exercise)):?>
			<div class="form-group type-of-diet">
				<label for="">Type Of Diet</label>
				<select class="form-control select-diet" name="type_of_diet" >
					<option value="">No Selection</option>
					<option name="type_of_diet" value="Intermittent Fasting" id="diet_select">Intermittent Fasting</option>
					<option name="type_of_diet" value="Zone Diet" id="diet_select">Zone Diet</option>
					<option name="type_of_diet" value="Paleo Diet" id="diet_select">Paleo Diet</option>
					<option name="type_of_diet" value="Blood Type Diet" id="diet_select">Blood Type Diet</option>
					<option name="type_of_diet" value="Vegan Diet" id="diet_select">Vegan Diet</option>
					<option name="type_of_diet" value="South Beach Diet" id="diet_select">South Beach Diet</option>
					<option name="type_of_diet" value="Mediterranean Diet" id="diet_select">Mediterranean Diet</option>
					<option name="type_of_diet" value="Food Diet" id="diet_select">Raw Food Diet</option>
					<option name="type_of_diet" value="Other Diet" id="other_diet" >Other Diet</option>
				</select>
			</div>
			<div class="form-group text-other-diet" >
				<label for="">Name of Diet Plan</label>
				<input class="form-control" type="text" value="" name="other_diet">
			</div>
			<?php endif; ?>


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
	$(document).ready(function(){

		$('.text-other-diet').hide();
		$(".select-diet").change(function() {
			if ($(this).val() == "Other Diet") {
				$(".text-other-diet").show();
			}
			if ($(this).val() !== "Other Diet") {
				$(".text-other-diet").hide();
			}
		});

		$('#dietPlan').on('click',function(){
			console.log("here");
		});
	});


	$(document).ready(function(){
		$("#thread-type").change(function() {
			if ($(this).val() == "Exercise") {
				$('.type-of-diet').hide();
			}
			if ($(this).val() == "Diet_Plan") {
				$('.type-of-diet').show();
			}

		});
	})
</script>
