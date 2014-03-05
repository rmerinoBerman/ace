<form class="commentForm" method="get" action="">
	<fieldset>
		<div class="formField">
			<div class="fieldContent">
				<label for="first_name">First Name</label>
				<input type="text" class="first_name" name="first_name" />
			</div>
		</div>
		<div class="formField">
			<div class="fieldContent">
				<label for="last_name">Last Name</label>
				<input type="text" class="last_name" name="last_name" />
			</div>
		</div>
		<div class="formField">
			<div class="fieldContent">
				<label for="company_name">Company Name</label>
				<input type="text" class="company_name" name="company_name" />
			</div>
		</div>
		<div class="formField">
			<div class="fieldContent">
				<label for="address">Address</label>
				<input type="text" class="address" name="address" />
			</div>
		</div>
		<div class="formField">
			<div class="fieldContent">
				<label for="telephone">Phone</label>
				<input type="text" class="telephone" name="telephone" />
			</div>
		</div>
		<div class="formField">
			<div class="fieldContent">
				<label for="email">E-Mail</label>
				<input type="text" class="email" name="email" />
			</div>
		</div>
		<div class="formField">
			<div class="fieldContent">
				<label for="city_state_zip">City/State/Zip Code</label>
				<input type="text" class="city_state_zip" name="city_state_zip" />
			</div>
		</div>
		<div class="formField">
			<div class="fieldContent">
				<label for="sponsorship_level">Sponsorship Level</label>
				<select class="sponsorship_level" name="sponsorship_level">
					<option value=""></option>
				</select>
			</div>
		</div>
		<div class="formField" id="contactCaptcha"></div>
		<div class="formField">
			<input class="submit" type="submit" value="Submit"/>
		</div>
	</fieldset>
	<div class="formResponse"></div>
</form>