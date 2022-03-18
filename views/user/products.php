<div class="new-arrival new-arrival2">
    <div class="row">
        <?php foreach($products as $product){ ?>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="single-new-arrival mb-50 text-center">
                <div class="popular-img">
                    <img src="/uploads/<?=$product->image?>" alt="product">
                    <div class="favorit-items"><img src="/uploads/favorit-card.png" alt=""></div>
                </div>
                <div class="popular-caption">
                    <h3><?=$product->prd_name?></h3>
                    <span>$ <?=$product->price?></span>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>