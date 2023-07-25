<?php
//webhost
// $connection = mysqli_connect("localhost", "id19478660_btech_queuing", "UK6Iut]g_FgS|C}4", "id19478660_queuing_database");

// localhost
$connection = mysqli_connect("localhost", "root", "", "queuing_database");

if (!$connection) {
  echo "cant connect to the database";
}
