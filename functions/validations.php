<?php
function validation($value)
{
  if (!$value) {
    die("failed to connect to the database" . mysqli_error($GLOBALS["connection"]));
  }
}
