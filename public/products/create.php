<?php
  
  /** @var $pdo \PDO */
  require_once "../../database.php";
  require_once "../../functions.php";

  // echo "<pre>";
  // var_dump($_SERVER);
  // echo "</pre>";
  // exit();

  $errors = [];
  $title = '';
  $price = '';
  $description = '';
  $product = [
    'image' => '',
    'title' => '',
    'price' => '',
    'description' => ''
  ];

  if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    require_once "../../validate_product.php";
    
    if (empty($errors)) {
      // using named parameters for safety reasons - no more sql injection
      $statement = $pdo->prepare("INSERT INTO products (title, image, description, price, create_date) 
      VALUES (:title, :image, :description, :price, :create_date)");

      $statement->bindValue(':title', $title);
      $statement->bindValue(':image', $imagePath);
      $statement->bindValue(':description', $description);
      $statement->bindValue(':price', $price);
      $statement->bindValue(':create_date', date('Y-m-d H:i:s'));

      $statement->execute();
      header('Location: index.php');
    }
  }



?>

<?php include_once "../../views/partials/header.php"?>

    <h1>Create new product</h1>

    <?php include_once "../../views/products/form.php"; ?>

  </body>
</html>