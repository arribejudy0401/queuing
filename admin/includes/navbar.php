<!-- navbar start -->
<nav class="navbar navbar-expand-md navbar-light sticky-top ">

  <div class="container-fluid">

    <div>

      <button class="btn offcanvas-btn-close" data-bs-target="#offCanvas" data-bs-toggle="offcanvas"><i class="fa fa-bars"></i></button>

      <span class="text-white text-uppercase fw-bold">Btech</span>

    </div>

    <?php if (isset($_SESSION["admin-role"])) { ?>

      <div class="ms-auto dropdown">

        <button type="button" class="btn text-white dropdown-toggle" data-bs-toggle="dropdown"><?php echo $_SESSION["admin-fullname"]; ?></button>

        <ul class="dropdown-menu dropdown-menu-end">

          <li class="dropdown-item">
            <a href="new-password.php" class="nav-link text-muted">Change Password</a>
          </li>

          <li class="dropdown-item"><a href="logout.php?logout=true" class="nav-link text-muted">Logout</a></li>

        </ul>

      </div>

    <?php } else {
      header("location: ../login.php");
    } ?>

  </div>



</nav>
<!-- end of navbar -->

<!-- offcanvas start -->
<div class="offcanvas offcanvas-start border-0 box-shadow-1" tabindex="-1" id="offCanvas" aria-labelledby="offCanvasLabel">

  <div class="offcanvas-header mt-4">

    <div class="m-auto ">

      <img src="assets/images/btechlogo.png" alt="" class="navbar-brand logo ">

    </div>

    <button type="button" class="offcanvas-btn-close btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>

  </div>

  <div class="offcanvas-body py-1">

    <ul class="navbar-nav">