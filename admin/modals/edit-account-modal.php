<!-- edit account modal -->
<div class="modal fade" id="editAccountModal<?= $account_id ?>" tabindex="-1" role="dialog" aria-labelledby="accountModal" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="editAccountModal<?= $account_id ?>">Edit Account</h5>

        <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">

          <span aria-hidden="true"><i class="fa fa-times"></i></span>

        </button>

      </div>

      <form action="" method="POST">

        <div class="modal-body">

          <input type="hidden" name="edit-account-id" value=" <?= $account_id ?>">

          <?php

          $select_account = "SELECT * FROM user WHERE id = '$account_id'";

          $select_account_result = mysqli_query($GLOBALS['connection'], $select_account);

          while ($rows = mysqli_fetch_assoc($select_account_result)) {

          ?>

            <select name="department" id="" class="form-select  mb-2" required>

              <option value="" selected disabled>--Choose Role--</option>

              <?php

              $select_office = "SELECT * FROM offices WHERE office_status != 'Archive' ORDER BY office_name";

              $select_office_result = mysqli_query($GLOBALS['connection'], $select_office);

              while ($row = mysqli_fetch_assoc($select_office_result)) {

              ?>

                <option value="<?= $row['office_name'] ?>" <?php if ($rows['role'] == $row['office_name']) { ?> selected <?php } ?>><?= $row['office_name'] ?></option>

              <?php } ?>

            </select>

            <?php

            ?>

            <select name="window" class="form-select mb-2" required>

              <option value="" selected disabled>Choose Window</option>

              <option value="Window 1" <?php if ($rows['window_name'] == 'Window 1') { ?> selected <?php } ?>>Window 1</option>

              <option value="Window 2" <?php if ($rows['window_name'] == 'Window 2') { ?> selected <?php } ?>>Window 2</option>

              <option value="Window 3" <?php if ($rows['window_name'] == 'Window 3') { ?> selected <?php } ?>>Window 3</option>

            </select>

            <input type="email" name="admin-account-email" id="" class="form-control mb-2" placeholder="Email" value="<?= $rows['email'] ?>">

            <input type="text" name="admin-firstname" id="" class="form-control mb-2" placeholder="First Name" value="<?= $rows['firstname'] ?>">

            <input type="text" name="admin-middlename" id="" class="form-control mb-2 " placeholder="Middle Name" value="<?= $rows['middlename'] ?>">

            <input type="text" name="admin-lastname" id="" class="form-control mb-2" placeholder="Last Name" value="<?= $rows['lastname'] ?>">

            <input type="password" name="admin-password" id="" class="form-control mb-2" minlength="8" placeholder="Enter Your New Password" required>

            <input type="password" name="admin-confirm-password" id="" class="form-control mb-2" minlength="8" placeholder="Confirm Your New Password" required>

          <?php }  ?>

        </div>

        <div class="modal-footer">

          <button type="submit" name="edit-account-btn" class="btn btn-bg-main btn-bg-main-hover mb-2">Edit</button>

        </div>

      </form>

    </div>

  </div>

</div>