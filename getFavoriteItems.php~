<?
	include "phpapi.php";
	$favoriteID = $_GET['favID'];
	$phpInit = new phpapi();
	$favoriteItems = array();
	$favoriteItems["cake"] = json_decode($phpInit->getFavoriteCake($favoriteID));
	$favoriteItems["filling"] = json_decode($phpInit->getFavoriteFilling($favoriteID));
	$favoriteItems["frosting"] = json_decode($phpInit->getFavoriteFrosting($favoriteID));
	$favoriteItems["toppings"] = json_decode($phpInit->getFavoriteToppings($favoriteID));
	echo(json_encode($favoriteItems));
?>
