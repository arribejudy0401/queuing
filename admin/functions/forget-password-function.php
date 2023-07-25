<?php
function change_pass()
{
  global $message;
  if (isset($_POST['new-pass-btn'])) {
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];

    $current_password = crypt($_POST['current-password'], "$2y$10$53a9122c3bea3872fc03bg");
    $new_password = $_POST['new-password'];
    $confirm_new_password = mysqli_real_escape_string($GLOBALS['connection'], $_POST['confirm-new-password']);


    if ($current_password === $password && $new_password === $confirm_new_password) {
      $current_password = mysqli_real_escape_string($GLOBALS['connection'], $current_password);

      $new_password = crypt($new_password, "$2y$10$53a9122c3bea3872fc03bg");
      $new_password = mysqli_real_escape_string($GLOBALS['connection'], $new_password);


      $update_user_password = "UPDATE user SET password = '$new_password' WHERE email = '$email'";
      $update_user_password_result = mysqli_query($GLOBALS['connection'], $update_user_password);

      if ($update_user_password_result) {
        $message =
          "<span class='d-block alert alert-success p-2 mb-1 text-center fw-bold'>Password successfully changed</span>";
        $_SESSION['password'] = $new_password;
      }
    } else if ($current_password !== $password) {
      $message =
        "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'>Invalid password</span>";
    } else {
      $message =
        "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'>New and confirm new password didn't match</span>";
    }
  }
}
change_pass();
