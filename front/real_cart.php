<?php
require_once "../ready_components/first_connection.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../scripts_styles/styles/products/styles.css">
    <link rel="stylesheet" href="../scripts_styles/styles/products/styles.css">
</head>
<body>
<?php require_once "navbar_front.php"?>
<div class="container py-2 w-75">
    <?php
        if(isset($_POST["cancel"]))
        {
            $_SESSION["panier"][$idUtilisateur] = [];
            header("location: real_cart.php");
        }
        $idUtilisateur = $_SESSION["client"]["id"];
        $panier = $_SESSION["panier"][$idUtilisateur];
        if(!empty($panier))
        {
            $idProduits = array_keys($panier);
            $idProduits = implode(',',$idProduits);
            $produits = $pdo->query("select * from produits where id in ($idProduits)")->fetchAll(PDO::FETCH_ASSOC);
        }
         if(isset($_POST["complete"]))
        {
              $sql = "insert into l_commande(id_produit,id_commande,prix,quantite,total) values";
              $total = 0;
              $prixProduits = [];
              foreach ($produits as $produit)
              {
                    $idProduit = $produit["id"];
                    $quantity = $panier[$idProduit];
                    $prix = $produit["prix"];
                    $total+=$quantity*$prix;
                    $prixProduits[$idProduit] = [
                                'id' => $idProduit,
                                'prix'=>$prix,
                                'total'=>$quantity*$prix,
                                'quantity'=>$quantity
                    ];
              }
             $sqlStateCommande = $pdo->prepare('insert into commande(id_client,total) values(?,?)');
             $sqlStateCommande->execute([$idUtilisateur,$total]);
             $idCommande = $pdo->lastInsertId();
              foreach ($prixProduits as $produit)
              {
                  $idI = $produit["id"];
                  $sql .= "(:id$idI,'$idCommande',:prix$idI,:quantity$idI,:total$idI ),";
              }
            $sql = substr($sql,0,-1);
            $sqlState = $pdo->prepare($sql);
            foreach ($prixProduits as $produit)
            {
                $id = $produit["id"];
                $sqlState->bindParam(':id'.$id,$produit["id"]);
                $sqlState->bindParam(':prix'.$id,$produit["prix"]);
                $sqlState->bindParam(':quantity'.$id,$produit["quantity"]);
                $sqlState->bindParam(':total'.$id,$produit["total"]);
            }
            $inserted=$sqlState->execute();
            if($inserted){
                $_SESSION["panier"][$idUtilisateur] = [];
            ?>
                <div class="alert alert-info" role="alert">
                    Command Successfully Completed !
                </div>
            <?php
            }
           }
    ?>

    <h4>List Of Items Currently Existing In The Cart : </h4>
    <div class="container">
        <div class="row">
            <?php
                if(empty($panier))
                {
                    ?>
                    <div class="alert alert-info" role="alert">
                        The Cart Is Empty !
                    </div>
                <?php
                }
                else
                {
                    ?>
                    <table class="table">
                        <thead>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">label</th>
                            <th scope="col">quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total</th>
                        </thead>
                        <tbody>
                        <?php
                        $somme = 0;
                        foreach($produits as $produit)
                        {
                            ?>
                                <tr>
                                    <td><?php echo $produit["id"] ?></td>
                                    <td><img width="50px" src="../Uploaded_pictures/product_files/<?php echo $produit["image"] ?>"></td>
                                    <td><?php echo $produit["libelle"] ?></td>
                                    <td><?php echo $panier[$produit["id"]] ?></td>
                                    <td><?php echo $produit["prix"] ?></td>
                                    <td  style="white-space: nowrap"><?php echo $produit["prix"]*$panier[$produit["id"]] ?> MAD</td>
                                </tr>
                           <?php
                            $somme+=$produit["prix"]*$panier[$produit["id"]];
                        }
                        ?>
                        </tbody>
                        <tfoot>
                                <tr>
                                    <td colspan="5" align="right"><strong>Total : </strong></td>
                                    <td style="white-space: nowrap"><?php echo$somme ?> MAD</td>
                                </tr>
                                <tr>
                                    <td colspan="6" align="right" style="white-space: nowrap">
                                        <form method="post">
                                                <input type="submit" class="btn btn-success" value="Complete" name="complete">
                                                <input onclick="return confirm('Are you sure you want to delete all the items in the cart ? ')" type="submit" class="btn btn-danger" value="Cancel Cart" name="cancel">
                                        </form>
                                    </td>
                                </tr>
                        </tfoot>
                    </table>
                    <?php
                }
            ?>
        </div>
        </div>
</div>
    <script src="../scripts_styles/scripts/products/scripts.js"></script>
</body>
</html>