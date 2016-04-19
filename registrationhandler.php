<?php

require_once "config.php";
require_once "session.php";

if (isset($_SESSION['id'])) {
    header('Location: secure.php');
    exit;
}
if (isset ($_POST['submit'])) {


    // Sets variables from inputs

    $firstnameInput = mysqli_escape_string($connect, $_POST['firstname']);
    $lastnameInput = mysqli_escape_string($connect, $_POST['lastname']);
    $emailInput = mysqli_escape_string($connect, $_POST['email']);
    $streetnameInput = mysqli_escape_string($connect, $_POST['streetname']);
    $streetnrInput = mysqli_escape_string($connect, $_POST['streetnr']);
    $streetnrsuffixInput = mysqli_escape_string($connect, $_POST['streetnrsuffix']);
    $zipcodeInput = mysqli_escape_string($connect, $_POST['zipcode']);
    $cityInput = mysqli_escape_string($connect, $_POST['city']);
    $passwordInput = mysqli_escape_string($connect, md5($_POST['password']));
    $ipInput = $_SERVER['REMOTE_ADDR'];

    //check if all fields have valid inputs and if input is email

    if ($firstnameInput == '' || $lastnameInput == '' || $emailInput == '' || $streetnameInput == '' || $streetnrInput == '' || $zipcodeInput == '' || $cityInput == '' || $passwordInput == '') {
        header('Location: registration.php?error=1');
    } else {
        if (!filter_var(mysqli_escape_string($connect, $emailInput), FILTER_VALIDATE_EMAIL)) {
            header('Location: registration.php?error=3');
        } else {

            //Checks if e-mail is already in database. If so, nothing is entered to database.

            $emailquery = "SELECT * FROM `users` WHERE `email` = '" . $emailInput . "';";
            $result = mysqli_query($connect, $emailquery);
            $resultFetched = mysqli_fetch_assoc($result);

            if ($resultFetched['email']) {
                header('Location: registration.php?error=2');


            } else {
                //Query for writing to mysql
                $query = "INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `streetname`, `streetnr`, `streetnrsuffix`, `zipcode`, `city`, `password`, `ip`, `date`)
    VALUES (NULL, '" . $firstnameInput . "', '" . $lastnameInput . "', '" . $emailInput . "', '" . $streetnameInput . "', '" . $streetnrInput . "', '" . $streetnrsuffixInput . "','" . $zipcodeInput . "','" . $cityInput . "','" . $passwordInput . "', '" . $ipInput . "', CURRENT_TIMESTAMP);";

                mysqli_query($connect, $query);
                mysqli_close($connect);
                header('Location: login.php?success=1');
            }
        }
    }


} else {
    header('Location: registration.php');


}




