<?php require APPROOT.'/views/inc/header.php' ?>

<h1>Dashbord</h1>
<div style="width:60%">
<form action="<?= URLROOT ?>carts/dashbord" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="" class="h6">Item Name</label>
    <input type="text" 
           name="name" 
           class="form-control <?= !empty($data['itemNameErr']) ? 'is-invalid' : '' ?>" 
           value="<?= !empty($data['itemName']) ? $data['itemName'] : "" ?>"
           placeholder="Product Name"
           id="">
    <span class="invalid-feedback font-weight-bold"><?= '! '.$data['itemNameErr'] ?></span>
  </div>
  <div class="form-group">
    <label for="" class="h6">Price</label>
    <input type="text" 
           name="price" 
           class="form-control <?= !empty($data['itemPriceErr']) ? 'is-invalid' : '' ?>" 
           value="<?= !empty($data['itemPrice']) ? $data['itemPrice'] : ""; ?>"
           placeholder="Product Price"
           id="">
    <span class="invalid-feedback font-weight-bold"><?= '! '.$data['itemPriceErr'] ?></span>
  </div>
  <div class="form-group">
    <label for="" class="h6">Category</label>
    <select class="custom-select <?= !empty($data['categoriesErr']) ? 'is-invalid' : '' ?>" name="category">
      <option <?= empty($data['category']) ? "selected" : '' ?> value="">Choose Categories...</option>
      <?php foreach($data['categories'] as $category): ?>
        <option value="<?= $category ?>" <?= !empty($data['category']) && strtolower($data['category']) == $category ? "selected" : '' ?>><?= ucfirst($category) ?></option>
      <?php endforeach; ?>
    </select>
    <span class="invalid-feedback font-weight-bold"><?= '! '.$data['categoriesErr'] ?></span>
  </div>
  <div class="form-group" id="images">
    <label for="" class="h6">Item Image</label>
    <?php if(empty($data['itemImage'])): ?>
      <input type="file" name="image[]" class="form-control mb-2" value="">
    <?php else: ?>
      <?php for($i = 0;$i < count($data['itemImage']); $i++): ?>
        <input type="file" name="image[]" class="form-control mb-2 <?= !empty($data['itemImageErr'][$i]) ? 'is-invalid' : '' ?>">
        <?php if(!empty($data['itemImageErr'])): ?>
          <span class="invalid-feedback font-weight-bold"><?= '! '.$data['itemImageErr'][$i] ?></span>
        <?php endif ?>
      <?php endfor; ?>
    <?php endif; ?>
    <button class="btn btn-success btn-sm mt-3 moreImage">More Image</button>
  </div>
  <div class="form-group">
      <label for="" class="h6">Content</label>
      <textarea class="form-control" name="content" id="" cols="30" rows="10"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>


<?php require APPROOT.'/views/inc/footer.php' ?>