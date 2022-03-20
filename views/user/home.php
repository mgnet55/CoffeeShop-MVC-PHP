<div class="container-fluid">
    <div class="new-arrival new-arrival2">
        <div class="row">
            <div class="col-xl-8">
                <div class="row">

                <?php foreach ($products as $product) { ?>

                    <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                        <div class="single-new-arrival text-center">
                            <div class="popular-img">
                                <img src="/uploads/<?= $product->image ?>" alt="product">

                                <div class="favorit-items"><img src="/uploads/favorit-card.png"
                                                                onclick="addToCart(<?= $product->id ?>,'<?= $product->prd_name ?>',<?= $product->price ?>,'<?= $product->image ?>')">
                                </div>
                            </div>
                            <div class="popular-caption">
                                <h3><?= $product->prd_name ?></h3>
                                <span>$ <?= $product->price ?></span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
<!--  Cart start          -->
            <div class="col-xl-4">
                <?php include(VIEWS_PATH . 'user' . DS . 'cart.php') ?>
            </div>
<!--  end cart  -->
        </div>
    </div>

</div>
