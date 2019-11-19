<?php
  include 'dbh.inc.php';
  include 'cart.inc.php';
  include 'item.inc.php';

  session_start();

  if(isset($_POST['submit'])) {
    if(isset($_SESSION['id'])) {
      if(isset($_POST['itemid'])) {
        $custId = $_SESSION['id'];
        $itemId = $_POST['itemid'];

        $cart = new Cart();
        $item = new Item();
        $cart->insertCart($custId, $itemId);
        $item->markItemSold($itemId, 'Y');
        header("Location: ../index.php?cart=addsuccess&storename=".$_POST['storename']);
        exit();
      }else {
        header("Location: ../index.php?cart=faileditemid");
        exit();
      }
    }else {
      header("Location: ../index.php?cart=failedcustid");
      exit();
    }
  }else {
    header("Location: ../index.php?cart=failed");
    exit();
  }

 ?>
