<?php
session_start();
include 'includes/header.php';
include 'includes/navbar.php';
guard_navbar();

// functions
include 'functions/reservation-function.php';
?>

<div class="container">

  <div class="row">

    <div class="col-md-10 col-lg-6 m-auto py-5">

      <form action="" method="POST" class="border box-shadow-1 border-top-3px mt-3 bg-white">

        <div class="text-center text-muted text-uppercase mt-3">

          <h4 class="fw-bold">

            Walk-in Form

            <hr>

          </h4>

        </div>

        <div class="m-2">

          <?php

          echo $message;

          ?>

          <div class="d-flex">

            <p></p>

            <div class="dropdown  form-control p-2 rounded mb-2">

              <a href="" data-bs-toggle="dropdown" class="d-block w-100 text-decoration-none text-muted">

                <?php
                if (isset($_GET['status'])) {
                  $status = $_GET['status'];
                  if ($status === 'new') {
                    echo 'New Visitor';
                  } else {
                    echo 'Student';
                  }
                } else {
                  echo '--Please Choose--';
                }
                ?>
              </a>

              <ul class="dropdown-menu">

                <?php

                if (!empty($_GET['office'])) {
                ?>
                  <li class="dropdown-item"><a href="walkin.php?status=new&office=<?= $_GET['office'] ?>" class="nav-link text-muted">New Visitor</a></li>

                  <li class="dropdown-item"><a href="walkin.php?status=old&office=<?= $_GET['office'] ?>" class="nav-link text-muted">Student</a></li>

                <?php
                } else { ?>

                  <li class="dropdown-item"><a href="walkin.php?status=new" class="nav-link text-muted">New Visitor</a></li>

                  <li class="dropdown-item"><a href="walkin.php?status=old" class="nav-link text-muted">Student</a></li>

                <?php } ?>

              </ul>

            </div>

          </div>

          <div class="d-flex">

            <p></p>

            <div class="dropdown  form-control p-2 rounded mb-2">

              <a href="" data-bs-toggle="dropdown" class="d-block w-100 text-decoration-none text-muted">

                <?php
                if (isset($_GET['office'])) {
                  $office = $_GET['office'];

                  $get_office = "SELECT * FROM offices  WHERE transaction_status = 'Continue' AND office_status = 'Active' AND office_name != 'Admin' AND office_name != 'Guard'  ORDER BY office_name";

                  $get_office_result = mysqli_query($GLOBALS['connection'], $get_office);

                  while ($rows = mysqli_fetch_assoc($get_office_result)) {

                    if ($office === $rows['office_name']) {
                      echo $rows['office_name'];
                    }
                  }
                } else {
                  echo '--Choose Office--';
                }
                ?>
              </a>

              <ul class="dropdown-menu">

                <?php

                $select_office = "SELECT * FROM offices  WHERE transaction_status = 'Continue' AND office_status = 'Active' AND office_name != 'Admin' AND office_name != 'Guard'  ORDER BY office_name";

                $select_office_result = mysqli_query($GLOBALS['connection'], $select_office);

                while ($row = mysqli_fetch_assoc($select_office_result)) {

                ?>

                  <li class="dropdown-item">
                    <?php

                    if (!empty($_GET['status'])) {

                    ?>
                      <a href="walkin.php?status=<?= $_GET['status'] ?>&office=<?= $row['office_name'] ?>" class="nav-link text-muted"><?= $row['office_name'] ?></a>

                    <?php
                    } else { ?>
                      <a href="walkin.php?office=<?= $row['office_name'] ?>" class="nav-link text-muted"><?= $row['office_name'] ?></a>

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

          if (isset($_GET['status'])) {
            $status = $_GET['status'];
            if ($status === 'new') {
              echo "
               <div class='d-flex'>

              <p></p>

              <input type='email' name='walkin-email' id='' class='form-control mb-2 ' placeholder='Enter Your Email' required>
              
              </div>";
            } else {
              echo "
               <div class='d-flex'>

              <p></p>

              <input type='number' name='walkin-email' id='' class='form-control mb-2 ' placeholder='Enter Your Student Number:' required>
              
              </div>";
            }
          }

          ?>

          <div class="d-flex input-group">

            <p></p>

            <input type="text" name="walkin-firstname" id="" class="form-control mb-2 rounded" placeholder="Firstname" required>

            <input type="text" name="walkin-middlename" id="" class="form-control mb-2 rounded mx-2" placeholder="Middlename">

            <p></p>
            <input type="text" name="walkin-lastname" id="" class="form-control mb-2 rounded" placeholder="Lastname" required>

          </div>



          <div class="d-flex">
            <p></p>

            <select name="transaction" id="" class="form-select  mb-2" required>

              <option value="" selected disabled class="text-muted">--Choose Transaction--</option>

              <?php

              $select_transaction = "SELECT * FROM transactions WHERE status = 'Active' AND office_name = '$office' ORDER BY Transaction";

              $select_transaction_result = mysqli_query($GLOBALS['connection'], $select_transaction);

              while ($r = mysqli_fetch_assoc($select_transaction_result)) {
              ?>

                <option value="<?= $r['transaction'] ?>"><?= $r['transaction'] ?></option>

              <?php } ?>

              <option value="Others">Others</option>

            </select>

          </div>

          <?php
          if (isset($_GET['status'])) {

          ?>
            <button type="submit" id="" name="walkin-reservation-btn" class="m-2 btn d-block btn-bg-main btn-bg-main-hover w-100 m-auto mt-2">Submit</button>
          <?php } ?>

        </div>

      </form>

    </div>

  </div>

</div>

<?php include 'includes/footer.php'; ?>