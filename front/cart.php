<?php
session_start();
if(!isset($_SESSION["client"]))
{
    header("location: clientLogin.php");
}
$id = $_POST["id"];
$idUtilisateur = $_SESSION["client"]["id"];
$quantity = $_POST["quantity"];
if(!isset($_SESSION["panier"][$idUtilisateur]))
 {
     $_SESSION["panier"][$idUtilisateur] = [];
 }
if($quantity==0)
{
    unset($_SESSION["panier"][$idUtilisateur][$id]);
}
else
{
    $_SESSION["panier"][$idUtilisateur][$id] = $quantity;
}
header("location:".$_SERVER["HTTP_REFERER"]);
?>

