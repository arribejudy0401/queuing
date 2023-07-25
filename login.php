<?php
session_start();
include 'includes/header.php';
include 'includes/navbar.php';
student_navbar();

// functions
include "functions/login-functions.php";
?>

<div class="container">

  <div class="row">

    <!-- login container -->
    <div class="col-md-10 col-lg-6 m-auto  py-5 text-center">

      <form action="" method="POST" class="p-2 box-shadow-1 border border-top-3px rounded bg-white">

        <h4 class="text-muted text-uppercase fw-bold m-2">Login</h4>

        <hr>

        <?php

        echo $message;

        ?>

        <input type="email" name="login-email" id="Email" class="form-control mt-2" placeholder="Enter Your Email">

        <input type="password" name="login-password" id="Password" class="form-control mt-2" placeholder="Enter Your Password">

        <button type="submit" name="login-btn" id="btn-submit" class="m-2 btn d-block btn-bg-main btn-bg-main-hover w-100 m-auto mt-2">Log In</button>

        <div class="py-2"><a href="forgot-password.php"> Forgot Password </a></div>

      </form>

    </div>

  </div>

</div>

<?php include 'includes/footer.php'; ?>