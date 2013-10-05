<?php
// Process the file if the submit button was clicked
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{   
    // Get the type being submitted, CSV or JSON
    $fileType = $_POST["fileType"];
    
    // Connect to the database
    $con = mysql_connect("localhost", "cupcake", "cupcake");
    if (!$con)
        die('Could not connect: ' . mysql_error());
    mysql_select_db("CustomCupcakes", $con);
    
    if ($fileType === "CSV")
    {
        // Get the table and file names from the form
        $tableName = $_POST["tableName"];
        $fileName = $_FILES["file"]["tmp_name"];

        // Parse the CSV file and populate the database
        if (!parseCSV($tableName, $fileName))
            echo "<h2>Error populating the database with the CSV file.</h2>";
        else
            echo "<h2>Population successful.</h2>";
    }
    else if ($fileType === "JSON")
    {
        // Get the file name from the form
        $fileName = $_FILES["file"]["tmp_name"];

        // Parse the JSON file and populate the database
        if (!parseJSON($fileName))
            echo "<h2>Error populating the database with the JSON file.</h2>";
        else
            echo "<h2>Population successful.</h2>";
    }
}
?>

<html>
    <head>
        <title>Custom Cupcakes - Convert CSV/JSON Files to SQL Inserts</title>
    </head>
    
    <body>
        <p>Instructions: First put in the JSON file and click submit. Then do
            the CSV files. If you try to do some of the CSV ones first, it will
            fail since there are foreign key constraints.</p>
        <h3>JSON Conversion</h3>
        <form method="post" enctype="multipart/form-data">
            JSON File:
            <input type="file" name="file">
            
            <button type="submit" name="fileType" value="JSON">Submit</button>
        </form>

        <h3>CSV Conversion</h3>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="fileType" value="csv">

            Name:
            <select name="tableName">
                <option value="Users">Users</option>
                <option value="Favorites">FavoriteCupcakes</option>
                <option value="FavoriteToppings">ToppingsBridge</option>
            </select>
            
            CSV File:
            <input type="file" name="file">
            
            <button type="submit" name="fileType" value="CSV">Submit</button>
        </form>
    </body>
</html>



<?php
/* FUNCTIONS */

// This function will be applied to the data array that is passed into the 
// addToDatabase function. It escapes any characters that need to be escaped
// then adds quotes around the whole thing. If the field is the password
// field, then also hash it. If the field is the OnMailingList field, change
// yes's to 1 and no's to 0 to fit the database schema.
function fixValues(&$value, $key)
{
    if ($key === "Password")
        $value = hash(md5, $value);
    else if ($key === "OnMailingList")
        $value = (($value === "yes") ? 1 : 0);
    $value = "'" . mysql_real_escape_string($value) . "'";
}


// Add a row into $table using the values in $data
function addToDatabase($data, $table)
{
    // Prepare the $data array for insertion into the database
    array_walk($data, "fixValues");

    // Create the appropriate query for the specified table
    if ($table === "Users")
    {
        $query = "INSERT INTO $table (UserID, MailingList, FirstName, LastName, 
            Address, City, State, ZipCode, Email, Password, PhoneNumber) 
            VALUES (" . implode(",", $data) . ")";
    }
    else if ($table === "Favorites")
    {
        $query = "INSERT INTO $table (FavoriteID, UserID, CakeID, FrostingID, 
            FillingID, Name) VALUES (" . implode(",", $data) . ")";
    }
    else if ($table === "FavoriteToppings")
    {
        $query = "INSERT INTO $table (FavoriteToppingsID, FavoriteID, ToppingsID) 
            VALUES (" . implode(",", $data) . ")";
    }
    else if ($table === "Cakes")
    {
        $query = "INSERT INTO $table (CakeID, Flavor, Img_Url) VALUES (" . 
            implode(",", $data) . ")";
    }
    else if ($table === "Frosting")
    {
        $query = "INSERT INTO $table (FrostingID, Flavor, Img_Url) VALUES (" . 
            implode(",", $data) . ")";
    }
    else if ($table === "Fillings")
    {
        $query = "INSERT INTO $table (FillingID, Flavor, RGB) VALUES (" . 
            implode(",", $data) . ")";
    }
    else if ($table === "Toppings")
    {
        $query = "INSERT INTO $table (ToppingsID, Flavor) VALUES (" . 
            implode(",", $data) . ")";
    }

    // Try to execute the query; return true on success or false on error
    if (mysql_query($query))
        return true;
    else
        return false;
}


// Open the CSV file and populate the database. Return true on success or 
// false on error.
function parseCSV($tableName, $fileName)
{
    if (empty($tableName) || empty($fileName)) return false;

    $success = true;

    // Open the file
    $row = 1;
    if (($handle = fopen($fileName, "r")) !== FALSE)
    {
        
        // Loop through the file
        while (($data = fgetcsv($handle)) !== FALSE)
        {
            $num = count($data);
            // If getting the first row in the file, then copy the $data array
            // in order to remember what the column names were. Otherwise, 
            // it's a row with data, so add it to the database. Break and 
            // return an error if one of the queries fails.
            if ($row == 1)
                $columns = $data;
            else
            {
                if (!addToDatabase(array_combine($columns, $data), $tableName))
                {
                    $success = false;
                    break;
                }
            }
            $row++;
        }
        fclose($handle);
    }
    else
    {
        $success = false;
    }

    return $success;
}


// Open the JSON file and populate the database. Return true on success or 
// false on error.
function parseJSON($fileName)
{
    if (empty($fileName)) return false;

    $success = true;

    // Open the file
    $row = 1;
    if (($handle = file_get_contents($fileName)) !== FALSE)
    {
        $json = (array) json_decode($handle);
        $json = (array) $json['menu'];

        // Loop through each table
        foreach ($json as $table => $data)
        {
            $index = 1;
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
    }
    else
    {
        $success = false;
    }

    return $success;
}
?>