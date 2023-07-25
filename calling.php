<?php
session_start();
include 'includes/header.php';

?>

<div class="container">

  <div class="row p-2">

    <?php
    $date = date('Y-m-d');


    // check all the existing offices
    $select_office_name = "SELECT office_name  FROM offices ORDER BY office_name";

    $select_office_name_result = mysqli_query($GLOBALS['connection'], $select_office_name);

    while ($rows = mysqli_fetch_assoc($select_office_name_result)) {
      $count = 0;
      $office_name = $rows['office_name'];

      // serching if specific window has a data
      $calling_queues = "SELECT * FROM reservations WHERE status = 'Serving' AND date = '$date' AND office = '$office_name'";

      $calling_queues_result = mysqli_query($GLOBALS['connection'], $calling_queues);

      while ($row = mysqli_fetch_assoc($calling_queues_result)) {

        $office = $row['office'];

        if ($row['window_name'] === 'Window 1') {
          $window1 = $row['transaction_number'];
        } elseif ($row['window_name'] === 'Window 2') {
          $window2 = $row['transaction_number'];
        } else {
          $window3 = $row['transaction_number'];
        }

        if ($office_name === $row['office']) {
          $row['office'] = $count++;
        }
      }

      // if the offices contains data
      if ($count !== 0) {

    ?>
        <div class="col-md-6">

          <div class=" box-shadow-1 border-top-3px rounded mb-2 p-3 bg-white">

            <h3 class=" text-uppercase text-color text-center fw-bold"><?= $office ?> </h3>

            <div class="d-flex justify-content-between">

              <h4 class="text-uppercase text-color fw-bold">Window Name</h4>

              <h4 class="text-uppercase text-color fw-bold">Queue No.</h4>

            </div>

            <!-- window 1 queue -->
            <div class="d-flex justify-content-between">

              <?php if (!empty($window1)) { ?>

                <h3 class="text-uppercase text-muted fw-bold">Window 1</h2>

                  <h3 class="fw-bold text-muted pe-5">

                  <?php

                  echo $window1;
                } ?>

                  </h3>

            </div>

            <!-- window 2 queue -->
            <div class="d-flex justify-content-between">

              <?php if (!empty($window2)) { ?>

                <h3 class="text-uppercase text-muted fw-bold">Window 2</h3>

                <h3 class="fw-bold text-muted pe-5">

                <?php echo $window2;
              } ?>

                </h3>

            </div>

            <!-- window 3 queue -->
            <div class="d-flex justify-content-between">

              <?php if (!empty($window3)) { ?>

                <h3 class="text-uppercase text-muted fw-bold">Window 3</h3>

                <h3 class="fw-bold text-muted pe-5">

                <?php echo $window3;
              } ?>

                </h3>

            </div>

          </div>

        </div>

    <?php
      }
    }
    ?>
  </div>

</div>

<script type="text/javascript">
  setTimeout(function() {
    window.location.reload();
  }, 60 * 50);
</script>

<?php include 'includes/footer.php'; ?>