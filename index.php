<?php
  $pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $statement = $pdo->prepare('SELECT * FROM products ORDER BY create_date DESC');

  $statement->execute();
  $products = $statement->fetchAll(PDO::FETCH_ASSOC);
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
    <h1>Products CRUD App</h1>

    <p>
      <a href="create.php" class='btn btn-success'>Create New Product</a>
    </p>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">PID</th>
          <th scope="col">Image</th>
          <th scope="col">Title</th>
          <th scope="col">Price</th>
          <th scope="col">Create Date</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($products as $i => $product): ?>
              <tr>
                <th scope="row"><?php echo $i+1 ?></th>
                <td><?php echo $product['id'] ?></td>
                <td>
                  <img src="<?php echo $product['image'] ?>" alt="" class='thumb-image'>
                </td>
                <td><?php echo $product['title'] ?></td>
                <td><?php echo $product['price'] ?></td>
                <td><?php echo $product['create_date'] ?></td>
                <td>
                  <a href="update.php?id=<?php echo $product['id']?>" type="button" class="btn btn-sm btn-outline-secondary">Update</a>
                  <button type="button" class="btn btn-sm btn-outline-primary">Edit</button>
                  <form style="display:inline-block" action="delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $product['id']?>">
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                  </form>
                </td>
            </tr>
            <?php endforeach; ?>
      </tbody>
    </table>

  </body>
</html>