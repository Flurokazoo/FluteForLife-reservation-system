<?php

//Includes

require_once "config.php";
require_once "session.php";
require_once "redirectloggedout.php";
require_once "header.php";


//Gets personal data from db to display it in form

$getPersonalInfoQuery = "SELECT * FROM `users` WHERE `id` = $id";
$getPersonalInfoResults = mysqli_query($connect, $getPersonalInfoQuery);
mysqli_close($connect);
$personalInfoResult = mysqli_fetch_assoc($getPersonalInfoResults);

//Sets message to false, and when redirected with a GET, fills it with the intended message

$message = false;

if (isset($_GET['message'])) {
    switch ($_GET['message']) {
        case 1:
            $message = "Er zijn lege invoervelden aangetroffen";
            break;
        case 2:
            $message = "Het ingevoerde wachtwoord klopt niet";
            break;
        case 3:
            $message = "Uw account is succesvol aangepast!";
            break;
    }
}

?>

    <div class="container">
        <div class="col-lg-6 col-lg-offset-3">

            <h2>Pas hier uw account aan</h2>
            <?php if ($message) { ?><span> <?= $message; ?></span>
            <?php } ?>

            <form id="registration" method="post" action="accountedithandler.php">
                <div class="form-group">
                    <label for="firstnameInput">Voornaam</label>
                    <input type="text" class="form-control" name="firstname" id="firstnameInput"
                           value="<?= $personalInfoResult['firstname']; ?>" required/>
                </div>

                <div class="form-group">
                    <label for="lastnameInput">Achternaam</label>
                    <input type="text" class="form-control" name="lastname" id="lastnameInput"
                           value="<?= $personalInfoResult['lastname']; ?>" required/>
                </div>

                <div class="form-group">
                    <label for="streetnameInput">Adres</label>

                    <div class="row">
                        <div class="col-xs-7">
                            <input type="text" class="form-control" name="streetname" id="streetnameInput"
                                   value="<?= $personalInfoResult['streetname']; ?>" required/>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" name="streetnr" id="streetnrInput"
                                   value="<?= $personalInfoResult['streetnr']; ?>" required/>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" name="streetnrsuffix" id="streetnrsuffixInput"
                                   value="<?= $personalInfoResult['streetnrsuffix']; ?>"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="zipcodeInput">Postcode</label>
                    <input type="text" class="form-control" name="zipcode" id="zipcodeInput"
                           value="<?= $personalInfoResult['zipcode']; ?>" required/>
                </div>

                <div class="form-group">
                    <label for="cityInput">Stad</label>
                    <input type="text" class="form-control" name="city" id="cityInput"
                           value="<?= $personalInfoResult['city']; ?>" required/>
                </div>

                <h3>Vul hier uw wachtwoord in ter verificatie</h3>

                <div class="form-group">
                    <label for="passwordCheck">Wachtwoord verificatie</label>
                    <input type="text" class="form-control" name="passwordCheck" id="passwordCheck"
                           placeholder="********" value="" required/>
                </div>

                <input type="submit" name="submit" class="btn btn-success" value="Verstuur" id="submitButton">

            </form>
            <a class="btn btn-primary" href=secureadmin.php>Terug naar <?php if (isset($_SESSION['admin'])) {
                    //Sets a different message for users and admins. Page relocates to secureadmin.php. If no admin session is set, that page relocates to secure.php
                    echo "admin";
                } else {
                    echo "gebruikers";
                } ?> panel</a>
        </div>
    </div>

<?=
require_once "footer.php";
?>