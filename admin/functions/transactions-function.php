<?php
// add transactions name
function addTransactions()
{
  global $error, $success;

  if (isset($_POST['add-transactions'])) {

    $office = $_POST['office-name'];
    $transactions = $_POST['office-transactions'];

    $count = 0;

    if (!empty($office)) {

      $select_office = "SELECT * FROM transactions WHERE office_name = '$office' AND transaction = '$transactions'";

      $select_office_result = mysqli_query($GLOBALS['connection'], $select_office);

      while (mysqli_fetch_assoc($select_office_result)) {

        $count++;
      }

      if ($count != 0) {
        $error['transaction'] =
          "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'>$transactions in $office already exist</span>";
      } else {

        $insert_transaction = "INSERT INTO transactions (office_name, transaction) VALUES ('$office','$transactions')";

        $insert_transaction_result = mysqli_query($GLOBALS['connection'], $insert_transaction);

        if ($insert_transaction_result) {

          $success['transaction'] =
            "<span class='d-block alert alert-success p-2 mb-1 text-center fw-bold'>$transactions added successfully</span>";

          $action = 'Added ' . $transactions;

          insert_activity('admin-fullname', $action);
        }
      }
    }
  }
}
addTransactions();

// update transaction
function updateTransaction()
{
  global $error, $success;

  if (isset($_POST['edit-transaction'])) {

    $transaction_id = mysqli_real_escape_string($GLOBALS['connection'], $_POST['transaction-id']);
    $office_name = mysqli_real_escape_string($GLOBALS['connection'], $_POST['office-name']);
    $transaction = mysqli_real_escape_string($GLOBALS['connection'], $_POST['transaction']);

    $select_transaction = "SELECT * FROM transactions WHERE office_name = '$office_name' AND transaction = '$transaction' AND id != '$transaction_id'";
    $select_transaction_result = mysqli_query($GLOBALS['connection'], $select_transaction);

    if (mysqli_num_rows($select_transaction_result)) {

      $error['transaction'] =
        "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'> $transaction in $office_name already exists</span>";
    } else {

      $update_transaction = "UPDATE transactions SET office_name = '$office_name' , transaction = '$transaction'  WHERE id = '$transaction_id'";

      $update_transaction_result = mysqli_query($GLOBALS['connection'], $update_transaction);

      if ($update_transaction_result) {
        $success['transaction'] =
          "<span class='d-block alert alert-success p-2 mb-1 text-center fw-bold'> Edited successfully</span>";

        $action = 'Edited ' . $transaction;

        insert_activity('admin-fullname', $action);
      }
    }
  }
}
updateTransaction();

// archived transaction
function archiveTransaction()
{
  global $success;

  if (isset($_GET['archive'])) {
    $id = $_GET['archive'];

    // select transaction by id
    $select_transaction = "SELECT * FROM transactions WHERE id = '$id'";

    $select_transaction_result = mysqli_query($GLOBALS['connection'], $select_transaction);
    while ($row = mysqli_fetch_assoc($select_transaction_result)) {
      $office = $row['office_name'];
      $transaction = $row['transaction'];

      // archive specific transaction
      $archive_transaction = "UPDATE transactions SET status = 'Archive' WHERE id = '$id'";

      $archive_transaction_result = mysqli_query($GLOBALS['connection'], $archive_transaction);

      if ($archive_transaction_result) {
        $success['transaction'] =
          "<span class='d-block alert alert-success p-2 mb-1 text-center fw-bold'>$transaction in $office archived successfully</span>";

        if ($_SESSION['role'] == 'Admin') {
          insert_activity('admin-fullname', 'Archived a transaction');
        }
      }
    }
  }
}
archiveTransaction();

// activated transaction
function activateTransaction()
{
  global $success;

  if (isset($_GET['activate'])) {
    $id = $_GET['activate'];

    // select transaction by id
    $select_transaction = "SELECT * FROM transactions WHERE id = '$id'";

    $select_transaction_result = mysqli_query($GLOBALS['connection'], $select_transaction);
    while ($row = mysqli_fetch_assoc($select_transaction_result)) {
      $office = $row['office_name'];
      $transaction = $row['transaction'];

      // activate specific transaction
      $activate_transaction = "UPDATE transactions SET status = 'Active' WHERE id = '$id'";

      $activate_transaction_result = mysqli_query($GLOBALS['connection'], $activate_transaction);

      if ($activate_transaction_result) {
        $success['transaction'] =
          "<span class='d-block alert alert-success p-2 mb-1 text-center fw-bold'>$transaction in $office activated successfully</span>";

        if ($_SESSION['role'] == 'Admin') {
          insert_activity('admin-fullname', 'Activated a transaction');
        }
      }
    }
  }
}
activateTransaction();
