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
        <a href="add_category.php" class="btn btn-primary">Add A new Category</a>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Insertion Date</th>
                <th>Icon</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once "ready_components/first_connection.php";
            $categories=$pdo->query("select * from catégories")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($categories as $categorie)
            {
                ?>
                <tr>
                    <td><?php echo $categorie["id"] ?></td>
                    <td><?php echo $categorie["libelle"]?></td>
                    <td><?php echo $categorie["description"]?></td>
                    <td><?php echo $categorie["date"]?></td>
                    <td><i class="<?php echo $categorie["icone"]?>"></i></td>
                    <td style="display: flex;">
                        <a style="margin-right: 15px" href="update_category.php?id=<?php echo$categorie["id"] ?>"  class="btn btn-success">Update</a>
                        <a onclick="return confirm('are you sure you wanna delete this category ?')" href="delete_category.php?id=<?php echo$categorie["id"] ?>"  class="btn btn-danger delete-categ">Delete</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>