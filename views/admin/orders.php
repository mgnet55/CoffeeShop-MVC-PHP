<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Users</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Order issued</th>
                                <th>Status</th>
                                <th>Details</th>
                                <th>Delete</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($orders as $order) { $processing=$order['order_status'];
                                if ($processing !== "done") {$processing="<a class='btn btn-primary' href='/admin/orders/done?id=".$order['id']."'>Set done</a>";}
                                ?>
                                <tr>
                                    <td><?= $order['id'] ?></td>
                                    <td><?= $order['name'] ?></td>
                                    <td><?= $order['total_amount'] ?></td>
                                    <td><?= $order['order_date'] ?></td>
                                    <td><?=$processing?></td>
                                    <td><a href='/admin/orders?id=<?= $order['id'] ?>' class='btn btn-info'>Details</a></td>
                                    <td><a href='/admin/orders/delete?id=<?= $order['id'] ?>' class='btn btn-danger'>Delete</a></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Room</th>
                                <th>Ext</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
