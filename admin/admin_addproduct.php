<?php
require_once 'scripts/config.php';
require_once 'scripts/connect.php';
confirm_logged_in();
$tbl = "tbl_categories";
$product_categories = getAll($tbl);
if (isset($_POST['submit'])) {
    // var_dump($_FILES['cover']);
    $cover = $_FILES['cover'];
    $title = trim($_POST['title']);
    $year = trim($_POST['year']);
    $run = trim($_POST['run']);
    $trailer = trim($_POST['trailer']);
    $release = trim($_POST['release']);
    $story = trim($_POST['story']);
    $genre = $_POST['genlist'];
    $result = addMovie($cover, $title, $year, $run, $trailer, $release, $story, $genre);
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
  <textarea name="desc" id="desc"></textarea>
  </div>
  <div class="form-group">
  <label for="price">Product Price:</label>
  <input type="text" name="price" id="price" value="">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Product Category</label>
    <select class="form-control" id="exampleFormControlSelect1">
      <option>--Select a Category--</option>
      <?php while ($row = $product_categories->fetch(PDO::FETCH_ASSOC)): ?>
      <option value="<?php echo $row['cat_id'] ?>"><?php echo $row['cat_name'] ?></option>
      <?php endwhile?>
    </select>
  </div>
  <button class="btn-primary" type="submit" name="submit">Add Product</button>
</form>
</div>
</body>
</html>
