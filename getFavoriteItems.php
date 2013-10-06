<?
	include "phpapi.php";
	$favoriteID = $_GET['favID'];
	$phpInit = new phpapi();
	$favoriteItems = array();
    array_push($favoriteItems, json_decode($phpInit->getFavoriteCake($favoriteID)));
    array_push($favoriteItems, json_decode($phpInit->getFavoriteFilling($favoriteID)));
    array_push($favoriteItems, json_decode($phpInit->getFavoriteFrosting($favoriteID)));
    array_push($favoriteItems, json_decode($phpInit->getFavoriteToppings($favoriteID)));
    echo(json_encode(array('favoriteitems' => $favoriteItems)));
?>
