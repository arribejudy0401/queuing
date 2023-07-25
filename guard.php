<?php
session_start();
include 'includes/header.php';
include 'includes/navbar.php';
guard_navbar();

// functions
include 'functions/reservation-function.php';
include 'functions/search-reference.php';

?>

<div class="container">

  <div class="overflow-auto py-3">

    <form action="" method="GET" class="border box-shadow-1 border-top-3px rounded p-3 bg-white">
      <?php $date = date('Y-m-d');
      $null = NULL;
      ?>

      <?= $message ?>


      <table id="table" class="table display align-middle nowrap" cellspacing="0">

        <thead>

          <tr>
            <th>Reference Number</th>

            <th>Full Name</th>

            <th>Action</th>

          </tr>

        </thead>

        <tbody>

          <?php
          $select_reference_number = "SELECT * FROM reservations WHERE date = '$date' AND status = '$null'";

          $select_reference_number_result = mysqli_query($GLOBALS['connection'], $select_reference_number);

          while ($rows = mysqli_fetch_assoc($select_reference_number_result)) :

          ?>

            <tr>

              <td><?= $rows['reference_number'] ?></td>

              <td><?= $rows['name'] ?></td>

              <td>

                <button type="submit" class="btn btn-bg-main btn-bg-main-hover" name="reference" value="<?= $rows['reference_number'] ?>">Search</button>

              </td>

            </tr>

          <?php endwhile ?>

        </tbody>

      </table>

    </form>

  </div>

</div>

<?php include 'includes/footer.php';
