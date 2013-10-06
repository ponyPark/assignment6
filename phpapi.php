<?


class phpapi {

    function phpapi()
    {
        session_start();

        $con = mysql_connect("localhost", "cupcake", "cupcake");
        if(!$con)
        {
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db("CustomCupcakes", $con)
        or die("Unable to select database: " . mysql_error());
    }

    public function addUser()
    {   
        //add a user to the system
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
        if(!mysql_query($query))
        {
            return false;
        }
        else
        {
            $_SESSION['logged'] = true; //a user will be logged in if this variable is true
            $_SESSION['userEmail'] = $email; //passing on the user's email for next page to use
            header ('Location: order.php'); 
        }
    
    }

    public function verifyUser()
    {
        //verify a user and start a new session
        $pw = hash(md5, $_POST['pw']);
        $query = "select * from Users where Email = '";
        $query = $query . $_POST['email'] . "' and Password = '" . $pw ."'";
        $result = mysql_query($query);
        $info = mysql_fetch_array( $result );
        if(!mysql_query($query))
        {
            return false;
        }
        if(mysql_num_rows($result) == 0)
            header ('Location: error.html');
        $ipaddress = substr((string)$_SERVER['REMOTE_ADDR'], 0,7);
        
        if($info['Privilege'] == 1 && $ipaddress == "129.119")
        {
            header ('Location: analytics.php');
        }
        else if(mysql_num_rows($result) > 0)
        {
            $_SESSION['logged'] = true;
            $_SESSION['userEmail'] = $info['Email'];
            //Added the user to the session since we use
            //that for adding favorites, etc.
            $_SESSION['userID'] = $info['UserID'];
            header ('Location: order.php'); 
        }

        
    }
    
    public function addFavorites()
    {
        //Retrieve the values from the session and the post. 
        $userID = $_SESSION['userID'];
        //If else statement in case there is no filling selected.
        $filling = $_POST['fillingID'];
        $frosting = $_POST['frostingID'];
        $cake = $_POST['CakeID'];
        //Fail-safe in case someone tries to hack us.
        $favName = mysql_real_escape_string($_POST['favoriteName']);
        $toppingsList = $_POST['toppingsID'];
        //Gets the current id in the favorites table.
        $favoriteStatus = mysql_fetch_assoc(mysql_query("SHOW TABLE STATUS LIKE 'Favorites'"));
        $favoriteID = $favoriteStatus['Auto_increment'];
        //Query to insert a favorite.
        $query = "INSERT INTO Favorites(UserID, CakeID, FillingID, FrostingID, Name) VALUES ('$userID', '$cake', '$filling', '$frosting', '$favName')";
        if(!mysql_query($query))
        {
            return false;
        }
        //Changes all values in toppingsList to (favoiteID, value) where value is a specific topping    
        foreach ($toppingsList as &$value)
        {   
            $value = "('$favoriteID','$value')";
        }
        //Query to insert all toppings into FavoriteToppings 
        //(with magical implode to concatenate all (favoriteID, value)'s from toppingsList with a comma.           
        $query = "INSERT INTO FavoriteToppings(FavoriteID, ToppingsID) VALUES " . implode(",", $toppingsList);
        if(!mysql_query($query))
        {
            return false;
        }                   
        return true;
    }
        
    public function getFavorites()
    {
        //Getting the name, id, and image of a user favorites using their id.
        if(!isset($_SESSION['userID']))
            return false;
        $userID = $_SESSION['userID'];

        $query = "SELECT FavoriteID, Name, Img_url FROM Favorites JOIN Cakes ON Favorites.CakeID = Cakes.CakeID WHERE UserID = '$userID'";
        $result = mysql_query($query);

        //Change mysql result to array so that it can be exported in JSON
        $rows = array();
        while($temp = mysql_fetch_assoc($result))
        {
            $rows[] = $temp;
        }     
        return json_encode(array('favorites' => $rows));
    }
    

	public function getCakes()
	{
        //Get all the cakes.
        $query = "SELECT * FROM Cakes";
        $result = mysql_query($query);

        //Change mysql result to array so that it can be exported in JSON.
        $rows = array();
        while($temp = mysql_fetch_assoc($result))
        {
            $rows[] = $temp;
        }     
        return json_encode(array('cakes' => $rows));

    }

    public function getFillings()
    {
        //Get all the fillings.
        $query = "SELECT * FROM Fillings";
        $result = mysql_query($query);

        //Change mysql result to array so that it can be exported in JSON.
        $rows = array();
        while($temp = mysql_fetch_assoc($result))
        {
            $rows[] = $temp;
        }     
        return json_encode(array('fillings' => $rows));
    }

    public function getFrostings()
    {
        //Get all the frostings.
        $query = "SELECT * FROM Frosting";
        $result = mysql_query($query);

        //Change mysql result to array so that it can be exported in JSON.
        $rows = array();
        while($temp = mysql_fetch_assoc($result))
        {
            $rows[] = $temp;
        }     
        return json_encode(array('frostings' => $rows));
    }

    public function getToppings()
    {
        //Get all the toppings.
        $query = "SELECT * FROM Toppings";
        $result = mysql_query($query);

        //Change mysql result to array so that it can be exported in JSON.
        $rows = array();
        while($temp = mysql_fetch_assoc($result))
        {
            $rows[] = $temp;
        }     
        return json_encode(array('toppings' => $rows));   
    }

    public function getFavoriteCake($favoriteID)
    {
        //Get the favorite cake based on the favorite ID.
        $query = "SELECT CakeID FROM Favorites WHERE FavoriteID = '$favoriteID'";
        $result = mysql_query($query);

        //Change mysql result to array so that it can be exported in JSON.
        $rows = mysql_fetch_assoc($result);
        return json_encode(array('favCake' => $rows));

    }

    public function getFavoriteFilling($favoriteID)
    {
        //Get the favorite filling based on the favoriteID.
        $query = "SELECT FillingID FROM Favorites WHERE FavoriteID = '$favoriteID'";
        $result = mysql_query($query);

        //Change mysql result to array so that it can be exported in JSON.
        $rows = mysql_fetch_assoc($result); 
        return json_encode(array('favfilling' => $rows));
    }

    public function getFavoriteFrosting($favoriteID)
    {
        //Get the favorite filling based on the favoriteID.
        $query = "SELECT FrostingID FROM Favorites WHERE FavoriteID = '$favoriteID'";
        $result = mysql_query($query);

        //Change mysql result to array so that it can be exported in JSON.
        $rows = mysql_fetch_assoc($result); 
        return json_encode(array('favfrosting' => $rows));
    }

    public function getFavoriteToppings($favoriteID)
    {
        //Get all the favorite toppings based on the favoriteID.
        $query = "SELECT ToppingsID FROM FavoriteToppings WHERE FavoriteID = '$favoriteID'";
        $result = mysql_query($query);

        //Change mysql result to array so that it can be exported in JSON.
        $rows = array();
        while($temp = mysql_fetch_assoc($result))
        {
            $rows[] = $temp;
        }     
        return json_encode(array('favtoppings' => $rows));   
    }

    

    
    public function addOrder($orderArray)
    {
        //Not complete yet.
        /*
        if (empty($orderArray)) return false;
        $success = true;

        //Retrieve the values from the session and the post. 
        $userID = $_SESSION['userID'];

        //Read the JSON.
        $json = (array) json_decode($orderArray);
        var_dump($json);

        // Loop through each order
        foreach ($json as $table => $data)
        {
            // $orderStatus = mysql_fetch_assoc(mysql_query("SHOW TABLE STATUS LIKE 'CupcakeOrders'"));
            // $orderID = $orderStatus['Auto_increment'];


            // Loop through all the rows in each table
            foreach ($data as &$row)
            {
                // Convert to an array, then add an index to the array.
                $row = (array) $row;
                array_unshift($row, $index);
                $index++;

                // Add the row to the database.
                if (!addToDatabase($row, ucfirst($table)))
                {
                    $success = false;
                    break;
                }
            }
        } 
        */
 
    }

    public function getCakeSalesInformation()
    {
        //Get the query for cake sales info.
        $query = "SELECT Flavor, sum(Quantity) Total FROM CupcakeOrders NATURAL JOIN Cakes GROUP BY Flavor ORDER BY Flavor";
        $result = mysql_query($query);

        //Change mysql result to array so that it can be exported in JSON.
        $rows = array();
        while($temp = mysql_fetch_assoc($result))
        {
            $rows[] = $temp;
        }     
        return json_encode(array('cakesales' => $rows));   
    }

    public function getFillingSalesInformation()
    {
        //Get the query for filling sales info.
        $query = "SELECT Flavor, sum(Quantity) Total FROM CupcakeOrders NATURAL JOIN Fillings GROUP BY Flavor ORDER BY Flavor";
        $result = mysql_query($query);

        //Change mysql result to array so that it can be exported in JSON.
        $rows = array();
        while($temp = mysql_fetch_assoc($result))
        {
            $rows[] = $temp;
        }     
        return json_encode(array('fillingsales' => $rows));   


    }

    public function getFrostingSalesInformation()
    {
        //Get the query for frosting sales info.
        $query = "SELECT Flavor, sum(Quantity) Total FROM CupcakeOrders NATURAL JOIN Frosting GROUP BY Flavor ORDER BY Flavor";
        $result = mysql_query($query);

        //Change mysql result to array so that it can be exported in JSON.
        $rows = array();
        while($temp = mysql_fetch_assoc($result))
        {
            $rows[] = $temp;
        }     
        return json_encode(array('frostingsales' => $rows));   


    }

    public function getToppingsSalesInformation()
    {
        //Get the query for topping sales info.
        $query = "SELECT Flavor, sum(Quantity) Total FROM OrderToppings NATURAL JOIN Toppings NATURAL JOIN CupcakeOrders GROUP BY Flavor ORDER BY Flavor";
        $result = mysql_query($query);

        //Change mysql result to array so that it can be exported in JSON.
        $rows = array();
        while($temp = mysql_fetch_assoc($result))
        {
            $rows[] = $temp;
        }     
        return json_encode(array('toppingsales' => $rows));   


    }
    
    
    
}

?>
