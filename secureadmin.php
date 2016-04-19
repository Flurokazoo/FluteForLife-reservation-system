<?php
require_once "config.php";
require_once "session.php";
require_once "admincheck.php";
require_once "redirectloggedout.php";
require_once "header.php";

/*
 * This is the secure admin page for the admin
 */
?>

    <div class="container">
        <div class="col-lg-4 col-lg-offset-4">


            <h1>Welkom <?= $userName; ?></h1>


            <div class="btn-group-vertical">
                <a href="agenda.php" class="btn btn-default btn-lg">Afspraakagenda</a>
                <a href="appointmentrequests.php" class="btn btn-default btn-lg">Afspraakverzoeken</a>
                <a href="clients.php" class="btn btn-default btn-lg">Gebruikersoverzicht</a>
                <a href="accountedit.php" class="btn btn-default btn-lg">Mijn gegevens aanpassen</a>
                <a href="logout.php" class="btn btn-default btn-lg">Uitloggen</a>

            </div>
        </div>
    </div>

<?php
require_once "footer.php";
?>