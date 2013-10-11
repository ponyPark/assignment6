/*BAM Software JS for CustomCupcakes Analytics Page
October, 2013*/

function init() {
	var json;
	var url = './SalesInformation.php';

	var request = new XMLHttpRequest();
	request.open("GET", url, true);
    //request.send();
    //request.onreadystatechange = function(e) {

       	//if(request.readyState === 4){
            //save the response from server
    //        var json = JSON.parse(request.responseText);
    //        console.log(json);
            var json = {"salesinfo":[
            			{"cakesales":[{"Flavor":"Banana","Total":"20"},{"Flavor":"Dark Chocolate","Total":"10"},{"Flavor":"Dark Chocolate","Total":"1"},{"Flavor":"Dark Chocolate","Total":"1"},{"Flavor":"Dark Chocolate","Total":"1"}]},
            			{"fillingsales":[{"Flavor":"Blackberry","Total":"1"},{"Flavor":"Strawbery","Total":"1"}]},
            			{"frostingsales":[{"Flavor":"Buttered Popcorn","Total":"1"},{"Flavor":"Strawberry Cremem","Total":"1"}]},
            			{"toppingsales":[{"Flavor":"Craisins","Total":"1"},{"Flavor":"M&M's","Total":"1"},{"Flavor":"Maraschino Cherries","Total":"1"},{"Flavor":"Maraschino Cherries","Total":"1"},{"Flavor":"Maraschino Cherries","Total":"1"},{"Flavor":"Maraschino Cherries","Total":"1"}]}]};
            
            	createPie('cakesales', json.salesinfo[0].cakesales);
            	createPie("fillingsales", json.salesinfo[1].fillingsales);
            	createPie("frostingsales", json.salesinfo[2].frostingsales);
            	createBar("toppingsales", json.salesinfo[3].toppingsales);
          
        //}
//}
};

function createPie(name, data) {
	var pieData = new Array();
	for (var i = 0, len = data.length; i < len; i++)
		pieData[i] = [data[i].Flavor, parseInt(data[i].Total, 10)];
	console.log(pieData);

	var chart = new Highcharts.Chart({
        chart: {
            renderTo: name,
            backgroundColor: 'rgba(255, 255, 255, 0)',
            plotBorderWidth: null,
            plotShadow: false,
            height: 300,
            margin: [40, 40, 80, 40]
        },
        credits: {
            enabled: false
        },
        title: {
            text: null
        },
 
        series: [{
            type: 'pie',
            name: 'Total Orders',
            data: pieData
        }]    
    });

};

function createBar(name, data) {
	console.log(data);
	var pageWidth = $(window).width();
	document.getElementById(name).width = pageWidth;

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
		.Set('chart.text.size', 8)
		.Draw();
};	

window.onload = init;