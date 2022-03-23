
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

                <h1>Orders of <?=$user?></h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <?php
                if (!$orders) {
                    echo "<h3 class='text-danger'>No Orders</h3>";
                }
                foreach (array_reverse($orders) as $order) { ?>
                    <div class="card card-primary shadow-none collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title"><?= $order->order_date ?></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        onClick="order_products(<?= $order->id ?>,orderId<?= $order->id ?>,this)"><i
                                            class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="card-body" style="display: none;">
                            <h5>Total Amount <?= $order->total_amount ?> | Status <?= $order->order_status ?></h5>
                            <div class="row" id="orderId<?= $order->id ?>">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                <?php } ?>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<script>
    function order_products(index, panel,button) {
        console.log(index, panel);
        fetch(`/admin/orderdetails?id=${index}`)
            .then(response => response.json())
            .then((data) => {
                let html=''
                data.forEach(product => {
                html+=
                    `<div class="card col-2 m-1"><p class="card-header">${product['prd_name']}</p>
                        <div class="card-body">
                            <img class="card-img-top" src="/uploads/${product['image']}" alt="Card image cap">
                        </div>
                        <p class="card-footer">Quantity: ${product['quantity']}</p>
                    </div>
`
                });
                button.onclick ='';
                panel.innerHTML=html;
            });
    }
</script>