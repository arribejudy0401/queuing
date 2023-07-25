<?php
session_start();
include 'includes/header.php';
include 'includes/office-navbar.php';
include 'includes/office-sidenav.php';
office_sidenav();

// functions
include 'functions/actions.php';
$office = $_SESSION['office-role'];
$date = date('Y-m-d');
$null = null;
?>

<form action="" method="GET">

  <div class="container-fluid">

    <div class="row p-2">

      <h3 class="text-uppercase text-color fw-bold">Queue List</h3>

      <?= $message ?>

      <!-- queuelist for online -->
      <div class="col-md-12 mb-2">

        <div class="box-shadow-1 border-top-3px rounded bg-white p-2">

          <h2 class="text-uppercase text-color fw-bold text-center">Online</h2>

          <div class="overflow-auto mx-30vh ">

            <table id="table" class="table display  align-middle nowrap" cellspacing="0">

              <thead class="text-muted">

                <tr>

                  <th>Queue Number</th>

                  <th>User Status</th>

                  <th>Name</th>

                  <th>Email Address</th>

                  <th>Transaction</th>

                  <th>Transferred by</th>

                  <th class="mw-25r text-center">Action</th>

                </tr>

              </thead>

              <tbody class=" text-muted">

                <?php

                $select_online_queuelist = "SELECT * FROM reservations WHERE office = '$office' AND date = '$date'  AND transaction_type = 'Online' AND transaction_number != '$null' AND status != 'Cancelled' AND status != 'Completed' ORDER BY transaction_number";

                $select_online_queuelist_result = mysqli_query($GLOBALS['connection'], $select_online_queuelist);

                while ($row = mysqli_fetch_assoc($select_online_queuelist_result)) {

                ?>

                  <tr class="text-center">

                    <td><?= $row['transaction_number']; ?></td>

                    <td><?= $row['user_status']; ?></td>

                    <td><?= $row['name']; ?></td>

                    <td><?= $row['email']; ?></td>

                    <td><?= $row['transaction']; ?></td>

                    <td><?= $row['transferred_by']; ?></td>

                    <td>

                      <?php
                      if ($row['status'] === 'Serving') { ?>
                        <h6 class="d-inline pe-3">Serving </h6>
                      <?php } else {
                      ?>

                        <a href="department.php?call-btn=<?= $row['id'] ?>&office=<?= $office ?>" class="btn btn-primary text-light">Call</a>

                      <?php
                      }
                      ?>

                      <div class="dropdown m-auto d-inline">

                        <button class="dropdown-toggle btn btn-secondary" data-bs-toggle="dropdown">Transfer</button>

                        <ul class="dropdown-menu text-center">

                          <?php

                          $select_office = "SELECT * FROM offices WHERE office_status != 'Archive' AND transaction_status != 'Pause' AND office_name != 'Admin' AND office_name != 'Guard' ORDER BY office_name";

                          $select_office_result = mysqli_query($GLOBALS['connection'], $select_office);

                          while ($rows = mysqli_fetch_assoc($select_office_result)) {

                          ?>

                            <li class="dropdown-item"><a href="department.php?transfer-transaction=<?= $row['id'] ?>&office=<?= $rows['office_name'] ?>" class="text-muted text-decoration-none"><?= $rows['office_name'] ?></a></li>

                          <?php } ?>

                        </ul>

                      </div>

                      <div class="dropdown m-auto d-inline">

                        <button class="dropdown-toggle btn btn-bg-main btn-bg-main-hover" data-bs-toggle="dropdown">End</button>

                        <ul class="dropdown-menu text-center">

                          <li class="dropdown-item"><a href="department.php?cancel-transaction=<?= $row['id'] ?>&office=<?= $office ?>" class="text-muted text-decoration-none">Cancel</a></li>

                          <li class="dropdown-item"><a href="department.php?complete-transaction=<?= $row['id'] ?>&office=<?= $office ?>" class="text-muted text-decoration-none">Completed</a></li>

                        </ul>

                      </div>

                    </td>

                  </tr>

                <?php } ?>

              </tbody>

            </table>

          </div>

        </div>

      </div>

      <!-- queuelist for walk-in -->
      <div class="col-md-12">

        <div class="box-shadow-1 border-top-3px rounded bg-white p-2">

          <h2 class="text-uppercase text-color fw-bold text-center">Walk-in</h2>

          <div class=" overflow-auto mx-30vh ">

            <table id="table" class="table display align-middle nowrap" cellspacing="0">

              <thead class="text-muted">

                <tr>

                  <th>Queue Number</th>

                  <th>User Status</th>

                  <th>Name</th>

                  <th>Email Address</th>

                  <th>Transaction</th>

                  <th>Transferred by</th>

                  <th class="mw-25r text-center">Action</th>

                </tr>

              </thead>

              <tbody class=" text-muted">

                <?php

                $select_online_queuelist = "SELECT * FROM reservations WHERE office = '$office' AND date = '$date'  AND transaction_type = 'Walk-in' AND transaction_number != '$null' AND status != 'Cancelled' AND status != 'Completed'";

                $select_online_queuelist_result = mysqli_query($GLOBALS['connection'], $select_online_queuelist);

                while ($row = mysqli_fetch_assoc($select_online_queuelist_result)) {

                ?>

                  <tr class="text-center">

                    <td><?= $row['transaction_number']; ?></td>

                    <td><?= $row['user_status']; ?></td>

                    <td><?= $row['name']; ?></td>

                    <td><?= $row['email']; ?></td>

                    <td><?= $row['transaction']; ?></td>

                    <td><?= $row['transferred_by']; ?></td>

                    <td>

                      <?php
                      if ($row['status'] === 'Serving') { ?>
                        <h6 class="d-inline pe-3">Serving </h6>
                      <?php } else {
                      ?>

                        <a href="department.php?call-btn=<?= $row['id'] ?>&office=<?= $office ?>" class="btn btn-primary text-light">Call</a>

                      <?php
                      }
                      ?>

                      <div class="dropdown m-auto d-inline">

                        <button class="dropdown-toggle btn btn-secondary" data-bs-toggle="dropdown">Transfer</button>

                        <ul class="dropdown-menu text-center">

                          <?php

                          $select_office = "SELECT * FROM offices WHERE office_status != 'Archive' AND transaction_status != 'Pause' AND office_name != 'Admin' AND office_name != 'Guard' ORDER BY office_name";

                          $select_office_result = mysqli_query($GLOBALS['connection'], $select_office);

                          while ($rows = mysqli_fetch_assoc($select_office_result)) {

                          ?>

                            <li class="dropdown-item"><a href="department.php?transfer-transaction=<?= $row['id'] ?>&office=<?= $rows['office_name'] ?>" class="text-muted text-decoration-none"><?= $rows['office_name'] ?></a></li>

                          <?php } ?>

                        </ul>

                      </div>
                      <div class="dropdown m-auto d-inline">

                        <button class="dropdown-toggle btn btn-bg-main btn-bg-main-hover" data-bs-toggle="dropdown">End</button>

                        <ul class="dropdown-menu text-center">

                          <li class="dropdown-item"><a href="department.php?cancel-transaction=<?= $row['id'] ?>&office=<?= $office ?>" class="text-muted text-decoration-none">Cancel</a></li>

                          <li class="dropdown-item"><a href="department.php?complete-transaction=<?= $row['id'] ?>&office=<?= $office ?>" class="text-muted text-decoration-none">Completed</a></li>

                        </ul>

                      </div>

                    </td>

                  </tr>

                <?php } ?>

              </tbody>

            </table>

          </div>

        </div>

      </div>

    </div>

  </div>

</form>


<?php include 'includes/footer.php' ?>