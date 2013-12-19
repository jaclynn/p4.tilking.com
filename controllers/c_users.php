<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

    public function index() {
        echo "This is the index page";
    }

    public function signup($error = NULL) {
       	if($this->user) {
	        Router::redirect('/users/login');
	    }
    	switch ($error) {
			case "EMAIL_BAD":
				$error = "Invalid email format";
				break;
			case "PASS_STRENGTH":
				$error = "Password too weak. Must include a number and a symbol.";
				break;
			case "PASS_LENGTH":
				$error = "Password must be between 8 and 20 characters long.";
				break;
			case "PASS_MATCH":
				$error = "The passwords do not match.";
				break;
			case "ACCOUNT_EXISTS":
				$error = "There is already an account associated with this email address.";
				break;
		}

       # Set up the view
       $this->template->content = View::instance('v_users_signup');
       $this->template->title = "Sign Up";
       $this->template->content->error = $error;
       
       
       # Render the view
       echo $this->template;
       
    }

    
    public function p_signup() {
                        
            $_POST = DB::instance(DB_NAME)->sanitize($_POST);
		           
		    $clean = array();
		    
		    $email_pattern = '/^[^@\s<&>]+@([-a-z0-9]+\.)+[a-z]{2,}$/i';
		    //$pass_pattern = '(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$';
		    //$pass_pattern = "(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$";
		    $pass_pattern = "#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#";
		    
		    if (preg_match($email_pattern, $_POST['email'])) 
			{ 
			    $clean['email'] = $_POST['email']; 			    
			} else {
				Router::redirect("/users/signup/EMAIL_BAD");
			}

		    if (preg_match($pass_pattern, $_POST['password'])) 
			{ 
			    $clean['password'] = $_POST['password']; 			    
			} else {
				Router::redirect("/users/signup/PASS_STRENGTH");
			}
			if (strlen($_POST['password'])>20) 
			{
				Router::redirect("/users/signup/PASS_LONG");
			}
			if (strlen($_POST['password'])<8)
			{
				Router::redirect("/users/signup/PASS_SHORT");
			}
			if ($_POST['password']!= $_POST['pass2'])
			{
				Router::redirect("/users/signup/PASS_MATCH");
			}
            
			$e = 'SELECT email
                    	FROM users
                        WHERE email="'.$clean['email'].'"';
            $testifemailexists = DB::instance(DB_NAME)->select_field($e);            
            
			if ($testifemailexists!=NULL) 
			{
				Router::redirect("/users/signup/ACCOUNT_EXISTS");
			}
			else {
			
				unset($_POST['pass2']); // Get rid of pass2 before it goes to DB
				
				$_POST['created']  = Time::now();
	            $_POST['modified'] = Time::now();
	            $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
	            $_POST['token']    = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
	            $_POST['first_name'] = strip_tags($_POST['first_name']);
	            $_POST['last_name'] = strip_tags($_POST['last_name']);
	            $_POST['email'] = strip_tags($_POST['email']);
	            	            
	                       
	            DB::instance(DB_NAME)->insert_row('users', $_POST);
	            $q='SELECT user_id FROM users WHERE email="'.$_POST['email'].'"';
	            
	            
	            $userid = DB::instance(DB_NAME)->select_field($q); 
	            $geolocation = Geolocate::locate();
				$newprofile = array('user_id' => $userid,
									'city' => $geolocation['city'],
									'state' => $geolocation['state'],
									'created' => $_POST['created'],
									'modified' => $_POST['modified'],
									'avatar' => PLACE_HOLDER_IMAGE
									);
				
					
	            DB::instance(DB_NAME)->insert_row('profiles', $newprofile);
	            # Send them to the login page
	            
	            # $initialfollowerentry = array('user_id' => $userid,
	            # 							  'created' => $_POST['created']);
	            							  
	            # DB::instance(DB_NAME)->insert_row('users_users', $initialfollowerentry);
	            							  					   
				Router::redirect('/users/login');
            }
            
    }

    public function login($error=NULL) {
    	    if($this->user) {
		        Router::redirect('/');
		    }
    
            $this->template->content = View::instance('v_users_login');    
               
            # Pass data to the view
            $this->template->title = "Login";
			$this->template->content->error = $error;

		    # Render the view
		    echo $this->template;

    }
    
    public function p_login() {
                $_POST = DB::instance(DB_NAME)->sanitize($_POST);      
                $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
                

                $q = 
                        'SELECT token 
                        FROM users
                        WHERE email = "'.$_POST['email'].'"
                        AND password = "'.$_POST['password'].'"';
                        
                        //echo $q;
           
                $token = DB::instance(DB_NAME)->select_field($q);
                
			    # Login failed
			    if(!$token) {
			        # Note the addition of the parameter "error"
			        Router::redirect("/users/login/error"); 
			    }
			    # Login passed
			    else {
			        setcookie("token", $token, strtotime('+2 weeks'), '/');
			        Router::redirect("/bricks/index");
			    }           
    }

	public function logout() {
	
	    # Generate and save a new token for next login
	    $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
	
	    # Create the data array we'll use with the update method
	    # In this case, we're only updating one field, so our array only has one entry
	    $data = Array("token" => $new_token);
	
	    # Do the update
	    DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");
	
	    # Delete their token cookie by setting it to a date in the past - effectively logging them out
	    setcookie("token", "", strtotime('-1 year'), '/');
	
	    # Send them back to the main index.
	    Router::redirect("/");
	
	}
	public function profile($selectfriend=NULL) {
	
	    # If user is blank, they're not logged in; redirect them to the login page
	    if(!$this->user) {
	        Router::redirect('/users/login');
	    }
		
		if (isset($selectfriend)) {
			$searchuserid = $selectfriend;
		} else {
			$searchuserid = $this->user->user_id;
		}
		
	    # If they weren't redirected away, continue:
		$q = 'SELECT 
		            *
		        FROM profiles
		        INNER JOIN users ON
		         profiles.user_id = users.user_id
		        WHERE profiles.user_id = '.$searchuserid;	
		//echo $q;
		
		$profile = DB::instance(DB_NAME)->select_rows($q);
		//echo var_dump($profile);
		
	    # Setup view
	    $this->template->content = View::instance('v_users_profile');
	    $this->template->title   = "Profile of ".$profile[0]['first_name'];
	    $this->template->content->profile = $profile;
	    
		
	    # Render template
	    echo $this->template;
	}
	
	public function updateprofile($error=NULL) {
	
		# If user is blank, they're not logged in; redirect them to the login page
	    if(!$this->user) {
	        Router::redirect('/users/login');
	    }

		switch ($error) {
			case "CITY_LENGTH":
				$error = "Too many characters in city field. Limit is 20.";
				break;
			case "STATE_BAD":
				$error = "Not a valid state format.";
				break;
			case "AVATAR_BAD":
				$error = "Not a valid avatar file.";
				break;	
		}
	
	    # If they weren't redirected away, continue:
		$q = 'SELECT 
		            *
		        FROM profiles
		        WHERE user_id = '.$this->user->user_id;	
		//echo $q;
		
		$profile = DB::instance(DB_NAME)->select_rows($q);
	    
	    
	    # Setup view
	    $this->template->content = View::instance('v_users_updateprofile');
	    $this->template->title   = "Profile of ".$this->user->first_name;
	    $this->template->content->error = $error;
	    $this->template->content->profile = $profile;
	
	    # Render template
	    echo $this->template;
	}
	
	public function p_updateprofile() {
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);
						
        $_POST['modified'] = Time::now();

		if (strlen($_POST['city'])<=20) 
		{
		    $_POST['city'] = strip_tags($_POST['city']);
		} else {
			Router::redirect("/users/updateprofile/CITY_LENGTH");
		}

		if (strlen($_POST['state'])>2) 
		{
		    Router::redirect("/users/updateprofile/STATE_BAD");
		} 


        $_POST['city'] = strip_tags($_POST['city']);
        
        /*
        echo "<pre>";
        print_r($_POST);
        echo "<pre>";
        */
                   
        DB::instance(DB_NAME)->update("profiles", $_POST, "WHERE user_id = '".$this->user->user_id."'");
		Router::redirect("/users/profile");
		
	}
	
	/* This is for the setavatar form on the updateprofile page. I use the GD library to manipulate image for use as avatar */
	public function p_setavatar() {
		
		$allowedExts = array("gif", "jpg", "png", "PNG", "JPG", "GIF");
		
		$temp = explode(".", $_FILES["avatar"]["name"]);
		$extension = end($temp);
		
		if ((($_FILES["avatar"]["type"] == "image/gif")
		|| ($_FILES["avatar"]["type"] == "image/jpeg")
		|| ($_FILES["avatar"]["type"] == "image/jpg")
		|| ($_FILES["avatar"]["type"] == "image/pjpeg")
		|| ($_FILES["avatar"]["type"] == "image/x-png")
		|| ($_FILES["avatar"]["type"] == "image/png"))
		//&& ($_FILES["file"]["size"] < 20000)
		&& in_array($extension, $allowedExts))
		  {
		  if ($_FILES["avatar"]["error"] > 0)
		    {
		    //echo "Return Code: " . $_FILES["avatar"]["error"] . "<br>";
		    }
		  else
		    {
		    /* 
		    echo "Upload: " . $_FILES["avatar"]["name"] . "<br>";
		    echo "Type: " . $_FILES["avatar"]["type"] . "<br>";
		    echo "Size: " . ($_FILES["avatar"]["size"] / 1024) . " kB<br>";
		    echo "Temp file: " . $_FILES["avatar"]["tmp_name"] . "<br>";
			
		      { //DECIDED NOT TO CHECK FOR DUPLICATE
		      //echo $_FILES["avatar"]["name"] . " already exists. ";
		      }
		    else
		      { */
		      copy($_FILES["avatar"]["tmp_name"],
		      APP_PATH.'uploads/avatars/profpic'.$this->user->user_id.'.'.$extension);
		      //echo "Stored in: " . APP_PATH.'uploads/avatars/'. $_FILES["avatar"]["name"];
		      $extension = strtolower($extension);
		      switch ($extension) {
				    case 'png':
				    case 'PNG':
				        $image = imagecreatefrompng(APP_PATH.'uploads/avatars/profpic'.$this->user->user_id.'.'.$extension);
				        break;
				    case 'jpg':
				    case 'JPG':
				        $image = imagecreatefromjpeg(APP_PATH.'uploads/avatars/profpic'.$this->user->user_id.'.'.$extension);
				        break;
				    case 'gif':
				    case 'GIF':
				        $image = imagecreatefromgif(APP_PATH.'uploads/avatars/profpic'.$this->user->user_id.'.'.$extension);
				        break;
				} //end switch
			  // Used GD library stuff to get the resize to work right, and it still isn't perfect
		      $oldw = imagesx($image);
		      $oldh = imagesy($image);
		      $newimage = imagecreatetruecolor(200,200);
		      imagecopyresampled($newimage, $image, 0, 0, 0, 0, 200, 200, $oldw, $oldh);
		      
		      $smallimagepath = APP_PATH.'uploads/avatars/profpic_small'.$this->user->user_id.'.'.$extension;
		      if (file_exists($smallimagepath)) { unlinchmk ($smallimagepath);}
		      switch ($extension) {
				    case 'png':				    	
				        imagepng($newimage, $smallimagepath);
				        break;
				    case 'jpg':
				        imagejpeg($newimage, $smallimagepath);
				        break;
				    case 'gif':
				        imagegif($newimage, $smallimagepath);
				        break;
				} //end switch
		      
		    } //end else
		  } //big if
		else
		  {
		  Router::redirect("/users/updateprofile/AVATAR_BAD");
		  }
		  $data = Array("avatar" => '/uploads/avatars/profpic_small'.$this->user->user_id.'.'.$extension);
		  DB::instance(DB_NAME)->update("profiles", $data, "WHERE user_id = '".$this->user->user_id."'");
		  Router::redirect("/users/updateprofile");
		//file_put_contents(APP_PATH.AVATAR_PATH.$_POST['avatar'], )
		
		
			
	}


	


} # end of the class
