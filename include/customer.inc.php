<?php

  class Customer extends Dbh{

    public function getAllCustomers() {
      $sql ="SELECT * FROM customer";
      $result = $this->connect()->query($sql);
      $numRows = $result->num_rows;

      if($numRows > 0){
        while($row = $result->fetch_assoc()) {
          $data[] = $row;
        }
        return $data;
      }
    }

    public function checkForCustomer($email_address) {
      $data = $this->getAllCustomers();

      foreach ($data as $datas) {
        if($datas['cust_email'] == $email_address) {
          return TRUE;
        }
      }
      return FALSE;
    }

    public function insertCustomer($first_name, $last_name, $email_address, $password, $address, $dob, $gender) {
      $conn = $this->connect();
      $result = $this->checkForCustomer($email_address);

      if($result) {
        return FALSE;
      }else {
        $name = $first_name . ' ' . $last_name;

        $theName = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email_address);
        $pass = mysqli_real_escape_string($conn, $password);
        $lname = mysqli_real_escape_string($conn, $last_name);
        $add = mysqli_real_escape_string($conn, $address);
        $date = mysqli_real_escape_string($conn, $dob);
        $gen = mysqli_real_escape_string($conn, $gender);

        $sql = "INSERT INTO `customer` (`cust_id`, `cust_name`, `cust_address`, `cust_email`, `cust_phoneno`, `cust_password`, `cust_isAdmin`, `cust_birth`, `cust_gender`) VALUES (NULL, '$theName', 'Address', '$email', 'NumPhon', '$pass', 'N', '$date', '$gen');";
        $conn->query($sql);
        return TRUE;
      }
    }

  }

?>
