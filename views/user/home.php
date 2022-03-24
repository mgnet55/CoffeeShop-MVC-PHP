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

                                <div class="favorit-items">
                                    <img src="/uploads/favorit-card.png" onclick="addToCart(<?= $product->id ?>,'<?= $product->prd_name ?>',<?= $product->price ?>,'<?= $product->image ?>')">
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
                <div class="container padding-bottom-3x mb-1">
                    <!-- Alert-->
                    <div class="alert alert-info text-center" style="margin-bottom: 30px;">
                        <strong>Cart Total</strong>
                        <p id="totalcart"></p>
                    </div>
                    <!-- Shopping Cart-->
                    <div class="table-responsive shopping-cart">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th class="text-center">Qty</th>
                                <th class="text-center">Subtotal</th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody id="cartSection">
                            </tbody>
                        </table>
                    </div>
                    <a class="btn btn-primary" onclick="sendOrder()">Checkout</a>
                    <a class="btn btn-danger" onclick="clearCart()">Clear Cart</a>

                </div>
                <script src="/js/cart.js"></script>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>            </div>
<!--  end cart  -->
        </div>
    </div>

</div>
