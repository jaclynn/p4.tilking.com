<?php

class bricks_controller extends base_controller {
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
	} 
		
	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/index/index/
	-------------------------------------------------------------------------------------------------*/
	public function index() {	
		if(!$this->user) {
	        Router::redirect('/users/login');
	    }
		
	    # Set up the View
	    $this->template->content = View::instance('v_bricks_index');
	    $this->template->title   = "Posts";
	    $this->template->client_files_head = '<script type="text/javascript">'.
			'var php_user = "'.$this->user->first_name.' '.$this->user->last_name.'";'.'</script>';
	
	    # Build the query 
	    # Added DISTINCT so I could add the OR and include the user's own posts. Also sorted by newest
	    $q = 'SELECT 
	    			bricks.brick_id,
		    		bricks.image, 
		    		bricks.price, 
		    		bricks.user_id as bricks_user_id, 
		    		bricks.created, 
		    		bricks.content,
		    		bricks.location,
		    		users.first_name,
		    		users.last_name
	    	    FROM bricks
	    		INNER JOIN users 
		        ON bricks.user_id = users.user_id
		        ORDER BY bricks.created';
		/* $q = 'SELECT DISTINCT
		            posts.content,
		            posts.created,
		            posts.user_id AS post_user_id,
		            users_users.user_id AS follower_id,
		            users.first_name,
		            users.last_name
		        FROM posts
		        INNER JOIN users_users 
		            ON posts.user_id = users_users.user_id_followed		
		            OR posts.user_id = users_users.user_id            
		        INNER JOIN users 
		            ON posts.user_id = users.user_id
		        WHERE users_users.user_id = '.$this->user->user_id.' ORDER BY posts.created DESC'; */
	    # Run the query
	    $bricks = DB::instance(DB_NAME)->select_rows($q);
	
	    # Pass data to the View
	    $this->template->content->bricks = $bricks;
	    $this->template->title = "Bricks";
	
	    # Render the View
	    echo $this->template;
		}
		
	public function add($error=NULL) {

        # Setup view
        $this->template->content = View::instance('v_bricks_add');
		$this->template->content->error = $error;

        $this->template->title   = "New Brick";
		
		
        # Render template
        echo $this->template;

    }
	public function p_interest() {
		// make a record linking brick to interested user
		DB::instance(DB_NAME)->insert('interest', $_POST);
		Router::redirect("/bricks/index");
	}

    public function p_add() {
		
        # Associate this post with this user
        $_POST['user_id']  = $this->user->user_id;
        
        # Unix timestamp of when this post was created / modified
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();
		
		//$row = mysql_fetch_row($brickq); 
		//$id = $row[0]; 
		
		# Insert
        # Note we didn't have to sanitize any of the $_POST data because we're using the insert method which does it for us
        
		$allowedExts = array("gif", "jpg", "png", "PNG", "JPG", "GIF");
		
		$temp = explode(".", $_FILES["brickpic"]["name"]);
		$extension = end($temp);
		
		if ((($_FILES["brickpic"]["type"] == "image/gif")
		|| ($_FILES["brickpic"]["type"] == "image/jpeg")
		|| ($_FILES["brickpic"]["type"] == "image/jpg")
		|| ($_FILES["brickpic"]["type"] == "image/jpeg")
		|| ($_FILES["brickpic"]["type"] == "image/x-png")
		|| ($_FILES["brickpic"]["type"] == "image/png"))
		//&& ($_FILES["file"]["size"] < 20000)
		&& in_array($extension, $allowedExts))
		  {
		  if ($_FILES["brickpic"]["error"] > 0)
		    {
		    //echo "Return Code: " . $_FILES["avatar"]["error"] . "<br>";
		    }
		  else
		    {
		      $path = 'uploads/items/brickpic_user'.$this->user->user_id.'_'.$_POST['created'].'.';
		      copy($_FILES["brickpic"]["tmp_name"],
		      $path.$extension);
		      //echo "Stored in: " . APP_PATH.'uploads/items/'. $_FILES["avatar"]["name"];
		      $extension = strtolower($extension);
		      switch ($extension) {
				    case 'png':
				    case 'PNG':
				        $image = imagecreatefrompng(APP_PATH.$path.$extension);
				        break;
				    case 'jpg':
				    case 'JPG':
				        $image = imagecreatefromjpeg(APP_PATH.$path.$extension);
				        break;
				    case 'gif':
				    case 'GIF':
				        $image = imagecreatefromgif(APP_PATH.$path.$extension);
				        break;
				} //end switch

		      
		    } //end else
		  } //big if
		else
		  {
		  Router::redirect("/bricks/add/error");
		  }
	  //$data = Array("image" => $path.$extension);
	  $_POST['image']  = '/'.$path.$extension;
	  DB::instance(DB_NAME)->insert('bricks', $_POST);
	  //DB::instance(DB_NAME)->update("bricks", $data, "WHERE brick_id = '".$id."'");
		  

	  # Quick and dirty feedback
	  Router::redirect("/bricks/index");

			
	}	
	
} # End of class
