<!--Ordering Page for CustomCupcakes by BAM Software-->
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
    <? echo($_SESSION['userEmail']);?> 
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
                <li>
                    <input type="checkbox" id="t1" class="topping" value="sprinkles" /><label for="t1">Sprinkles</label></li>
                <li>
                    <input type="checkbox" id="t2" class="topping" value="bacon" /><label for="t2">Bacon</label></li>
                <li>
                    <input type="checkbox" id="t3" class="topping" value="m&ms" /><label for="t3">M&Ms</label>
                </li>
                <li>
                    <input type="checkbox" id="t4" class="topping" value="reese's pieces" /><label for="t4">Reese's Pieces</label>
                </li>
                <li>
                    <input type="checkbox" id="t5" class="topping" value="skittles" /><label for="t5">Skittles</label>
                </li>
                <li>
                    <input type="checkbox" id="t6" class="topping" value="mini chocolate chips" /><label for="t6">Mini Chocolate Chips</label></li>
                <li>
                    <input type="checkbox" id="t7" class="topping" value="oreo bits" /><label for="t7">Oreo bits</label>
                </li>
                <li>
                    <input type="checkbox" id="t8" class="topping" value="twix bits" /><label for="t8">Twix bits</label>
                </li>
                <li>
                    <input type="checkbox" id="t9" class="topping" value="butterfinger bits" /><label for="t9">Butterfinger bits</label>
                </li>
                <li>
                    <input type="checkbox" id="t10" class="topping" value="snicker bits" /><label for="t10">Snicker bits</label></li>
                <li>
                    <input type="checkbox" id="t11" class="topping" value="mini marshmellows" /><label for="t11">Mini marshmellows</label></li>
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
