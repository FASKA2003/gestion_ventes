<?php
session_start();
$connected = false ;
if(isset($_SESSION["utilisateur"]))
{
    $connected = true;
}
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">TechZone</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php"><i class="fa-solid fa-user"></i>Add User</a>
                </li>
                <?php
                    if($connected)
                    {
                        ?>

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="add_category.php"><i class="fa-regular fa-object-group"></i>Add Category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="add_product.php"><i class="fa-solid fa-box-open"></i>Add Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="categories_list.php"><i class="fa-regular fa-rectangle-list"></i>List of categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="products_list.php"><i class="fa-solid fa-list-ul"></i>List Of Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="commandes.php"><i class="fa-solid fa-check"></i>Commands</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
                        </li>

                <?php
                    }
                    else
                    {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="connection.php"><i class="fa-solid fa-right-to-bracket"></i>Connection</a>
                        </li>
                   <?php
                    }
                    ?>

            </ul>
        </div>
    </div>
</nav>