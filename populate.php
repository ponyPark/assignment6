<?php
// Process the file if the submit button was clicked
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{   
    // Get the table and file names from the form
    $table_name = $_POST['table_name'];
    $file_name = $_FILES["file"]["tmp_name"];
    
    // Open the CSV file and populate the database.
    $row = 1;
    if (($handle = fopen($file_name, "r")) !== FALSE)
    {
        // Connect to the database
        $con = mysql_connect("localhost", "cupcake", "cupcake");
        if (!$con)
            die('Could not connect: ' . mysql_error());
        mysql_select_db("CustomCupcakes", $con);
        
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
                if (!addToDatabase(array_combine($columns, $data), $table_name))
                {
                    $error = true;
                    break;
                }
            }
            $row++;
        }

        if ($error === true)
            echo "<h2>There was an error executing a query.</h2>";
        else
            echo "<h2>Population successful.</h2>";
        fclose($handle);
    }
    else
    {
        echo "<h2>There was an error opening the CSV file.</h2>";
    }
}
?>

<html>
    <head>
        <title>Custom Cupcakes - Convert CSV/JSON Files to SQL Inserts</title>
    </head>
    
    <body>
        <h3>CSV Conversion</h3>
        <form method="post" enctype="multipart/form-data">
            Name:
            <select name="table_name">
                <option value="Users">Users</option>
                <option value="Favorites">FavoriteCupcakes</option>
                <option value="FavoriteToppings">ToppingsBridge</option>
            </select>
            
            CSV File:
            <input type="file" name="file">
            
            <input type="submit">
        </form>
    </body>
</html>

<?php
// FUNCTIONS

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
    if ($table == "Users")
    {
        $query = "INSERT INTO $table (UserID, MailingList, FirstName, LastName, 
            Address, City, State, ZipCode, Email, Password, PhoneNumber) 
            VALUES (" . implode(",", $data) . ")";
    }
    else if ($table == "Favorites")
    {
        $query = "INSERT INTO $table (FavoriteID, UserID, CakeID, FrostingID, 
            FillingID) VALUES (" . implode(",", $data) . ")";
    }
    else if ($table == "FavoriteToppings")
    {
        $query = "INSERT INTO $table (FavoriteToppingsID, FavoriteID, ToppingsID) 
            VALUES (" . implode(",", $data) . ")";
    }

    // Try to execute the query; return true on success or false on error
    if (mysql_query($query))
        return true;
    else
        return false;
}
?>