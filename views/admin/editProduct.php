<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Product</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" enctype="multipart/form-data" method="POST" action="/admin/products/edit">
                            <div class="card-body">
                                <input type="number" hidden name="id" value="<?= $product->id ?>">
                                <div class="form-group">
                                    <label for="name">Product</label>
                                    <input type="text" value="<?= $product->prd_name ?>" name="prd_name" class="form-control" id="name" placeholder="Enter your name" />
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" value="<?= $product->price ?>" step="0.01" name="price" class="form-control" id="price" placeholder="Enter price" />
                                </div>
                                <!-- select -->
                                <div class="form-group">
                                    <label>Select Category</label>
                                    <select class="form-control" name="cat_id" value="<?= $product->cat_id ?>">
                                        <option value="1">Hot Drinks</option>
                                        <option value="2">Soft Drinks</option>
                                        <option value="3">Ice Craem</option>
                                        <option value="4">Zbady khalat</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <img src="/uploads/<?= $product->image ?>" alt="#">
                                </div>
                                <div class="form-group">
                                    <label for="inputFile">Product Image</label>
                                    <input type="file" accept="image/png, image/gif, image/jpeg" id="avatar"
                                           name="image">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-default float-right">Reset</button>
                            </div>
                        </form>
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