<?
    include "phpapi.php";
    $phpInit = new phpapi();

    $salesInfo = array();
    array_push($salesInfo, json_decode($phpInit->getCakeSalesInformation()));
    array_push($salesInfo, json_decode($phpInit->getFillingSalesInformation()));
    array_push($salesInfo, json_decode($phpInit->getFrostingSalesInformation()));
    array_push($salesInfo, json_decode($phpInit->getToppingsSalesInformation()));
    echo(json_encode(array('salesinfo' => $salesInfo)));
?>