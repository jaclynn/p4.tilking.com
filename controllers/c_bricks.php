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
		
	    # Set up the View
	    $this->template->content = View::instance('v_bricks_index');
	    $this->template->title   = "Posts";
	
	    # Build the query 
	    # Added DISTINCT so I could add the OR and include the user's own posts. Also sorted by newest
	    $q = 'SELECT 
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
		        WHERE bricks.user_id = '.$this->user->user_id.' ORDER BY bricks.created';
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
		
	public function add() {

        # Setup view
        $this->template->content = View::instance('v_bricks_add');
        $this->template->title   = "New Brick";
		
		
        # Render template
        echo $this->template;

    }

    public function p_add() {
		
        # Associate this post with this user
        $_POST['user_id']  = $this->user->user_id;
        
        # Unix timestamp of when this post was created / modified
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();
		echo $_POST;
        # Insert
        # Note we didn't have to sanitize any of the $_POST data because we're using the insert method which does it for us
        DB::instance(DB_NAME)->insert('bricks', $_POST);

        # Quick and dirty feedback
        Router::redirect("/grid/index");

    }

	
	
} # End of class
