<?php
require_once 'admin/scripts/config.php';
if (isset($_GET['id'])) {
    $tbl = 'tbl_product';
    $col = 'product_id';
    $value = $_GET['id'];
    $result = getSingle($tbl, $col, $value);
} else {
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include 'templates/header.html'?>

<div class="container">
  <div class="row">
    <div class="col-lg-12">
    <?php
$results = getSingle('tbl_product', 'product_id', $value);
while ($row = $results->fetch(PDO::FETCH_ASSOC)): ?>
      <h2><?php echo $row['product_name'] ?></h2>
      <img src="images/<?php echo $row['product_img']; ?>" alt="<?php echo $row['product_name']; ?>">
      <p><?php echo $row['product_description'] ?></p>
      <?php endwhile;?>

    </div>
  </div>
</div>
<?php include 'templates/footer.html'?>