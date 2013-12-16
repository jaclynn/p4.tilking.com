<div id="freewall" class="free-wall"> 
<?php foreach($bricks as $brick): ?>

<div class="brick">
	<img src='<?=$brick['image']?>' width="100%">
	<div class="info">
	    <h5>By: <?=$brick['first_name']?> <?=$brick['last_name']?></h5>
	    <h5>Price: $ <?=$brick['price']?></h5>
	    <h5>Description: <?=$brick['content']?></h5>
	    <h5>Pickup: <?=$brick['location']?></h5>
		<h5>Created: <time datetime="<?=Time::display($brick['created'],'Y-m-d G:i')?>">
        	<?=Time::display($brick['created'])?>
		</time></h5>
		<form method='POST' action='/bricks/p_interest'>
			<input type="hidden" name="brick_id" value=<?=$brick['brick_id']?>/>
			<input type="hidden" name="user_id" value=<?=$user->user_id?>/>
			<input type="submit" class="myButton" id="interestBtn" value="Express Interest"/>
		</form>
		<h5>Interested Parties:</h5>
		<h5>Tom Jones</h5>
		<h5>David Wilson</h5>
		<h5>Amy Butler</h5>
		
    </div>
    <!--
    <h1><?=$post['first_name']?> <?=$post['last_name']?> posted:</h1>

    <p><?=$post['content']?></p>

    <time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
        <?=Time::display($post['created'])?>
    </time>
	-->
</div>

<?php endforeach; ?>
</div>