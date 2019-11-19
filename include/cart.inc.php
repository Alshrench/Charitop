<?php

  class Cart extends Dbh{

    public function getAllCart() {
      $sql ="SELECT * FROM cart";
      $result = $this->connect()->query($sql);
      $numRows = $result->num_rows;

      if($numRows > 0){
        while($row = $result->fetch_assoc()) {
          $data[] = $row;
        }
        return $data;
      }
    }



    public function getItem($itemid) {
      $sql ="SELECT * FROM item WHERE item_id='$itemid'";
      $result = $this->connect()->query($sql);
      $numRows = $result->num_rows;

      if($numRows > 0){
        $row = $result->fetch_assoc();
        return $row;
      }
    }

    public function insertCart($cust_id, $item_id) {
      $conn = $this->connect();

      $item = mysqli_real_escape_string($conn, $item_id);
      $cust = mysqli_real_escape_string($conn, $cust_id);

      $sql = "INSERT INTO `cart` (`cart_id`, `cust_id`, `item_id`, `paid`) VALUES (NULL, '$cust', '$item', 'N');";

      $conn->query($sql);
      return TRUE;

    }

    public function deleteCart($cust_id, $item_id) {
      $conn = $this->connect();

      $item = mysqli_real_escape_string($conn, $item_id);
      $cust = mysqli_real_escape_string($conn, $cust_id);

      $sql = "DELETE FROM `cart` WHERE `cart`.`cust_id` = '$cust' AND `cart`.`item_id` = '$item'";

      $conn->query($sql);
      return TRUE;

    }

  }

?>
