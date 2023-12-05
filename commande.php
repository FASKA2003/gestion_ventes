<?php
require_once "ready_components/first_connection.php";
$idCommande = $_GET["id"];
$sqlState=$pdo->prepare('select commande.*,utilisateurs.login as "login" from commande inner join utilisateurs on commande.id_client=utilisateurs.id
                                                where commande.id = ?
                                                order by commande.date_creation desc');
$sqlState->execute([$idCommande]);
$commande = $sqlState->fetch(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Commande N° <?= $commande["id"] ?></title>
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
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
                    $sqlStateLigneCommandes = $pdo->prepare("select l_commande.* ,produits.libelle,produits.image from l_commande inner join 
                                                                        produits on l_commande.id_produit = produits.id
                                                                        where id_commande = ?");
                    $sqlStateLigneCommandes->execute([$idCommande]);
                    $lignesCommande = $sqlStateLigneCommandes->fetchAll(PDO::FETCH_OBJ);
            ?>
                <tr>
                    <td><?php echo $commande["id"] ?></td>
                    <td><?php echo $commande["login"]?></td>
                    <td><?php echo $commande["total"]?></td>
                    <td><?php echo $commande["date_creation"]?></td>
                    <td>
                            <?php if($commande["valide"]==0) :  ?>
                                <a class="btn btn-success btn-sm" href="valider_commande.php?id=<?= $commande['id'] ?>&etat=1">Initiale Offer</a>
                            <?php else:   ?>
                                <a class="btn btn-danger btn-sm" href="valider_commande.php?id=<?= $commande['id'] ?>&etat=0">Cancel</a>
                            <?php endif;  ?>

                        </a>
                    </td>
                </tr>
            <?php  ?>
            </tbody>
        </table>
        <hr>
        <hr>
        <hr>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                    <?php foreach ($lignesCommande as $ligneCommande) :  ?>
                        <tr>
                            <td><?php echo $ligneCommande->id ?></td>
                            <td><?php echo $ligneCommande->libelle ?></td>
                            <td><?php echo $ligneCommande->prix ?> MAD</td>
                            <td>x<?php echo $ligneCommande->quantite ?></td>
                            <td><?php echo $ligneCommande->total ?> MAD</td>
                        </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>