<?php
require_once "../ready_components/first_connection.php";
$id = $_GET['id'];
$sql_state = $pdo->prepare("select * from produits where id=?");
$sql_state->execute([$id]);
$produit = $sql_state->fetch(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category | <?php echo $produit['libelle'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../scripts_styles/styles/products/styles.css">
    <style>
        .badgeX
        {
            background-color: #1fd51f;
            color: white;
            border-radius: 9px;
            padding: 2px 8px;
            font-weight: bold-
            display: inline-block;
            margin: 1rem 0;
        }
        .discount-term
        {
            color: coral;
            font-weight: bold;
            font-size: 20px;
        }
    </style>
</head>
<body>
<?php require_once "navbar_front.php"?>
<div class="container py-2">
    <div class="row">
        <div class="col-md-6">
            <img class="img img-fluid" src="../Uploaded_pictures/product_files/<?php echo$produit['image'] ?>">
        </div>
        <div class="col-md-6" style="padding-top: 1.8rem">
            <h3 style="color:steelblue"><?php echo$produit['libelle'] ?></h3>
            <h5><?php echo$produit['description']?></h5>
            <?php if(!empty($produit['discount'])) echo'<span class="discount-term">Discount : </span><span class="badgeX">-'.$produit['discount'].'%'.'</span>' ;?>
            <div style="display: flex; gap: 20px">
                    <?php
                    if(!empty($produit['discount'])) {
                        $first_display = "<strike><h4 style='background-color: red; margin: 2.2rem 0; color: white; width: fit-content; padding: 5px 1rem; border-radius: 1rem'> {$produit['prix']} MAD</h4></strike>";
                        echo $first_display; }
                    ?>
                    <?php
                    $prix = $produit['prix'];
                        if(!empty($produit['discount']))
                        {
                            $discount = $produit['discount'];
                            $remise = $prix - $prix*($discount)/100;
                            echo"<h4 style='background-color: green; margin: 2.2rem 0; color: white; width: fit-content; padding: 5px 1rem; border-radius: 1rem'> {$remise} MAD</h4>";
                        }
                        else
                        {
                            echo"<h4 style='background-color: green; margin: 2.2rem 0; color: white; width: fit-content; padding: 5px 1rem; border-radius: 1rem'> {$produit['prix']} MAD</h4>";
                        }
                    ?>
            </div>
            <div>
                <?php
                $idProduit = $produit["id"];
                include('../ready_components/front_ready_components/code1.php'); ?>
            </div>
        </div>
    </div>
</div>
<script src="../scripts_styles/scripts/products/scripts.js"></script>
</body>
</html>