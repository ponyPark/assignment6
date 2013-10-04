ORDER.PHP
<? 
	session_start();
	//these are the only two session variables that 
	//will be there if the user has successfully loggin into the system
	echo($_SESSION['userEmail']);
	echo($_SESSION['logged']);


	?>