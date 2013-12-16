    <?php if(isset($error)): ?>
    <br/>
        <div class='error'>
            Invalid File. Try again.<br/>
            
        </div>
        <br>
    <?php endif; ?>


<br/>
<br/>
<form method='POST' action='/bricks/p_add' enctype="multipart/form-data">
	<label for='brickpic'>Picture:</label><br/>
	<input type="file" name="brickpic" id="file" class="myButton"><br>
	<label for='price'>Price:</label><br/>
	<input type="number" name='price' /><br/>
<!--	<label for='image'>Image Location:</label><br/>
	<input type="text" name='image' /><br/> -->
	<label for='location'>Location:</label><br/>
	<input type="text" name='location' /><br/>
    <label for='content'>New Brick:</label><br/>
    <textarea name='content' name='content' maxlength="512"></textarea>
    <br/><br/>
    <input class="myButton" type='submit' value='New Brick' />

</form> 