<?php

class bricks_controller extends base_controller {
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
		
        # Make sure user is logged in if they want to use anything in this controller
        if(!$this->user) {
            die("Members only. <a href='/users/login'>Login</a>");
        }
		
	} 
		
	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/index/index/
	-------------------------------------------------------------------------------------------------*/
	public function index($status=NULL) {	

		
	    # Set up the View
	    $this->template->content = View::instance('v_bricks_index');
	    $this->template->title   = "Posts";
	    $this->template->client_files_head = '<script type="text/javascript">'.
			'var php_user = "'.$this->user->first_name.' '.$this->user->last_name.'";'.
			'var php_user_id = "'.$this->user->user_id.'";'.'</script>';
	
		$mybricks=FALSE;
		
	    if ($status!=NULL){
	    	switch ($status) {
		    	case "AVAILABLE":
		    	case "PPU":
		    	case "SOLD":
			    	$whereStatus = 'WHERE bricks.availability = "'.$status.'"';
			    	break;
			    default:
			    	$whereStatus = 'WHERE bricks.user_id = "'.$status.'"';
			    	$mybricks = TRUE;
			    	break;
			} //end switch
	    } else {
		    $whereStatus = '';
	    }
	    
	    # Build the query, narrow by parameter, if passed, order by newest
	    $q = 'SELECT 
	    			bricks.brick_id,
		    		bricks.image, 
		    		bricks.price, 
		    		bricks.user_id as bricks_user_id, 
		    		bricks.created, 
		    		bricks.content,
		    		bricks.location,
		    		bricks.availability,
		    		users.first_name,
		    		users.last_name
	    	    FROM bricks
	    		INNER JOIN users 
		        ON bricks.user_id = users.user_id '.$whereStatus.
		        ' ORDER BY bricks.created';
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
	    
	    $key = "parties";
	    for ($i = 0; $i < count($bricks); $i++) {
	    	$intQ='SELECT 
					interest.user_id,
		    		users.first_name as fn,
		    		users.last_name as ln
	    	    FROM interest
	    		INNER JOIN users 
		        ON interest.user_id = users.user_id 
		        AND interest.brick_id = "'.$bricks[$i]['brick_id'].'" 
		        ORDER BY interest.created';
		    $intEntry = DB::instance(DB_NAME)->select_rows($intQ);
			$bricks[$i]['parties']=$intEntry;
		}
	    	
	    	    # Pass data to the View
	    $this->template->content->bricks = $bricks;
	    $this->template->content->mybricks = $mybricks;
	    $this->template->title = "Bricks";
	
	    # Render the View
	    echo $this->template;
		}
		
	public function add($error=NULL) {
		
		if ($error=="FILE_BAD"){
			$error = "Invalid file type for brick picture.";
		}
        # Setup view
        $this->template->content = View::instance('v_bricks_add');
		$this->template->content->error = $error;

        $this->template->title   = "New Brick";
		
		
        # Render template
        echo $this->template;

    }

	public function p_interest() {
		// make a record linking brick to interested user
		$_POST['created'] = Time::now();
		$test = 'SELECT user_id FROM interest WHERE brick_id="'.$_POST['brick_id'].'" AND user_id = "'.$_POST['user_id'].'"';
		$user_interest = DB::instance(DB_NAME)->select_field($test);
		
		if ($user_interest==NULL) {
			DB::instance(DB_NAME)->insert('interest', $_POST);
		}
		$q = 'SELECT 
					interest.user_id,
		    		users.first_name as fn,
		    		users.last_name as ln
	    	    FROM interest
	    		INNER JOIN users 
		        ON interest.user_id = users.user_id
		        WHERE interest.brick_id = "'.$_POST['brick_id'].'" ORDER BY interest.created';
		$interested_parties = '<br/>';
		$interests = DB::instance(DB_NAME)->select_rows($q);
		foreach($interests as $interest):
			$interested_parties=$interested_parties.$interest['fn'].' '.$interest['ln'].'<br/>';
		endforeach;
		echo $interested_parties;
		//Router::redirect("/bricks/index");
	}

	public function mybricks() {
		# If user is blank, they're not logged in; redirect them to the login page
		if(!$this->user) {
	        Router::redirect('/users/login');
	    }
		
		
		$b = 'SELECT 
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
        WHERE bricks.user_id = '.$this->user->user_id.'
        ORDER BY bricks.created';	
		
		$bricks = DB::instance(DB_NAME)->select_rows($b);

	    $key = "parties";
	    for ($i = 0; $i < count($bricks); $i++) {
	    	$intQ='SELECT 
					interest.user_id,
		    		users.first_name as fn,
		    		users.last_name as ln
	    	    FROM interest
	    		INNER JOIN users 
		        ON interest.user_id = users.user_id 
		        AND interest.brick_id = "'.$bricks[$i]['brick_id'].'" 
		        ORDER BY interest.created';
		    $intEntry = DB::instance(DB_NAME)->select_rows($intQ);
			$bricks[$i]['parties']=$intEntry;
		}

		$this->template->content = View::instance('v_bricks_mybricks');
		$this->template->content->bricks = $bricks;

        $this->template->title   = "My Bricks";
		
        # Render template
        echo $this->template;

	}
	public function p_updatebrickstatus() {
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);
						
        $_POST['modified'] = Time::now();
        // switch case for statusA, statusP, statusS            
        DB::instance(DB_NAME)->update("bricks", $_POST['available'], "WHERE brick_id = '".$this->user->user_id."'");
		//Router::redirect("/bricks/index/".$this->user->id);
		
		//echo the new available field?

	}

    public function p_add() {
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);
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
		  Router::redirect("/bricks/add/FILE_BAD");
		  }
	  //$data = Array("image" => $path.$extension);
	  $_POST['image']  = '/'.$path.$extension;
	  DB::instance(DB_NAME)->insert('bricks', $_POST);
	  //DB::instance(DB_NAME)->update("bricks", $data, "WHERE brick_id = '".$id."'");
		  

	  # Quick and dirty feedback
	  Router::redirect("/bricks/index");

			
	}	
	
} # End of class
