<?php
    require_once "ready_components/first_connection.php";
    $id = $_GET["id"];
    $sql_state = $pdo->prepare("delete from produits where id=?");
    $sql_state->execute([$id]);
    header("location:products_list.php");
?>