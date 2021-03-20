<form action="<?= base_url() . 'admin/temp_add' ?>" method="POST" enctype="multipart/form-data">
	<center>
		<table style="margin-top:80px;">
			<tr>
				<td>
			<tr>
				<td><label hidden>Thread</label><input class="form-control"
													   type="text"
													   name="post_type"
													   value="Diet_Plan" readonly hidden></td>
			</tr>
			<tr>
				<td>
					<label hidden>userId</label>
					<input class="form-control" type="text" name="user_id" value="<?= (isset($this->session->userdata['id']))? $this->session->userdata['id']:'' ?>" readonly hidden>
				</td>
			</tr>
			<td>
				<tr>
					<td><label>Diet Title</label><input class="form-control" type="text" name="post_title"
														placeholder="Title"></td>
				</tr>
				<tr>
					<!-- <td><input type="date" name="date_range"></td> -->
				</tr>
				<tr>
					<td><label>Diet Plan </label><select class="form-control" name="routine_format">
							<option name="routine_format" value="Day">Day</option>
							<option name="routine_format" value="Month">Month</option>
							<option name="routine_format" value="Year">Year</option>
						</select>
						<input class="form-control" type="text" name="routine_count"
							   placeholder="number of year|month|day|">

					</td>
				</tr>
				<tr>
					<td><label>Types of Diet </label>
						<select name="activity_type">
							<option value=""></option>

							<option name="activity_type" value="Intermittent Fasting">Intermittent Fasting</option>
							<option name="activity_type" value="Zone Diet">Zone Diet</option>
							<option name="activity_type" value="Paleo Diet">Paleo Diet</option>
							<option name="activity_type" value="Paleo Diet">Paleo Diet</option>
							<option name="activity_type" value="Blood Type Diet">Blood Type Diet</option>
							<option name="activity_type" value="Vegan Diet">Vegan Diet</option>
							<option name="activity_type" value="South Beach Diet">South Beach Diet</option>
							<option name="activity_type" value="Mediterranean Diet">Mediterranean Diet</option>
							<option name="activity_type" value="Food Diet">Raw Food Diet</option>

						</select>
					</td>
				</tr>
				<tr>
					<td>
						<select name="targetAudience" class="form-control">
							<option name="targetAudience" value="Adults">Adults</option>
							<option name="targetAudience" value="Teens"> Teens</option>
							<option name="targetAudience" value="Kids">Kids</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<textarea name="post_content" class="form-control" id="" cols="100" rows="10"
								  placeholder="Diet Content" id="post_content"></textarea>
					</td>
				</tr>
				<tr>
					<td>
						<input type="file" name="userfile" size="20"
							   oninput="pic.src=window.URL.createObjectURL(this.files[0])"/>
						<img id="pic" style="width:150px;height:150px"/>
					</td>
				</tr>
				<tr>
					<td><input type="submit" name="submit" id="">
						<input type="reset" name="reset"></td>
				</tr>
		</table>
</form>
            


