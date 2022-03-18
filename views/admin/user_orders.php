<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>User Orders</h1>
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
                    echo "<h3>No Orders</h3>";
                }
                foreach ($orders as $order) { ?>
                    <div class="card card-primary shadow-none collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title"><?= $order->order_date ?></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        onClick="order_products(<?= $order->id ?>,orderId<?= $order->id ?>)"><i
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
    function order_products(index, panel) {
        console.log(index, panel);
        fetch(`/admin/orderdetails?id=${index}`)
            .then(response => response.json())
            .then((data) => {
                let html=''
                data.forEach(product => {
                html+=`<div class="card col-2 m-1">
                    <img class="card-img-top" src="${product['image']}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">${product['prd_name']}</h5>
                    </div>
                </div>
                `
                });
                panel.innerHTML=html;
            });
    }
</script>