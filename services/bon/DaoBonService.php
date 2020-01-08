<?php
require('./bonService.php');
require('../../SPDO.php');

$res = SPDO::getInstance();
session_start();
if(isset($_GET['remove'])){
    BonService::remove($_GET['id_bon'],$res);
    header("Location: ../../bon.php");

}else
if (isset($_GET["totale"]))

{ $totale= $_GET["totale"];
BonService::set($totale,$_SESSION["id_bon"],$res);}
else if (isset($_GET["client_id"]))
 {
     BonService::setSession($_GET["client_id"],$_GET["client_name"],$_GET["client_num"],$_GET["id_bon"]);

     header("Location: ../../index.php");


}


