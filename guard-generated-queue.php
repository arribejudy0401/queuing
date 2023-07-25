<?php
session_start();
include 'includes/header.php';
include 'includes/navbar.php';
guard_navbar();

// functions
include 'functions/reservation-function.php';
include 'functions/leave-queue-function.php';
include 'functions/search-reference.php';
?>

<div class="container">

  <?php

  $name = $_GET['name'];
  $office = $_GET['o'];
  $date = $_GET['date'];
  $type = $_GET['type'];
  $email = $_GET['e'];

  if ($type === 'Online') {
    $ref = $_GET['ref'];
  }
  ?>

  <div class="row">

    <div class="col-md-10 col-lg-6 m-auto p-5">

      <?php if ($type === 'Online') { ?>
        <form action="guard-generated-queue.php?name=<?= $name ?>&o=<?= $office ?>&e=<?= $email ?>&type=<?= $type ?>&date=<?= $date ?>&ref=<?= $ref ?>" method="POST" class="border box-shadow-1 border-top-3px mt-5 bg-white" method="GET">

        <?php } else { ?>

          <form action="guard-generated-queue.php?name=<?= $name ?>&o=<?= $office ?>&type=<?= $type ?>&date=<?= $date ?>&e=<?= $email ?>" method="POST" class="border box-shadow-1 border-top-3px mt-5 bg-white" method="GET">

          <?php } ?>

          <div class="text-center text-muted">

            <div class="queue-number-watermark">

              <div class="text-muted text-uppercase m-2">

                <div class="watermark">

                  <img src="assets/images/btechlogo.png" alt="">

                </div>

                <h4 class="fw-bold mt-3">

                  Queue Number is

                </h4>

              </div>

              <h1>

                <hr>

                <div class="transaction-number">

                  <?php
                  if ($type === 'Online') {
                    $select_transaction_number = " SELECT * FROM reservations WHERE  date = '$date' AND reference_number = '$ref'";
                  } else {
                    $select_transaction_number = " SELECT * FROM reservations WHERE  date = '$date' AND name = '$name'";
                  }

                  $select_transaction_number_result = mysqli_query($GLOBALS['connection'], $select_transaction_number);

                  while ($rows = mysqli_fetch_assoc($select_transaction_number_result)) {
                    $transaction = $rows['transaction_number'];
                  }

                  ?>
                  <h3 class="background-white">

                    <?php

                    echo $transaction;

                    ?>
                  </h3>

                  <div class="text-end text-muted pe-2 mt-3 mb-3 fw-bold">

                    <h6 class="m-0"><?= $date ?></h6>

                  </div>

                </div>

            </div>

            <hr class="mt-2">

            <div class="text-end m-2">

              <a href="guard.php" class="btn btn-primary hidden-print">Back</a>

              <button type="button" class="btn btn-bg-main btn-bg-main-hover hidden-print" onclick="window.print()">Print</button>

            </div>

            </h1>

          </div>

          </form>

    </div>

  </div>

</div>

<?php include 'includes/footer.php'; ?>