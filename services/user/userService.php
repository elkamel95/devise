
<?php
echo  dirname(__FILE__) . '\SPDO.php';
require('../../SPDO.php');
$res = SPDO::getInstance();


if (isset($_POST['nom']) && isset($_POST['password'])) {
    $nom = $_POST['nom'];
    $password = $_POST['password'];
    session_start();
    $q=    $res->prepare("select  * from users where  username = ? and  password = ?");
       $q->execute(array($nom,$password));
       foreach ( $q as $user){
echo $user["username"] ;
           $_SESSION["user_id"] = $user["id"];
           $_SESSION["user_name"] = $user["username"];
           $_SESSION["user_pass"] = $user["password"];

       }
    header("Location: ../../index.php");


} else {
    $msg ="erreur";

    header("Location: ../../auth.php?msg=$msg");

}
if (isset($_POST['nom']) && isset($_POST['password']) && isset($_POST['Action'])) {
    $Action = $_POST['Action'];
if ($_POST['Action'] == "update") {

    $idUser = $_GET['idUser'];
    $sql = "UPDATE `users` SET `username`=?,`password`=? WHERE id =  " . $idUser;
    $action = "modifier";

}else if(  $Action == "add"){
    $sql = "INSERT INTO `users`( `username`, `password`) VALUES (?,?)";


}
else{
    $idUser = $_GET['idUser'];
    $sqlD = "DELETE FROM `users` WHERE id = ".$idUser;

    $q = $res->prepare($sqlD);

    $qry = $q->execute();

}
    $q = $res->prepare($sql);

    $qry = $q->execute(array($nom, $password));
    $msg ="1";

    header("Location: ../../auth.php?msg=$msg");

}
?>
