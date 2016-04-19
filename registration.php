<?php
require_once "config.php";
require_once "session.php";
require_once "redirectloggedin.php";
require_once "header.php";


/*
 * Error message section
 * Error will be filled according to GET given at registrationhandler.php
 */

$error = false;
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 1:
            $error = "Er zijn lege invoervelden aangetroffen";
            break;
        case 2:
            $error = "Er staat al een account gekoppeld aan dit e-mail adres";
            break;
        case 3:
            $error = "Er is geen geldig e-mail adres ingevoerd";
            break;
    }
}
?>
    <div class="container">
        <div class="col-lg-6 col-lg-offset-3">
            <h2>Maak uw account</h2>
            <?php if ($error) { ?>
                <div> <?= $error; ?></div>
            <?php } ?>

            <form id="registration" method="post" action="registrationhandler.php">
                <div class="form-group">
                    <label for="firstnameInput">Voornaam</label>
                    <input type="text" class="form-control" name="firstname" id="firstnameInput" required/>
                </div>
                <div class="form-group">
                    <label for="lastnameInput">Achternaam</label>
                    <input type="text" class="form-control" name="lastname" id="lastnameInput" required/>
                </div>
                <div class="form-group">
                    <label for="emailInput">E-mail</label>
                    <input type="email" class="form-control" name="email" id="emailInput" required/>
                </div>
                <div class="form-group">
                    <label for="streetnameInput">Straatnaam, huisnummer, en toevoegsel</label>

                    <div class="row">
                        <div class="col-xs-7">
                            <input type="text" class="form-control" name="streetname" id="streetnameInput" required/>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" name="streetnr" id="streetnrInput" required/>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" name="streetnrsuffix" id="streetnrsuffixInput"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="zipcodeInput">Postcode</label>
                    <input type="text" class="form-control" name="zipcode" id="zipcodeInput" required/>
                </div>
                <div class="form-group">
                    <label for="cityInput">Stad</label>
                    <input type="text" class="form-control" name="city" id="cityInput" required/>
                </div>
                <div class="form-group">
                    <label for="passwordInput">Gewenst wachtwoord</label>
                    <input type="password" class="form-control" name="password" id="passwordInput" required/>
                </div>
                <input type="submit" name="submit" class="btn btn-success" value="Verstuur" id="submitButton">
            </form>
        </div>
    </div>

<?php

include "footer.php";

?>