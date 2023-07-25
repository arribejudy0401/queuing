<?php

function student_navbar()
{
?>
  <!-- student navbar start -->
  <nav class="navbar navbar-expand-md navbar-light box-shadow-1 sticky-top">

    <div class="container">

      <span class="text-uppercase fw-bold">

        <img src="assets/images/btechlogo.png" alt="" class="navbar-brand h-4r"> btech

      </span>

    </div>

  </nav>
  <!-- end of navbar -->

<?php } ?>

<?php

function guard_navbar()
{
?>

  <!-- guard navbar start -->
  <nav class="navbar navbar-expand-md navbar-light box-shadow-1 rounded hidden-print sticky-top">

    <div class="container justify-content-between">

      <span class="text-uppercase fw-bold">

        <img src="assets/images/btechlogo.png" alt="" class="navbar-brand h-4r"> btech

      </span>

      <?php
      if (isset($_SESSION['guard-role'])) {
      ?>

        <div class="ms-auto dropdown">

          <button type="button" class="btn text-white dropdown-toggle" data-bs-toggle="dropdown"><?= $_SESSION['guard-fullname'] ?></button>

          <ul class="dropdown-menu dropdown-menu-end">

            <li class="dropdown-item">

              <a href="walkin.php" class="nav-link text-muted">Walk-in Form</a>

            </li>

            <li class="dropdown-item">

              <a href="guard.php" class="nav-link text-muted">Search Reference Number</a>

            </li>

            <li class="dropdown-item">

              <a href="guard-change-password.php" class="nav-link text-muted">Change Password</a>

            </li>

            <li class="dropdown-item"><a href="admin/logout.php?logout=true" class="nav-link text-muted">Logout</a>

            </li>

          </ul>


        </div>

      <?php } else {

        header("location:login.php");
      } ?>

    </div>

  </nav>
  <!-- end of navbar -->

<?php } ?>