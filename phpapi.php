<?


class phpapi {

    function phpapi() {
	//constructor
    }

	public function addUser(){	
		//add a user to the system
		$con = mysql_connect("localhost", "cupcake", "cupcake");
		if(!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("CustomCupcakes", $con)
		or die("Unable to select database: " . mysql_error());
		$mailList = $_POST['mailingList'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$pw = hash(md5, $_POST['pw']);
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zip = $_POST['zip'];
		$auth = 0;
		$query = "INSERT INTO Users(MailingList,FirstName,LastName,Email,Password,PhoneNumber,Address,City,State,ZipCode,Privilege) VALUES ('$mailList','$fname','$lname','$email','$pw','$phone','$address','$city','$state','$zip','$auth')";

		

		if(!mysql_query($query,$con)){
			die('ERROR ' . mysql_error());
		}
		else{
			//START SESSION
		session_start();
		$_SESSION['logged'] = true; //a user will be logged in if this variable is true
		$_SESSION['userEmail'] = $email; //passing on the user's email for next page to use
		mysql_close($con);
		header ('Location: order.php');	
		}
	
	}

	public function verifyUser(){
		//verify a user and start a new session
		$con = mysql_connect("localhost", "cupcake", "cupcake");
		if(!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("CustomCupcakes", $con)
		or die("Unable to select database: " . mysql_error());
		$pw = hash(md5, $_POST['pw']);
		$query = "select * from Users where Email = '";
		$query = $query . $_POST['email'] . "' and Password = '" . $pw ."'";

		$result = mysql_query($query);
		$info = mysql_fetch_array( $result );
		

		if(!mysql_query($query,$con)){
			die('ERROR ' . mysql_error());
		}
		if(mysql_num_rows($result) == 0)
			header ('Location: error.html');
		$ipaddress = substr((string)$_SERVER['REMOTE_ADDR'], 0,7);
		
		if($info['Privilege'] == 1 && $ipaddress == "129.119"){
			mysql_close($con);
			header ('Location: analytics.php');	}
		if(mysql_num_rows($result) > 0){
			session_start();
			$_SESSION['logged'] = true;
			$_SESSION['userEmail'] = $info['Email'];
			//Added the user to the session since we use
			//that for adding favorites, etc.
			$_SESSION['user'] = $info['UserID'];
			mysql_close($con);
			echo($info['Privilege']);
			header ('Location: order.php');	
		}

		
	}
	
	public function addFavorites()
	{
		$con = mysql_connect("localhost", "cupcake", "cupcake");
		if(!$con){
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("CustomCupcakes", $con)
		or die("Unable to select database: " . mysql_error());
		$user = $_SESSION['user'];
		$filling = $_POST['fillingID'];
		$frosting = $_POST['frostingID'];
		$cake = $_POST['CakeID'];
		$favName = $_POST['favoriteName'];
		//Need to do toppings, depends on how GUI formats it.
	}

}

?>
