<?php
session_start();
if(!isset($_SESSION["client"]))
{
    header("location: clientLogin.php");
}
$idUtilisateur = $_SESSION["client"]["id"];
$id = $_POST["id"];
unset($_SESSION["panier"][$idUtilisateur][$id]);
header("location:".$_SERVER["HTTP_REFERER"]);

