<?php
session_start();
include 'includes/header.php';
include 'includes/navbar.php';
include 'includes/sidenav.php';
superadmin_sidenav();

// function 
include 'functions/office-function.php';


?>

<div class="container-fluid">

  <div class="row p-2">

    <div class="col-md-12 p-2">

      <h3 class="text-uppercase text-color fw-bold">Offices

        <button type="button" class="btn btn-bg-main btn-bg-main-hover" data-bs-toggle="modal" data-bs-target="#addOfficeModal"><i class="fa-solid fa-plus"></i></button>

      </h3>

      <?php include 'modals/add-office-modal.php' ?>

      <?= isset($error) ? $error['office'] : '' ?>
      <?= isset($success) ? $success['office'] : '' ?>

      <div class="box-shadow-1 rounded border-top-3px mb-2 p-2 bg-white">

        <div class="overflow-auto">

          <table id="table" class="table display align-middle nowrap " cellspacing="0">

            <thead class="text-muted">

              <th>Office Name</th>

              <th>Limit</th>

              <th>Actions</th>

            </thead>

            <tbody class="text-muted">

              <?php
              global $office_id;
              $date = date('y-m-d');
              $null = null;

              // selects offices
              $select_all_office = "SELECT * FROM offices WHERE office_name != 'Admin' AND office_name != 'Guard' ORDER BY office_name";

              $select_all_office_result = mysqli_query($GLOBALS['connection'], $select_all_office);

              while ($row = mysqli_fetch_assoc($select_all_office_result)) {
                $office = $row['office_name'];
                $office_id = $row['id'];
              ?>

                <!-- offices -->
                <tr>

                  <td><?= $office ?></td>

                  <td><?= $row['number_of_transaction'] ?></td>

                  <td>

                    <!-- pause or continue transaction -->
                    <?php

                    if ($row['transaction_status'] === 'Pause') { ?>

                      <a href="offices.php?continue=<?= $office_id ?>" class="btn"><i class="fa-solid fa-play text-muted"></i></a>

                    <?php
                    } else {

                    ?>

                      <a href="offices.php?pause=<?= $office_id ?>" class="btn"><i class="fa-solid fa-pause text-success"></i></a>

                    <?php

                    } ?>


                    <!-- edit office -->
                    <a href="#editOfficeModal<?= $office_id ?>" class="btn" data-bs-toggle="modal"><i class="fa-solid fa-edit text-primary"></i></a>



                    <!-- activate or archive office -->
                    <?php

                    if ($row['office_status'] === 'Active') { ?>

                      <a href="offices.php?archive=<?= $office_id ?>" class="btn"><i class="fa-solid fa-archive text-warning"></i></a>


                    <?php } else {
                    ?>

                      <a href="offices.php?activate=<?= $office_id ?>" class="btn"><i class="fa-solid fa-check text-success"></i></a>

                    <?php

                    } ?>

                    <!-- cut-off -->
                    <a href="offices.php?end=<?= $office_id ?>" class="btn btn-primary">End Transactions</a>

                    <?php include 'modals/edit-office-modal.php' ?>

                  </td>

                </tr>

              <?php }
              ?>

            </tbody>

          </table>

        </div>

      </div>

    </div>

  </div>

</div>


<?php include 'includes/footer.php' ?>