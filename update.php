<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_crud','root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['id'] ?? null;

if (!$id){
  header('Location: index.php');
  exit;
}

$statement = $pdo->prepare("SELECT * FROM products WHERE id = :id");
$statement->bindValue(':id', $id);
$statement->execute();
$product = $statement->fetch(PDO::FETCH_ASSOC);

$errors = [];
$title = $product['title'];
$price = $product['price'];
$description = $product['description'];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  $title = $_POST['title'];
  $image = $_POST['image'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $id = $_POST['id'];

  //  echo "<pre>";
  // var_dump($_POST);
  // echo "</pre>";
  // exit();


  if (!$title){
    $errors[] = "Product title is required!";
  }

  if (!$price){
    $errors[] = "Product price is required!";
  }

  if (!is_dir('images')){
    mkdir('images');
  }

  if (empty($errors)) {
    $image = $_FILES['image'] ?? null;
    $imagePath = $products['image'];

    if ($product['image']){
      unlink($product['image']);
    }

    if ($image && $image['tmp_name']){
      $imagePath = 'images/'.randomString(8).'/'.$image['name'];
      mkdir(dirname($imagePath));
      move_uploaded_file($image['tmp_name'], $imagePath);
    }

    // using named parameters for safety reasons - no more sql injection
    $statement = $pdo->prepare("UPDATE products 
          SET 
            title = :title,
            image = :image,
            description = :description,
            price = :price 
          WHERE
            id = :id");
    $statement->bindValue(':id', $id);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':image', $imagePath);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':price', $price);

    $statement->execute();
    header('Location: index.php');
  }
}

function randomString($n) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $str = '';
  for ($i = 0; $i < $n ; $i++){
    $index = rand(0, strlen($characters) - 1);
    $str .= $characters[$index];
  }
  return $str;
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="app.css">
    <title>Products CRUD App</title>
  </head>
  <body>
    <h1>Update Product <i><?php echo $product['title']; ?></i> Info</h1>

    <p>
      <a href="create.php" class='btn btn-success'>Update Product Info</a>
    </p>

    <?php if (!empty($errors)):?>
      <div class="alert alert-danger">
        <?php foreach ($errors as $i => $error): ?>
          <div><?php echo $error; ?></div>
        <?php endforeach;?>
      </div>
    <?php endif;?>

    <form method="POST" enctype="multipart/form-data">

      <?php if ($product['image']): ?>
        <img src="<?php echo $product['image'];?>" class="thumb-image">
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
        <textarea type="text" class="form-control" name="description" value="<?php echo $description; ?>"></textarea>
      </div>
      <div class="mb-3">
        <label>Product Price</label>
        <input type="number" step="0.01" class="form-control" value="<?php echo $price; ?>" min="0.00" name="price" >
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href='./index.php' class="btn btn-outline-success">Homepage</a>
    </form>

  </body>
</html>