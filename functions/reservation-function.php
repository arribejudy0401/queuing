<?php

include "functions/validations.php";

function online_reservation_function()
{
  global $message;

  if (isset($_POST['reservation-btn'])) {
    $date = date('Y-m-d');

    if ($_GET['status'] === 'new') {
      $user_status = 'New Visitor';
      if (strpos($_POST['student-email'], '@btech.ph.education') === false) {
        $appointed_email = $_POST['student-email'];
      }
    } else {
      $user_status = 'Student';
      $appointed_email = $_POST['student-email'] . '@btech.ph.education';
    }

    $firstname = mysqli_real_escape_string($GLOBALS['connection'], $_POST['student-firstname']);
    $middlename = mysqli_real_escape_string($GLOBALS['connection'], $_POST['student-middlename']);
    $lastname = mysqli_real_escape_string($GLOBALS['connection'], $_POST['student-lastname']);

    $appointed_name = $firstname  . " " . $middlename . " " . $lastname;
    $designated_office = $_GET['office'];
    $transaction = $_POST['transaction'];
    $status = null;
    $transaction_type = "Online";

    $appointed_name = mysqli_real_escape_string($GLOBALS['connection'], $appointed_name);
    $designated_office = mysqli_real_escape_string($GLOBALS['connection'], $designated_office);
    $transaction = mysqli_real_escape_string($GLOBALS['connection'], $transaction);

    if (isset($appointed_email)) {
      // check if the user already queue itself for the day
      $check_existing_queue = "SELECT * FROM reservations WHERE date = '$date' AND (email = '$appointed_email'  OR name = '$appointed_name')";
      $check_existing_queue_result = mysqli_query($GLOBALS['connection'], $check_existing_queue);

      if (mysqli_num_rows($check_existing_queue_result)) {
        $message =
          "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'>Already reserved, kindly check your email for your reference number.</span>";
      } else {
        // get the limit
        $select_limit = "SELECT * FROM offices WHERE office_name = '$designated_office'";
        $select_limit_result = mysqli_query($GLOBALS['connection'], $select_limit);
        while ($rows = mysqli_fetch_assoc($select_limit_result)) {
          $office_limit = $rows['number_of_transaction'];
          $queues = $rows['available_transactions'];
          $curdate = $rows['date'];
        }

        // if the limit is not 0
        if ($queues != 0) {

          // checking date for the reset of limit
          if ($curdate === $date) {
            $total_queues = $queues - 1;
          } else {
            $total_queues = $office_limit;
          }

          // generating transaction number
          $reference_number = "OL-" . rand(111111, 999999);

          $insert_reservation = "INSERT INTO reservations ( reference_number,user_status, firstname,middlename,lastname,name , email, office, transaction,transaction_type,date, status) VALUES ('$reference_number','$user_status' ,'$firstname','$middlename','$lastname','$appointed_name', '$appointed_email', '$designated_office', '$transaction','$transaction_type', '$date','$status')";

          $insert_reservation_result = mysqli_query($GLOBALS['connection'], $insert_reservation);


          if ($insert_reservation_result) {

            $to = $appointed_email;

            $subject = "Baliwag Polytechnic College Online Reservation";

            $body = "Good Day! your reference number is $reference_number, Please show this message to the guard to get your queue number.";

            $header = "From:btechqueuing001@gmail.com";

            mail($to, $subject, $body, $header);

            $update_available_transaction = "UPDATE offices SET available_transactions = '$total_queues' , date = '$date' WHERE office_name = '$designated_office'";
            $update_available_transaction_result = mysqli_query($GLOBALS['connection'], $update_available_transaction);

            header("location:registered-number.php?e=$appointed_email&o=$designated_office&date=$date");
          }
        } else {
          if ($curdate !== $date) {
            $update_available_transaction = "UPDATE offices SET available_transactions = '$office_limit' , date = '$date' WHERE office_name = '$designated_office'";
            $update_available_transaction_result = mysqli_query($GLOBALS['connection'], $update_available_transaction);
          } else {
            $message =
              "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'>Daily limit has been reached</span>";
          }
        }
      }
    } else {
      $message =
        "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'>Please input a valid email!</span>";
    }
  }
}
online_reservation_function();


