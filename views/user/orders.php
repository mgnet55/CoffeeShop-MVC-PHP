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
                foreach (array_reverse($orders) as $order) { ?>
                    <div class="card card-primary shadow-none collapsed-card">
                        <div class="card-header">
                            <p class="card-title"><?= $order->order_date ?></p>
                                <button type="button" class="btn btn-primary" data-card-widget="collapse"
                                        onClick="order_products(<?= $order->id ?>,orderId<?= $order->id ?>,this)">
                                    <i class="fas fa-plus"></i>
                                </button>
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
<script src="/js/order_details.js"></script>