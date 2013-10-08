/*BAM Software JS for CustomCupcakes Analytics Page
October, 2013*/

function init() {
	//$("head").append('<script src="js/rgraph/RGraph.common.core.js"></script>');
	//$("head").append('<script src="js/rgraph/RGraph.pie.js"></script>');
	//$("head").append('<script src="js/rgraph/RGraph.bar.js"></script>');
	var json;
	var url = './SalesInformation.php';

/**	var request = new XMLHttpRequest();
	request.open("GET", url, true);
    request.send();
    request.onreadystatechange = function(e) {

       	if(request.readyState === 4){
*/            //save the response from server
            var json = {"salesinfo":[
            			{"cakesales":[{"Flavor":"Banana","Total":"1"},{"Flavor":"Dark Chocolate","Total":"1"}]},
            			{"fillingsales":[{"Flavor":"Blackberry","Total":"1"},{"Flavor":"Strawbery","Total":"1"}]},
            			{"frostingsales":[{"Flavor":"Buttered Popcorn","Total":"1"},{"Flavor":"Strawberry Cremem","Total":"1"}]},
            			{"toppingsales":[{"Flavor":"Craisins","Total":"1"},{"Flavor":"M&M's","Total":"1"},{"Flavor":"Maraschino Cherries","Total":"1"}]}]};
            	createPie("cakesales", json.salesinfo[0].cakesales);
            	createPie("fillingsales", json.salesinfo[1].fillingsales);
            	createPie("frostingsales", json.salesinfo[2].frostingsales);
            	createBar("toppingsales", json.salesinfo[3].toppingsales);


          
//        }
}

function createPie(name, data) {
	canvas = document.createElement("canvas");
	console.log(data);
	canvas.id = name;
	canvas.width = "400";
	canvas.height = "200";
	canvas.display = "block";
	document.body.appendChild(canvas);

	var flavors = new Array();
	var totals = new Array();

	for (var i = 0, len = data.length; i < len; i++) {
		flavors[i] = data[i].Flavor;
		totals[i] = parseInt(data[i].Total, 10);
	}

	console.log(flavors);
	console.log(totals);

	var pie = new RGraph.Pie(name, totals)
		.Set('chart.labels', flavors)
		.Set('chart.title', name)
		.Set('chart.text.size', 8)
		.Draw();
}		

function createBar(name, data) {
	canvas = document.createElement("canvas");
	console.log(data);

	canvas.id = name;
	canvas.width = "400";
	canvas.height = "200";
	canvas.display = "block";
	document.body.appendChild(canvas);

	var flavors = new Array();
	var totals = new Array();

	for (var i = 0, len = data.length; i < len; i++) {
		flavors[i] = data[i].Flavor;
		totals[i] = parseInt(data[i].Total, 10);
	}

	console.log(flavors);
	console.log(totals);

	var bar = new RGraph.Bar(name, totals)
		.Set('chart.labels', flavors)
		.Set('chart.title', name)
		.Set('chart.text.size', 8)
		.Draw();
}		

window.onload = init;