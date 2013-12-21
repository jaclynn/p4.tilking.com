<div id="colorguide">
		<div id="ALL"><a href="/bricks/index">All Items</a></div>
		<div id="AVAILABLE"><a href="/bricks/index/AVAILABLE">Available Items</a></div>
		<div id="PPU"><a href="/bricks/index/PPU">Pending Items</a></div>
		<div id="SOLD"><a href="/bricks/index/SOLD">Sold Items</a></div>
</div>

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
<!-- putting all the JS down here works fine on real browsers, but
IE ver# would not work unless this script below was explicitly in
script tags, at explicitly this location, necessitating my widget
js in the head -->
<script type="text/javascript">
var ewall = new freewall("#freewall");
ewall.reset({
	selector: '.brick',
	animate: true,
	cellW: 200,
	cellH: 'auto',
	onResize: function() {
		ewall.fitWidth();
	}
});


var images = ewall.container.find('.brick');
var length = images.length;
images.css({visibility: 'hidden'});
images.find('img').load(function() {
	-- length;
	console.log(length);
	if (!length) {
		setTimeout(function() {
			images.css({visibility: 'visible'});						
			ewall.fitWidth();
		}, 505);
	}

});
</script>
