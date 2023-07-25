<?php
session_start();
include 'includes/header.php';
include 'includes/navbar.php';
include 'includes/sidenav.php';
superadmin_sidenav();

?>

<div class="container">

  <div class="overflow-auto py-3">

    <form action="" method="GET" class="border box-shadow-1 border-top-3px rounded p-3 bg-white">
      <?php $date = date('Y-m-d');
      $null = NULL;
      ?>

      <div class="overflow-auto">

        <table id="table" class="table display align-middle nowrap" cellspacing="0">

          <thead>

            <tr>
              <th>Fullname</th>

              <th>Action</th>

              <th>Date</th>

              <th>Time</th>

            </tr>

          </thead>

          <tbody>

            <?php
            $select_activity_log = "SELECT * FROM activity_log WHERE date = '$date'";

            $select_activity_log_result = mysqli_query($GLOBALS['connection'], $select_activity_log);

            while ($rows = mysqli_fetch_assoc($select_activity_log_result)) :

            ?>

              <tr>

                <td><?= $rows['name'] ?></td>

                <td><?= $rows['actions'] ?></td>

                <td><?= $rows['date'] ?></td>

                <td><?= $rows['time'] ?></td>

              </tr>

            <?php endwhile ?>

          </tbody>

        </table>

      </div>

    </form>

  </div>

</div>

<div class="text-end text-muted col-11 pe-2">

  <h4>

    <!-- <?= date('M-d-y'); ?> -->

  </h4>

</div>

<?php include 'includes/footer.php';
