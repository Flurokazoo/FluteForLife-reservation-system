<?php

//includes

require_once "config.php";
require_once "session.php";
require_once "redirectloggedout.php";

/*
 * This page deletes the appointment that is set in the GET (id).
 */

//Checks the database for the appointment and whether or not it's the owner trying to delete it

$appointment = $_GET['id'];
$controlQuery = "SELECT `id` FROM `appointments` WHERE `id` = '" . $appointment . "' AND `userId` = '" . $id . "';";
$controlQueryResult = mysqli_query($connect, $controlQuery);

//If user and appointment match, or user is admin, delete the appointment from the database and returns user to original page

if (mysqli_num_rows($controlQueryResult) == 1 || isset($_SESSION['admin'])) {
    $deleteQuery = "DELETE FROM `appointments` WHERE `id` = '" . $appointment . "';";
    mysqli_query($connect, $deleteQuery);
    mysqli_close($connect);
    if (isset($_SESSION['admin'])) {
        if (isset($_GET['a'])) {
            header('Location: appointmentrequests.php?message=2');
        } else {
            header('Location: agenda.php?delete=1');
        }
    } else {
        header('Location: myappointments.php?delete=1');
    }
}
