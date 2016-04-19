<?php

//includes

require_once "config.php";
require_once "session.php";
require_once "admincheck.php";

//sets appointment to approved for appointment id in GET

if (isset ($_GET['id'])) {
    $appointment = $_GET['id'];
    $updateQuery = "UPDATE `appointments` SET `approved` = '1' WHERE `id` = $appointment;";
    $updateQueryResult = mysqli_query($connect, $updateQuery);
    header('Location: appointmentrequests.php?message=1');
}






