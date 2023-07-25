<?php
session_start();
include 'includes/header.php';
include 'includes/navbar.php';
guard_navbar();

// functions 
include 'admin/functions/forget-password-function.php';
?>

<!-- new password container -->
<div class="container-fluid">

  <div class="row">

    <div class="col-md-10 col-lg-6 m-auto  py-5 text-center">

      <form action="" method="post" class="p-2 box-shadow-1 border border-top-3px rounded bg-white">

        <h4 class="text-muted text-uppercase fw-bold m-2">New Password</h4>

        <hr>

        <?= $message ?>

        <div class="d-flex">

          <p class="ps-2"></p>

          <input type="password" name="current-password" id="" class="form-control mt-2" minlength="8" placeholder="Enter Your Current Password" required>

        </div>

        <div class="d-flex">

          <p class="ps-2"></p>

          <input type="password" name="new-password" id="" class="form-control mt-2" minlength="8" placeholder="Enter Your New Password" required>

        </div>

        <div class="d-flex">

          <p class="ps-2"></p>

          <input type="password" name="confirm-new-password" id="" class="form-control mt-2" minlength="8" placeholder="Confirm Your New Password" required>

        </div>

        <div class="text-end"> <button type="submit" name="new-pass-btn" id="btn-submit" class="m-2 btn d-block btn-bg-main btn-bg-main-hover w-100 m-auto mt-2">Change Password</button></div>

      </form>

    </div>

  </div>

</div>

<?php
include 'includes/footer.php';
?>