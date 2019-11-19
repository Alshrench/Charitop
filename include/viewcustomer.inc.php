<?php

  class ViewCustomer extends Customer {

    public function showAllCustomers() {
      $data = $this->getAllCustomers();

      foreach($datas as $data) {
        echo $data['cust_id'];
      }
    }

    public function searchACustomersName($email_address) {
      $data = $this->getAllCustomers();

      foreach ($data as $datas) {
        if($datas['cust_email'] == $email_address) {
          return $datas['cust_name'];
        }
      }
    }

    public function searchACustomersIfAdmin($email_address) {
      $data = $this->getAllCustomers();

      foreach ($data as $datas) {
        if($datas['cust_email'] == $email_address && $datas['cust_isAdmin'] == 'Y') {
          return true;
        }
      }
      return false;
    }

  }

?>
