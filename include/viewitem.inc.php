<?php

  class ViewItem extends Item {

    public function showAllItem() {
      $data = $this->getAllItem();

      foreach($datas as $data) {
        echo $datas['item_id'];
      }
    }

    private function searchAItem($itemid, $col) {
      $data = $this->getAllItem();

      foreach ($data as $datas) {
        if($datas['item_id'] == $itemid) {
          return $datas['$col'];
        }
      }
    }

    public function showAllItemCard($item_type) {
      $data = $this->getAllItem();
      $num = 0;
      foreach($data as $datas) {
        if($datas['item_type'] == $item_type && $datas['item_sold'] == 'N' && $datas['item_approve'] == 'Y') {
            $num++;
            echo "<div class='card-body col-sm-3'>";
              echo "<img class='card-img-top mt-3' src='img/".$datas['item_image']."'alt='Card image cap'>";
              echo "<form action='include\cartadd.php' method='POST'>";
                echo "<input type='hidden' name='itemid' value='".$datas['item_id']."'>";
                echo "<input type='hidden' name='storename' value='".$datas['item_type']."'>";
                if(isset($_SESSION['id'])) {
                  echo "<input type='submit' class='btn btn-dark btn-block' value='Add to chart' name='submit'>";
                }else {
                  echo "<input type='submit' class='btn btn-dark btn-block' value='Add to chart' name='submit' disabled>";
                }
              echo "</form>";
              echo "<h5 class='card-title mt-1 mb-0'>NAME: " .strtoupper($datas['item_name']). "</h5>";
              echo "<p class='card-text pt-2 mb-1'><kbd>Price: RM" .$datas['item_price']. "</kbd></p>";
              echo "<p class='card-text pt-1 mb-1 text-muted'>Description: " .$datas['item_desc']. "</p>";
            echo "</div>";
        }
      }
      if($num <= 0) {
        echo "
        <div class='container col-md-6'>
          <img class='col-centered ' src='img\\empty_cart.png' alt='icon'>
          <p class='card-text text-muted mb-4'>We currently have no item for sale...</p>
        </div>";
      }
    }

    public function showAllItemCardForApproval() {
      $data = $this->getAllItem();
      $num = 0;
      foreach($data as $datas) {
        if($datas['item_sold'] == 'N') {
          $num++;
          echo "<div class='card-body col-sm-3'>";
            echo "<img class='card-img-top mt-3' src='img/".$datas['item_image']."'alt='Card image cap'>";

            if($datas['item_approve'] == 'N') {
              echo "<form action='include\itemapprove.php' method='POST'>";
                echo "<input type='hidden' name='itemid' value='".$datas['item_id']."'>";
                echo "<input type='hidden' name='storename' value='".$datas['item_type']."'>";
                if(isset($_SESSION['id'])) {
                  echo "<input type='submit' class='btn btn-dark btn-block' value='Approve' name='submit'>";
                }else {
                  echo "<input type='submit' class='btn btn-dark btn-block' value='Approve' name='submit' disabled>";
                }
              echo "</form>";
            }else{
              echo "<form action='include\itemunapprove.php' method='POST'>";
                echo "<input type='hidden' name='itemid' value='".$datas['item_id']."'>";
                echo "<input type='hidden' name='storename' value='".$datas['item_type']."'>";
                if(isset($_SESSION['id'])) {
                  echo "<input type='submit' class='btn btn-dark btn-block' value='Unapprove' name='submit'>";
                }else {
                  echo "<input type='submit' class='btn btn-dark btn-block' value='Unapprove' name='submit' disabled>";
                }
              echo "</form>";
            }
            

            echo "<h5 class='card-title mt-1 mb-0'>NAME: " .strtoupper($datas['item_name']). "</h5>";
            echo "<p class='card-text pt-2 mb-1'><kbd>Price: RM" .$datas['item_price']. "</kbd></p>";
            echo "<p class='card-text pt-1 mb-1 text-muted'>Description: " .$datas['item_desc']. "</p>";
          echo "</div>";
        }else {
          $num++;
          echo "<div class='card-body col-sm-3'>";
            echo "<img class='card-img-top mt-3' src='img/".$datas['item_image']."'alt='Card image cap'>";
            echo "<form action='include\itemapprove.php' method='POST'>";
              echo "<input type='hidden' name='itemid' value='".$datas['item_id']."'>";
              echo "<input type='hidden' name='storename' value='".$datas['item_type']."'>";
              if(isset($_SESSION['id'])) {
                echo "<input type='submit' class='btn btn-dark btn-block' value='Sold' name='submit' disabled>";
              }else {
                echo "<input type='submit' class='btn btn-dark btn-block' value='Sold' name='submit' disabled>";
              }
            echo "</form>";
            echo "<h5 class='card-title mt-1 mb-0'>NAME: " .strtoupper($datas['item_name']). "</h5>";
            echo "<p class='card-text pt-2 mb-1'><kbd>Price: RM" .$datas['item_price']. "</kbd></p>";
            echo "<p class='card-text pt-1 mb-1 text-muted'>Description: " .$datas['item_desc']. "</p>";
          echo "</div>";
        }
      }
      if($num <= 0) {
        echo "
        <div class='container col-md-6'>
          <img class='col-centered ' src='img\\empty_cart.png' alt='icon'>
          <p class='card-text text-muted mb-4'>We currently have no item for sale...</p>
        </div>";
      }
    }

  }

?>
