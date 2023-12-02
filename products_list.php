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
                width: fit-content;
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
        <a href="add_product.php" class="btn btn-primary">Add a new product</a>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Category</th>
                <th>Image</th>
                <th>insertion Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once "ready_components/first_connection.php";
            $products=$pdo->query("select * from produits")->fetchAll(PDO::FETCH_ASSOC);
            $categories = $pdo->query("select * from catégories")->fetchAll(PDO::FETCH_ASSOC);
            $category_name = null ;

            foreach ($products as $product)
            {
                foreach($categories as $categorie)
                {
                    if($categorie["id"] == $product["id_categorie"])
                    {
                        $category_name = $categorie["libelle"];
                        break ;
                    }
                    $category_name = "No Matching Categories !";
                }
                ?>
                <tr>
                    <td><?php echo $product["id"] ?></td>
                    <td><?php echo $product["libelle"]?></td>
                    <td><?php echo $product["prix"]?></td>
                    <td><?php echo $product["discount"]?></td>
                    <td><?php echo $category_name?></td>
                    <td><img style="width:90px" src="Uploaded_pictures/product_files/<?php echo $product["image"] ?>"></td>
                    <td><?php echo $product["date_creation"]?></td>
                    <td>
                        <a href="update_product.php?id=<?php echo$product['id'] ?>" class="btn btn-success">Update</a>
                        <a onclick = "return confirm('Are you sure you wanna delete this product ? ')" href="delete_product.php?id=<?php echo$product['id'] ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>