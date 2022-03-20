
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
                <th class="text-center">Quantity</th>
                <th class="text-center">Subtotal</th>
                <th class="text-center">Remove</a></th>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
