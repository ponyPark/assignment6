<!--Homepage for CustomCupcakes by BAM Software-->
<!DOCTYPE html>

<html lang="en">
    <head>
        <title>CustomCupcakes Homepage</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Cantarell' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div id="signin">
        
            <form name="login" method="POST" action="verify.php">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="pw" placeholder="Password">
                <input class="submitButton" type="submit" value="Log In">
            </form>
            <?php
                if ($_GET["login"] === "false")
                    echo "Incorrect login information.";
            ?>

        </div>

        <div id="createAcct">
            <h1> Create a CustomCupcake Account</h1>
            <form id="createAccount" name="createAcct" method="POST" action="create.php">
                Would you like to join our mailing list?
                <label class= "mailList" for="yes">Yes</label>
                <input class=" mailList" type="radio" name="mailingList" id="yes" value="1">
                <label class= "mailList" for="no">No</label>
                <input class= "mailList" checked type="radio" name="mailingList" id="no" value="0">
                <input type="text" name="fname" pattern="[a-zA-Z]+" title="Letters only" placeholder="First Name" required>
                <input type="text" name="lname" placeholder="Last Name" title="Letters only" pattern="[a-zA-Z]+"required>
                <input type="email" name="email" placeholder="Email Address" required>
                <input type="password" name="pw" placeholder="Password" pattern=".{8,}" title="Need at least 8 characters"required>
                <input type="tel" name="phone" placeholder="Phone Number" pattern="[0-9]{10}" title="10 Digit Phone Number, Numbers only" required>
                <input type="text" name="address" placeholder="Address" required>
                <input type="text" name="city" placeholder="City" pattern="[a-zA-Z\s]+" title="Letters only" required>
                <select name="state">
                    <!--To save time, list was copied from http://www.freeformatter.com/usa-state-list-html-select.html -->
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District Of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option selected="selected" value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select>
                <input type="text" name="zip" placeholder="Zip Code" title="Five digit zip code" pattern="[0-9]{5}"required>
                <input class="submitButton" type="submit" value="Sign Up">
            </form>
        </div>
        <div id = "logoandslogan">
            <h2>Great Flavors, Awesome Cupcakes, Fast Delivery</h2>
            <img id="logo" src="artwork/cclogo.png" alt ="CustomCupcake Logo">
            
        </div>
    </body>

