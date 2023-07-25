<?php
session_start();
include 'includes/header.php';
include 'includes/navbar.php';
include 'includes/sidenav.php';
superadmin_sidenav();

?>

<div class="container-fluid">

  <div class="row p-2">

    <div class="p-2">

      <form action="" method="get">

        <h3 class="text-uppercase text-color fw-bold">Pending Queues</h3>

        <div class="input-group gap-2">

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
                    $of = $rows['office_name'];
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

                  <a href="queue-list.php?office=<?= $row['office_name'] ?>" class="nav-link text-muted"><?= $row['office_name'] ?></a>

                </li>

              <?php }

              ?>

            </ul>

          </div>

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

          <input type="hidden" name="o" id="" value="<?= $of ?>">

          <button type="submit" class="btn btn-bg-main btn-bg-main-hover mb-2">Search</button>

        </div>

      </form>

      <div class="box-shadow-1 border-top-3px rounded p-0 p-2 bg-white">

        <div class="overflow-auto ">

          <table id="table" class="table display align-middle nowrap" cellspacing="0">

            <thead class="text-muted">

              <tr>

                <th>Queue Number</th>

                <th>Name</th>

                <th>Transaction</th>

                <th>Designated Office</th>

                <th>Date</th>

              </tr>

            </thead>

            <tbody class="text-muted">

              <?php
              $status = null;
              $date = date('y-m-d');

              if (isset($_GET['transaction']) && isset($_GET['o'])) :
                $transaction = $_GET['transaction'];
                $o = $_GET['o'];

                $select_queue_list  = "SELECT * FROM reservations WHERE transaction = '$transaction' AND office = '$o' AND(status = 'Pending' OR status = 'Transferred') AND date = '$date'";

              elseif (isset($_GET['office'])) :
                $o = $_GET['office'];
                $select_queue_list  = "SELECT * FROM reservations WHERE office = '$o' AND (status = 'Pending' OR status = 'Transferred')AND  date = '$date'";

              else :
                $select_queue_list  = "SELECT * FROM reservations WHERE (status = 'Pending' OR status = 'Transferred')AND  date = '$date'";

              endif;

              $select_queue_list_result  = mysqli_query($GLOBALS['connection'], $select_queue_list);

              while ($row = mysqli_fetch_assoc($select_queue_list_result)) {

              ?>

                <tr>

                  <td><?= $row['transaction_number'] ?></td>

                  <td><?= $row['name'] ?></td>

                  <td><?= $row['transaction'] ?></td>

                  <td><?= $row['office'] ?></td>

                  <td><?= $row['date'] ?></td>

                </tr>

              <?php } ?>

            </tbody>

          </table>

        </div>

      </div>

    </div>

  </div>

</div>

<?php include 'includes/footer.php' ?>