<?php
function createUser($username, $fname, $email)
{
    require_once('connect.php');


    // CHECK IF USERNAME ALREADY EXISTS
    $check_user_exists_query = "SELECT COUNT(*) FROM tbl_user WHERE user_name = :username";
    $check_user_exists = $pdo->prepare($check_user_exists_query);
    $check_user_exists->execute(
        array(
      ':username'=> $username
    )
  );
    $check_user = $check_user_exists->fetchColumn();
    // IF USERNAME EXISTS SEND BACK A MESSAGE ALERTING USER
    if ($check_user > 0) {
        $message = "This username already exists, please choose a different one.";
        return $message;
    }
    //GENERATE PASSWORD
    $psw = generate_password();
  
    //HASH PASSWORD
    $password =  password_hash($psw, PASSWORD_DEFAULT);
    // CREATE USER
    $create_user_query = "INSERT INTO tbl_user (user_fname, user_name, user_pass, user_email) VALUES (:fname, :username, :password, :email)";
    $create_user = $pdo->prepare($create_user_query);
    $create_user->execute(
        array(
      ":fname" => $fname,
      ":username" => $username,
      ":password" => $password,
      ":email" => $email
    )
    );
    //? or you could store in a variable and check the result as an interger
    //? $count = $create_user->rowCount();
    // if there is more than 0 rows being affected by the query then user was saved and send an email with user info
    if ($create_user->rowCount()) {
        $message = send_email($username, $fname, $email, $psw);
        // echo $username;
        // echo $psw;
        // redirect_to('index.php');
        Header('Location:index.php?success= '.$psw);
    } else {
        $message = "Create User Failed";
        return $message;
    }
}
function editUser($username, $fname, $email, $password, $id)
{
    include 'connect.php';
  
    $psw =  password_hash($password, PASSWORD_DEFAULT);
 
    // UPDATE USER
    $update_user_query = "UPDATE tbl_user SET user_fname = :fname, user_name = :username, user_pass = :password , user_email = :email WHERE user_id = :id";
    $update_user = $pdo->prepare($update_user_query);
    $update_user->execute(
        array(
      ":fname" => $fname,
      ":username" => $username,
      ":password" => $psw,
      ":email" => $email,
      ":id" => $id
    )
    );
    if ($update_user->rowCount()) {
        $message = "User Updated Successfully";
        return $message;
    // redirect_to('index.php');
    } else {
        $message = "Update User Failed";
        return $message;
    }
}

function deleteUser($id)
{
    include 'connect.php';
  
    $delete_user_query = "DELETE FROM tbl_user WHERE user_id = :id";
    $delete_user = $pdo->prepare($delete_user_query);
    $delete_user->execute(
        array(
        ':id' => $id
      )
    );

    if ($delete_user) {
        redirect_to('../index.php');
    } else {
        $message = "Unable to Delete User";
        return $message;
    }
}
