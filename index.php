<?php
  include 'include\dbh.inc.php';
  include 'include\customer.inc.php';
  include 'include\item.inc.php';
  include 'include\viewitem.inc.php';
  include 'include\cart.inc.php';
  include 'include\viewcart.inc.php';
  include 'include\viewcustomer.inc.php';

  $viewitem = new ViewItem();
  $viewcart = new ViewCart();
  $viewcust = new ViewCustomer();

  session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!--
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    -->

    <link rel="stylesheet" href="css\bootstrap.css">
    <link rel="stylesheet" href="css\bootstrap-square.css">
    <link rel="stylesheet" href="css\custom-style.css">
    <link rel="stylesheet" href="fontawesome/web-fonts-with-css/css/fontawesome-all.css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
    <script src="js\custome-js.js"></script>

    <!--custom page style-->
    <style>
      body, html {
        background-image: url("img\\bg2.jpg");
        height:100vh;
        background-position: center;
        background-size: cover;
        background-color: #E5E5E5;
        background-repeat: no-repeat;
        background-attachment: fixed;
      }
      footer {
          box-shadow: 0 50vh 0 50vh #E1E1E1;
      }
      div#load_screen{
      	background: #343A40;
      	opacity: 1;
      	position: fixed;
          z-index:10;
      	top: 0px;
      	width: 100%;
      	height: 1600px;
      }
    </style>

    <title>Charitop</title>

  </head>

  <body>

    <header>

      <nav class="navbar bg-dark text-white" style="z-index: 9999">
        <!--brand-->
        <div class="h1 col-md-2 col-sm-4 text-center navbar-brand" style="margin-right: 0px;margin-bottom: 0px; margin-top: 2px;padding-bottom: 0px;">
          <img src="img/brand_a.svg" alt="brand logo" height="60px" width="40px" />  
          CHARITOP
        </div>
          

        
        
        </div>
        
        <!--upper tab-->
        <ul class="nav nav-tab col-md-6 nav-fill bg-dark p-0" id="upperTab" role="tablist">

          <?php
            if (!isset($_SESSION["email"])){
              echo '<li class="nav-item">';
              echo '<a class="nav-link text-secondary text-light" id="signup-tab" data-toggle="tab" href="#signup" role="tab" aria-controls="signup" aria-selected="false"><i class="fas fa-user-plus"></i> SIGNUP</a>';
              echo '</li>';

              echo '<li class="nav-item">';
              echo '<a class="nav-link text-secondary text-light" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="false"><i class="fas fa-sign-in-alt"></i> LOGIN</a>';
              echo '</li>';
            }else {
              $custName = $viewcust->searchACustomersName($_SESSION['email']);
              echo '<li class="nav-item">';
              echo '<a class="nav-link text-secondary text-light" disabled><i class="fas fa-user"></i> '.strtoupper($custName).'</a>';
              echo '</li>';

              echo '<li class="nav-item">';
              echo '<a class="nav-link text-secondary text-light" href="include\logout.php"><i class="fas fa-sign-out-alt"></i> LOGOUT</a>';
              echo '</li>';
            }
          ?>

          <li class="nav-item">
            <a class="nav-link text-secondary text-light" id="cart-tab" data-toggle="tab" href="#cart" role="tab" aria-controls="cart" aria-selected="false"><i class="fas fa-shopping-cart"></i> CART</a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-secondary text-light" id="donate-tab" data-toggle="tab" href="#donate" role="tab" aria-controls="donate" aria-selected="false"><i class="fas fa-hand-holding-usd"></i> DONATE</a>
          </li>
        </ul>

        <!--searchbar-->
        <div class="input-group col-md-2">
          <input type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button">Search</button>
          </div>
        </div>

      </nav>

      <!--lower tabs-->
      <ul class="nav nav-tabs nav-fill bg-light" id="lowerTab" role="tablist">

        <!--load screen-->
        <div class="se-pre-con">
          <div id="text">
            <img class="col-centered" src="img\\Preloader_9.gif" alt="icon">
          </div>
        </div>

        <li class="nav-item">
          <a class="nav-link text-secondary active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-home"></i> HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-secondary" id="store-tab" data-toggle="tab" href="#store" role="tab" aria-controls="store" aria-selected="false"><i class="fas fa-shopping-bag"></i> STORE</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-secondary" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="false"><i class="fas fa-globe"></i> ABOUT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-secondary" id="feedback-tab" data-toggle="tab" href="#feedback" role="tab" aria-controls="feedback" aria-selected="false"><i class="fas fa-comments"></i> FEEDBACK</a>
        </li>

        <?php
          if(ISSET($_SESSION['email'])) {
            $custIsAdmin = $viewcust->searchACustomersIfAdmin($_SESSION['email']);
            if($custIsAdmin)
              echo '<li class="nav-item">
                      <a class="nav-link text-secondary" id="approve-tab" data-toggle="tab" href="#approve" role="tab" aria-controls="approve" aria-selected="false"><i class="fas fa-thumbs-up"></i> APPROVE</a>
                    </li>';
          }
        ?>
        
      </ul>

    </header>

    <main>
      <div class="tab-content" id="mainTabContent">

        <!--Home Tab-->
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <!--title-->
          <div class="container">
            <h1 class="display-3 text-light text-center"><b>BUY & DONATE AT CHARITOP</b></h1>
            <h1 class="display-4 text-light text-center">FOR CHARITY IS OUR TOP PRIORITY</h1>
          </div>
          <!--carousel-->
          <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">

              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="img\\carousel_1.jpg?auto=yes&bg=777&fg=555&text=First slide" alt="First slide">
                </div>
                <div class="carousel-item" >
                  <img class="d-block w-100" src="img\\carousel_2.png?auto=yes&bg=777&fg=555&text=Second slide" alt="Second slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="img\\carousel_3.jpg?auto=yes&bg=777&fg=555&text=Third slide" alt="Third slide">
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
          <!--partners-->
          <div class="container">
            <div class="card text-center">
              <h2 class="card-title mt-4">PARTNERS</h2>
              <div class="row pr-4 pl-4">
                <div class="card-body col-sm-4">
                  <img class="d-block w-100" src="img\\kinabalu_park_ribbon.jpg?auto=yes&bg=777&fg=555&text=image cap" alt="icon">
                  <h5 class="card-title mt-2">Kinabalu Park Ribbon</h5>
                  <!--p class="card-text">Supporting text.</p-->
                </div>
                <div class="card-body col-sm-4">
                  <img class="d-block w-100" src="img\\pikos.jpg?auto=yes&bg=777&fg=555&text=image cap" alt="icon">
                  <h5 class="card-title mt-2">Pertubuhan Kebajikan Komuniti Sabah - PIKOS</h5>
                </div>
                <div class="card-body col-sm-4">
                  <img class="d-block w-100" src="img\\sabah_society_for_the_deaf.png?auto=yes&bg=777&fg=555&text=image cap" alt="icon">
                  <h5 class="card-title mt-2">Sabah Society for The Deaf</h5>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
          <!--main article-->
          <div class="card text-center mt-0 mb-0 container-fluid">
            <div class="row">
              <div class="container col-md-6">
                <h1 class="display-5 text-center mt-4">ABOUT</h1>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="card col-md-10">
              <div class="card-body text-center mt-0 pt-0">
                  <img src="img\donate.png" class="img-round" alt="...">
                </div>
                <div class="card-body text-center">
                  <h5 class="card-title">DONATE TO CHARITY WITH CHARITOP</h5>
                  <p class="card-text">We won't live with proverty. Find a bargain or unique treasure in Charitop Online Shop and join thousands of supporters who helps us to fight proverty and injustice around the world. Choose from 100,000+ donated and new products or buy a loved one a fun and quirky charity gift. The proceeds will go towards our life changing work.</p>
                  <p class="card-text">Every day our amaxing team of volunteers list hundreds of items donated by supporters like you, including second-hand women's clothing, second-hand men's clothing and range of one-off collectables. Not to mention our second-hand home wares, vintage wedding dresses, vinly, music, books, seasonal favorites like Fair Trade Christmas cars and more. There's always something new to discover in Charitop Online Shop.</p>
                </div>
                
              </div>
              <!--div class="col-md-3 text-center">
                <img src="img\donate.png" class="img-round" alt="...">
              </div-->
            </div>
          </div>

        </div>

        <!--Store Tab-->
        <div class="tab-pane fade" id="store" role="tabpanel" aria-labelledby="store-tab">

          <!--storefront-->
          <div class="card text-center mt-0 mb-0 container-fluid" id="store_front">
            <!--title-->
            <div class="row">
              <div class="container col-md-6">
                <h1 class="display-5 text-center mt-4">STORE FRONT</h1>
              </div>
            </div>

            <div class="row">
              <div class="card-body col-sm-3">
                <img class="d-block w-100 bg-light" src="img\\apparel.png?auto=yes&bg=777&fg=555&text=image cap" alt="icon">
                <!--h5 class="card-title">APPAREL</h5-->
                <!--p class="card-text">With supporting text below as a natural lead-in to additional content.</p-->
                <form action="index.php" method="get">
                  <input type="hidden" name="storename" value="apparel">
                  <input type="submit" class="btn btn-dark btn-block" onclick="changeStoreName('apparel')" value="APPAREL">
                </form>
                <!--button type="button" class="btn btn-dark btn-block" onclick="switchStoreSide();changeStoreName('apparel')">apparel</button-->
              </div>
              <div class="card-body col-sm-3">
                <img class="d-block w-100 bg-light" src="img\\shoe.png?auto=yes&bg=777&fg=555&text=image cap" alt="icon">
                <form action="index.php" method="get">
                  <input type="hidden" name="storename" value="shoe">
                  <input type="submit" class="btn btn-dark btn-block" onclick="changeStoreName('shoe')" value="SHOE">
                </form>
              </div>
              <div class="card-body col-sm-3">
                <img class="d-block w-100 bg-light" src="img\\bags.png?auto=yes&bg=777&fg=555&text=image cap" alt="icon">
                <form action="index.php" method="get">
                  <input type="hidden" name="storename" value="bag">
                  <input type="submit" class="btn btn-dark btn-block" onclick="changeStoreName('bag')" value="BAG">
                </form>
              </div>
              <div class="card-body col-sm-3">
                <img class="d-block w-100 bg-light" src="img\\accessories.png?auto=yes&bg=777&fg=555&text=image cap" alt="icon">
                <form action="index.php" method="get">
                  <input type="hidden" name="storename" value="accessories">
                  <input type="submit" class="btn btn-dark btn-block" onclick="changeStoreName('accessories')" value="ACCESSORIES">
                </form>
              </div>
            </div>

            <div class="row">
              <div class="card-body col-sm-3">
                <img class="d-block w-100 bg-light" src="img\\books.png?auto=yes&bg=777&fg=555&text=image cap" alt="icon">
                <form action="index.php" method="get">
                  <input type="hidden" name="storename" value="books">
                  <input type="submit" class="btn btn-dark btn-block" onclick="changeStoreName('books')" value="BOOKS">
                </form>
              </div>
              <div class="card-body col-sm-3">
                <img class="d-block w-100 bg-light" src="img\\household.png?auto=yes&bg=777&fg=555&text=image cap" alt="icon">
                <form action="index.php" method="get">
                  <input type="hidden" name="storename" value="household">
                  <input type="submit" class="btn btn-dark btn-block" onclick="changeStoreName('household')" value="HOUSEHOLD ITEM">
                </form>
              </div>
              <div class="card-body col-sm-3">
                <img class="d-block w-100 bg-light" src="img\\electric.png?auto=yes&bg=777&fg=555&text=image cap" alt="icon">
                <form action="index.php" method="get">
                  <input type="hidden" name="storename" value="electrical">
                  <input type="submit" class="btn btn-dark btn-block" onclick="changeStoreName('electrical')" value="ELECTRICAL APPLIANCES">
                </form>
              </div>
              <div class="card-body col-sm-3">
                <img class="d-block w-100 bg-light" src="img\\beauty.png?auto=yes&bg=777&fg=555&text=image cap" alt="icon">
                <form action="index.php" method="get">
                  <input type="hidden" name="storename" value="beauty">
                  <input type="submit" class="btn btn-dark btn-block" onclick="changeStoreName('beauty')" value="BEAUTY PRODUCT">
                </form>
              </div>
            </div>

          </div>

          <!--storeback-->
          <div class="card text-center mt-0 mb-0 container-fluid" id="store_back">

            <!--store name-->
            <div class="row">
              <div class="container col-md-6">
                <h1 class="display-5 text-center mt-4" id="storename"></h1>
                <button type="button" class="btn btn-outline-dark" onclick="switchStoreSide();loading()">BACK TO CATEGORY LIST</button>
              </div>
            </div>

            <!--store item-->
            <div class="row">
              <?php
                if (isset($_GET['storename'])) {
                  $viewitem->showAllItemCard($_GET['storename']);
                }
              ?>
            </div>

          </div>

        </div>

        <!--Feedback Tab-->
        <div class="tab-pane fade" id="feedback" role="tabpanel" aria-labelledby="feedback-tab">

          <div class="card text-center mt-0 mb-0 container-fluid">
            <div class="row">
              <div class="container col-md-6">
                <h1 class="display-5 text-center mt-4">FEEDBACK</h1>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="card col-md-10 mb-3 mt-3 col-centered">
                <div class="card-body text-center">
                  <h5 class="card-title">SYSTEM FEEDBACK</h5>
                  <p class="card-text">Striving the highest standard service is our aim, thus we would love to hear from you either when we are right or wrong. With that, we can learn from our mistake and continue to improve. Please, be sincere with rating us below:</p>
                </div>
              </div>
            </div>
            <!--rating system-->
            <div class="row">
              <div class="card col-md-10 mb-3 col-centered">

                <form action='include\rate.php' method='POST'>
                <div class="card-body">
                  <h5 class="card-title text-center">How was the help you recieved?</h5>

                  <div class="form-check ml-5">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="very good" checked>
                    <label class="form-check-label" for="exampleRadios1">
                      <i class="fas fa-thumbs-up"></i> Very Good
                    </label>
                  </div>
                  <div class="form-check ml-5">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="good">
                    <label class="form-check-label" for="exampleRadios1">
                      <i class="fas fa-smile"></i> Good
                    </label>
                  </div>
                  <div class="form-check ml-5">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="satisfied">
                    <label class="form-check-label" for="exampleRadios1">
                      <i class="fas fa-meh"></i> Satisfied
                    </label>
                  </div>
                  <div class="form-check ml-5">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="bad">
                    <label class="form-check-label" for="exampleRadios1">
                      <i class="fas fa-frown"></i> Bad
                    </label>
                  </div>
                  <div class="form-check ml-5">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="very bad">
                    <label class="form-check-label" for="exampleRadios1">
                      <i class="fas fa-thumbs-down"></i> Very Bad
                    </label>
                  </div>

                </div>
                <input type='submit' class='btn btn-outline-dark btn-block mb-3' name='submit' value='Submit'>
                </form>

              </div>
            </div>
            <!--other contact-->
            <div class="row">
              <div class="card col-md-10 mb-3 col-centered">
                <div class="card-body text-center">
                  <h5 class="card-title">Other ways to contact us</h5>
                  <p class="card-text">
                    By telephone: 088-55544 (Phone lines are open 9am - 5 pm, Monday to Friday)
                  </p>
                  <p class="card-text">
                    If you have any complaints or comments outside of these hourse, please call our afterhours query line on 088-555666. This phone line is open 5pm - 9:30pm Monday to Friday and 12pm - 9:30pm on weekend.
                  </p>
                  <p class="card-text">
                    Feedback and contact will be directed to the back - end admins.
                  </p>
                </div>
              </div>
            </div>

          </div>

        </div>


        <!--Approve Tab-->
        <div class="tab-pane fade" id="approve" role="tabpanel" aria-labelledby="approve-tab">
          <div class="card text-center mt-0 mb-0 container-fluid" id="store_back">
            
            <!--title-->
            <div class="row">
              <div class="container col-md-6">
                <h1 class="display-5 text-center mt-4">ITEMS NEEDING APPROVAL</h1>
              </div>
            </div>

            <!--approve list-->
            <div class="row">
              <?php
                $viewitem->showAllItemCardForApproval();
              ?>
            </div>
          </div>
        </div>

        <!--Signup Tab-->
        <div class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="signup-tab">
          <p class="text-white bg-danger text-center p-2 m-0 col-12" id="signup_warning"></p>
          <p class="text-white bg-primary text-center p-2 m-0 col-12" id="signup_success">You have successfully made an account. Please login to the system to continue.</p>
          <div class="container-fluid p-5 container-transparent">

            <form class="form-signin" action="include/signup.php" method="POST">

              <!--title-->
              <div class="row d-flex justify-content-start ml-5 mb-2">
                <h1 class="display-5">CREATE AN ACCOUNT</h1>
              </div>
              <!--forms-->
              <div class="row ml-5 mr-5">

                <div class="container col-md-6 pl-0">
                  <h3 class="display-5">Login Information</h3>
                  <div class="form-group">
                    <label for="email_address">Email address</label>
                    <input type="text" class="form-control" id="email_address" name="email_address" placeholder="Enter email" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                  </div>
                  <div class="form-group">
                    <label for="comfirmed_password">Comfirm Password</label>
                    <input type="password" class="form-control" id="comfirmed_password" name="comfirmed_password" placeholder="Password" required>
                  </div>
                  <div class="form-group form-check ">
                    <input type="checkbox" class="form-check-input" id="newslatter" name="newslatter">
                    <label class="form-check-label" for="newslatter">Sign up for Newslatter</label>
                  </div>
                </div>

                <div class="container col-md-6">
                  <h3 class="display-5">Personal Information</h3>
                  <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter first name" required>
                  </div>
                  <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last name" required>
                  </div>
                  <div class="form-group">
                    <label for="date_of_birth">Date Of Birth</label>
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="Enter date of birth" required>
                  </div>
                  <div class="form-group">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="gender" id="gender" value="male" required>
                      <label class="form-check-label" for="gender">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="gender" id="gender" value="female" required>
                      <label class="form-check-label" for="gender">Female</label>
                    </div>
                  </div>
                </div>

              </div>
              <!--submit-->
              <div class="row d-flex justify-content-center">
                  <button type="submit" name="submit" class="btn btn-dark">Submit</button>
              </div>

            </form>

          </div>

        </div>

        <!--Login Tab-->
        <div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="login-tab">

          <p class="text-white bg-danger text-center p-2 m-0 col-12" id="signin_warning">User is not currently in the system.</p>

          <div class="container-fluid container-transparent">

            <form class="form-signin" action="include/signin.php" method="POST">
              <!--title-->
              <div class="row d-flex justify-content-center mb-2 pt-4">
                <h1 class="display-5">LOGIN</h1>
              </div>
              <!--forms-->
              <div class="row">

                <div class="container col-md-6 ">
                  <h3 class="display-5">Login Information</h3>
                  <div class="form-group">
                    <label for="login_email">Email address</label>
                    <input type="email" class="form-control" id="login_email" placeholder="Enter email" name="login_email" required>
                  </div>
                  <div class="form-group">
                    <label for="email_password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="email_password" required>
                  </div>
                  <div class="form-group form-check ">
                    <input type="checkbox" class="form-check-input" id="remember_me">
                    <label class="form-check-label" for="remember_me">Remember me</label>
                  </div>
                </div>

              </div>
              <!--submit-->
              <div class="row d-flex col-md-6 d-flex justify-content-center col-centered pb-5">
                  <button type="submit" name="submit" class="btn btn-dark">Login</button>
              </div>

            </form>

          </div>

        </div>
        <div class="tab-pane fade" id="cart" role="tabpanel" aria-labelledby="cart-tab">
          <div class="card text-center mt-0 mb-0 container-fluid" id="store_back">
            <!--title-->
            <div class="row">
              <div class="container col-md-6">
                <h1 class="display-5 text-center mt-4">MY CART</h1>
              </div>

            </div>

            <div class="row">
              <?php
                if (isset($_SESSION['id'])) {
                  $viewcart->showCartSummary($_SESSION['id']);
                  $viewcart->showAllCartCard($_SESSION['id']);
                }else {
                  echo "
                  <div class='container col-md-6'>
                    <p class='card-text'>Please login to view cart...</p>
                    <img class='col-centered mb-2' src='img\\Preloader_5.gif' alt='icon'>
                  </div>";
                }
              ?>
            </div>

          </div>

        </div>

        <!--Donate Tab-->
        <div class="tab-pane fade" id="donate" role="tabpanel" aria-labelledby="donate-tab">

          <!--p class="text-white bg-danger text-center p-2 m-0 col-12" id="signin_warning">User is not currently in the system.</p-->

          <div class="container-fluid container-transparent">
            <!--title-->
            <div class="row">
              <div class="container col-md-6">
                <h1 class="display-5 text-center mt-4">DONATE</h1>
              </div>
            </div>

            <?php
              if(isset($_SESSION['id'])) {
                echo "
                  <form class='form-signin' action='include/itemadd.php' method='POST' enctype='multipart/form-data'>
                    <!--forms-->
                    <div class='row'>

                      <div class='container col-md-6 '>
                        <h3 class='display-5'>Donation Information</h3>

                        <div class='form-group row'>
                          <label for='item_name' class='col-sm-2 col-form-label'>Item name</label>
                          <div class='col-sm-10'>
                            <input type='text' class='form-control' id='item_name' name='item_name' placeholder='Item Name'>
                          </div>
                        </div>

                        <div class='form-group row'>
                          <label for='item_name' class='col-sm-2 col-form-label'>Price</label>
                          <div class='col-sm-10'>
                            <div class='input-group'>
                              <div class='input-group-prepend'>
                                <span class='input-group-text' id='item_price_1' >RM</span>
                              </div>
                              <input type='text' class='form-control' placeholder='0' name='item_price_1'>
                              <div class='input-group-prepend'>
                                <span class='input-group-text' id='item_price_2' >.</span>
                              </div>
                              <input type='text' class='form-control' placeholder='00' name='item_price_2'>
                            </div>
                          </div>
                        </div>

                        <div class='form-group row'>
                          <label for='item_name' class='col-sm-2 col-form-label'>Type</label>
                          <div class='col-sm-10'>
                            <select class='form-control' id='item_type' name='item_type'>
                              <option>apparel</option>
                              <option>shoe</option>
                              <option>bag</option>
                              <option>accessories</option>
                              <option>book</option>
                              <option>household</option>
                              <option>electrical</option>
                              <option>beauty</option>
                            </select>
                          </div>
                        </div>

                        <div class='form-group row'>
                          <label for='item_name' class='col-sm-2 col-form-label'>Description</label>
                          <div class='col-sm-10'>
                            <textarea class='form-control' id='item_desc' name='item_desc' rows='2' placeholder='Description...'></textarea>
                          </div>
                        </div>

                        <div class='form-group row'>
                          <label for='item_name' class='col-sm-2 col-form-label'>Picture</label>
                          <div class='col-sm-10'>
                            <input type='file' class='form-control-file' id='item_image' name='item_image'>
                          </div>
                        </div>

                      </div>

                    </div>
                    <!--submit-->
                    <div class='row d-flex col-md-6 d-flex justify-content-center col-centered pb-5'>
                        <button type='submit' name='submit' class='btn btn-dark'>Donate</button>
                    </div>

                  </form>
                ";
              }else {
                echo "
                  <div class='row d-flex col-md-6 d-flex justify-content-center col-centered'>
                    <p>Please login to donate...</p>
                  </div>
                  <div class='row d-flex col-md-6 d-flex justify-content-center col-centered'>
                    <img class='col-centered mb-2' src='img\\Preloader_6.gif' alt='icon'>
                  </div>";
              }
            ?>
          </div>

        </div>

      </div>
    </main>

    <footer class="page-footer font-small blue pt-4 bg-light" id="">
        <!--main footer-->
        <div class="container-fluid text-center text-md-left">
            <div class="row">
                <!--motto-->
                <div class="col-md-4">
                    
                    <h5 class="text-uppercase">Charitop's Vision</h5>
                    <p>A future where donation can reach all humanity around the world.</p>
                    <img src="img/brand_a.svg" alt="brand logo" height="300px" width="100%" />
                </div>
                <!--vision-->
                <div class="col-md-4">
                    <h5 class="text-uppercase">Charitop's Mission</h5>
                    <p>Providing a platform where donations can go through a simpler an easier process that is ensured to go to the hands in need. We guarantee that the credibility of the donations process will benefits the donee and reduce good-in-condition products go to waste.</p>
                </div>
                <!--social media icon-->
                <div class="col-md-2">
                    <h5 class="text-uppercase">Social Medias</h5>
                    <ul class="list-unstyled">
                      <a><i class="fab fa-facebook-square fa-lg fa-2x"> </i></a>
                      <a><i class="fab fa-instagram fa-lg fa-2x"> </i></a>
                      <a><i class="fab fa-twitter-square fa-lg fa-2x"> </i></a>
                </div>
                <!--team member-->
                <div class="col-md-2">
                    <h5 class="text-uppercase">Team Members</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="#!">HARUN BIN PASI,</a>
                        </li>
                        <li>
                            <a href="#!">SARAH NAFISA BINTI ROSLI,</a>
                        </li>
                        <li>
                            <a href="#!">NUR NIQMAH ATRIA BINTI BADEAN,</a>
                        </li>
                        <li>
                            <a href="#!">NUR ALIFFAH BINTI MOHD NIZAM,</a>
                        </li>
                        <li>
                            <a href="#!">LYNNETTE LIM WENG KHEY,</a>
                        </li>
                        <li>
                            <a href="#!">DIONG MEI YEE,</a>
                        </li>
                        <li>
                            <a href="#!">SHAMINDRAN PONNIAH,</a>
                        </li>
                        <li>
                            <a href="#!">ALAN JULIUS.</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <!--copyright-->
        <div class="footer-copyright py-3 text-center">
            © 2018 Copyright Charity (583211-K) ● All Rights Reserved
        </div>

    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <!--
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    -->

    <script src="js\jquery.js"></script>
    <script src="js\bootstrap.bundle.js"></script>

  </body>
</html>
