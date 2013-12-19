<div id="freewall" class="free-wall"> 
<?php foreach($bricks as $brick): ?>

<div class="brick">
	<img src='<?=$brick['image']?>' width="100%">
	<div class="<?=$brick['availability']?>">&nbsp;</div>
	<div class="info" id=<?=$brick['brick_id']?>>
	    <p>By: <?=$brick['first_name']?> <?=$brick['last_name']?><br/> 
	    Price: $ <?=$brick['price']?><br/>
	    Description:<br/><?=$brick['content']?><br/>
	    Pickup: <?=$brick['location']?><br/>
		Created:<br/><time datetime="<?=Time::display($brick['created'],'Y-m-d G:i')?>">
        	<?=Time::display($brick['created'])?>
		</time><br/></p>
		<!--<form method='POST' action='/bricks/p_interest'>
			<input type="hidden" name="brick_id" value=<?=$brick['brick_id']?>/>
			<input type="hidden" name="user_id" value=<?=$user->user_id?>/>-->
		<?php if($mybricks): ?>
		<button class="statusBtn myButton" id="statusA">Available</button>
		<button class="statusBtn myButton" id="statusP">Pending</button>
		<button class="statusBtn myButton" id="statusS">Sold</button>
		<?php else: ?>
		<button class="interestBtn myButton">Express INTEREST</button>
		<?php endif; ?>
		<!--</form>-->
		
		<h6>Interested Parties:</h6>
		<div class="int_parties">
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