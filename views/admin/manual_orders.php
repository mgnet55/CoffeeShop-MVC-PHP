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

<div class="form-group col-md-4" >
    <label>Select User</label>
    <select class="form-control">
        <?php foreach($users as $user){ ?>
        <option value="<?=$user['id']?>"><?=$user['name']?></option>
        <?php } ?>
    </select>
</div>

            <div class="card-body">
                <div class="row"">
                <?php foreach($products as $product){ ?>
                    <div class="card col-1 m-1">
                        <img class="card-img-top" src="<?=$product['image'] ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?=$product['prd_name'] ?></h5>
                            <h5 class="card-title"><?=$product['price'] ?></h5>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>



        </div>
    </div>
</section>
