<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once('scripts/config.php');
confirm_logged_in();
// require_once('scripts/connect.php');
$tbl = "tbl_user";
$get_users = getAll($tbl);
$users = array();
// When using fetch it gets the first row in the db with the loop it goes through all the users in the table.
// while ($user = $get_users->fetch(PDO::FETCH_ASSOC)) {
//     $users[] = $user;
// }

// var_dump($users);



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
  <title>Delete User</title>
</head>
<body>
  <h2>Delete User</h2>
  
<table class="table">
  <thead>
    <tr>
      <th>User Firt Name </th>
      <th>User Name </th>
      <th>User Email</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
  <?php while ($user= $get_users->fetch(PDO::FETCH_ASSOC)): ?>
    <tr>
      <td> <?php echo $user['user_fname'];?></td>
      <td> <?php echo $user['user_name'];?></td>
      <td><?php echo $user['user_email'];?></td>
      <td><a href="scripts/caller.php?caller_id=delete&id=<?php echo $user['user_id'];?>">Delete User</a></td>
    </tr>
  <?php endwhile; ?>
  </tbody>
</table>
  

</body>
</html>