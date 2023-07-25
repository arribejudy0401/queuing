<?php
include 'functions/validations.php';

// still working
function callNumber()
{
  global $message;

  if (isset($_GET['call-btn'])) {
    $status = "Serving";

    $call_number = $_GET['call-btn'];
    $window_name = $_SESSION['office-window'];
    $role = $_SESSION['office-role'];
    $count = 0;
    $date = date('y-m-d');

    // check if the window is already serving a number
    $select_office = "SELECT * FROM reservations WHERE office = '$role' AND status = 'Serving' AND date = '$date'";
    $select_office_result = mysqli_query($GLOBALS['connection'], $select_office);
    while ($row = mysqli_fetch_assoc($select_office_result)) {
      $office = $row['office'];
      $window = $row['window_name'];

      if ($window === $window_name && $role === $office) {
        $count = $count + 1;
      }
    }

    $update_reservation  = "UPDATE reservations SET status = '$status' , window_name = '$window_name' WHERE id = '$call_number'";

    // sending email
    $send_email = "SELECT * FROM reservations WHERE id = '$call_number'";
    $send_email_result = mysqli_query($GLOBALS['connection'], $send_email);
    while ($result = mysqli_fetch_assoc($send_email_result)) {
      $to = $result['email'];

      $subject = 'Now Calling';

      $body = 'Hi! ' . $result['name'] . ' , ' . $result['office'] . '  ' . $window_name . ' is calling your number please proceed to your designated window. Remember that without your appearance, your transaction will automatically be cancelled.';

      $header = "From:btechqueuing001@gmail.com";
    }

    if ($count === 0) {
      $update_reservation_result = mysqli_query($GLOBALS['connection'], $update_reservation);

      mail($to, $subject, $body, $header);
    } else {
      $message =
        "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'>Already serving a number transfer or end transaction first</span>";
    }
  }
}
callNumber();

function transferQueue()
{

  global $message;

  if (isset($_GET['transfer-transaction'])) {
    $null = NULL;
    $id = $_GET['transfer-transaction'];
    $status = 'Transferred';
    $transferred_office = $_GET['office'];
    $transferred_by = $_SESSION['office-role'] . ' ' . $_SESSION['office-window'];

    $select_transferred = "SELECT * FROM reservations WHERE id = '$id'";
    $select_transferred_result = mysqli_query($GLOBALS['connection'], $select_transferred);
    while ($row = mysqli_fetch_assoc($select_transferred_result)) {
      $transaction_number = $row['transaction_number'];
      $reference_number = $row['reference_number'];
      $name = $row['name'];
      $user_status = $row['user_status'];
      $email = $row['email'];
      $transaction = $row['transaction'];
      $transaction_type = $row['transaction_type'];
      $date = $row['date'];


      // send email
      $to = $email;
      $subject = 'Transferred Queue';
      $body = 'Hi! ' . $name . ', you are successfully transferred to ' . $transferred_office . ' by ' . $transferred_by . '.';

      $header = "From:btechqueuing001@gmail.com";
    }

    // get the limit
    $select_limit = "SELECT * FROM offices WHERE office_name = '$transferred_office'";
    $select_limit_result = mysqli_query($GLOBALS['connection'], $select_limit);
    while ($rows = mysqli_fetch_assoc($select_limit_result)) {
      $office_limit = $rows['number_of_transaction'];
      $queues = $rows['available_transactions'];
      $curdate = $rows['date'];
    }

    if ($queues != 0) {
      mail($to, $subject, $body, $header);

      // checking date for the reset of limit
      if ($curdate === $date) {
        $total_queues = $queues - 1;
      } else {
        $total_queues = $office_limit;
      }

      $insert_transfered_data = "INSERT INTO reservations (transaction_number,reference_number,name,user_status,email,office,transaction,transaction_type,date,window_name,status,transferred_by) VALUES ('$transaction_number','$reference_number','$name','$user_status','$email','$transferred_office','$transaction','$transaction_type','$date','$null','$status','$transferred_by')";

      $insert_transfered_data_result = mysqli_query($GLOBALS['connection'], $insert_transfered_data);

      if ($insert_transfered_data_result) {
        $drop_transfered_data = "DELETE FROM reservations WHERE id='$id'";
        $drop_transfered_data_result = mysqli_query($GLOBALS['connection'], $drop_transfered_data);


        $update_available_transaction = "UPDATE offices SET available_transactions = '$total_queues' , date = '$date' WHERE office_name = '$transferred_office'";
        $update_available_transaction_result = mysqli_query($GLOBALS['connection'], $update_available_transaction);
      }
    } else {
      $message =
        "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'>Daily limit has been reached data can't be transferred</span>";
    }
  }
}
transferQueue();


function completeTransaction()
{

  $status = "Completed";

  if (isset($_GET['complete-transaction'])) {

    $completed = $_GET['complete-transaction'];

    $complete_reservation = "UPDATE reservations SET status = '$status' WHERE id = '$completed'";

    $complete_reservation_result = mysqli_query($GLOBALS['connection'], $complete_reservation);

    // sending email
    $send_email = "SELECT * FROM reservations WHERE id = '$completed'";
    $send_email_result = mysqli_query($GLOBALS['connection'], $send_email);
    while ($result = mysqli_fetch_assoc($send_email_result)) {
      $to = $result['email'];

      $subject = 'Transaction Completed';

      $body = 'Hi! ' . $result['name'] . ', your transaction is completed.';

      $header = "From:btechqueuing001@gmail.com";
    }

    mail($to, $subject, $body, $header);

    validation($complete_reservation_result);
  }
}
completeTransaction();

function cancellTransaction()
{

  $status = "Cancelled";

  if (isset($_GET['cancel-transaction'])) {

    $cancelled = $_GET['cancel-transaction'];

    $cancelled_reservation = "UPDATE reservations SET status = '$status' WHERE id = '$cancelled'";

    $cancelled_reservation_result = mysqli_query($GLOBALS['connection'], $cancelled_reservation);

    // sending email
    $send_email = "SELECT * FROM reservations WHERE id = '$cancelled'";
    $send_email_result = mysqli_query($GLOBALS['connection'], $send_email);
    while ($result = mysqli_fetch_assoc($send_email_result)) {
      $to = $result['email'];

      $subject = 'Transaction Cancelled';

      $body = 'Hi! ' . $result['name'] . ', your transaction has been cancelled because of your non-appearance.';

      $header = "From:btechqueuing001@gmail.com";
    }

    mail($to, $subject, $body, $header);

    validation($cancelled_reservation_result);
  }
}
cancellTransaction();
