<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once('scripts/config.php');
confirm_logged_in();
require_once('scripts/connect.php');
$id = $_SESSION['user_id'];
$tb1 = "tbl_user";
$col ="user_id";
// Get user info
$found_user_set = getSingle($tb1, $col, $id);

if(is_string($found_user_set)) {
  $message = "Failed to get the user info!";
}

if(filter_has_var(INPUT_POST,'submit')) {
  // var_dump($_POST);
  // sanitize user input
  $username = trim(htmlspecialchars($_POST['username']));
  $fname = trim(htmlspecialchars($_POST['fname']));
  $email = trim(htmlspecialchars($_POST['email']));
  $password = trim(htmlspecialchars($_POST['password']));
  // var_dump($username, $password, $email, $fname); exit;
  //Validation
  if(empty($_POST['username']) || empty($_POST['fname']))
  {
    $message = 'Please fill out all fields';
    
  }elseif(filter_var($email, FILTER_VALIDATE_EMAIL) === false)
  {
    $message = 'Please fill out all fields';
  }
  else
  {
    $result = editUser($username, $fname, $email, $password, $id);
    $message = $result;
  }
}

// var_dump($found_user);
// exit;


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,500" rel="stylesheet">
  <link rel="stylesheet" href="../css/main.css">
  <title>Edit User</title>
</head>
<body>
  <h1>Edit User</h1>
  <!-- Show error messages  -->
  <?php if(!empty($message)):?>
  <div class="message">
    <p><?php echo $message?></p>
    </div>
  <?php endif; ?>
  <div class="button">
    <li>
    <i class="fas fa-arrow-left"></i>
    <a href="index.php">Admin Dashboard</a>
  </li>
  </div>
  <!-- Show form only if user info is found -->
  <?php if($found_user = $found_user_set->fetch(PDO::FETCH_ASSOC)): ?>
  <form action="admin_edituser.php" method="post">
    <label for="first-name">First Name:</label>
     <input type="text" id="first-name" name="fname" value="<?php echo $found_user['user_fname'];?>">

    <label for="username">Username:</label>
     <input type="text" id="username" name="username" value="<?php echo $found_user['user_name'];?>">

    <label for="email">Email:</label>
     <input type="email" id="email" name="email" value="<?php echo $found_user['user_email'];?>">

  <label for="password">Password:</label>
  <input type="password" id="password" name="password">

    <button class="btn" type="submit" name="submit">Update</button>
  </form>
<?php endif; ?>
</body>
</html>