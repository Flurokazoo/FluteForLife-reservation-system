<?php
require_once "config.php";
require_once "session.php";
require_once "redirectloggedout.php";
require_once "noadmincheck.php";
require_once "header.php";
/*
 * This is the secure login page for the user
 */
?>

    <div class="container">
        <div class="col-lg-4 col-lg-offset-4">


            <h1>Welkom <?= $userName; ?></h1>


            <div class="btn-group-vertical">
                <a href="appointmentmaker.php" class="btn btn-default btn-lg">Nieuwe afspraak maken</a>
                <a href="myappointments.php" class="btn btn-default btn-lg">Mijn afspraken</a>
                <a href="accountedit.php" class="btn btn-default btn-lg">Accountgegevens aanpassen</a>
                <a href="logout.php" class="btn btn-default btn-lg">Uitloggen</a>

            </div>
        </div>
    </div>

<?php
require_once "footer.php";
?>