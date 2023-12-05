<?php

require_once "../ready_components/first_connection.php";
$id = $_GET['id'];
$sql_state = $pdo->prepare("select * from catégories where id=?");
$sql_state->execute([$id]);
$categorie = $sql_state->fetch(PDO::FETCH_ASSOC);

$sql_state = $pdo->prepare("select * from produits where id_categorie=?");
$sql_state->execute([$id]);
$produits = $sql_state->fetchAll(PDO::FETCH_OBJ);


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category | <?php echo $categorie['libelle'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../scripts_styles/styles/products/styles.css">
    <link rel="stylesheet" href="../scripts_styles/styles/products/styles.css">
</head>
<body>
<?php require_once "navbar_front.php"?>
<div class="container py-2 w-75">
    <h4><i class="<?php echo $categorie['icone'] ?>"></i> <?php echo $categorie['libelle'] ?></h4>
    <div class="container">
        <div class="row">
            <?php
                foreach($produits as $produit)
                {
                    $idProduit = $produit->id ;
                  //$_SESSION["client"]["product_id"] = $product_id;
                    ?>
                <div class="card mb-3 col-md-4 my-1 ">
                    <img width="100" height="300" class="card-img-top" src="../Uploaded_pictures/product_files/<?php echo$produit->image ?>" alt="Card image cap">
                    <div class="card-body">
                        <a  class="btn btn-primary stretched-link" href="product.php?id=<?php echo$idProduit ?>">More Details</a>
                        <h5 class="card-title"><?php echo $produit->libelle?></h5>
                        <p class="card-text"><?php echo $produit->description ?></p>
                        <p class="card-text"><?php echo $produit->prix ?>MAD</p>
                        <p class="card-text">Ajouté le : <small class="text-muted"><?php echo date_format(date_create($produit->date_creation),'Y/m/d')?></small></p>
                    </div>
                    <div class="card-footer" style="z-index: 11">
                            <?php
                            include('../ready_components/front_ready_components/code1.php'); ?>
                    </div>
                </div>
                <?php }
                if(empty($produit))
                {   echo"<h4 style='margin-top:40px'>No Products Added In This Category</h4>";
                }?>
</div>
</div>
    <script src="../scripts_styles/scripts/products/scripts.js"></script>
</body>
</html>