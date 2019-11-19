<?php

  class ViewCart extends Cart {

    public function showAllCart() {
      $data = $this->getAllCart();

      foreach($datas as $data) {
        echo $datas['item_id'];
      }
    }

    public function showCartSummary($cust_id) {
      $data = $this->getAllCart();
      if(empty($data)) {

      }else {
        $totalPrice = 0;
        $totalItem = 0;
        foreach($data as $datas) {
          if($datas['cust_id'] == $cust_id) {
            $item = $this->getItem($datas['item_id']);
            if($item['item_paid'] == 'N') {
              $totalItem++;
              $totalPrice+=$item['item_price'];
            }
          }
        }
        echo "
        <div id='cartsummary' class='card col-md-2 mb-3 bg-dark text-light'>
          <div class='card-body'>
            <h5 class='card-title'>CART SUMMARY</h5>
            <div class='line'></div>
            <p class='card-text text-justify'>Total Item: ".$totalItem."</p>
            <p class='card-text text-justify'>Total Price: RM".$totalPrice."</p>
          </div>
          <form action='include\cartpay.php' method='POST'>
            <input type='submit' class='btn btn-outline-light btn-block mb-3' name='submit' value='Comfirm Purchase'>
          </form>
        </div>";
      }
    }

    public function showAllCartCard($cust_id) {
      $data = $this->getAllCart();
      if(empty($data)) {
        echo "
        <div class='container col-md-6'>
          <img class='col-centered ' src='img\\empty_cart.png' alt='icon'>
          <p class='card-text text-muted mb-4'>Your cart is currently empty...</p>
        </div>";
      }else {
        foreach($data as $datas) {
          if($datas['cust_id'] == $cust_id) {
            $item = $this->getItem($datas['item_id']);
            echo "<div class='card-body col-sm-3'>";
              echo "<img class='card-img-top mt-3' src='img/".$item['item_image']."'alt='Card image cap'>";
              if($item['item_paid'] == 'N') {
                echo "<form action='include\cartremove.php' method='POST'>";
                  echo "<input type='hidden' name='itemid' value='".$datas['item_id']."'>";
                  //echo "<input type='hidden' name='storename' value='".$datas['item_type']."'>";
                  echo "<input type='submit' class='btn btn-dark btn-block' name='submit' value='Remove from cart'>";
                echo "</form>";
              }else {
                echo "<input type='submit' class='btn btn-dark btn-block' name='submit' value='Paid' disabled>";
              }
              echo "<h5 class='card-title mt-1 mb-0'>NAME: " .strtoupper($item['item_name']). "</h5>";
              echo "<p class='card-text pt-2 mb-1'><kbd>Price: RM" .$item['item_price']. "</kbd></p>";
              echo "<p class='card-text pt-2 mb-1'>Description: " .$item['item_desc']. "</p>";
            echo "</div>";
          }
        }
      }
    }
  }

?>
