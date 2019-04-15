<?php
require_once 'scripts/config.php';
require_once 'scripts/connect.php';
confirm_logged_in();
$tbl = "tbl_category";
$product_categories = getAll($tbl);
if (isset($_POST['submit'])) {
  // var_dump($_FILES['cover']);
  $image = $_FILES['image'];
  $title = trim($_POST['title']);
  $desc = trim($_POST['desc']);
  $price = trim($_POST['price']);
  $category = trim($_POST['category']);
  $result = addProduct($image, $title, $desc, $price, $category);
  $message = $result;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <title>Add Products</title>
</head>

<body>
  <div class="container">
    <h1>Add Products</h1>
    <form action="admin_addproduct.php" method="post" enctype="multipart/form-data">

      <div class="form-group">
        <label for="image">Product Image:</label>
        <input type="file" name="image" id="image" value="">
      </div>
      <div class="form-group">
        <label for="title">Product Title:</label>
        <input type="text" name="title" id="title" value="">
      </div>
      <div class="form-group">
        <label for="desc">Product Description:</label>
        <textarea class="form-control" name="desc" id="desc" rows="3"></textarea>
      </div>
      <div class="form-group">
        <label for="price">Product Price:</label>
        <input type="text" name="price" id="price" value="">
      </div>
      <div class="form-group">
        <label for="category">Product Category</label>
        <select class="form-control" id="category" name="category">
          <option>--Select a Category--</option>
          <?php while ($row = $product_categories->fetch(PDO::FETCH_ASSOC)) : ?>
            <option value="<?php echo $row['cat_id'] ?>"><?php echo $row['cat_name'] ?></option>
          <?php endwhile ?>
        </select>
      </div>
      <button class="btn btn-primary mb-2" type="submit" name="submit">Add Product</button>
    </form>
  </div>
</body>

</html>