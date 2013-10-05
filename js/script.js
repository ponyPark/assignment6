/*BAM Software CSS for CustomCupcakes
October, 2013*/
function init() {
    var flavorList = document.getElementById("flavor");
    var favList = document.getElementById("favUl");
    var fillingList = document.getElementById("filling");
    var frostingList = document.getElementById("frosting");
    var flavListSelection = flavorList.getElementsByTagName("img");
    var favListSelection = favList.getElementsByTagName("img");
    var fillingListSelection = fillingList.getElementsByTagName("img");
    var frostingListSelection = frostingList.getElementsByTagName("img");
    //Test data to be inserted in
    generateList(flavorList);
    generateList(fillingList);
    generateList(frostingList);

    function generateList(input) {
        for (var i = 0; i < 10; i++) {
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
        }
    }


    /*
    The selectImage function will allow the user to know that they made a selection.
    */
    function selectImage(e) {

        removeClasses(e);

    }
    function removeClasses(e) {

        if (e.target.parentNode.parentNode.id === "filling") {
            var counter = 0;

            for (var i = 0; i < fillingListSelection.length; i++) {
                fillingListSelection[i].className = "";
            }
            e.target.className = "selected";
        }
        if (e.target.parentNode.parentNode.id === "flavor") {
            var counter = 0;
            for (var i = 0; i < flavListSelection.length; i++) {              
                    flavListSelection[i].className = "";
            }
            
            e.target.className = "selected";

        }
        
        if (e.target.parentNode.parentNode.id === "favUl") {
            var counter = 0;
            for (var i = 0; i < favListSelection.length; i++) {
                favListSelection[i].className = "";
            }
            e.target.className = "selected";
        }
        if (e.target.parentNode.parentNode.id === "frosting") {
            var counter = 0;
            for (var i = 0; i < frostingListSelection.length; i++) {         
                    frostingListSelection[i].className = "";
                }            
            e.target.className = "selected";
        }
    }
    var overlay = document.getElementById("addFavorite");
    overlay.addEventListener("click", function () {
       
            el = document.getElementById("overlay");
            el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";
    });
    var exitOverlay = document.getElementById("exit");
    exitOverlay.addEventListener("click", function () {
        el = document.getElementById("overlay");
        el.style.visibility = "hidden";
    });
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
        //TODO
    });
    var order = document.getElementById("order");
    order.addEventListener("click", function () {
       //TODO
    });
}
window.onload = init;
