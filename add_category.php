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

if(isset($_POST["add-cetegory"]))
{
    $libelle = $_POST["libelle"];
    $description = $_POST["description"];
    $icon = $_POST["icon"];
    if(!empty($libelle) && !empty($description))
    {
        require_once "ready_components/first_connection.php";
        $sql_state = $pdo->prepare("insert into catégories (libelle,description,icone)
                                         values (?,?,?)");
        $sql_state->execute([$libelle,$description,$icon]);
        ?>
            <div class='alert alert-success' role='alert'>Category Successfully Added </div>
<?php
    }
    else
    {
         ?>
        <div class='alert alert-danger' role='alert'>All the fields are required</div>
       <?php
    }
}
?>

<div class="container py-3 my-3" >
    <h4>Add Category</h4>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Libelle</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Category Name"  name="libelle">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Icon</label>
            <textarea name="icon" class="form-control"></textarea>
        </div>
        <input type="submit" class="btn btn-primary" value="Add Category" name="add-cetegory">
    </form>
</div>

</body>
</html>