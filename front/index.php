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
</head>
<body>
<?php require_once "navbar_front.php"?>
<div class="container py-2 w-75">
    <h4><i style="display: inline-block; margin-right: 10px" class="fa-solid fa-list"></i>List of Categories</h4>
    <?php
    require_once "../ready_components/first_connection.php";
    $categories = $pdo->query("select * from catégories")->fetchAll(PDO::FETCH_OBJ);
    ?>
    <ul class="list-group">
        <?php
            foreach($categories as $categorie)
            {
        ?> <li class="list-group-item">

                <i class="<?php echo $categorie->icone ?>"></i>  <a class="btn btn-light" href="category.php?id=<?php echo $categorie->id ?>">
                    <?php echo $categorie->libelle ?>
                </a>
            </li>
        <?php
            }
        ?>
    </ul>
</div>
</body>
</html>