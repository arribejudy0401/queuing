<?php
session_start();
include 'includes/header.php';
include 'includes/navbar.php';
include 'includes/sidenav.php';
include 'functions/account_function.php';
superadmin_sidenav();
?>

<div class="container-fluid">

  <div class="row p-2">

    <form action="" method="POST" class="col-12 box-shadow-1 border-top-3px rounded p-3 pb-2 bg-white">

      <div class="text-center text-muted text-uppercase">

        <h4 class="fw-bold">

          New Account

          <hr>

        </h4>

      </div>

      <div class="mb-3">

        <?= $message ?>

      </div>

      <div class="d-flex">

        <p></p>

        <div class="dropdown  form-control p-2 rounded mb-2">

          <a href="" data-bs-toggle="dropdown" class="d-block w-100 text-decoration-none text-muted">

            <?php
            if (($_GET['office']) != 'false') {

              $office = $_GET['office'];

              $get_office = "SELECT * FROM offices  WHERE office_status = 'Active' ORDER BY office_name";

              $get_office_result = mysqli_query($GLOBALS['connection'], $get_office);

              while ($rows = mysqli_fetch_assoc($get_office_result)) {

                if ($office === $rows['office_name']) {
                  echo $rows['office_name'];
                }
              }
            } else {
              echo '--Choose Role--';
            }
            ?>
          </a>

          <ul class="dropdown-menu">

            <?php

            $select_office = "SELECT * FROM offices  WHERE office_status = 'Active' ORDER BY office_name";

            $select_office_result = mysqli_query($GLOBALS['connection'], $select_office);

            while ($row = mysqli_fetch_assoc($select_office_result)) {

            ?>

              <li class="dropdown-item">
                <?php

                if (!empty($_GET['status'])) {

                ?>
                  <a href="new-admin-account.php?status=<?= $_GET['status'] ?>&office=<?= $row['office_name'] ?>" class="nav-link text-muted"><?= $row['office_name'] ?></a>

                <?php
                } else { ?>
                  <a href="new-admin-account.php?office=<?= $row['office_name'] ?>" class="nav-link text-muted"><?= $row['office_name'] ?></a>

                <?php
                }
                ?>
              </li>

            <?php }

            ?>

          </ul>

        </div>

      </div>

      <?php

      if ($_GET['office'] != 'Admin' && $_GET['office'] != 'Guard') {

      ?>

        <div class="d-flex">

          <p></p>

          <select name="window" class="form-select mb-2" required>

            <option value="" selected disabled>--Choose Window--</option>

            <option value="Window 1">Window 1</option>

            <option value="Window 2">Window 2</option>

            <option value="Window 3">Window 3</option>

          </select>


        </div>

      <?php } ?>

      <div class="d-flex">

        <p></p>

        <input type="email" name="admin-account-email" id="" class="form-control mb-2" placeholder="Email" required>

      </div>

      <div class="d-flex">

        <p></p>

        <input type="text" name="admin-firstname" id="" class="form-control mb-2 " placeholder="First Name" required>

        <input type="text" name="admin-middlename" id="" class="form-control mb-2 ms-2 pe-0" placeholder="Middle Name">

        <p class="ms-2 pe-0"></p>

        <input type="text" name="admin-lastname" id="" class="form-control mb-2" placeholder="Last Name" required>

      </div>

      <div class="d-flex">

        <p></p>

        <input type="password" name="admin-password" id="" class="form-control mb-2" placeholder="Password" required>

      </div>

      <div class="d-flex">

        <p></p>

        <input type="password" name="admin-confirm-password" id="" class="form-control mb-2" placeholder="Confirm Your Password" required>

      </div>

      <div class="text-end">

        <button type="submit" name="new-account-btn" class="btn btn-bg-main btn-bg-main-hover mb-2">Add</button>

      </div>

    </form>

  </div>

</div>

<?php
include 'includes/footer.php';
?>