<?php
ob_start();
include "includes/connection.php";
include "includes/timezone.php";

// function
include 'functions/user-defined.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Btech Queuing System</title>
  <link rel="icon" type="image/x favicon" href="assets/images/btechlogo.png">


  <!-- bootstrap -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">

  <!-- font-awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- main css -->
  <link rel="stylesheet" href="assets/css/style.css">

  <!-- datatables css -->
  <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">

  <!-- datatable responsive -->
  <link rel="stylesheet" href="assets/css/responsive.bootstrap.min.css">

  <!-- remove banner -->
  <script src="assets/js/banner-remove.js"></script>
</head>

<body class="body">

  <img src="assets/images/btechlogo.png" alt="" class="banner hidden-print">