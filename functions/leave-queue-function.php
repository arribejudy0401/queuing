<?php


function leave_queue()
{
  if (isset($_POST['leave-btn'])) {

    $status = "Cancelled";
    $email = $_GET['e'];
    $office = $_GET['o'];
    $date = $_GET['date'];
    $null = null;

    $leaving_queue = "UPDATE reservations SET status = '$status' WHERE email = '$email' AND office = '$office' AND date = '$date' AND status = '$null'";

    $leaving_queue_result = mysqli_query($GLOBALS['connection'], $leaving_queue);

    if ($leaving_queue_result) {
      header("location:index.php");
    }
  }
}

leave_queue();
