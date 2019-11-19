<?php
  include 'dbh.inc.php';
  include 'feedback.inc.php';

  session_start();

  if(isset($_POST['submit'])) {
    if(isset($_SESSION['id'])) {
      $custId = $_SESSION['id'];
      $rate = $_POST['exampleRadios'];
      $feed = new Feedback();
      $feed->insertRating($rate, $custId);
      header("Location: ../index.php");
      exit();
    }else {
      header("Location: ../index.php");
      exit();
    }
  }else {
    header("Location: ../index.php");
    exit();
  }

 ?>
