<!--Ordering Page for CustomCupcakes by BAM Software-->
<!--Ordering Page for CustomCupcakes by BAM2 Software-->
<!DOCTYPE html>
<html lang="en">
<head>
    <? 
    session_start();
    //will be there if the user has successfully loggin into the system


    ?>
    <title>CustomCupcakes Homepage</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Cantarell' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="js/script.js"></script>
</head>
<body>
    <p id="userEmail">
    <? echo ($_SESSION['userEmail']);?> 
    </p>
    <fieldset class="favList">
        <legend>Favorites List</legend>
        <ul id="favUl">
        </ul>
    </fieldset>
    <div id="orderingPane">
	 <ul id="orderingList">
            </ul>
        <button id="order" type="button">Order</button>
    </div>
    <div id="selectContainer">
        <h4>Cupcake Flavor</h4>
        <div class="selectorBox">
         <!--The ul element will be injected with list elements from javascript-->
            <ul id="flavor">
            </ul>
        </div>
        <h4>Filling</h4>
        <!--The ul element will be injected with list elements from javascript-->
        <div class="selectorBox">
            <ul id="filling">
            </ul>
        </div>
        <h4>Frosting</h4>
        <!--The ul element will be injected with list elements from javascript-->
        <div class="selectorBox">
            <ul id="frosting">
            </ul>
        </div>
        <fieldset class="toppingGroup">
            <legend>Toppings</legend>
            <ul id="quad">
              
            </ul>
            <button id="clearAll" type="button">Clear all toppings</button>
        </fieldset>
    </div>
    <footer>
        <button id="resetCupcake" type="button">Reset Cupcake</button>
        <button id="updateOrder" type="button">Update Order</button>
        <input id="quan" type="number" value="1" name="quantity" min="1" max="50">  
        <button id="addFavorite" type="button">Add to Favorites</button>
    </footer>
    <div id="overlay">
     <div>
          <p>Cupcake name: <input type="text" id="cupcakeName" ></p>
           <ul>
               <li id="cupcakeFlavor"></li>
               <li id="cupcakeFilling"></li>
               <li id="cupcakeFrosting"></li>
               <li id="cupcakeTopping"></li>
           </ul>
          <button id="saveFavorite" type="button">Save</button>
          <button id="exit" type="button">Exit</button>
     </div>
            </div>        
</body>
</html>
