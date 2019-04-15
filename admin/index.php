<?php
require_once 'scripts/config.php';
confirm_logged_in();
greeting();
if (isset($_GET['add'])) {
    echo "<div class='alert alert-success' role='alert'>Product Added Successfully!</div>";
} elseif (isset($_GET['edit'])) {
    echo "<div class='alert alert-success' role='alert'>Product Edited Successfully!</div>";
}
$products = getAll('tbl_product');
$message = greeting();
$date = date_create($_SESSION['user_login_time']);
$readable_date = (date_format($date, ' l jS F Y \a\t g:ia'));
if (isset($_GET['success'])) {
    echo "<h3 style='color:red;'>This: <span style='color:blue;'>" . $_GET['success'] . "</span> is the system generated password for the new user. Make sure to copy it to be able to login and change it later.</h3>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="../css/login.css"> -->
  <title>Admin Dashboard</title>
</head>

<body id="admin-dash">
  <div class="jumbotron">
    <h1 class="display-4 text-info">Admin Dashboard</h1>
    <hr class="my-4">
    <h2 class="text-muted">Welcome <?php echo $_SESSION['user_name']; ?></h2>
    <h3 class="text-muted"> <?php echo $message; ?></h3>
    <h4 class="text-muted">Your Last Login Was on <?php echo $readable_date; ?></h4>

  </div>


  <nav>
    <ul>
      <li><a href="admin_createuser.php">Create User</a></li>
      <li><a href="admin_edituser.php">Edit User</a></li>
      <li><a href="admin_deleteuser.php">Delete User</a></li>
      <li><a href="scripts/caller.php?caller_id=logout">Sign Out</a></li>
    </ul>
    <ul>
      <li><a href="admin_addproduct.php">Add Product</a></li>
    </ul>
  </nav>

  <div style="display: grid; grid-template-columns: auto auto auto;" class="container">
    <?php while ($row = $products->fetch(PDO::FETCH_ASSOC)): ?>
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="../images/<?php echo $row['product_img']; ?>" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
          <p class="card-text"><?php echo trim_length($row['product_description'], 100); ?></p>
          <a href="admin_editproduct.php/?product=<?php echo $row['product_id'] ?>" class="btn btn-primary">Edit</a>
          <a href="admin_deleteproduct.php" class="btn btn-danger">Delete</a>
        </div>
      </div>
    <?php endwhile;?></div>
