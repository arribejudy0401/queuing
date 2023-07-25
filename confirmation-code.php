<?php
include 'includes/header.php';
include 'includes/navbar.php';
student_navbar();

// functions 
include 'functions/forget-password-function.php'
?>

<!-- confirmation code container -->
<div class="container">

  <div class="row">

    <div class="col-md-10 col-lg-6 m-auto  py-5 text-center">

      <form action="" method="post" class="p-2 box-shadow-1 border border-top-3px rounded bg-white">

        <h4 class="text-muted text-uppercase fw-bold m-2">Confirmation Code</h4>

        <hr>

        <?= $message ?>

        <input type="number" name="confirmation-code" id="Email" class="form-control mt-2" placeholder="Enter Confirmation Code" required>

        <button type="submit" name="confirmation-code-btn" id="btn-submit" class="m-2 btn d-block btn-bg-main btn-bg-main-hover w-100 m-auto mt-2">Submit</button>

      </form>

    </div>

  </div>

</div>

<?php include 'includes/footer.php'; ?>