<div>
    <?php
        $idUtilisateur = $_SESSION["client"]["id"];
        $quantity = $_SESSION["panier"][$idUtilisateur][$idProduit] ?? 0;
        $button = $quantity == 0 ? 'Ajouter' : 'Modifier';
    ?>
    <form class="d-flex" method="post" action="cart.php" style="flex-direction: column; gap:1rem">
        <div class="counter d-flex">
            <button onclick="return false" class="btn btn-success mx-2 plus">+</button>
            <input type="hidden" value="<?php echo $idProduit?>" name="id">
            <input class="form-control quantity" value="<?php echo $quantity?>" min="0" type="number" name="quantity"  max="99">
            <button onclick="return false" class="btn btn-danger mx-2 minus">-</button>
        </div>
        <input class="btn add-2-cart" type="submit" value="<?php echo$button ?>" name="add">
        <?php
            if($quantity !== 0)
            {
        ?>
        <input formaction="delete_cart.php" style="font-weight: bold" class="btn btn-danger" type="submit" value="delete" name="delete">
        <?php
            }
        ?>
    </form>
</div>
