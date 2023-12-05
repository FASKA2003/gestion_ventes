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
 require_once "ready_components/first_connection.php";
 $sql_state = $pdo->prepare("select * from catégories where id=?");
 $id = $_GET["id"];
 $sql_state->execute([$id]);

 $category = $sql_state->fetch(PDO::FETCH_ASSOC);


if(isset($_POST["update-cetegory"]))
{
$libelle = $_POST["libelle"];
$description = $_POST["description"];
$icone = $_POST["icon"];
if(!empty($libelle) && !empty($description))
{
    require_once "ready_components/first_connection.php";
    $sql_state = $pdo->prepare("update catégories set libelle = ?, description = ?,icone = ? where id = ?");
    $sql_state->execute([$libelle,$description,$icone,$id]);
    ?>
    <div class='alert alert-success' role='alert'>Category Successfully Updated </div>
    <?php
}
else
{
    ?>
    <div class='alert alert-danger' role='alert'>All The fields Are Required To Update The Category</div>
    <?php
}
}
?>

<div class="container py-3 my-3" >
    <h4>Update Category</h4>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Id</label>
            <input readonly type="text" class="form-control" id="formGroupExampleInput" name="ID" value="<?php echo$category['id'] ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Libelle</label>
            <input type="text" class="form-control" id="formGroupExampleInput" name="libelle" value="<?php echo$category['libelle']?>">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Description</label>
            <textarea name="description" class="form-control"><?php echo$category['description']?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Libelle</label>
            <input type="text" class="form-control" id="formGroupExampleInput" name="icon" value="<?php echo$category['icone']?>">
        </div>
        <input type="submit" class="btn btn-primary" value="Update Category" name="update-cetegory">
    </form>
</div>

</body>
</html>