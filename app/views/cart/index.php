<?php require_once APPROOT.'/views/inc/header.php' ?>
<div class="row py-5">
    <?php foreach($data['items'] as $items): ?>
    <form action="#" method="POST">
        <div class="card col m-1 border border-secondary" style="width: 17rem;height:500px">
            <input type="hidden" name="product_id" value="<?= $this->id ?>">
            <img src="<?= URLROOT.$items->image ?>" class="card-img-top" alt="...">
            <hr>
            <div class="card-body">
                <a href="#"><h5 class="card-title"><?= $items->name ?></h5></a>
                <h6 class="card-subtitle mb-2 mt-2">$ <?= $items->price ?></h6>
                <p class="card-text">
                    <?php if(strlen($items->content) > 60){
                        echo substr($items->content, 0, 60).'......';
                    }else{
                        echo $items->content;
                    }?>
                </p>
                <button class="btn btn-warning text-white mx-auto" type="submit" name="addCart">Add To Cart</button>
            </div>
        </div>
    </form>
    <?php endforeach; ?>
</div>

<?php require_once APPROOT.'/views/inc/footer.php' ?>