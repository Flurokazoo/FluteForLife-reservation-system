<?php
require_once "config.php";
require_once "session.php";
require_once "admincheck.php";
require_once "redirectloggedout.php";
require_once "header.php";

//Gets name from database to use in html header. If no get is set for id, redirects to clients.php

if (isset ($_GET['id'])) {
    $userId = $_GET['id'];
    $nameQuery = "SELECT `firstname`, `lastname` FROM `users` WHERE `id` = $userId;";
    $nameResults = mysqli_query($connect, $nameQuery);
    $nameResult = mysqli_fetch_assoc($nameResults);

} else {
    header('Location: clients.php');
}

/*
 * This page creates a form to change e-mail of user, then changes it in emailchangehandler.php
 */

?>

    <div class="container">
        <div class="col-lg-6 col-lg-offset-3">

            <h2>E-mail aanpassen voor: <?= $nameResult['firstname'] ?> <?= $nameResult['lastname'] ?></h2>

            <form id="registration" method="post" action="emailchangehandler.php">
                <div class="form-group">
                    <label for="emailInput">Nieuw e-mailadres</label>
                    <input type="text" class="form-control" name="email" id="emailInput"
                           value="" required/>
                </div>

                <h3>Vul hier uw admin wachtwoord in ter verificatie</h3>

                <div class="form-group">
                    <label for="passwordCheck">Wachtwoord verificatie</label>
                    <input type="text" class="form-control" name="password" id="passwordCheck"
                           placeholder="********" value="" required/>
                </div>
                <input type="hidden" name="clientid" value="<?= $_GET['id'] ?>">

                <input type="submit" name="submit" class="btn btn-success" value="Verstuur" id="submitButton">

            </form>
        </div>
    </div>

<?php
require_once "footer.php";