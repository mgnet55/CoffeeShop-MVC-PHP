<table class="table table-striped table-dark">
    <thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">Image</th>
        <th scope="col">Available</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($products as $product){?>
    <tr>
        <td scope="col"><?=$product->prd_name?></td>
    <td scope="col"><?=$product->price?></td>
    <td scope="col"><img width="50px" src="https://erasmusnation-com.ams3.digitaloceanspaces.com/woocommerce-placeholder.png"></td>
    <td scope="col"><?=$product->available ? 'Available': ".."?></td>
    <td><a href='/products/edit?id=<?=$product->id?>' class='btn btn-info'>Edit</a></td>
    <td><a href='/products/delete?id=<?=$product->id?>' class="btn btn-danger">Delete</a></td>
    </tr>
<?php } ?>

    </tbody>
</table>