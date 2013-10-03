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
		$mailList = $_POST['mailList'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$pw = $_POST['pw'];
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
		session_start();
		$_SESSION['logged'] = true;
		$_SESSION['userEmail'] = $email;
		mysql_close($con);
		header ('Location: order.php');	
		}
	
	}

}

?>
