<?php require_once APPROOT.'/views/inc/header.php' ?>

<div class="row">
    <div class="col-md-8">
        <?php foreach($data as $item): ?>
            <form action="<?= URLROOT ?>carts/dellCart/<?= $item->id ?>" method="POST" class="mb-3">
                <div class="border rounded">
                    <div class="row bg-white">
                        <div class="col-md-3">
                            <img class="img-fluid" src="<?= URLROOT.$item->image ?>" alt="">
                        </div>
                        <div class="col-md-6">
                            <h5 class="py-2"><?= $item->name ?></h5>
                            <small class="text-secondary">Seller: dailytuition</small>
                            <h5 class="py-3">$ <?= $item->price ?></h5>
                            <div class="mb-2">
                                <button type="submit" class="btn btn-warning" name="">Save for later</button>
                                <button type="submit" class="btn btn-danger mx-2" name="remove">Remove</button>
                            </div>
                        </div>
                        <div class="col-md-3 py-5">
                            <div>
                                <button type="button" class="btn bg-light border rounded-circle">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="text" class="form-control w-25 d-inline" value="1">
                                <button type="button" class="btn bg-light border rounded-circle">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>   
                </div>
            </form>
        <?php endforeach; ?>
    </div>
    <div class="col-md-4 border rounded bg-white h-25">
        <div class="pt-4">
            <h6>Price Details</h6>
            <hr>
            <div class="row price-details">
                <div class="col-md-6">
                    <h6>Price ($count items)</h6>
                    <h6>Delivery Charges</h6>
                    <hr>
                    <h6>Amount Payable</h6>
                </div>
                <div class="col-md-6">
                    <h6>2000</h6>
                    <h6 class="text-success">FREE</h6>
                    <hr>
                    <h6>2000</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once APPROOT.'/views/inc/footer.php' ?>