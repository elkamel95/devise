<?php 
 require(dirname(__FILE__).'\SPDO.php');
	      $res = SPDO::getInstance();
		  
		  
$id= $_GET['idchange'];
$sql = "DELETE FROM `devise` WHERE `devise`.`id` = ? ";
            $q = $res->prepare($sql);
            $q->execute(array($id));
			header('Location: index.php');

?>