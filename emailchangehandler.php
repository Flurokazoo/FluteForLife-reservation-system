<?php
require_once "config.php";
require_once "session.php";
require_once "admincheck.php";

if (isset ($_POST['submit'])) {

    //Creates variables to check password, user id, and new e-mail adress

    $emailInput = mysqli_escape_string($connect, $_POST['email']);
    $clientidInput = mysqli_escape_string($connect, $_POST['clientid']);
    $passwordCheck = mysqli_escape_string($connect, md5($_POST['password']));

//This query checks if password filled in checks out

    $passwordQuery = "SELECT `password` FROM `users` WHERE `id` = $id;";
    $passwordResults = mysqli_query($connect, $passwordQuery);
    $passwordResult = mysqli_fetch_assoc($passwordResults);


    //Checks if the entered e-mail is already in database, if it doesn't, writes the new e-mail adress to db

    $emailQuery = "SELECT `email` FROM `users` WHERE `email` = '" . $emailInput . "';";
    $emailResults = mysqli_query($connect, $emailQuery);
    $emailresultFetched = mysqli_fetch_assoc($emailResults);
    if (!$emailresultFetched['email']) {
        if ($passwordResult['password'] == $passwordCheck) {
            echo "lekker";
            $updateQuery = "UPDATE `users` SET `email` = '$emailInput' WHERE `id` = $clientidInput;";
            mysqli_query($connect, $updateQuery);
            mysqli_close($connect);
            header('Location:emailchange.php?message=1');
        }

    } else {
        header('Location:emailchange.php?message=2');
    }


}