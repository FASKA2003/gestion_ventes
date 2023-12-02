<?php
    require_once "ready_components/first_connection.php";
    $id = $_GET["id"];
    $etat = $_GET["etat"];

    $sqlState = $pdo->prepare("update commande set valide = ? where id = ?");
    $sqlState->execute([$etat,$id]);

    header('location: commande.php?id='.$id);

?>