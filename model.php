<?php


  require(dirname(__FILE__).'\SPDO.php');
	      $res = SPDO::getInstance();
   
   

   if(isset($_POST['code'])){
$id = $_POST['id'];
$code = $_POST['code'];
$prix = $_POST['prix'];
$montant = $_POST['montant'];
$montant_ml = $prix * $montant;
$action="inseration";

       session_start();
   if(isset($_POST['idAction'])){

   $idAction =$_POST['idAction'];
       $sql = "UPDATE devise SET montant = ?,  montant_ml = ? ,ID_Taux = ? , id_bon = ? ,id_user= ? WHERE id = ".$idAction;
$action="modifier";
  
   }else{
	   
 $sql = "INSERT INTO `devise` ( `montant`,  `montant_ml`, ID_Taux , id_bon ,id_user) VALUES ( ?, ?, ?,?,?)";
   }
            $q = $res->prepare($sql);
           
			$qry= $q->execute(array($montant,$montant_ml,$id,$_SESSION["id_bon"],$_SESSION["user_id"]));
   }

header("Location: index.php?msg=$qry&&action=$action");

?>

