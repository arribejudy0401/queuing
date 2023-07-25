<?php
session_start();
include 'includes/header.php';
if ($_SESSION['role'] === 'Admin') {
  include 'includes/navbar.php';
  include 'includes/sidenav.php';
  superadmin_sidenav();
} else {
  include 'includes/office-navbar.php';
  include 'includes/office-sidenav.php';
  office_sidenav();
}

// functions 
include 'functions/forget-password-function.php';
?>

<!-- new password container -->
<div class="container-fluid">

  <div class="row">

    <div class=" m-auto py-2 text-center">

      <form action="" method="post" class="p-2 box-shadow-1 border border-top-3px rounded bg-white">

        <h4 class="text-muted text-uppercase fw-bold m-2">New Password</h4>

        <hr>

        <?= $message ?>

        <div class="d-flex">

          <p class="ps-1"></p>

          <input type="password" name="current-password" id="" class="form-control mt-2" minlength="8" placeholder="Enter Your Current Password" required>

        </div>

        <div class="d-flex ">

          <p class="ps-1"></p>

          <input type="password" name="new-password" id="" class="form-control mt-2" minlength="8" placeholder="Enter Your New Password" required>

        </div>

        <div class="d-flex">

          <p class="ps-1"></p>

          <input type="password" name="confirm-new-password" id="" class="form-control mt-2" minlength="8" placeholder="Confirm Your New Password" required>

        </div>

        <div class="text-end"> <button type="submit" name="new-pass-btn" id="btn-submit" class="mt-2 btn btn-bg-main btn-bg-main-hover mb-2">Change Password</button></div>

      </form>

    </div>

  </div>

</div>

<?php
include 'includes/footer.php';
?>