// for walkins
function walkin_reservation_function()
{
  global $message;

  if (isset($_POST['walkin-reservation-btn'])) {
    $date = date('Y-m-d');

    if ($_GET['status'] === 'new') {
      $user_status = 'New Visitor';
      if (strpos($_POST['walkin-email'], '@btech.ph.education') === false) {
        $walkin_email = $_POST['walkin-email'];
      }
    } else {
      $user_status = 'Student';
      $walkin_email = $_POST['walkin-email'] . '@btech.ph.education';
    }

    $designated_office = $_GET['office'];
    $firstname = mysqli_real_escape_string($GLOBALS['connection'], $_POST['walkin-firstname']);
    $middlename = mysqli_real_escape_string($GLOBALS['connection'], $_POST['walkin-middlename']);
    $lastname = mysqli_real_escape_string($GLOBALS['connection'], $_POST['walkin-lastname']);

    $walkin_name = $firstname . " " . $middlename . " " . $lastname;
    $transaction = $_POST['transaction'];
    $null = null;
    $transaction_type = "Walk-in";

    $designated_office = mysqli_real_escape_string($GLOBALS['connection'], $designated_office);
    $transaction = mysqli_real_escape_string($GLOBALS['connection'], $transaction);

    if (isset($walkin_email)) {
      // check if the user already have a queue
      $select_user = "SELECT * FROM reservations WHERE date = '$date' AND name = '$walkin_name' AND email = '$walkin_email'";
      $select_user_result = mysqli_query($GLOBALS['connection'], $select_user);

      if (mysqli_num_rows($select_user_result)) {
        $message =
          "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'>Already in the queue</span>";
      } else {

        // get the limit
        $select_limit = "SELECT * FROM offices WHERE office_name = '$designated_office'";
        $select_limit_result = mysqli_query($GLOBALS['connection'], $select_limit);
        while ($rows = mysqli_fetch_assoc($select_limit_result)) {
          $office_limit = $rows['number_of_transaction'];
          $queues = $rows['available_transactions'];
          $curdate = $rows['date'];
        }

        // if the limit is not 0
        if ($queues != 0) {

          // checking date for the reset of limit
          if ($curdate === $date) {
            $total_queues = $queues - 1;
          } else {
            $total_queues = $office_limit;
          }

          // generating transaction number
          $select_reservation = "SELECT * FROM reservations WHERE date = '$date' AND transaction_type != 'Online'";

          $select_reservation_result = mysqli_query($GLOBALS['connection'], $select_reservation);

          $transaction_number = 1;

          while ($row = mysqli_fetch_assoc($select_reservation_result)) {
            $transaction_number = $transaction_number + 1;
          }

          $number = 'WI-' . $transaction_number;

          $insert_reservation = "INSERT INTO reservations ( transaction_number, user_status, firstname, middlename,lastname,name ,email, office, transaction,transaction_type,date, status) VALUES ('$number' ,'$user_status','$firstname','$middlename','$lastname','$walkin_name', '$walkin_email','$designated_office', '$transaction','$transaction_type', '$date','Pending')";

          $insert_reservation_result = mysqli_query($GLOBALS['connection'], $insert_reservation);

          if ($insert_reservation_result) {
            echo 'Success';

            $to = $walkin_email;

            $subject = "Baliwag Polytechnic College Online Reservation";

            $body = "Good Day! your queue number is $number.";

            $header = "From:btechqueuing001@gmail.com";

            mail($to, $subject, $body, $header);

            // update available transactions
            $update_available_transaction = "UPDATE offices SET available_transactions = '$total_queues' , date = '$date' WHERE office_name = '$designated_office'";
            $update_available_transaction_result = mysqli_query($GLOBALS['connection'], $update_available_transaction);


            header("location:guard-generated-queue.php?o=$designated_office&date=$date&name=$walkin_name&type=Walk-in&e=$walkin_email");
          }
        } else {
          if ($curdate !== $date) {
            $update_available_transaction = "UPDATE offices SET available_transactions = '$office_limit' , date = '$date' WHERE office_name = '$designated_office'";
            $update_available_transaction_result = mysqli_query($GLOBALS['connection'], $update_available_transaction);
          } else {
            $message =
              "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'>Daily limit has been reached</span>";
          }
        }
      }
    } else {
      $message =
        "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'>Please input a valid email</span>";
    }
  }
}

walkin_reservation_function();
