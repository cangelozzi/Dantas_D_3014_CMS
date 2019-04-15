<?php


function addProduct($image, $title, $desc, $price, $category)
{
  try {
    include 'connect.php';

    $product_name = htmlspecialchars($title);

    //! image file information
    $product_image_name = $image['name'];
    $product_image_temp = $image['tmp_name'];
    $product_image_size = $image['size'];
    $product_image_error = $image['error'];
    $product_image_type = $image['type'];

    // 1. check FILE extension
    $file_extension = strtolower(pathinfo($product_image_name, PATHINFO_EXTENSION));
    $accepted_extensions = array('gif', 'jpg', 'jpe', 'jpeg', 'png', 'JPG');
    if (!in_array($file_extension, $accepted_extensions)) {
      throw new Exception('Wrong file type!');
    }

    // 2. check FILE error
    if ($product_image_error !== 0) {
      throw new Exception('Error in uploading, file size can be too big!');
    }

    // 3. assign FILE unique name (based on microsecond actual timeformat)
    $product_image = time() . '_' . rand(1000, 9999) . "." . $file_extension;

    // 4. resize image
    $folderPath = "../images/thumbs/";
    $sourceProperties = getimagesize($product_image_temp);
    $imageType = $sourceProperties[2];

    switch ($imageType) {

      case IMAGETYPE_PNG:

        $imageResourceId = imagecreatefrompng($product_image_temp);
        $targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
        imagepng($targetLayer, $folderPath . "th_" . $product_image);

        $product_resized_image = "th_" . $product_image;

        break;

      case IMAGETYPE_GIF:

        $imageResourceId = imagecreatefromgif($product_image_temp);
        $targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
        imagegif($targetLayer, $folderPath . "th_" . $product_image);

        $product_resized_image = "th_" . $product_image;

        break;

      case IMAGETYPE_JPEG:

        $imageResourceId = imagecreatefromjpeg($product_image_temp);
        $targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
        imagejpeg($targetLayer, $folderPath . "th_" . $product_image);

        $product_resized_image = "th_" . $product_image;

        break;

      default:

        echo "Invalid Image type.";

        exit;

        break;
    }

    // move img from temporary location to images folder
    move_uploaded_file($product_image_temp, "../images/$product_image");

    $product_content = htmlspecialchars( $desc);

    $insert_product_query = 'INSERT INTO tbl_product(product_name, product_description,';
    $insert_product_query .= ' product_img, product_price)';
    $insert_product_query .= ' VALUES(:product_name, :product_description, :product_img,';
    $insert_product_query .= ' :product_price)';

    $insert_product  = $pdo->prepare($insert_product_query);
    $insert_result = $insert_product->execute(
      array(
        ':product_name'     => $title,
        ':product_description'     => $product_content,
        ':product_img'      => $product_image,
        ':product_price'   => $price
      )
    );

    if (!$insert_result) {
      throw new Exception('Failed to insert the new product!');
    }

    $last_id = $pdo->lastInsertId();
    $insert_cat_query = 'INSERT INTO tbl_prod_cat(product_id, cat_id) VALUES(:product_id, :cat_id)';
    $insert_cat       = $pdo->prepare($insert_cat_query);
    $insert_cat->execute(
      array(
        ':product_id' => $last_id,
        ':cat_id'  => $category,
      )
    );
    if (!$insert_cat->rowCount()) {
      throw new Exception('Failed to set Category!');
    }
    //5. If all of above works fine, redirect user to index.php
    redirect_to('index.php');
  } catch (Exception $e) {
    $error = $e->getMessage();
    return $error;
  }
}
