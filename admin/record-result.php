<?php
session_start();
include 'includes/header.php';
include 'includes/office-navbar.php';
include 'includes/office-sidenav.php';
office_sidenav();
?>

<div class="container-fluid">

  <div class="row p-2">

    <div class="col-md-12">

      <div class="d-flex justify-content-between p-2 show">

        <h3 class="text-uppercase text-color fw-bold">Record</h3>

        <div class="">

          <?php
          include 'includes/date-search.php';
          office_record();
          ?>
        </div>

        <?php

        $office = $_SESSION['office-role'];
        $start = $_GET['date-from'];
        $end = $_GET['date-to'];
        $null = null;

        ?>

      </div>

      <div class="hidden">

        <div class="d-flex justify-content-between align-items-center text-color">

          <img src="assets/images/btechlogo.png" alt="btech logo" class="h-2r">

          <h3 class="fw-bold">Baliwag Polytechnic College</h3>

          <h3 class="text-white"></h3>

        </div>

        <br>

        <div class="d-flex justify-content-between">

          <h5 class="text-uppercase text-color fw-bold text-muted"><?= $office ?>'s Record</h5>

          <h5 class="text-muted text-color text-uppercase fw-bold">Date: <?= $start ?> to <?= $end ?> </h5>

        </div>

      </div>

    </div>

    <form action="record-result.php?date-from=<?= $start ?>&date-to=<?= $end ?>" method="POST">

      <div class="col-12 box-shadow-1 border-top-3px  rounded p-2 bg-white">

        <div class="overflow-auto">

          <table id="table" class="table display align-middle nowrap p-2" cellspacing="0">

            <thead class="text-muted text-color">

              <tr>

                <th>Queue Number</th>

                <th>Name</th>

                <th>Transaction</th>

                <th>Date</th>

                <th>Status</th>

              </tr>

            </thead>

            <tbody class="text-muted text-color">

              <?php

              $select_admission_record = "SELECT * FROM reservations WHERE office = '$office'  AND status != '$null' AND status != 'Pending' AND status != 'Serving' AND status != 'Transferred' AND date BETWEEN '$start' AND '$end' ORDER BY date";

              $select_admission_record_result = mysqli_query($GLOBALS['connection'], $select_admission_record);

              while ($row = mysqli_fetch_assoc($select_admission_record_result)) {

              ?>

                <tr>

                  <td><?= $row['transaction_number'] ?></td>

                  <td><?= $row['name'] ?></td>

                  <td><?= $row['transaction'] ?></td>

                  <td><?= $row['date'] ?></td>

                  <td><?= $row['status'] ?></td>

                </tr>

              <?php } ?>

            </tbody>

          </table>

        </div>

        <div class="text-end">

          <button class="btn btn-bg-main btn-bg-main-hover hidden-print" type="button" onclick="window.print()">Print <i class="fa-solid fa-print"></i></button>

        </div>

      </div>

    </form>

  </div>

</div>



<?php include 'includes/footer.php' ?>