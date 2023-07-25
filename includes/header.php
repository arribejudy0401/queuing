<?php
ob_start();
include "admin/includes/connection.php";
include "admin/includes/timezone.php";

// function
include 'admin/functions/user-defined.php';
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

  <!-- css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" />

  <!-- font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- main css -->
  <link rel="stylesheet" href="assets/css/style.css">

  <!-- datatables css -->
  <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">

  <!-- datatable responsive -->
  <link rel="stylesheet" href="assets/css/responsive.bootstrap.min.css">

  <!-- remove banner -->
  <script src="admin/assets/js/banner-remove.js"></script>
</head>

<body>