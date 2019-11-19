<?php
  include 'dbh.inc.php';
  include 'cart.inc.php';
  include 'item.inc.php';

  session_start();

  if(isset($_POST['submit'])) {
    $cart = new Cart();
    $aitem = new Item();
    $data = $cart->getAllCart();
    if(empty($data)) {
      //
    }else {
      foreach($data as $datas) {
        if($datas['cust_id'] == $_SESSION['id']) {
          $item = $cart->getItem($datas['item_id']);
          if($item['item_paid'] == 'N') {
            $aitem->markItemPaid($datas['item_id'], 'Y');
          }
        }
      }
    }
    header("Location: ../index.php?cart=success");
    exit();
  }else {
    header("Location: ../index.php?cart=failed");
    exit();
  }

 ?>
