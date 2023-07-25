<?php
session_start();
include 'includes/header.php';
include 'includes/navbar.php';
include 'includes/sidenav.php';
superadmin_sidenav();
?>

<div class="container-fluid">

  <div class="row p-2">

    <!-- total offices -->
    <?php
    $date = date('y-m-d');

    $office = 0;

    $office_count = "SELECT * FROM offices WHERE office_status != 'Archive' AND office_name != 'Admin' AND office_name != 'Guard'";

    $office_count_result = mysqli_query($GLOBALS['connection'], $office_count);

    $office = mysqli_num_rows($office_count_result);

    ?>

    <div class="col-md-6 p-1">

      <div class="box-shadow-1 text-white rounded  mb-2 p-2 bg-primary">

        <div class="d-flex justify-content-between">

          <span class="lead d-block text-uppercase">

            <h1 class="fw-bold">Offices</h1>

          </span>

          <div class="pe-2">

            <h2 class="fw-bold"><?= $office ?></h2>

          </div>

        </div>

        <hr>

        <div class="text-end">

          <a href="offices.php?id=0" class="text-decoration-none text-white">View More &rarr;</a>

        </div>

      </div>

    </div>

    <!-- pending queues -->
    <?php
    $status = null;
    $pending_queue = 0;

    $select_queuelist = "SELECT * FROM reservations WHERE (status = 'Pending' OR status = 'Transferred') AND date = '$date'";

    $select_queuelist_result = mysqli_query($GLOBALS['connection'], $select_queuelist);

    $pending_queue = mysqli_num_rows($select_queuelist_result);

    ?>

    <div class="col-md-6 p-1">

      <div class="box-shadow-1 text-white rounded  mb-2 p-2 bg-warning">

        <div class="d-flex justify-content-between">

          <span class="lead d-block text-uppercase">

            <h1 class="fw-bold">Pending Queues</h1>

          </span>

          <div class="pe-2">

            <h2 class="fw-bold"><?= $pending_queue ?></h2>

          </div>

        </div>

        <hr>

        <div class="text-end">

          <a href="queue-list.php?call=0" class="text-decoration-none text-white">View More &rarr;</a>

        </div>

      </div>

    </div>

  </div>

</div>


<?php include 'includes/footer.php' ?>