<?php require_once APPROOT.'/views/inc/header.php' ?>
<?php flash('item_has_been_add'); ?>
<?php flash('add_item_success'); ?>

<div class="row align-items-center">
    <div class="search-front">
		<h4 class="mb-0"><i class="fas fa-shopping-basket"></i></h4>
	</div>
	<div class="col-lg-6 col-12 col-sm-12">
		<form action="#" class="search">
			<div class="input-group w-100">
			    <input type="text" class="form-control" placeholder="Search Item...">
			    <div class="input-group-append">
			      <button class="btn btn-primary" type="submit">
			        <i class="fa fa-search"></i>
			      </button>
			    </div>
		    </div>
		</form> <!-- search-wrap .end// -->
	</div> <!-- col.// --></div> <!-- row.// -->
<nav class="navbar navbar-main navbar-expand-lg navbar-light border-bottom">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="main_nav">
        <ul class="navbar-nav">
            <!-- <li class="nav-item">
            <a class="nav-link pl-0" data-toggle="dropdown" href="#"><strong> <i class="fa fa-bars"></i> &nbsp  All category</strong></a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Foods and Drink</a>
                <a class="dropdown-item" href="#">Home interior</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Category 1</a>
                <a class="dropdown-item" href="#">Category 2</a>
                <a class="dropdown-item" href="#">Category 3</a>
            </div>
            </li> -->
            <li class="nav-item mr-2">
                <h5 class="nav-link mb-0">Categores</h5>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">All category</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Smart Phone</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Computer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Others</a>
            </li>
        </ul>
    </div> <!-- collapse .// -->
</nav>
<div class="container main-banner mt-3 mb-1">
    <div class="slider">
        <figure>
            <img src="<?= URLROOT ?>upload/banner1.jpg" alt="">
            <img src="<?= URLROOT ?>upload/banner2.jpg" alt="">
            <img src="<?= URLROOT ?>upload/banner1.jpg" alt="">
            <img src="<?= URLROOT ?>upload/banner3.jpg" alt="">
            <img src="<?= URLROOT ?>upload/banner1.jpg" alt="">
        </figure>
    </div>
    <!-- <div class="slider"> -->
        <!-- <img src="<?php //URLROOT."upload/banner2.jpg" ?>" class="img-fluid rounded"> -->
        <!-- <div class="img">
            <p>first</p>
        </div>
        <div class="img">
            <p>second</p>
        </div>
        <div class="img">
            <p>first</p>
        </div>
        <div class="img">
            <p>thrid</p>
        </div>
        <div class="img">
            <p>first</p>
        </div>
    </div> -->
</div> <!-- container //  -->
<div class="onsale mt-4">
    <h2 class="text-center" style="color:rgba(0,0,0,.5)">On Sales</h2>
    <hr>
    <div style="display: flex">
    <?php foreach($data['items'] as $items): ?>
    <form action="<?= URLROOT ?>carts/addItemTocart/<?= $items->id ?>" method="POST">
        <div class="card col m-1 border border-secondary" style="width: 17rem">
            <input type="hidden" name="product_id" value="<?= $this->id ?>">
            <img src="<?= URLROOT.$items->image ?>" class="card-img-top" style="width:160px;margin:0 auto" alt="...">
            <hr>
            <div class="card-body">
                <a href="<?= URLROOT ?>carts/index/<?= $items->id ?>"><h5 class="card-title"><?= $items->name ?></h5></a>
                <h6 class="card-subtitle mb-2 mt-2">$ <?= $items->price ?></h6>
                <!-- <p class="card-text">
                    <?php 
                    // if(strlen($items->content) > 60){
                    //     echo substr($items->content, 0, 60).'......';
                    // }else{
                    //     echo $items->content;
                    // }
                    ?>
                </p> -->
                <button class="btn btn-warning text-white mx-auto" type="submit" name="addItem">Add To Cart</button>
            </div>
        </div>
    </form>
    <?php endforeach; ?>
    </div>
</div>
<div class="mt-4"  style="color:rgba(0,0,0,.5)">
    <h2 class="text-center">Smart Phone</h2>
    <hr>
</div>
<div class="mt-4" style="color:rgba(0,0,0,.5)">
    <h2 class="text-center">Computer</h2>
    <hr>
</div>
<div class="mt-4" style="color:rgba(0,0,0,.5)">
    <h2 class="text-center">Others</h2>
    <hr>
</div>
<?php require_once APPROOT.'/views/inc/footer.php' ?>