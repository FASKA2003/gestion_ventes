<?php
    require_once "ready_components/first_connection.php";
    $id = $_GET["id"];
    $sql_state = $pdo->prepare("delete from catégories where id=?");
    $sql_state->execute([$id]);
    header("location:categories_list.php");
?>