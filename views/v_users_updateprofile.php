
<h2>This is the profile of <?=$user->first_name?></h2>
    <?php if(isset($error)): ?>
	<br/>Server Side Error: <div class='error'>
            <?=$error?>
        </div>
        <br>
    <?php endif; ?>
	
	<?php foreach($profile as $currentuser): ?>
	<img src='<?=$currentuser['avatar']?>' alt="profile picture" /><br/>
	<div class="contentside">
	<form action="/users/p_setavatar" method="post" enctype="multipart/form-data">
	<fieldset>
		<legend>Change Profile Picture</legend>
		<input type="file" name="avatar" id="file"><br>
		<input type="submit" name="submit" value="Change Profile Picture">
	</fieldset>
	</form>
	</div>
	<?=$user->first_name?>&#160;<?=$user->last_name?><br/>
	Email: <a href="mailto:<?=$user->email?>"><?=$user->email?></a>
	<br/><br/>
		
	<div>
	<form method='POST' action='/users/p_updateprofile'>
	<fieldset>
	<legend>Profile Data:</legend>
	<p>Last Modified: <time datetime="<?=Time::display($currentuser['modified'],'Y-m-d G:i')?>">
        <?=Time::display($currentuser['modified'])?></time></p>
    <p>Enter date of birth as (YYYY-MM-DD) if you don't have datepicker</p>
	<p><label class="field" for="dob">Date of Birth:</label><input type='date' id='dob' name='dob' value='<?=$currentuser['dob']?>'/></p>
		<label class="field" for="city">City:</label><input type='text' id='city' name='city' value='<?=$currentuser['city']?>'/></p>
	<p><label class="field" for="state">State:</label><select id='state' name="state">
		<option value="<?=$currentuser['state']?>" selected="selected"><?=$currentuser['state']?></option>
		<option value="AL">Alabama</option>
		<option value="AK">Alaska</option>
		<option value="AZ">Arizona</option>
		<option value="AR">Arkansas</option>
		<option value="CA">California</option>
		<option value="CO">Colorado</option>
		<option value="CT">Connecticut</option>
		<option value="DE">Delaware</option>
		<option value="DC">District Of Columbia</option>
		<option value="FL">Florida</option>
		<option value="GA">Georgia</option>
		<option value="HI">Hawaii</option>
		<option value="ID">Idaho</option>
		<option value="IL">Illinois</option>
		<option value="IN">Indiana</option>
		<option value="IA">Iowa</option>
		<option value="KS">Kansas</option>
		<option value="KY">Kentucky</option>
		<option value="LA">Louisiana</option>
		<option value="ME">Maine</option>
		<option value="MD">Maryland</option>
		<option value="MA">Massachusetts</option>
		<option value="MI">Michigan</option>
		<option value="MN">Minnesota</option>
		<option value="MS">Mississippi</option>
		<option value="MO">Missouri</option>
		<option value="MT">Montana</option>
		<option value="NE">Nebraska</option>
		<option value="NV">Nevada</option>
		<option value="NH">New Hampshire</option>
		<option value="NJ">New Jersey</option>
		<option value="NM">New Mexico</option>
		<option value="NY">New York</option>
		<option value="NC">North Carolina</option>
		<option value="ND">North Dakota</option>
		<option value="OH">Ohio</option>
		<option value="OK">Oklahoma</option>
		<option value="OR">Oregon</option>
		<option value="PA">Pennsylvania</option>
		<option value="RI">Rhode Island</option>
		<option value="SC">South Carolina</option>
		<option value="SD">South Dakota</option>
		<option value="TN">Tennessee</option>
		<option value="TX">Texas</option>
		<option value="UT">Utah</option>
		<option value="VT">Vermont</option>
		<option value="VA">Virginia</option>
		<option value="WA">Washington</option>
		<option value="WV">West Virginia</option>
		<option value="WI">Wisconsin</option>
		<option value="WY">Wyoming</option>
	</select></p>
	<input type='submit' value='Update Profile'/>
	</fieldset>
</form>
<?php endforeach; ?>
