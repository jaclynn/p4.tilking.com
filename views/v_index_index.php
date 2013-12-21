<br/>

<h1>See * LUV * Get!</h1>
<h6>The place to do all three.</h6>
<br/>
<br/>
<?php if(!$user):?>

You're new here! Please <a href="/users/signup">sign up</a> so you can start shopping!

<?php else: ?>

Welcome Back <?=$user->first_name?>!
<br/>

<?php endif ?>
<p>
See*LUV*Get is a site designed to offer services similar to local "yard sale" sites on Facebook. Similar to Craigslist, there is no money exchanged online, but unlike Craigslist, the community knows identities of others who are interested in the items.
</p>
<p>
Posted items for sale are displayed in what I call "bricks". This is both a nod to the Freewall code, and an effort to not blatantly steal a concept from my inspiration site (which is also why I did not name this site Brickterist).<br/>
<br/>
It should be obvious from the site that I am not very good with CSS, and I do realize that the site could benefit from features such as the ability for the user to modify their brick beyond "status", the ability to see other users. In the interest of time, I worked on improving the features I have.
</p>
<h2>Basic instructions:</h2>
<p>
1. Create an account via Sign Up<br/>
2. Your default landing page will be "Show All Bricks" <br/>
3. Bricks with a green bar are still available. Yellows are pending. Reds are sold.<br/>
4. Choose "Add Brick" to list an item for sale.<br/>
</p>
<h2>Features:</h2>
<p>
* jQuery plugin - <a href="http://vnjs.net/www/project/freewall/">Freewall</a><br/>
* jQuery plugin - <a href="http://www.berriart.com/sidr/">Sidr Slider Menu</a><br/>
* Javascript by me all contained in js/p4.js. Modified Sidr to default open, used JS to validate form entry, created the "interested" names in the bricks.<br/>
* User can upload avatars and item photos

</p>