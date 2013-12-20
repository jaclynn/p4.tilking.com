

<div class="colorguide" id="AVAILABLE">Available Items</div>
<div class="colorguide" id="PPU">Pending Items</div>
<div class="colorguide" id="SOLD">Sold Items</div>

<div id="freewall" class="free-wall">

<?php foreach($bricks as $brick): ?>

<div class="brick">
	<img class="brickimage" src='<?=$brick['image']?>' alt="img<?=$brick['brick_id']?>">
	<div class="<?=$brick['availability']?>" id="status<?=$brick['brick_id']?>">&nbsp;</div>
	<div class="info" id=<?=$brick['brick_id']?>>
	    By: <?=$brick['first_name']?> <?=$brick['last_name']?><br/> 
	    Price: $ <?=$brick['price']?><br/>
	    Description:<br/><?=$brick['content']?><br/>
	    Pickup: <?=$brick['location']?><br/>
		Created:<br/><time datetime="<?=Time::display($brick['created'],'Y-m-d G:i')?>">
        	<?=Time::display($brick['created'])?>
		</time><br/>
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