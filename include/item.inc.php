<?php

  class Item extends Dbh{

    protected function getAllItem() {
      $sql ="SELECT * FROM item";
      $result = $this->connect()->query($sql);
      $numRows = $result->num_rows;

      if($numRows > 0){
        while($row = $result->fetch_assoc()) {
          $data[] = $row;
        }
        return $data;
      }
    }

    public function markItemSold($item_id, $mark) {
      $conn = $this->connect();
      $data = $this->getAllItem();

      foreach ($data as $datas) {
        if($datas['item_id'] == $item_id) {
          $item = mysqli_real_escape_string($conn, $item_id);
          $amark = mysqli_real_escape_string($conn, $mark);
          $sql = "UPDATE `item` SET `item_sold` = '$amark' WHERE `item`.`item_id` = '$item';";
          $conn->query($sql);
        }
      }
      return FALSE;
    }

    public function markItemPaid($item_id, $mark) {
      $conn = $this->connect();
      $data = $this->getAllItem();

      foreach ($data as $datas) {
        if($datas['item_id'] == $item_id) {
          $item = mysqli_real_escape_string($conn, $item_id);
          $amark = mysqli_real_escape_string($conn, $mark);
          $sql = "UPDATE `item` SET `item_paid` = '$amark' WHERE `item`.`item_id` = '$item';";
          $conn->query($sql);
        }
      }
      return FALSE;
    }

    public function markItemApprove($item_id, $mark) {
      $conn = $this->connect();
      $data = $this->getAllItem();

      foreach ($data as $datas) {
        if($datas['item_id'] == $item_id) {
          $item = mysqli_real_escape_string($conn, $item_id);
          $amark = mysqli_real_escape_string($conn, $mark);
          $sql = "UPDATE `item` SET `item_approve` = '$amark' WHERE `item`.`item_id` = '$item';";
          $conn->query($sql);
        }
      }
      return FALSE;
    }

    public function insertitem($item_name, $item_desc, $item_price_1, $item_price_2, $item_image, $item_type) {
      $conn = $this->connect();

      $itemprice = $item_price_1 . '.' . $item_price_2;

      $itemName = mysqli_real_escape_string($conn, $item_name);
      $itemDesc = mysqli_real_escape_string($conn, $item_desc);
      $itemPrice = mysqli_real_escape_string($conn, $itemprice);
      $itemType = mysqli_real_escape_string($conn, $item_type);

      $sql = "INSERT INTO `item` (`item_id`, `item_name`, `item_desc`, `item_price`, `item_image`, `item_type`, `item_sold`, `item_paid`, `item_approve`) VALUES (NULL, '$itemName', '$itemDesc', '$itemPrice', '$item_image', '$itemType', 'N', 'N', 'N');";
      $conn->query($sql);

    }
  }

?>
