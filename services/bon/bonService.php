<?php
class BonService
{
    public function Add($client_id , $usre_id ,$res)
    {


        if (isset( $client_id) && isset(  $usre_id) ) {

            $sql = "INSERT INTO `bonechange`( `date_creation`, `date_update`, `id_client`, `id_user`) VALUES (?,?,?,?)";
            $q = $res->prepare($sql);
            $today = date("Y-m-d H:i:s");
            $q->execute(array($today,$today,$client_id,$usre_id));

            $q=    $res->prepare("SELECT * FROM `bonechange` where  `id_user` = ? and `id_client` = ? ");
            $q->execute(array($usre_id,$client_id));
            foreach ( $q as $bon){
                echo $bon["id_bon"] ;
                $_SESSION["id_bon"] = $bon["id_bon"];


            }
        }}
    public function set( $totale , $idbon, $res)
    {
        if (isset( $idbon) ) {

            $q=    $res->prepare("UPDATE `bonechange` SET  totale = ? WHERE id_bon = ?  ");
            $q->execute(array($totale, $idbon));

        }}
    public function setSession(  $sessionidclient ,$sessionNomclient , $sessionNumClient , $sessionIdbon)
    {
        $_SESSION["client_id"] =  $sessionidclient;
        $_SESSION["id_bon"] = $sessionIdbon;
        $_SESSION["client_num"] =$sessionNumClient ;
        $_SESSION["client_name"] = $sessionNomclient;

    }
public  function  remove($idbon, $res)
{
    $q = $res->prepare("DELETE FROM `bonechange` WHERE  id_bon = ? ");
    $q->execute(array($idbon));


}
}
