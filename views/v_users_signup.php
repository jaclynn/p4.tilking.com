<h2>Sign up for an account</h2>
    <?php if(isset($error)): ?>
	<br/>Server Side Error: <div class='error'>
            <?=$error?>
        </div>
        <br>
    <?php endif; ?>

<form method='POST' action='/users/p_signup'>
<fieldset>
		<legend>Enter your credentials</legend>    
		<p><label class="field" for="first_name">First  Name:</label><input type='text' id='first_name' name='first_name' required /></p>
		<p><label class="field" for="last_name">Last  Name:</label><input type='text' id='last_name' name='last_name' required /></p>
		<p><label class="field" for="email">Email:</label><input type='email' id='email' name='email' required /></p>
		<br/>
		<p>Password must be 8-20 chars, include a number, a symbol, mixed case: 
		<p><label class="field" for="password">Password:</label><input type='password' id='password' name='password'  maxlength="20" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required/></p>
		<p><label class="field" for="pass2">Confirm Password:</label><input type='password' id='pass2' name='pass2'  maxlength="20" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required/></p>
				
		<input type='submit' value='Sign Up'/>
</fieldset>
</form>
