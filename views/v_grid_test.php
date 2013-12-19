
    <?php if(isset($error)): ?>
        <br/>Server Side Error: <div class='error'>
            <?=$error?>
        </div>
        <br>
    <?php endif; ?>


<form action="/grid/p_test" method="POST">
<input type="hidden" name="form" value="login" />
<p>Username:
<input type="text" name="username" /></p>
<p>Password:
<input type="password" name="password" /></p>
<p>Email:
<input type="text" name="email" /></p>
<p>Number:
<input type="text" name="number" /></p>
<input type="submit" />
</form>