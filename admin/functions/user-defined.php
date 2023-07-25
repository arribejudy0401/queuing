<?php
include 'includes/timezone.php';

function insert_activity($fullname, $action)
{
  $activity_fullname = $_SESSION[$fullname];
  $activity_role = $_SESSION['role'];
  $activity_date = date('Y-m-d');
  $activity_time = date('h:i:s a');

  $insert_activity = "INSERT INTO activity_log (name,role,actions,date,time) VALUES ('$activity_fullname', '$activity_role', '$action', '$activity_date','$activity_time')";

  $insert_activity_result = mysqli_query($GLOBALS['connection'], $insert_activity);
}
