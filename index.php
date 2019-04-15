<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
require_once 'admin/scripts/config.php';
$categories = getAll('tbl_category');
if (isset($_GET['filter'])) {
  $tbl = 'tbl_product';
  $tbl_2 = 'tbl_category';
  $tbl_3 = 'tbl_prod_cat';
  $col = 'product_id';
  $col_2 = 'cat_id';
  $col_3 = 'cat_name';
  $filter = $_GET['filter'];
  $results = filterResults($tbl, $tbl_2, $tbl_3, $col, $col_2, $col_3, $filter);
  // var_dump($results);exit;
} else {
  $results = getAll('tbl_product');
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include 'templates/header.html' ?>

<body>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">Sports Check</h1>
        <div class="list-group">
          <?php while ($row = $categories->fetch(PDO::FETCH_ASSOC)) : ?>

            <a href="index.php?filter=<?php echo $row['cat_name']; ?>" class="list-group-item"><?php echo $row['cat_name']; ?></a>
          <?php endwhile; ?>
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="images/Sportcheck-01.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="images/Sportcheck-02.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="images/Sportcheck-03.jpg" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <div class="row">
          <?php while ($row = $results->fetch(PDO::FETCH_ASSOC)) : ?>
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">
                <a href="details.php?id=<?php echo $row['product_id']; ?>"><img class="card-img-top" src="images/<?php echo $row['product_img']; ?>" alt="<?php echo $row['product_name']; ?>"></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="details.php?id=<?php echo $row['product_id']; ?>"><?php echo $row['product_name']; ?></a>
                  </h4>
                  <h5><?php echo $row['product_price']; ?></h5>
                  <p class="card-text"><?php echo trim_length($row['product_description'], 150); ?>
                  </p>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <?php include 'templates/footer.html' ?>