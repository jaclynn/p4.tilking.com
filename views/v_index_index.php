<h1>Welcome to <?=APP_NAME?><?php if($user) echo ', '.$user->first_name; ?></h1>

<?php if(!$user):?>

<a href="/users/signup"><img src="/images/register.png" alt="Register"/></a>
<a href="/users/login"><img src="/images/login.png" alt="Login"/></a>

<?php else: ?>


<a href="/posts/users"><img src="/images/showusers.png" alt="Register"/></a>
<a href="/posts/index"><img src="/images/showposts.png" alt="Login"/></a>
<a href="/posts/add"><img src="/images/addpost.png" alt="Register"/></a>
<a href="/users/logout"><img src="/images/logout.png" alt="Login"/></a>

<?php endif ?>

<h2>+1 Features:</h2>
<h4>User profile information is accessible via Show Users</h4>
<h4>Profile pictures can be uploaded via Update Profile</h4>