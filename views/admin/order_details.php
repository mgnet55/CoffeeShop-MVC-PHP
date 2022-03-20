<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Order Details</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <?php foreach($products as $product){ ?>
            <div class="card col-lg-2 col-m-4 col-s-6 m-1">
                <h5 class="card-header"><?=$product['prd_name']?></h5>
                <img class="card-img-top" src="/uploads/<?=$product['image']?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Qty: <?=$product['quantity']?></h5>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
