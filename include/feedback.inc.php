<?php

  class Feedback extends Dbh{

    public function insertRating($rating, $cust_id) {
      $conn = $this->connect();

      $rate = mysqli_real_escape_string($conn, $rating);
      $cust = mysqli_real_escape_string($conn, $cust_id);

      $sql = "INSERT INTO `feedback` (`feedback_id`, `rating`, `cust_id`) VALUES (NULL, '$rate', '$cust');";

      $conn->query($sql);
    }

  }

?>
