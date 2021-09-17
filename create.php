<?php
  $pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // echo "<pre>";
  // var_dump($_POST);
  // echo "</pre>";

  $title = $_POST['title'];
  $description = $_POST['description'];
  $price = $_POST['price'];
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