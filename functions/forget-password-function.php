<?php

function forget_password()
{
  global $message;

  if (isset($_POST['forget-password-btn'])) {

    $forget_password_email = mysqli_real_escape_string($GLOBALS['connection'], $_POST['email']);

    $forget_password_email_select_query = "SELECT * FROM user WHERE email = '$forget_password_email'";

    $forget_password_email_select_query_result = mysqli_query($GLOBALS['connection'], $forget_password_email_select_query);

    if (mysqli_num_rows($forget_password_email_select_query_result)) {

      $user_code = rand(111111, 999999);
      $user_update_query = "UPDATE user SET confirmation_code = '$user_code' WHERE email = '$forget_password_email'";

      $user_update_query_result = mysqli_query($GLOBALS['connection'], $user_update_query);

      if ($user_update_query_result) {

        $row = mysqli_fetch_assoc($forget_password_email_select_query_result);

        $to = $row['email'];

        $subject = "Confirmation Code";

        $body = "Good Day! your confirmation code is: $user_code";

        $header = "From:btechqueuing001@gmail.com";

        if (mail($to, $subject, $body, $header)) {

          header("location: confirmation-code.php?e=$forget_password_email");
        }
      }
    } else {

      $message =
        "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'>Invalid email</span>";
    }
  }
}
forget_password();

function confirmation()
{

  global $message;

  if (isset($_POST['confirmation-code-btn'])) {

    $email = $_GET['e'];

    $confirmation = mysqli_real_escape_string($GLOBALS['connection'], $_POST['confirmation-code']);

    $user_select_query = "SELECT * FROM user WHERE email = '$email'";

    $user_select_query_result = mysqli_query($GLOBALS['connection'], $user_select_query);

    while ($rows = mysqli_fetch_assoc($user_select_query_result)) {
      $code = $rows['confirmation_code'];

      if ($confirmation === $code) {

        header("location: new-password.php?e=$email");
      } else {
        $message =
          "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'>Confirmation code didn't match</span>";
      }
    }
  }
}
confirmation();

function new_password()
{

  global $message;

  if (isset($_POST['new-password-btn'])) {
    $email = $_GET['e'];

    $new_password =  $_POST['new-password'];
    $confirm_new_password = mysqli_real_escape_string($GLOBALS['connection'], $_POST['confirm-new-password']);


    if ($new_password === $confirm_new_password) {

      $new_password = crypt($new_password, "$2y$10$53a9122c3bea3872fc03bg");
      $new_password = mysqli_real_escape_string($GLOBALS['connection'], $new_password);

      $user_update_query = "UPDATE user SET password = '$new_password' WHERE email = '$email'";

      $user_update_query_result = mysqli_query($GLOBALS['connection'], $user_update_query);

      if ($user_update_query_result) {

        $message =
          "<span class='d-block alert alert-success p-2 mb-1 text-center fw-bold'>Password successfully changed</span>";
      }
    } else {
      $message =
        "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'>Password mismatch</span>";
    }
  }
}
new_password();
