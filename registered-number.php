<?php
session_start();
include 'includes/header.php';
include 'includes/navbar.php';
student_navbar();

// functions
include 'functions/reservation-function.php';
include 'functions/leave-queue-function.php';
?>

<div class="container">

  <div class="row">

    <div class="col-md-10 col-lg-6 m-auto p-5">

      <?php

      $email = $_GET['e'];
      $office = $_GET['o'];
      $date = $_GET['date'];

      ?>

      <form action="registered-number.php?e=<?= $email ?>&o=<?= $office ?>&date=<?= $date ?>&type=online" method="POST" class="border box-shadow-1 border-top-3px mt-5 bg-white" method="GET">

        <div class=" text-muted">

          <div class="text-muted text-uppercase m-2">

            <h4 class="fw-bold mt-3 text-center">

              Reference Number

            </h4>

          </div>

          <h1 class="text-justify p-2 h5">

            <hr>

            <h1 class="text-center mb-4">

              <?php
              $select_transaction_number = " SELECT * FROM reservations WHERE email = '$email' AND date = '$date'";

              $select_transaction_number_result = mysqli_query($GLOBALS['connection'], $select_transaction_number);

              while ($rows = mysqli_fetch_assoc($select_transaction_number_result)) {
                $reference = $rows['reference_number'];
                $stat = $rows['status'];
              }

              if ($stat === 'Completed' || $stat === 'Cancelled') {
                header('location:index.php');
              } else {
                echo $reference;
              }
              ?>


            </h1>

            <hr class="mt-2">

            <div class="text-end m-2">

              <a href="index.php" class="btn btn-primary mb-1">Reserved</a>

              <button type="button" data-bs-target="#leaveQueueModal" data-bs-toggle="modal" class="btn btn-bg-main btn-bg-main-hover mb-1">Cancel Transaction</button>

              <?php include 'modals/leave-queue-message-modal.php'; ?>

            </div>

          </h1>

        </div>

      </form>

    </div>

  </div>

</div>

<?php include 'includes/footer.php'; ?>