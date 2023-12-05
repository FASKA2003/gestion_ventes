<?php
session_start();
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">TechZone</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php
            if(!isset($_SESSION["client"]))
            {
         ?>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="clientRegister.php" class="nav-link active" aria-current="page" href="index.php">Create An Account</a>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="clientLogin.php" class="nav-link active" aria-current="page" href="index.php">Start Shopping Now </a>
                </li>
            </ul>
        </div>
        <?php }?>
        <?php
            if(isset($_SESSION["client"])) {
        ?>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">List Of Categories</a>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                    <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="logout_client.php">Logout</a>
                    </li>
            </ul>
        </div>
              <?php
                $idUtilisateur = $_SESSION['client']['id'];
              ?>
                <a class="btn" href="real_cart.php"><i class="fa fa-solid fa-cart-shopping"></i> Cart </a>
            <?php }
            // echo count($_SESSION['panier'][$idUtilisateur]
            ?>
    </div>
</nav>