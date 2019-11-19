<?php
  include 'dbh.inc.php';
  include 'item.inc.php';

  session_start();

  if(isset($_POST['submit'])) {
    if(isset($_SESSION['id'])) {
      $itemName = $_POST['item_name'];
      $itemPrice1 = $_POST['item_price_1'];
      $itemPrice2 = $_POST['item_price_2'];
      $itemType = $_POST['item_type'];
      $itemDesc = $_POST['item_desc'];

      $image = $_FILES['item_image']['name'];

      // image file directory
      $target = "../img/".basename($image);

      $item = new Item();
      $result = $item->insertItem($itemName, $itemDesc, $itemPrice1, $itemPrice2, $image, $itemType);

      if (move_uploaded_file($_FILES['item_image']['tmp_name'], $target)) {
        echo "Image uploaded successfully";
      }else{
        echo "Failed to upload image";
      }
      
      header("Location: ../index.php?item=added");
      exit();
    }else {
      header("Location: ../index.php?item=failed");
      exit();
    }
  }else {
    header("Location: ../index.php?item=failed");
    exit();
  }

 ?>
