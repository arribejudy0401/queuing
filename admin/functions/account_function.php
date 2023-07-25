<?php

include 'functions/validations.php';

// adding an account function
function addAccount()
{
  global $message;

  if (isset($_POST['new-account-btn'])) {

    $new_account_office = mysqli_real_escape_string($GLOBALS['connection'], $_GET['office']);

    if ($new_account_office !== 'Admin' && $new_account_office !== 'Guard') {
      $new_account_window = mysqli_real_escape_string($GLOBALS['connection'], $_POST['window']);
    } else {
      $new_account_window = Null;
    }

    $new_account_email = mysqli_real_escape_string($GLOBALS['connection'], $_POST['admin-account-email']);
    $new_account_firstname = mysqli_real_escape_string($GLOBALS['connection'], $_POST['admin-firstname']);
    $new_account_middlename = mysqli_real_escape_string($GLOBALS['connection'], $_POST['admin-middlename']);
    $new_account_lastname = mysqli_real_escape_string($GLOBALS['connection'], $_POST['admin-lastname']);
    $new_account_fullname = $new_account_firstname . "  " . $new_account_middlename . "  " . $new_account_lastname;
    $new_account_password = $_POST['admin-password'];
    $new_account_confirm_password = $_POST['admin-confirm-password'];


    if (($new_account_confirm_password === $new_account_password) && (!empty($new_account_confirm_password)) && (!empty($new_account_password))) {

      $select_existing_user = "SELECT * FROM user WHERE email = '$new_account_email'";

      $select_existing_user_result = mysqli_query($GLOBALS['connection'], $select_existing_user);

      if (mysqli_num_rows($select_existing_user_result)) {
        $message =
          "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'>User already exist</span>";
      } else {

        // crypting password
        $new_account_password = crypt($new_account_password, "$2y$10$53a9122c3bea3872fc03bg");

        $new_account_password = mysqli_real_escape_string($GLOBALS['connection'], $new_account_password);

        $new_account_confirm_password = mysqli_real_escape_string($GLOBALS['connection'], $new_account_confirm_password);

        // adding new account
        $insert_new_account  = " INSERT INTO user (firstname, middlename, lastname, fullname, email, password,  role, window_name) VALUES ('$new_account_firstname','$new_account_middlename','$new_account_lastname','$new_account_fullname', '$new_account_email', '$new_account_password', '$new_account_office','$new_account_window') ";

        $insert_new_account_result = mysqli_query(
          $GLOBALS['connection'],
          $insert_new_account
        );

        if ($insert_new_account_result) {
          $message =
            "<span class='d-block alert alert-success p-2 mb-1 text-center fw-bold'>Account added successfully</span>";

          $action = 'Added ' . $new_account_fullname .  ' account';

          insert_activity('admin-fullname', $action);
        }

        validation($insert_new_account_result);
      }
    } else {
      $message =
        "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'>Password didn't match</span>";
    }
  }
}

addAccount();

// edit account function
function editAccount()
{

  global $message;

  if (isset($_POST['edit-account-btn'])) {

    $id = mysqli_real_escape_string($GLOBALS['connection'], trim($_POST['edit-account-id']));

    $edit_account_office = mysqli_real_escape_string($GLOBALS['connection'], $_POST['department']);
    $edit_account_window = mysqli_real_escape_string($GLOBALS['connection'], $_POST['window']);
    $edit_account_email = mysqli_real_escape_string($GLOBALS['connection'], trim($_POST['admin-account-email']));
    $edit_account_firstname = mysqli_real_escape_string($GLOBALS['connection'], trim($_POST['admin-firstname']));
    $edit_account_middlename = mysqli_real_escape_string($GLOBALS['connection'], trim($_POST['admin-middlename']));
    $edit_account_lastname = mysqli_real_escape_string($GLOBALS['connection'], trim($_POST['admin-lastname']));
    $edit_account_fullname = $edit_account_firstname . "  " . $edit_account_middlename . "  " . $edit_account_lastname;
    trim($edit_account_fullname);
    $edit_account_password = $_POST['admin-password'];
    $edit_account_confirm_password = $_POST['admin-confirm-password'];


    if (($edit_account_confirm_password === $edit_account_password) && (!empty($edit_account_confirm_password)) && (!empty($edit_account_password))) {


      $select_existing_user = "SELECT * FROM user WHERE email = '$edit_account_email' AND id != '$id'";

      $select_existing_user_result = mysqli_query($GLOBALS['connection'], $select_existing_user);

      if (mysqli_num_rows($select_existing_user_result)) {
        $message =
          "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'>User already exist</span>";
      } else {

        // crypting password
        $edit_account_password = crypt($edit_account_password, "$2y$10$53a9122c3bea3872fc03bg");

        $edit_account_password = mysqli_real_escape_string($GLOBALS['connection'], $edit_account_password);

        $edit_account_confirm_password = mysqli_real_escape_string($GLOBALS['connection'], $edit_account_confirm_password);

        // editing new account
        $insert_edit_account  = "UPDATE user SET firstname = '$edit_account_firstname', middlename = '$edit_account_middlename', lastname = '$edit_account_lastname', fullname = '$edit_account_fullname', email = '$edit_account_email', password = '$edit_account_password', role = '$edit_account_office', window_name = '$edit_account_window' WHERE id ='$id'";

        $insert_edit_account_result = mysqli_query(
          $GLOBALS['connection'],
          $insert_edit_account
        );

        if ($insert_edit_account_result) {
          $message =
            "<span class='d-block alert alert-success p-2 mb-1 text-center fw-bold'>Account edited successfully</span>";

          $action = 'Edit ' . $edit_account_fullname .  ' account';

          insert_activity('admin-fullname', $action);
        }

        validation($insert_edit_account_result);
      }
    } else {
      $message =
        "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'>Password didn't match</span>";
    }
  }
}
editAccount();

// archive user account 
function archiveAccount()
{
  global $message;

  if (isset($_GET['archive'])) {

    $id = $_GET['archive'];

    $archive_account = "UPDATE user SET user_status ='Archive' WHERE id = '$id'";

    $archive_account_result = mysqli_query($GLOBALS['connection'], $archive_account);

    if ($archive_account_result) {
      $message =
        "<span class='d-block alert alert-success p-2 mb-1 text-center fw-bold'>Account archived successfully</span>";

      insert_activity('admin-fullname', 'Archive an account');
    }
  }
}

archiveAccount();

// activate user account 
function activateAccount()
{
  global $message;

  if (isset($_GET['active'])) {

    $id = $_GET['active'];

    $activate_account = "UPDATE user SET user_status ='Active' WHERE id = '$id'";

    $activate_account_result = mysqli_query($GLOBALS['connection'], $activate_account);

    if ($activate_account_result) {
      $message =
        "<span class='d-block alert alert-success p-2 mb-1 text-center fw-bold'>Account activated successfully</span>";

      insert_activity('admin-fullname', 'Activated an account');
    }
  }
}

activateAccount();
