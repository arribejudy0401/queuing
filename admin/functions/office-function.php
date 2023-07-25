<?php
// add office name
function addOffice()
{
  global $error, $success;

  if (isset($_POST['add-office'])) {

    $office = $_POST['office-name'];
    $office_limit = $_POST['office-limit'];
    $date = date('Y-m-d');

    $count = 0;

    if (!empty($office)) {

      $select_office = "SELECT * FROM offices WHERE office_name = '$office'";

      $select_office_result = mysqli_query($GLOBALS['connection'], $select_office);

      while (mysqli_fetch_assoc($select_office_result)) {

        $count++;
      }

      if ($count != 0) {

        $error['office'] =
          "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'>$office already exist</span>";
      } else {

        $insert_office = "INSERT INTO offices (office_name, number_of_transaction, available_transactions, date) VALUES ('$office','$office_limit', '$office_limit', '$date')";

        $insert_office_result = mysqli_query($GLOBALS['connection'], $insert_office);

        if ($insert_office_result) {

          $success['office'] =
            "<span class='d-block alert alert-success p-2 mb-1 text-center fw-bold'>$office added successfully</span>";

          $action = 'Added ' . $office;

          insert_activity('admin-fullname', $action);
        }
      }
    }
  }
}
addOffice();

// update office
function updateOffice()
{
  global $error, $success;

  if (isset($_POST['edit-office'])) {

    $office_id = mysqli_real_escape_string($GLOBALS['connection'], $_POST['office-id']);
    $office_name = mysqli_real_escape_string($GLOBALS['connection'], $_POST['office-name']);
    $office_limit = mysqli_real_escape_string($GLOBALS['connection'], $_POST['office-limit']);

    $select_office = "SELECT * FROM offices WHERE office_name = '$office_name' AND id != '$office_id'";
    $select_office_result = mysqli_query($GLOBALS['connection'], $select_office);

    if (mysqli_num_rows($select_office_result)) {

      $error['office'] =
        "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'> Office name already exists</span>";
    } else {

      $update_office = "UPDATE offices SET office_name = '$office_name' , number_of_transaction = '$office_limit', available_transactions = '$office_limit'  WHERE id = '$office_id'";

      $update_office_result = mysqli_query($GLOBALS['connection'], $update_office);

      if ($update_office_result) {
        $success['office'] =
          "<span class='d-block alert alert-success p-2 mb-1 text-center fw-bold'> Edited successfully</span>";

        $action = 'Edited ' . $office_name;

        insert_activity('admin-fullname', $action);
      }
    }
  }
}
updateOffice();

// archived office
function archiveOffice()
{
  global $error, $success;

  if (isset($_GET['archive'])) {
    $id = $_GET['archive'];

    // select office name by id
    $select_office = "SELECT * FROM offices WHERE id = '$id'";

    $select_office_result = mysqli_query($GLOBALS['connection'], $select_office);
    while ($row = mysqli_fetch_assoc($select_office_result)) {
      $office = $row['office_name'];

      // archive specific office
      $archive_office = "UPDATE offices SET office_status = 'Archive' WHERE id = '$id'";

      $archive_office_result = mysqli_query($GLOBALS['connection'], $archive_office);

      if ($archive_office_result) {
        $success['office'] =
          "<span class='d-block alert alert-success p-2 mb-1 text-center fw-bold'>$office archived successfully</span>";

        insert_activity('admin-fullname', 'Archive an account');
      }
    }
  }
}
archiveOffice();

// activate office
function activateOffice()
{
  global $error, $success;

  if (isset($_GET['activate'])) {
    $id = $_GET['activate'];

    // select office name by id
    $select_office = "SELECT * FROM offices WHERE id = '$id'";

    $select_office_result = mysqli_query($GLOBALS['connection'], $select_office);
    while ($row = mysqli_fetch_assoc($select_office_result)) {
      $office = $row['office_name'];

      // activated specific office
      $activated_office = "UPDATE offices SET office_status = 'Active' WHERE id = '$id'";

      $activated_office_result = mysqli_query($GLOBALS['connection'], $activated_office);

      if ($activated_office_result) {
        $success['office'] =
          "<span class='d-block alert alert-success p-2 mb-1 text-center fw-bold'>$office activated successfully</span>";

        insert_activity('admin-fullname', 'Activated an account');
      }
    }
  }
}
activateOffice();

// stop office transaction
function pauseOffice()
{
  global $error, $success;

  if (isset($_GET['pause'])) {
    $id = $_GET['pause'];

    // select office name by id
    $select_office = "SELECT * FROM offices WHERE id = '$id'";

    $select_office_result = mysqli_query($GLOBALS['connection'], $select_office);
    while ($row = mysqli_fetch_assoc($select_office_result)) {
      $office = $row['office_name'];

      // activated specific office
      $pause_office_transaction = "UPDATE offices SET transaction_status = 'Pause' WHERE id = '$id'";

      $pause_office_transaction_result = mysqli_query($GLOBALS['connection'], $pause_office_transaction);

      if ($pause_office_transaction_result) {
        $success['office'] =
          "<span class='d-block alert alert-success p-2 mb-1 text-center fw-bold'>$office can no longer accepts transaction</span>";

        $action = 'Paused ' . $office;

        insert_activity('admin-fullname', $action);
      }
    }
  }
}
pauseOffice();

// continue office transaction
function continueOffice()
{
  global $error, $success;

  if (isset($_GET['continue'])) {
    $id = $_GET['continue'];

    // select office name by id
    $select_office = "SELECT * FROM offices WHERE id = '$id'";

    $select_office_result = mysqli_query($GLOBALS['connection'], $select_office);
    while ($row = mysqli_fetch_assoc($select_office_result)) {
      $office = $row['office_name'];

      // activated specific office
      $continue_office_transaction = "UPDATE offices SET transaction_status = 'Continue' WHERE id = '$id'";

      $continue_office_transaction_result = mysqli_query($GLOBALS['connection'], $continue_office_transaction);

      if ($continue_office_transaction_result) {
        $success['office'] =
          "<span class='d-block alert alert-success p-2 mb-1 text-center fw-bold'>$office can now accepts transaction</span>";

        $action = 'Continue ' . $office;
        insert_activity('admin-fullname', $action);
      }
    }
  }
}
continueOffice();


// cut transactions
function  cut_transaction()
{
  global $error, $success;

  if (isset($_GET['end'])) {
    $date = date('Y-m-d');
    $id = $_GET['end'];
    $null = NULL;

    // sealecting office
    $select_office = "SELECT * FROM offices WHERE id = '$id'";
    $select_office_result = mysqli_query($GLOBALS['connection'], $select_office);


    while ($rows = mysqli_fetch_assoc($select_office_result)) {
      $office_name = $rows['office_name'];

      $update_reservations = "UPDATE reservations SET status = 'Cancelled' WHERE office = '$office_name'  AND (status = 'Pending' OR status = '$null') AND date =  '$date'";

      $update_reservations_result = mysqli_query($GLOBALS['connection'], $update_reservations);

      if ($update_reservations_result) {
        $success['office'] =
          "<span class='d-block alert alert-success p-2 mb-1 text-center fw-bold'>Successfully cancelled all pending transaction</span>";

        $action = 'Cut trsaction in ' . $office_name;
        insert_activity('admin-fullname', $action);
      }
    }
  }
}
cut_transaction();
