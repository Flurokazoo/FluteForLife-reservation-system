<?php

//Includes
require_once "config.php";
require_once "session.php";
require_once "admincheck.php";
require_once "redirectloggedout.php";
require_once "header.php";


/*
 * This page displays all the upcoming approved appointments of the admin.
 */


//Message settings for display in body

$message = false;

if (isset($_GET['delete'])) {
    $message = "Afspraak is succesvol verwijderd";
}

//Query for getting appoint and user data (join)

$currentTimestamp = date("U");
$appointmentGetQuery = "SELECT appointments.day, appointments.id, appointments.userId, appointments.hour, appointments.month, appointments.year, users.lastname, users.firstname FROM `appointments` INNER JOIN `users` ON appointments.userId = users.id WHERE `timestamp` > '" . $currentTimestamp . "' AND `approved` = 1 ORDER BY `timestamp` ASC ;";
$appointmentGetResult = mysqli_query($connect, $appointmentGetQuery);

//Make an array of the retrieved query which will be put in foreach in body

$appointmentRow = [];
while ($appointmentGet = mysqli_fetch_array($appointmentGetResult)) {
    $appointmentRow[] = $appointmentGet;
}


?>
    <div class="container">
        <div class="col-lg-8 col-lg-offset-2">
            <h1>Gespreksschema</h1>
            <?php if ($message) { ?>
                <span>Afspraak succesvol verwijderd!</span>
            <?php } ?>
            <table class="table table-hover">
                <tr>
                    <th>Datum</th>
                    <th>Tijd</th>
                    <th>Cliëntnaam</th>
                    <th>Afspraak afzeggen</th>
                </tr>

                <?php foreach ($appointmentRow as $appointment) { ?>
                    <tr>
                        <td><?= $appointment['day'] ?> <?= date("F", mktime(0, 0, 0, $appointment['month'], 10)); ?></td>
                        <td><?= $appointment['hour'] ?> uur</td>
                        <td><?= $appointment['firstname'] ?> <?= $appointment['lastname'] ?></td>
                        <td><a class="btn btn-xs btn-danger"
                               href=appointmentdelete.php?id=<?= $appointment['id'] ?>>
                                <i class="glyphicon glyphicon-remove"></i></a></td>
                    </tr>
                <?php } ?>
            </table>
            <a class="btn btn-primary" href=secureadmin.php>Terug naar admin panel</a>
        </div>
    </div>


<?php
require_once "footer.php";