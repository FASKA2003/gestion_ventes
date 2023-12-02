<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
            form
            {
                margin-bottom: 2rem ;
            }
            td
            {
                white-space: nowrap;
            }
            i
            {
                display: inline-block;
                margin-right: 7px;
            }
    </style>
</head>
<body>
    <?php
        include('ready_components/navbar.php');
        if(!isset($_SESSION["utilisateur"]))
        {
            header("location:connection.php");
        }
    ?>
    <div class="container">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>Client</th>
                <th>Total</th>
                <th>Date</th>
                <th>Operations</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once "ready_components/first_connection.php";
            $commandes=$pdo->query('select commande.*,utilisateurs.login as "login" from commande inner join utilisateurs on commande.id_client=utilisateurs.id order by commande.date_creation desc')->fetchAll(PDO::FETCH_ASSOC);
            foreach ($commandes as $categorie)
            {
                ?>
                <tr>
                    <td><?php echo $categorie["id"] ?></td>
                    <td><?php echo $categorie["login"]?></td>
                    <td><?php echo $categorie["total"]?></td>
                    <td><?php echo $categorie["date_creation"]?></td>
                    <td>
                        <a class="btn btn-success btn-sm" href="commande.php?id=<?php echo $categorie["id"]?>">Details</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>