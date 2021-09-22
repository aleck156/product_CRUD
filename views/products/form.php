<?php if (!empty($errors)):?>
      <div class="alert alert-danger">
        <?php foreach ($errors as $i => $error): ?>
          <div><?php echo $error; ?></div>
        <?php endforeach;?>
      </div>
    <?php endif;?>

    <form method="POST" enctype="multipart/form-data">

      <?php if ($product['image']): ?>
        <img src="../<?php echo $product['image'];?>" class="thumb-image">
      <?php endif; ?>

      <div class="mb-3">
        <label>Product Image</label>
        <input type="file" class="form-control" name="image">
      </div>
      <div class="mb-3">
        <label>Product Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
      </div>
      <div class="mb-3">
        <label>Product Description</label>
        <textarea type="text" class="form-control" name="description"><?php echo $description; ?></textarea>
      </div>
      <div class="mb-3">
        <label>Product Price</label>
        <input type="number" step="0.01" class="form-control" value="<?php echo $price; ?>" min="0.00" name="price" >
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href='./index.php' class="btn btn-outline-success">Homepage</a>
    </form>