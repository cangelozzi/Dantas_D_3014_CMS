<?php

  require_once('config.php');
  confirm_logged_in();

  if (isset($_GET['caller_id'])) {
      $action = $_GET['caller_id'];

      switch ($action) {
        case 'logout':
          logged_out();
          break;

      case 'delete':
        $id = $_GET['id'];
        deleteUser($id);
        break;
    }
  }
