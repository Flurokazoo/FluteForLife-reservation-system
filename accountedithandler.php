<?php


require_once "config.php";
require_once "session.php";
require_once "redirectloggedout.php";


if (isset ($_POST['submit'])) {

    // variables for inputs

    $firstnameInput = mysqli_escape_string($connect, $_POST['firstname']);
    $lastnameInput = mysqli_escape_string($connect, $_POST['lastname']);
    $streetnameInput = mysqli_escape_string($connect, $_POST['streetname']);
    $streetnrInput = mysqli_escape_string($connect, $_POST['streetnr']);
    $streetnrsuffixInput = mysqli_escape_string($connect, $_POST['streetnrsuffix']);
    $zipcodeInput = mysqli_escape_string($connect, $_POST['zipcode']);
    $cityInput = mysqli_escape_string($connect, $_POST['city']);
    $passwordCheck = mysqli_escape_string($connect, md5($_POST['passwordCheck']));

    $passwordQuery = "SELECT `password` FROM `users` WHERE `id` = $id;";
    $passwordResults = mysqli_query($connect, $passwordQuery);
    $passwordResult = mysqli_fetch_assoc($passwordResults);

    //check if all fields have valid inputs

    if ($firstnameInput == '' || $lastnameInput == '' || $streetnameInput == '' || $streetnrInput == '' || $zipcodeInput == '' || $cityInput == '') {
        header('Location: accountedit.php?message=1');
    } else {

        //Updates the database with new data, redirects account with success/fail message
        if ($passwordResult['password'] == $passwordCheck) {
            $updateQuery = "UPDATE `users` SET `firstname` = '$firstnameInput',`lastname` = '$lastnameInput', `streetname` = '$streetnameInput', `streetnr` = '$streetnrInput', `streetnrsuffix` = '$streetnrsuffixInput', `zipcode` = '$zipcodeInput', `streetnr` = '$streetnrInput', `city` = '$cityInput' WHERE `id` = $id;";
            mysqli_query($connect, $updateQuery);
            mysqli_close($connect);
            header('Location:accountedit.php?message=3');
        } else {
            header('Location: accountedit.php?message=2');
        }
    }
}