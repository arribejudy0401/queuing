<?php
session_start();
include 'includes/connection.php';
include 'functions/user-defined.php';
if ($_GET['logout']) {
  if ($_SESSION['role'] === 'Admin') :
    insert_activity('admin-fullname', 'Logs out');
  elseif ($_SESSION['role'] === 'Guard') :
    insert_activity('guard-fullname', 'Logs out');
  else :
    insert_activity('office-fullname', 'Logs out');
  endif;
  session_destroy();
  header('location: ../login.php');
}
