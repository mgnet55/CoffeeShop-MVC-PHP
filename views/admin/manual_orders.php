<!-- users select -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>New Order</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-8">
                <div class="row">
                    <?php foreach ($products as $product) { ?>
                        <div class="card col-3">
                            <p class="card-header"><?= $product['prd_name'] ?></p>
                            <div class="card-body">
                                <img class="card-img-top" src="/uploads/<?= $product['image'] ?>" style="cursor:pointer"
                                     onclick="addToCart(<?= $product['id'] ?>,'<?= $product['prd_name'] ?>',<?= $product['price'] ?>,'<?= $product['image'] ?>')">
                            </div>
                            <p class="card-footer"><?= $product['price'] ?> EGP</p>

                        </div>
                    <?php } ?>
                </div>
            </div>

            <!--   cart -->
            <div class="col-xl-4">
                <div class="container padding-bottom-3x mb-1">
                    <div class="form-group">
                        <label>Select User</label>
                        <select class="form-control" id="userId">
                            <?php foreach ($users as $user) { ?>
                                <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
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
                    <a class="btn btn-primary" onclick="sendOrder(getUserId())">Checkout</a>
                    <a class="btn btn-danger" onclick="clearCart()">Clear Cart</a>

                </div>
                <script src="/js/cart.js"></script>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            </div>
        </div>
    </div>
</section>
