<?php
require_once "config.php";
require_once "session.php";
require_once "admincheck.php";
require_once "redirectloggedout.php";
require_once "header.php";

$message = false;

//Sets message when appointment is approved or deleted

if (isset($_GET['message'])) {
    if ($_GET['message'] == 1) {
        $message = "Afspraak is goedgekeurd!";
    } else if ($_GET['message'] == 2) {
        $message = "Afspraak is succesvol verwijderd";
    }
}

//Gets all useful information from database from both the users and appointment tables

$currentTimestamp = date("U");
$appointmentGetQuery = "SELECT appointments.day, appointments.id, appointments.userId, appointments.hour, appointments.month, appointments.year, users.lastname, users.firstname FROM `appointments` INNER JOIN `users` ON appointments.userId = users.id WHERE `timestamp` > '" . $currentTimestamp . "' AND `approved` = '0' ORDER BY `timestamp` ASC ;";
$appointmentGetResult = mysqli_query($connect, $appointmentGetQuery);

//Puts the results in an array for foreach

$appointmentRow = [];
while ($appointmentGet = mysqli_fetch_array($appointmentGetResult)) {
    $appointmentRow[] = $appointmentGet;

}
?>

    <div class="container">
        <div class="col-lg-8 col-lg-offset-2">
            <h1>Gespreksverzoeken</h1>
            <?php if ($message) { ?>
                <span><?= $message; ?></span>
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
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-xs btn-success"
                                   href="appointmentapprove.php?id=<?= $appointment['id'] ?>">
                                    <i class="glyphicon glyphicon-ok"></i></a>
                                <a class="btn btn-xs btn-danger"
                                   href="appointmentdelete.php?id=<?= $appointment['id'] ?>&a">
                                    <i class="glyphicon glyphicon-remove"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <a class="btn btn-primary" href=secureadmin.php>Terug naar admin panel</a>
        </div>
    </div>
<?php
require_once "footer.php";