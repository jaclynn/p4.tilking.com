<div id="freewall" class="free-wall"> 
<?php foreach($bricks as $brick): ?>

<div class="brick">
	<img src='<?=$brick['image']?>' width="100%">
	<div class="info" id=<?=$brick['brick_id']?>>
	    <h5>By: <?=$brick['first_name']?> <?=$brick['last_name']?></h5>
	    <h5>Price: $ <?=$brick['price']?></h5>
	    <h5>Description: <?=$brick['content']?></h5>
	    <h5>Pickup: <?=$brick['location']?></h5>
		<h5>Created: <time datetime="<?=Time::display($brick['created'],'Y-m-d G:i')?>">
        	<?=Time::display($brick['created'])?>
		</time></h5>
		<!--<form method='POST' action='/bricks/p_interest'>
			<input type="hidden" name="brick_id" value=<?=$brick['brick_id']?>/>
			<input type="hidden" name="user_id" value=<?=$user->user_id?>/>-->
		<button class="interestBtn myButton">Express INTEREST</button>
		<!--</form>-->
		<h5>Interested Parties:</h5>
		<div class="int_parties">
			<script>console.log(<?=$brick['brick_id']?>);</script>
		</div>
		
    </div>
</div>

<?php endforeach; ?>
</div>