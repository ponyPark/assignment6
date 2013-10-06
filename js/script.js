/*BAM Software CSS for CustomCupcakes
October, 2013*/
function init() {
    var flavorList = document.getElementById("flavor");
    var favList = document.getElementById("favUl");
    var fillingList = document.getElementById("filling");
    var frostingList = document.getElementById("frosting");
    var orderingList = document.getElementById("orderingList");
    var toppingList = document.getElementById("quad");
    var flavListSelection = flavorList.getElementsByTagName("img");
    var favListSelection = favList.getElementsByTagName("img");
    var fillingListSelection = fillingList.getElementsByTagName("img");
    var frostingListSelection = frostingList.getElementsByTagName("img");
    var resetEveryting = false;
    var flavorChoice = "";
    var fillingChoice = "";
    var frostingChoice = "";
    var toppingChoices = [];
    //Store orders in object array
    var favoriteObjects = new Array();
    var cupcakeOrder = new Array();
    //Test data to be inserted in
    generateList(flavorList, 'getCakes.php');
    generateListfav(favList, 'getFavorites.php');
    generateList(fillingList, 'getFillings.php');
    generateList(frostingList, 'getFrostings.php');
    generateToppings(toppingList);

    function generateListfav(input ,url) {
        var mCurrentIndex = 0;
        var request = new XMLHttpRequest();
        var mImages = new Array();
        var json;
        var favID 

        request.open("GET", url, true);
        request.send();
        request.onreadystatechange = function(e) {

            if(request.readyState === 4){
                //save the response from server
                var jsonData = JSON.parse(request.responseText);
                
                //grab the array and the length
                if(url === 'getFavorites.php')
                    favID = jsonData.favorites;
                
                var numFavs = favID.length; //number of elements in array
                
                //add them to the list
                for (var i = 0, len = numFavs; i < len; i++){
                var newNumberListItem = document.createElement("li");
                var numberListValue = document.createElement("img");
                numberListValue.setAttribute("src", "artwork/" + favID[i].Img_url);
                numberListValue.setAttribute("id", "fav"+i);
                numberListValue.setAttribute("name", favID[i].FavoriteID);
                var p = document.createElement('alt'),
                
                // creates a new text-node:
                text = document.createTextNode(favID[i].Name);
                p.appendChild(text);
                newNumberListItem.appendChild(numberListValue);
                newNumberListItem.appendChild(p);
                newNumberListItem.addEventListener("click", selectImage, false);
                
                input.appendChild(newNumberListItem);

                }



            }
        }

    }

    function generateList(input, url) {
        
        var mCurrentIndex = 0;
        var request = new XMLHttpRequest();
        var mImages = new Array();
        var json;
        var favID;
        var items;
        var idVal;

        request.open("GET", url, true);
        request.send();
        request.onreadystatechange = function(e) {

            if(request.readyState === 4){
                //save the response from server
                var jsonData = JSON.parse(request.responseText);

                
                //grab the array and the length
                if(url === 'getCakes.php'){
                    favID = jsonData.cakes;
                    item = 'Cake';
                    idVal = item + "ID";
                    }
                if(url === 'getFillings.php'){
                    favID = jsonData.fillings;
                    item = 'Filling';
                    idVal = item + "ID";}
                if(url === 'getFrostings.php'){
                    favID = jsonData.frostings;
                    item = 'Frosting';
                    idVal = item + "ID";}

                
                var numFavs = favID.length; //number of elements in array
                
                //add them to the list
                for (var i = 0, len = numFavs; i < len; i++){
                var newNumberListItem = document.createElement("li");
                var numberListValue = document.createElement("img");
                numberListValue.setAttribute("src", "artwork/" + favID[i].Img_Url);
                numberListValue.setAttribute("id", item + i);
                numberListValue.setAttribute("name", favID[i][idVal]);
                var p = document.createElement('p'),
                
                // creates a new text-node:
                text = document.createTextNode(favID[i].Flavor);
                p.appendChild(text);
                newNumberListItem.appendChild(numberListValue);
                newNumberListItem.appendChild(p);
                newNumberListItem.addEventListener("click", selectImage, false);
                
                input.appendChild(newNumberListItem);

                }



            }







        /*for (var i = 0; i < 10; i++) {
            //create new li element
            var newNumberListItem = document.createElement("li");
            //create new text node
            var numberListValue = document.createElement("img");
            numberListValue.src = 'artwork/banana.PNG';
            numberListValue.id = "img" + i;
            var p = document.createElement('p'),
            // creates a new text-node:
            text = document.createTextNode('vanilla');
            // appends the text-node to the newly-created p element:
            p.appendChild(text);
            numberListValue.addEventListener("click", selectImage, false);
            newNumberListItem.appendChild(numberListValue);
            newNumberListItem.appendChild(p);
           input.appendChild(newNumberListItem);
        }*/
    }
}


function generateToppings(input) {
        
        var request = new XMLHttpRequest();
        var mImages = new Array();
        var json;
        var url = 'getToppings.php'

        request.open("GET", url, true);
        request.send();
        request.onreadystatechange = function(e) {

            if(request.readyState === 4){
                //save the response from server
                var jsonData = JSON.parse(request.responseText);
                
                //grab the array and the length
                var favID = jsonData.toppings;

                
                var numFavs = favID.length; //number of elements in array
                
                //add them to the list
                for (var i = 0, len = numFavs; i < len; i++){
                    var newNumberListItem = document.createElement("li");
                    var numberListValue = document.createElement("input");
                    var label = document.createElement("label");
                    numberListValue.setAttribute("type", "checkbox");
                    numberListValue.setAttribute("id", "Topping"+i);
                    numberListValue.setAttribute("name", favID[i].ToppingsID);
                    label.setAttribute("for","Topping"+i);
                    label.innerHTML = favID[i].Flavor;
                
                // creates a new text-node:
                    newNumberListItem.appendChild(numberListValue);
                    newNumberListItem.appendChild(label);
                    
                    input.appendChild(newNumberListItem);

                }



            }
        }
}


    /*
    The selectImage function will allow the user to know that they made a selection.
    */
    function selectImage(e) {
        if(e.target.innerHTML === "") //ensures only images can be clicked
            removeClasses(e);

    }
    function removeClasses(e) {

        if (e.target.parentNode.parentNode.id === "filling") {
            var counter = 0;

            for (var i = 0; i < fillingListSelection.length; i++) {
                fillingListSelection[i].className = "";
            }
            if (!resetEveryting)
            e.target.className = "selected";
        }
        if (e.target.parentNode.parentNode.id === "flavor") {
            var counter = 0;
            for (var i = 0; i < flavListSelection.length; i++) {              
                    flavListSelection[i].className = "";
            }
            if (!resetEveryting)
            e.target.className = "selected";

        }
        
        if (e.target.parentNode.parentNode.id === "favUl") {
            var counter = 0;
            for (var i = 0; i < favListSelection.length; i++) {
                favListSelection[i].className = "";
            }
            if (!resetEveryting)
            e.target.className = "selected";
        }
        if (e.target.parentNode.parentNode.id === "frosting") {
            var counter = 0;
            for (var i = 0; i < frostingListSelection.length; i++) {         
                    frostingListSelection[i].className = "";
            }
            if (!resetEveryting)
            e.target.className = "selected";
        }
    }
    /** Display overlay screen **/
    var overlay = document.getElementById("addFavorite");
    overlay.addEventListener("click", function () {
       
            el = document.getElementById("overlay");
            el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";
            var options = document.getElementById("overlay").getElementsByTagName("li");
            options[0].textContent = "Cupcake Flavor: " + flavorChoice;
            options[1].textContent = "Filling: " + fillingChoice;
            options[2].textContent = "Frosting: " + frostingChoice;
            var fieldSet = document.getElementById('quad').getElementsByTagName("input");
            var len = fieldSet.length;
            for (i = 0; i < len; i++) {
                if (fieldSet[i].checked) {
                    toppingChoices.push(fieldSet[i].value);
                }
            }
            options[3].textContent = "Toppings: " + toppingChoices.slice(0, toppingChoices.length);

    });
    var exitOverlay = document.getElementById("exit");
    exitOverlay.addEventListener("click", function () {
        el = document.getElementById("overlay");
        el.style.visibility = "hidden";
    });
    /** Save optino within the overlay screen **/
    var saveOverlay = document.getElementById("saveFavorite");
    saveOverlay.addEventListener("click", function () {
        var cupcakeName = document.getElementById("cupcakeName");
        //create new li element
        var newCupcakeListItem = document.createElement("li");
        //create new text node
        var cupcakeListValue = document.createElement("img");
        cupcakeListValue.src = 'artwork/banana.PNG';
        var p = document.createElement('alt'),
        // creates a new text-node:
        text = document.createTextNode(cupcakeName.value);
        favoriteObjects.push(
   {
       "name": cupcakeName.value,
       "flavor": flavorChoice,
       "frosting": frostingChoice,
       "filling": fillingChoice,
       "toppings": toppingChoices
   });
        // appends the text-node to the newly-created p element:
        p.appendChild(text);
        cupcakeListValue.addEventListener("click", selectImage, false);
        newCupcakeListItem.appendChild(cupcakeListValue);
        newCupcakeListItem.appendChild(p);
        favList.appendChild(newCupcakeListItem);
        //close the dialog
        el = document.getElementById("overlay");
                el.style.visibility = "hidden";
    });
    var resetToppings = document.getElementById("clearAll");
    resetToppings.addEventListener("click", function () {
        var fieldSet = document.getElementById('quad').getElementsByTagName("input");
        var len = fieldSet.length;

        for (i = 0; i < len; i++) {
            if (fieldSet[i].type === "checkbox") {
                fieldSet[i].checked = false;
            }
        }
    });
    var resetCupcake = document.getElementById("resetCupcake");
    resetCupcake.addEventListener("click", function () {
        resetEveryting = true;
        flavListSelection[0].click();
        frostingListSelection[0].click();
        fillingListSelection[0].click();
        flavorChoice = "";
        toppingChoices.length = 0;
        fillingChoice = "";
        frostingChoice = "";
        resetEveryting = false;
        resetToppings.click();
    });
    var order = document.getElementById("order");
    order.addEventListener("click", function () {
        //As of now prints out stored information of cupcake order
        for (var i = 0; i < cupcakeOrder.length; i++)
            console.log(cupcakeOrder[i]);
    });
    //Removes item from ordering list
    var removeButton;

    var updateOrder = document.getElementById("updateOrder");
    updateOrder.addEventListener("click", function () {
        //adds to order pane
        var selectedImage;
        var falvorImgEl;
        var fillingImgEl;
        var frostingImgEl;
        var selectedItems = document.getElementsByClassName('selected');
        if(selectedItems.length != 3){
            selectedImage = selectedItems[1].src;
            flavorImgEl = selectedItems[1];
            fillingImgEl = selectedItems[2];
            frostingImgEl = selectedItems[3];}
        else{
            selectedImage = selectedItems[0].src;
            flavorImgEl = selectedItems[0];
            fillingImgEl = selectedItems[1];
            frostingImgEl = selectedItems[2];}


        //create new li element
        var newCupcakeListItem = document.createElement("li");
        //create new button element
        removeButton = document.createElement("button");
        removeButton.innerHTML = "Remove";
        //create new text node
        var cupcakeListValue = document.createElement("img");
        cupcakeListValue.src = selectedImage;

        var p = document.createElement('alt');
        var cupcakeFlavor = document.createTextNode(flavorChoice);
        var frosting = document.createTextNode(frostingChoice);
        var filling = document.createTextNode(fillingChoice);
        var toppings = document.createTextNode(toppingChoices.slice(0, toppingChoices.length));
        // Add some new cupcake order object, we need unqiue identifier for each order though
        cupcakeOrder.push(
            {
                "name": cupcakeName.value,
                "flavor": flavorChoice,
                "frosting": frostingChoice,
                "filling": fillingChoice,
                "toppings": toppingChoices
            });
        // appends the text-node to the newly-created p element:
        p.appendChild(document.createTextNode(flavorChoice + " x " + quan.value));
        newCupcakeListItem.appendChild(cupcakeListValue);
        newCupcakeListItem.appendChild(p);
        orderingList.appendChild(newCupcakeListItem);
        removeButton.addEventListener("click", removeItem, true);
        newCupcakeListItem.appendChild(removeButton);
    });
    function removeItem(e) {
        var itemRem = e.target.parentNode;
        cupcakeOrder.remove
        itemRem.parentNode.removeChild(itemRem);
    }
}
window.onload = init;
