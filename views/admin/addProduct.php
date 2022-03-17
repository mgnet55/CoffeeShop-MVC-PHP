<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Product</h1>
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
                  <form id="quickForm" enctype="multipart/form-data" method="post" action="/admin/products/add">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="name">Product</label>
                        <input
                          type="text"
                          name="prd_name"
                          class="form-control"
                          id="name"
                          placeholder="Enter your name"/>
                      </div>
                      <div class="form-group">
                        <label for="price">Price</label>
                        <input
                          type="number"
                          step="0.01"
                          name="price"
                          class="form-control"
                          id="price"
                          placeholder="Enter price"
                        />
                      </div>
                      <!-- select -->
                      <div class="form-group">
                        <label>Select Category</label>
                        <select class="form-control" name="cat_id">
                            <?php foreach ($categories as $cat) {
                            echo "<option value='{$cat->id}'>{$cat->cat_name}</option>";
                              } ?>
                        </select>
                      </div>
                        <div class="form-group">
                            <label for="inputFile">Product Image</label>
                            <input type="file" accept="image/png, image/gif, image/jpeg" id="avatar"
                                   name="image" required>
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