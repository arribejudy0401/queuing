<?php
session_start();
include 'includes/header.php';

if ($_SESSION['role'] == 'Admin') {
  include 'includes/navbar.php';
  include 'includes/sidenav.php';
  superadmin_sidenav();
} else {
  include 'includes/office-navbar.php';
  include 'includes/office-sidenav.php';
  office_sidenav();
}

// function 
include 'functions/transactions-function.php';

?>

<div class="container-fluid">

  <div class="row p-2">

    <div class="col-md-12 p-2">

      <h3 class="text-uppercase text-color fw-bold">Office Transactions

        <?php if ($_SESSION['role'] == 'Admin') { ?>

          <button type="button" class="btn btn-bg-main btn-bg-main-hover" data-bs-toggle="modal" data-bs-target="#addTransactionsModal"><i class="fa-solid fa-plus"></i></button>

        <?php } ?>

      </h3>

      <?php include 'modals/add-transactions.php' ?>

      <?= isset($error) ? $error['transaction'] : '' ?>
      <?= isset($success) ? $success['transaction'] : '' ?>


      <div class="box-shadow-1 rounded border-top-3px mb-2 p-2 bg-white">

        <div class="overflow-auto">

          <table id="table" class="table display align-middle nowrap " cellspacing="0">

            <thead class="text-muted">

              <th>Office Name</th>

              <th>Transactions</th>

              <th>Actions</th>

            </thead>

            <tbody class="text-muted">

              <?php
              global $transactions_id;
              $date = date('y-m-d');
              $null = null;

              // selects transactions
              $select_transactions = "SELECT * FROM transactions ORDER BY office_name";

              $select_transactions_result = mysqli_query($GLOBALS['connection'], $select_transactions);

              while ($row = mysqli_fetch_assoc($select_transactions_result)) {
                $office = $row['office_name'];
                $transaction_id = $row['id'];
              ?>

                <!-- offices -->
                <tr>

                  <td><?= $office ?></td>

                  <td><?= $row['transaction'] ?></td>

                  <td>
                    <!-- edit transactions -->
                    <?php if ($_SESSION['role'] == 'Admin') { ?> <a href="#editTransactionModal<?= $transaction_id ?>" class="btn" data-bs-toggle="modal"><i class="fa-solid fa-edit text-primary"></i></a>
                    <?php } ?>


                    <!-- activate or archive transaction -->
                    <?php

                    if ($row['status'] === 'Active') { ?>

                      <a href="office-transactions.php?archive=<?= $transaction_id ?>" class="btn"><i class="fa-solid fa-archive text-warning"></i></a>


                    <?php } else {
                    ?>

                      <a href="office-transactions.php?activate=<?= $transaction_id ?>" class="btn"><i class="fa-solid fa-check text-success"></i></a>

                    <?php

                    }

                    include 'modals/edit-transaction.php';

                    ?>

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