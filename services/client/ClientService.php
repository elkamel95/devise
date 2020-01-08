
<?php
require('../../SPDO.php');
require('../bon/bonService.php');

$res = SPDO::getInstance();


if (isset($_POST['nom']) && isset($_POST['pren']) && isset($_POST['num'])) {
    $nom = $_POST['nom'];
    $pren = $_POST['pren'];
    $num = $_POST['num'];
    if(isset($_POST['Action'])) {
        $Action = $_POST['Action'];
        if(  $Action == "add"){
            $sql = "INSERT INTO `client`( `nom`, `prenom`, `numpassport`) VALUES (?,?,?)";
          $q =  $res->prepare($sql);
            $qry =  $q->execute(array($nom, $pren,$num));
            $msg ="1";
        }

    }
    session_start();
    $q=    $res->prepare("SELECT * FROM `client` WHERE numpassport = ".$num);
    $q->execute(array($num));
    foreach ( $q as $user){
        $_SESSION["client_id"] = $user["id"];
        $_SESSION["client_name"] = $user["nom"];
        $_SESSION["client_num"] = $user["numpassport"];
        header("Location: ../../index.php");

    }
    BonService::add( $_SESSION["client_id"] , $_SESSION["user_id"],$res);

} else {
    $msg ="erreur";}
?>
