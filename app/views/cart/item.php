<?php require_once APPROOT.'/views/inc/header.php' ?>
<div class="item-info">
    <a href="<?= URLROOT ?>carts/index" class="btn btn-secondary">Back</a>
    <div class="card">
        <div class="container-fliud">
            <form action="">
                <div class="wrapper row">
                    <div class="preview col-md-6">
                        <div class="preview-pic tab-content">
                            <div class="tab-pane active" id="pic-1"><img src="<?= URLROOT.$data['image'] ?>" /></div>
                            <div class="tab-pane" id="pic-2"><img src="http://placekitten.com/400/252" /></div>
                            <div class="tab-pane" id="pic-3"><img src="http://placekitten.com/400/252" /></div>
                            <div class="tab-pane" id="pic-4"><img src="http://placekitten.com/400/252" /></div>
                            <div class="tab-pane" id="pic-5"><img src="http://placekitten.com/400/252" /></div>
                        </div>
                        <ul class="preview-thumbnail nav nav-tabs">
                            <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="<?= URLROOT.$data['image'] ?>"/></a></li>
                            <li><a data-target="#pic-2" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
                            <li><a data-target="#pic-3" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
                            <li><a data-target="#pic-4" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
                            <li><a data-target="#pic-5" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
                        </ul>
                        
                    </div>
                    <div class="details col-md-6">
                        <h3 class="product-title"><?= $data['name'] ?></h3>
                        <div class="rating">
                            <div class="stars">
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                            <span class="review-no">0 reviews</span>
                        </div>

                        <p class="product-description"><?= $data['content'] ?></p>
                        <h2 class="price my-3">current price: <span>$<?= $data['price'] ?></span></h4>
                        <p class="vote"><strong>0%</strong> of buyers enjoyed this product! <strong>(0 votes)</strong></p>
                        <!-- <h5 class="sizes my-3">sizes:
                            <span class="size" data-toggle="tooltip" title="small">s</span>
                            <span class="size" data-toggle="tooltip" title="medium">m</span>
                            <span class="size" data-toggle="tooltip" title="large">l</span>
                            <span class="size" data-toggle="tooltip" title="xtra large">xl</span>
                        </h5>
                        <h5 class="colors my-3">colors:
                            <span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
                            <span class="color green"></span>
                            <span class="color blue"></span>
                        </h5> -->
                        <div class="star">
                            <ul class="nav">
                                <li class="nav-item"><span class="font-weight-bold mr-2 h5">Score -</span><li>
                                <li class="nav-item"><span class="fa fa-star mr-1"></span></li>
                                <li class="nav-item"><span class="fa fa-star mr-1"></span></li>
                                <li class="nav-item"><span class="fa fa-star mr-1"></span></li>
                                <li class="nav-item"><span class="fa fa-star mr-1"></span></li>
                                <li class="nav-item"><span class="fa fa-star mr-1"></span></li>
                                <li class="nav-item"><span></span></li>
                            </ul>
                            <input type="hidden" value="">
                        </div>
                        <div class="action">
                            <button class="add-to-cart btn btn-default" type="button">add to cart</button>
                            <!-- <button class="like btn btn-default" type="button"></button> -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once APPROOT.'/views/inc/footer.php' ?>