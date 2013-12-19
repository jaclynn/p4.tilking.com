<?php

class grid_controller extends base_controller {
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
	} 
		
	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/index/index/
	-------------------------------------------------------------------------------------------------*/
	public function index() {	
		
		# Any method that loads a view will commonly start with this
		# First, set the content of the template with a view file
			$this->template->content = View::instance('v_grid_index');
			
		# Now set the <title> tag
			$this->template->title = "Hello World";
	
		# CSS/JS includes
			/*
			$client_files_head = Array("");
	    	$this->template->client_files_head = Utils::load_client_files($client_files);
	    	
	    	$client_files_body = Array("");
	    	$this->template->client_files_body = Utils::load_client_files($client_files_body);   
	    	*/
	      					     		
		# Render the view
			echo $this->template;

	} # End of method
	
	public function test($error=NULL) {
	
		switch ($error) {
			case "EMAIL_BAD":
				$error = "Not a valid email format.";
				break;
			case "NUMBER_BAD":
				$error = "Not a valid number format.";
				break;
			
		}
		$this->template->content=View::instance('v_grid_test');
		$this->template->content->error = $error;
		$this->template->title = "Security Testing";
		echo $this->template;
	}
	
	public function p_test() {
		$clean = array();

		$email_pattern = '/^[^@\s<&>]+@([-a-z0-9]+\.)+[a-z]{2,}$/i';
		
		if (preg_match($email_pattern, $_POST['email'])) 
		{ 
		    $clean['email'] = $_POST['email']; 
		    
		} else {
			$error = "Bad email address";
			//test($error);
			Router::redirect("/grid/test/EMAIL_BAD");
		}
		
		if ($_POST['number'] == strval(floatval($_POST['number'])))
		{
		    $clean['number'] = $_POST['number'];
		} else {
			Router::redirect("/grid/test/NUMBER_BAD");
		}
	}
} # End of class
