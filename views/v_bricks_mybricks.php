<h2><?=$user->first_name?>'s Bricks</h2>
<div id="freewall" class="free-wall"> 
<?php foreach($bricks as $brick): ?>
<div class="brick">
	<img src='<?=$brick['image']?>' width="100%">
	<div class="info" id=<?=$brick['brick_id']?>>
	    <h6>By: <?=$brick['first_name']?> <?=$brick['last_name']?></h6>
	    <h6>Price: $ <?=$brick['price']?></h6>
	    <h6>Description: <?=$brick['content']?></h6>
	    <h6>Pickup: <?=$brick['location']?></h6>
		<h6>Created: <time datetime="<?=Time::display($brick['created'],'Y-m-d G:i')?>">
        	<?=Time::display($brick['created'])?>
		</time></h6>
		<!--<form method='POST' action='/bricks/p_interest'>
			<input type="hidden" name="brick_id" value=<?=$brick['brick_id']?>/>
			<input type="hidden" name="user_id" value=<?=$user->user_id?>/>
		<button class="interestBtn myButton">Express INTEREST</button>
		</form>-->
		<h6>Interested Parties:</h6>
		<div class="int_parties">
		<br/>
		<?php foreach($brick['parties'] as $interest): ?>
			<?=$interest['fn']?> <?=$interest['ln']?><br/>
		<?php endforeach; ?>
		</div>
		<br/>
		<br/>
		
    </div>
</div>

<?php endforeach; ?>
</div>
</div>