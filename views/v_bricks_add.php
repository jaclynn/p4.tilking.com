    <?php if(isset($error)): ?>
	<br/>Server Side Error: <div class='error'>
            <?=$error?>
        </div>
        <br>
    <?php endif; ?>

<br/>
<br/>
<form method='POST' action='/bricks/p_add' enctype="multipart/form-data">
	<label for="brickpic">Picture:</label><br/>
	<input type="file" name="brickpic" id="brickpic" class="myButton">
	<br/>
	<br/>
	<label for="price">Price:</label><br/>
	<input type="number" name="price" id="price" />
	<div></div>
	<br/>
	<label for="location">Location:</label><br/>
	<input type="text" id="location" name="location" maxlength="20" required />
	<div></div>
	<br/>
    <label for="content">Description:</label><br/>
    <textarea name="content" id="content" maxlength="128"></textarea>
    <div id="maxcharerr"></div>
    <br/><br/>
    <input class="myButton" type="submit" value="New Brick" />

</form> 