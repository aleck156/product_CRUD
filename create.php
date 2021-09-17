<?php
  $pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // echo "<pre>";
  // var_dump($_SERVER);
  // echo "</pre>";
  // exit();

  if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = $_POST['title'];
    $image = $_POST['image'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $create_date = date('Y-m-d H:i:s');

    // using named parameters for safety reasons - no more sql injection
    $statement = $pdo->prepare("INSERT INTO products (title, image, description, price, create_date) 
      VALUES (:title, :image, :description, :price, :create_date)");

    $statement->bindValue(':title', $title);
    $statement->bindValue(':image', '');
    $statement->bindValue(':description', $description);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':create_date', $create_date);

    $statement->execute();
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
    <h1>Create new product</h1>

    <form action="create.php" method="POST">
      <div class="mb-3">
        <label>Product Image</label>
        <input type="file" class="form-control" name="image">
      </div>
      <div class="mb-3">
        <label>Product Title</label>
        <input type="text" class="form-control" name="title" required>
      </div>
      <div class="mb-3">
        <label>Product Description</label>
        <textarea type="text" class="form-control" name="description"></textarea>
      </div>
      <div class="mb-3">
        <label>Product Price</label>
        <input type="number" step="0.01" class="form-control" value="0.00" min="0.00" name="price" required>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

  </body>
</html>