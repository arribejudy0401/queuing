<?php
function login()
{
  global $message;

  // login btn is clicked
  if (isset($_POST['login-btn'])) {

    // get email and password
    $email = $_POST["login-email"];
    $password = $_POST["login-password"];

    // validation for empty email or password
    if (empty($email) || empty($password)) {

      $message =
        "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'>Email and password are required</span>";
    } else {

      $password = crypt($password, "$2y$10$53a9122c3bea3872fc03bg");

      $password = mysqli_real_escape_string($GLOBALS["connection"], $password);

      // checks if the inputted email and password matches the one in the database
      $login_account = " SELECT * FROM user WHERE email = '$email' AND password = '$password' AND user_status = 'Active' ";

      // sanitizing email and password
      $email = mysqli_real_escape_string($GLOBALS["connection"], $email);


      $login_result = mysqli_query($GLOBALS["connection"], $login_account);

      // checking the result
      if (mysqli_num_rows($login_result)) {

        $row = mysqli_fetch_assoc($login_result);

        // switch all the results
        switch ($row) {

            // admin
          case $row["role"] === "Admin";
            $_SESSION["admin-id"] = $row["id"];
            $_SESSION["admin-fullname"] = $row["fullname"];
            $_SESSION["admin-email"] = $row["email"];
            $_SESSION["admin-password"] = $row["password"];
            $_SESSION["admin-role"] = $row["role"];
            $_SESSION["admin-window"] = $row["window_name"];

            $_SESSION["fullname"] = $row["fullname"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["password"] = $row["password"];
            $_SESSION['role'] = $row['role'];
            insert_activity('admin-fullname', 'Logs into its account');
            header("location:admin/dashboard.php");
            break;

            // guard
          case $row["role"] === "Guard";
            $_SESSION["guard-id"] = $row["id"];
            $_SESSION["guard-fullname"] = $row["fullname"];
            $_SESSION["guard-email"] = $row["email"];
            $_SESSION["guard-password"] = $row["password"];
            $_SESSION["guard-role"] = $row["role"];

            $_SESSION["fullname"] = $row["fullname"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["password"] = $row["password"];
            $_SESSION['role'] = $row['role'];
            insert_activity('guard-fullname', 'Logs into its account');
            header("location:guard.php");
            break;

            // other role
          case $row["role"] != 'Admin' && $row["role"] != 'Guard';
            $_SESSION["office-id"] = $row["id"];
            $_SESSION["office-fullname"] = $row["fullname"];
            $_SESSION["office-email"] = $row["email"];
            $_SESSION["office-password"] = $row["password"];
            $_SESSION["office-role"] = $row["role"];
            $_SESSION['office-window'] = $row['window_name'];

            $_SESSION["fullname"] = $row["fullname"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["password"] = $row["password"];
            $_SESSION['role'] = $row['role'];
            $role = $row['role'];
            insert_activity('office-fullname', 'Logs into its account');
            header("location:admin/department.php?office=$role");
            break;

          default:
            return false;
        }
      } else {
        $message =
          "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'>Invalid email or password</span>";
      }
    }
  }
}
login();
