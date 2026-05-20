<div class="product-item <?php if($row['stock'] <= 0){ echo 'sold-out'; } ?>">

    <a href='product.php?id=<?php echo $row["product_id"]; ?>' class="product_link">

        <div class="images">
            <img src="img/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
        </div>

        <div class="metadata">

                        <span class="name">
                            <?php echo $row['name']; ?>
                        </span>

            <span class="price">
                            SAR <?php echo $row['price']; ?>
                        </span>

            <span class="rating">
                            <?php echo $row['rating']; ?>
                        </span>

        </div>

    </a>

        <?php if($row['stock'] > 0){ ?>

        <button
            class="btn-add-to-cart add_cart"
            data-id="<?php echo $row['product_id']; ?>"
            data-name="<?php echo $row['name']; ?>"
            data-price="<?php echo $row['price']; ?>"
            data-image="<?php echo $row['image']; ?>"
            data-stock="<?php echo $row['stock']; ?>"
        >

            Add to Cart

        </button>

    <?php }else{ ?>

        <button class="sold-btn" disabled>

            Out of Stock

        </button>

    <?php } ?>

</div>

