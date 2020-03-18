<?php require_once APPROOT.'/views/inc/header.php' ?>
<?php flash('item_remove'); ?>
<?php flash('empty_cart'); ?>
<div class="row">
    <div class="col-md-8">
        <?php foreach($data as $item): ?>
            <div class="item" data-id="<?= $item->id ?>">
                <form action="<?= URLROOT ?>carts/dellCart/<?= $item->id ?>" method="POST" class="mb-3">
                    <div class="border rounded">
                        <div class="row bg-white">
                            <div class="col-md-3">
                                <img class="img-fluid" src="<?= URLROOT.$item->image ?>" alt="">
                            </div>
                            <div class="col-md-6">
                                <h5 class="py-2"><?= $item->name ?></h5>
                                <small class="text-secondary">Seller: dailytuition</small>
                                <h5 class="py-3">$<?= $item->price ?></h5>
                                <div class="mb-2">
                                    <button type="submit" class="btn btn-danger mx-2" name="remove">Remove</button>
                                </div>
                            </div>
                            <div class="col-md-3 py-5">
                                <div>
                                    <button type="button" class="btn bg-light border rounded-circle minus">
                                        <i class="fas fa-minus minus"></i>
                                    </button>
                                    <input type="text" class="form-control w-25 d-inline item-count" value="1" disabled>
                                    <button type="button" class="btn bg-light border rounded-circle plus">
                                        <i class="fas fa-plus plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>   
                    </div>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="col-md-4 border rounded bg-white h-25">
        <div class="pt-4">
            <h6>Price Details</h6>
            <hr>
            <form action="<?= URLROOT ?>carts/account" method="POST">
            <?php foreach($data as $item){ ?>
                  <input type="hidden" name="<?= $item->id ?>" data-id="<?= $item->id ?>" value="1" class="itemSelect">  
            <?php } ?>
            <div class="row">
                <div class="col-md-6">
                    <h6>Price (<span class="text-danger"><?= count($data) ?></span> items)</h6>
                    <h6>Delivery Charges</h6>
                    <hr>
                    <h6>Amount Payable</h6>
                </div>
                <div class="col-md-6 price-detail">
                    <h6 class="total-price">
                        <?php 
                            $price = 0;
                            foreach($data as $item){
                                $price += $item->price;
                            }
                            echo $price; 
                        ?>
                    </h6>
                    <h6 class="text-success">FREE</h6>
                    <hr>
                    <h6><?= $price ?></h6>
                    <input type="hidden" value="<?= $price ?>">
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success btn-block mb-2">Go to Pay</button>
            </form>
        </div>
    </div>
</div>
<?php require_once APPROOT.'/views/inc/footer.php' ?>