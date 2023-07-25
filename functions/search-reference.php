<?php
function search_reference()
{
  global $message;

  if (isset($_GET['reference'])) {
    $date = date('Y-m-d');
    $reference_number  = $_GET['reference'];
    $null = null;


    $select_user = "SELECT * FROM reservations WHERE reference_number = '$reference_number' AND date = '$date' AND status != 'Cancelled'";
    $select_user_result = mysqli_query($GLOBALS['connection'], $select_user);

    if (mysqli_num_rows($select_user_result)) {

      $rows = mysqli_fetch_assoc($select_user_result);
      $transaction_number = $rows['transaction_number'];

      if ($transaction_number !== $null) {
        $message =
          "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'>Already in the queue</span>";
      } else {

        // select all online reservation for the day
        $select_reference_number = "SELECT * FROM reservations WHERE date = '$date' AND transaction_type = 'Online' AND transaction_number != '$null'";

        $select_reference_number_result = mysqli_query($GLOBALS['connection'], $select_reference_number);

        $type = "OL-";
        $transaction_number = 1;

        while ($row = mysqli_fetch_assoc($select_reference_number_result)) {
          $transaction_number = $transaction_number + 1;
        }

        $transaction = $type . $transaction_number;

        $update_reservation = "UPDATE reservations SET transaction_number = '$transaction', status = 'Pending' WHERE reference_number = '$reference_number'";

        $update_reservation_result = mysqli_query($GLOBALS['connection'], $update_reservation);

        // select reservation offices by reference number
        $select_reservation = "SELECT * FROM reservations WHERE reference_number = '$reference_number' AND date = '$date'";
        $select_reservation_result = mysqli_query($GLOBALS['connection'], $select_reservation);
        while ($designated = mysqli_fetch_assoc($select_reservation_result)) {
          $designated_office = $designated['office'];
          $name = $designated['name'];
          $email = $designated['email'];

          $to = $email;

          $subject = "Queue Number";

          $body = "Good Day! your queue number is $transaction.";

          $header = "From:btechqueuing001@gmail.com";

          mail($to, $subject, $body, $header);
        }

        header("location:guard-generated-queue.php?name=$name&o=$designated_office&e=$email&type=Online&date=$date&ref=$reference_number");
      }
    } else {
      $message =
        "<span class='d-block alert alert-danger p-2 mb-1 text-center fw-bold'>Reference number does not exists</span>";
    }
  }
}
search_reference();
