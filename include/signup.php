<?php
  include 'dbh.inc.php';
  include 'customer.inc.php';

  function validateInput($data, $fieldName){
		global $errorCount;
		if (empty($data)){
			++$errorCount;
			$retval = "";
		} else { //Only clean up the input if it isn't empty
			if ($fieldName == "Email address"){
				if (!filter_var($data, FILTER_VALIDATE_EMAIL)){
					++$errorCount;
				}
			}

			if ($fieldName == "Password"){
				if(strlen($data) < 8){
				++$errorCount;
				}
			}

			$retval = trim($data);
			$retval = stripslashes($retval);
		}
		return ($retval);
	}


  if(isset($_POST['submit'])) {

    //login info
    $email_address = validateInput($_POST['email_address'], "Email address");
    $password = validateInput($_POST['password'], "Password");
    $com_password = $_POST['comfirmed_password'];

    //customer info
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $address = "";

    if($password != $com_password) {
      header("Location: ../index.php?signup=pass_com");
      exit();
    }else {
      if( strlen($password) < 8 ) {
        header("Location: ../index.php?signup=pass_lenght");
        exit();
      }else {
        $cust = new Customer();

        $result = $cust->insertCustomer($first_name, $last_name, $email_address, $password, $address, $dob, $gender);
        if($result) {
          header("Location: ../index.php?signup=success");
          exit();
        }else {
          header("Location: ../index.php?signup=exist");
          exit();
        }
      }
    }
  }

 ?>
