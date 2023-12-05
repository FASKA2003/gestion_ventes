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
 $sql_state = $pdo->prepare("select * from produits where id=?");
 $id = $_GET["id"];
 $sql_state->execute([$id]);

 $produit = $sql_state->fetch(PDO::FETCH_ASSOC);


if(isset($_POST["add-product"]))
{
    $libelle = $_POST["product-libelle"];
    $prix = $_POST["product-price"];
    $discount = $_POST["product-discount"];
    $categ = $_POST["categorie"];
    $description = $_POST["product-description"];
    $file_name = "";
    if(!empty($_FILES['product-image']['name']))
    {
        $image = $_FILES['product-image']['name'];
        $file_name = uniqid().$image;
        move_uploaded_file($_FILES['product-image']['tmp_name'],"Uploaded_pictures/product_files/".$file_name);
    }
if(!empty($libelle) && !empty($prix) && !empty($categ))
{
    require_once "ready_components/first_connection.php";
    $query="";
    if(!empty($file_name))
    {
        $query="update produits set libelle = ?,prix=?,discount=?,id_categorie=?,description=?,image=? where id = ?";
        $sql_state = $pdo->prepare($query);
        $sql_state->execute([$libelle,$prix,$discount,$categ,$description,$file_name,$id]);
    }
    else
    {
        $query="update produits set libelle = ?,prix=?,discount=?,id_categorie=?,description=? where id = ?";
        $sql_state = $pdo->prepare($query);
        $sql_state->execute([$libelle,$prix,$discount,$categ,$description,$id]);
    }

    ?>
    <div class='alert alert-success' role='alert'>Product Successfully Updated </div>
    <?php
}
else
{
    ?>
    <div class='alert alert-danger' role='alert'>Missing Required fields To Update The Product</div>
    <?php
}
}
?>
<div class="container py-3 my-3" >
    <h4>Add a product</h4>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Id</label>
            <input type="text" class="form-control" id="formGroupExampleInput" readonly name="product-id" value="<?php echo$produit['id'] ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" id="formGroupExampleInput" name="product-libelle" value="<?php echo$produit['libelle'] ?>">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Price</label>
            <input type="number" min="0" step="0.1" class="form-control" id="formGroupExampleInput2"  name="product-price" value="<?php echo$produit['prix'] ?>">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Discount</label>
            <input type="number" min="0" max="90" class="form-control" id="formGroupExampleInput2"  name="product-discount" value="<?php echo$produit['discount'] ?>">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Description</label>
            <textarea class="form-control" name="product-description"><?php echo$produit['description'] ?></textarea>
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Image</label>
            <input type="file" class="form-control" id="formGroupExampleInput2"  name="product-image">
        </div>
        <div class="mb-3">
            <img src="Uploaded_pictures/product_files/<?php echo$produit['image'] ?>">
        </div>
        <div style="margin-bottom: 1rem; display: flex; align-items: center">
            <label style="display: inline-block; margin-right: 1rem">Category</label>
            <?php
            require_once "ready_components/first_connection.php";
            $sql_state = $pdo->prepare("select * from catégories");
            $sql_state->execute();
            $catégories = $sql_state->fetchAll(PDO::FETCH_ASSOC);
            $categorie = null;
            ?>
            <select name="categorie" class="form-control my-2">
                <option>Choose a catgory</option>
                <?php
                foreach($catégories as $categorie)
                {
                    echo"<option value='".$categorie['id']."'>".$categorie['libelle']."</option>";
                }
                ?>
            </select>
        </div>
        <input type="submit" class="btn btn-primary" value="Update product" name="add-product">
    </form>
</div>

</body>
</html>