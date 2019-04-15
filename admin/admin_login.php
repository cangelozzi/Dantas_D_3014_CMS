<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
require_once 'scripts/config.php';

if (empty($_POST['username']) || empty($_POST['password'])) {
    $message = 'Please fill out all fields';
} else {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    //$_SERVER is not a very reliable varible for production
    $ip = $_SERVER["REMOTE_ADDR"];
    $message = login($username, $password, $ip);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/login.css">
  <title>Admin Login</title>
</head>
<body>

<div class="container-fluid">
  <div class="row no-gutter">
    <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image">

    </div>
    <div class="col-md-8 col-lg-6">
      <div class="login d-flex align-items-center py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-lg-8 mx-auto">
              <h3 class="login-heading mb-4">Welcome back!</h3>
              <?php if (!empty($message)): ?>
                <div class="alert alert-danger">
                  <p><?php echo $message ?></p>
                  </div>
                <?php endif;?>
              <form action="admin_login.php" method="post">
                <div class="form-label-group">
                  <input type="username" name="username" id="username" class="form-control" placeholder="Email address" required autofocus>
                  <label for="username">Username</label>
                </div>

                <div class="form-label-group">
                  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                  <label for="inputPassword">Password</label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Sign in</button>
                <div class="text-center">

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>