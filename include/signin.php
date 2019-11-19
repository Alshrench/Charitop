<?php

  if(isset($_POST['submit'])) {

    session_start();

    include "dbh.inc.php";
    include "customer.inc.php";

    $cust = new Customer();

    $username = $_POST['login_email'];
  	$password = $_POST['email_password'];

    if(empty($username) || empty($password)) {
      header("Location: ../index.php?login=empty");
      exit();
    }else {
      if($cust->checkForCustomer($username)) {
        $data = $cust->getAllCustomers();
        $check = FALSE;
        foreach($data as $datas) {
          if($datas['cust_email'] == $username && $datas['cust_password'] == $password) {
            $_SESSION["email"] = $datas["cust_email"];
            $_SESSION["id"] = $datas["cust_id"];
            $check = TRUE;
            break;
          }
        }
        if($check == FALSE) {
          header("location:../index.php?login=pass");
          exit();
        }else {
          header("location:../index.php?login=success");
          exit();
        }

      }else {
        header("location:../index.php?login=custnoexist");
        exit();
      }
    }

  }else {
    header("Location: ../index.php?login=error");
    exit();
  }

?>
