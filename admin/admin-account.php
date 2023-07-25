<?php
session_start();
include 'includes/header.php';
include 'includes/navbar.php';
include 'includes/sidenav.php';
include 'functions/account_function.php';
superadmin_sidenav();
?>

<form action="" method="GET">

  <div class="container-fluid">

    <div class="row p-2">

      <div class="col-md-12 p-2">

        <h3 class="text-uppercase text-color fw-bold">Account

          <a href="new-admin-account.php?office=false" class="btn m-1 btn btn-bg-main btn-bg-main-hover"><i class="fa-solid fa-plus"></i>
          </a>

        </h3>

        <?php

        echo $message;

        ?>

        <div class=" box-shadow-1 border-top-3px rounded p-2 bg-white">

          <div class="overflow-auto">

            <table id="table" class="table display align-middle nowrap" cellspacing="0">

              <thead class="text-muted">

                <tr>

                  <th>Email</th>

                  <th>Name</th>

                  <th>Role</th>

                  <th class="mw-10r">Action</th>

                </tr>

              </thead>

              <tbody class="text-muted">

                <?php
                global $account_id;

                $select_accounts = "SELECT * FROM user ORDER BY fullname";

                $select_accounts_result = mysqli_query($GLOBALS['connection'], $select_accounts);

                while ($row = mysqli_fetch_assoc($select_accounts_result)) {
                  $account_id = $row['id'];

                ?>

                  <tr>

                    <td><?= $row['email'] ?></td>

                    <td><?= $row['fullname'] ?></td>

                    <td><?= $row['role'] ?></td>

                    <td>

                      <a href="#editAccountModal<?= $account_id ?>" class="btn" data-bs-toggle="modal"><i class="fa-solid fa-edit text-primary"></i></a>

                      <?php
                      if ($row['user_status'] === 'Active') { ?>

                        <a href="admin-account.php?archive=<?= $account_id ?>" class="btn"><i class="fa-solid fa-archive text-warning"></i></a>

                      <?php } else { ?>

                        <a href="admin-account.php?active=<?= $account_id ?>" class="btn"><i class="fa-solid fa-check text-success"></i></a>

                      <?php } ?>

                      <?php include 'modals/edit-account-modal.php'; ?>

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

<?php
include 'includes/footer.php';
?>