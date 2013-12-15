<?php foreach($posts as $post): ?>

<div class="brick">
	<img src="i/photo/1.jpg" width="100%">
	<div class="info">
	    <h3>Freewall</h3>
	    <h5>Pinterest layout</h5>
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