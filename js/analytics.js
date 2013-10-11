/*BAM Software JS for CustomCupcakes Analytics Page
October, 2013*/

function init() {
	var json;
	var url = './SalesInformation.php';

	var request = new XMLHttpRequest();
	request.open("GET", url, true);
    request.send();
    request.onreadystatechange = function(e) {

       	if(request.readyState === 4){
            //save the response from server
            var json = JSON.parse(request.responseText);

            createPie('cakesales', json.salesinfo[0].cakesales);
            createPie("fillingsales", json.salesinfo[1].fillingsales);
            createPie("frostingsales", json.salesinfo[2].frostingsales);
            createBar("toppingsales", json.salesinfo[3].toppingsales);  
        }
	}
};

function createPie(name, data) {
	var pieData = new Array();

	for (var i = 0, len = data.length; i < len; i++)
		pieData[i] = [data[i].Flavor, parseInt(data[i].Total, 10)];

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
	var flavors = new Array();
	var totals = new Array();

	for (var i = 0, len = data.length; i < len; i++) {
		flavors[i] = data[i].Flavor;
		totals[i] = parseInt(data[i].Total, 10);
	}

	var chart = new Highcharts.Chart({
        chart: {
            renderTo: name,
            type: 'column',
            backgroundColor: 'rgba(255, 255, 255, 0)',
            plotBorderWidth: null,
            plotShadow: false,
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories: flavors,
            title: {text: 'Toppings'}
        },
        yAxis: {
        	title: {text: 'Total Orders'}
        },
        title: {
            text: null
        },
 		legend: {
 			enabled: false
 		},	
        series: [{
            data: totals
        }]    
    });
};	

window.onload = init;