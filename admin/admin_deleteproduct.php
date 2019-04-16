<?php
require_once('scripts/config.php');
confirm_logged_in();

if (isset($_GET['delete'])) {
  $delete_product_id =  $_GET['delete'];
  deleteItem($delete_product_id);
}
