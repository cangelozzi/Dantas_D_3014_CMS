<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once 'scripts/config.php';
confirm_logged_in();
require_once 'scripts/connect.php';
if (isset($_GET['product'])) {
  $id = $_GET['product'];
}
$tb1 = "tbl_product";
$col = "product_id";
// Get product info
$found_product = getSingle($tb1, $col, $id);
// Get categories
$tbl = "tbl_category";
$product_categories = getAll($tbl);
// Get prod category info
$get_prod_category = "SELECT cat_id FROM tbl_prod_cat WHERE product_id = :id";
$prod_category = $pdo->prepare($get_prod_category);
$prod_category->execute(
  array(
    ':id' => $id,
  )
);
$get_prod_cat = $prod_category->fetch(PDO::FETCH_ASSOC);
$prod_cat = $get_prod_cat['cat_id'];
// var_dump($prod_cat);
// Get prod_at_name
$col2 = "cat_id";
$get_prod_category = getSingle($tbl, $col2, $prod_cat);
$prod_cat_name = $get_prod_category->fetch(PDO::FETCH_ASSOC);
// var_dump($prod_cat_name);
if (is_string($found_product)) {
  $message = "Failed to get the user info!";
}
if (isset($_POST['product_update'])) {
  // var_dump($_FILES['cover']);
  $image = $_FILES['image'];
  $title = trim($_POST['title']);
  $desc = trim($_POST['desc']);
  $price = trim($_POST['price']);
  $category = trim($_POST['category']);
  $result = editProduct($image, $title, $desc, $price, $category);
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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <title>Edit Product</title>
</head>

<body>
  <?php if (!empty($message)) : ?>
    <p><?php echo $message ?></p>
  <?php endif; ?>
  <br>
  <div class="container">
    <a class="btn btn-outline-info" href="./index.php" role="button"><i class="fas fa-arrow-left"></i> Admin Dashboard</a>
    <br><br>
    <h1>Edit Product</h1>
    <?php if ($product = $found_product->fetch(PDO::FETCH_ASSOC)) : ?>
      <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
          <div>
            <img style="width: 100px;" src="../images/<?php echo $product['product_img']; ?>" alt="<?php echo $product['product_name'] ?>">
          </div>
          <label for="image">Product Image:</label>
          <input type="file" name="image" id="image" value="" required>
        </div>
        <div class="form-group">
          <label for="title">Product Title:</label>
          <input required class="form-control" rows="2" type="text" name="title" id="title" value="<?php echo $product['product_name'] ?>">
        </div>
        <div class="form-group">
          <label for="desc">Product Description:</label>
          <textarea required class="form-control" rows="3" name="desc" id="desc"><?php echo $product['product_description'] ?></textarea>
        </div>
        <div class="form-group">
          <label for="price">Product Price:</label>
          <input required class="form-control" rows="1" type="text" name="price" id="price" value="<?php echo $product['product_price'] ?>">
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
        <button class="btn btn-primary mb-2" type="submit" name="product_update">Edit Product</button>
      </form>
    </div>
  <?php endif; ?>
</body>

</html>