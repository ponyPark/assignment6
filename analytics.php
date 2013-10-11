<!--Analytics Page for CustomCupcakes by BAM Software-->
<!DOCTYPE html>
<html>
	<head>
		<? 
    	session_start();
    	//will be there if the user has successfully loggin into the system
		?>
    	<title>CustomCupcakes Analytics</title>
    	<meta charset="UTF-8">
    	<link rel="stylesheet" href="css/style.css" type="text/css">
    	<link href='http://fonts.googleapis.com/css?family=Cantarell' rel='stylesheet' type='text/css'>
    	<script type="text/javascript" src="js/analytics.js"></script>
    	<script src="js/rgraph/RGraph.common.core.js"></script>
    	<script src="js/rgraph/RGraph.bar.js"></script>
    	<script src="js/rgraph/RGraph.pie.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="http://code.highcharts.com/2.2.4/highcharts.js"></script>



	</head>

	<body>
		<header>
			<h1>Custom Cupcakes Analytics</h1>
		</header>
            
            <table width='100%'>
                <tr>
                    <td width='33%'><h2>Cake Sales</h2></td>
                    
                    <td width='33%'><h2>Frosting Sales</h2></td>
                    <td width='33%'><h2>Filling Sales</h2></td>
                </tr>
                <tr>
                    <td><div id='cakesales'></div></td>
                     <td>  <div id='frostingsales'></div></td>

                    
               <td> <div id='fillingsales'></div></td>
           </tr>
       </table>
                    <h2>Topping Sales</h2>
                            <canvas id='toppingsales' height=250></canvas>

</td>
</tr>

        </table>
	</body>
</html>