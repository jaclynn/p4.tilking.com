<h1>Welcome to <?=APP_NAME?></h1>
<br/>
<br/>
<?php if(!$user):?>

You're new here! Please <a href="/users/signup">sign up</a> so you can start shopping!


<?php else: ?>

Welcome Back <?=$user->first_name?>!
<br/>
<br/>
<?php endif ?>

<h2>+1 Features:</h2>
