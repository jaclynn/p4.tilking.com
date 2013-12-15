


<?php foreach($profile as $currentuser): ?>
<h1>This is the profile of <?=$currentuser['first_name']?></h1>
<img src='<?=$currentuser['avatar']?>' alt="profile picture" /><br/>
	<?=$currentuser['first_name']?>&#160;<?=$currentuser['last_name']?><br/>
	<a href="mailto:<?=$currentuser['email']?>"><?=$currentuser['email']?></a><br/><br/><br/>
	<?php if($user->user_id==$currentuser['user_id']):?>
	<a href="/users/updateprofile"><img src="/img/updateprofile.png" alt="Register"/></a>
	<?php endif; ?>
	<br/><br/>

<div class="contentside">
<article>
<br/><br/>

Location: 
<?=$currentuser['city']?>,&#160;
<?=$currentuser['state']?><br/>
Birthdate: <?=$currentuser['dob']?><br/>

<?php endforeach; ?>
</article>
</div>