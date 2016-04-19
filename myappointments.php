<?php
require_once "config.php";
require_once "session.php";
require_once "redirectloggedout.php";
require_once "noadmincheck.php";
require_once "header.php";

$message = false;

if (isset($_GET['delete'])) {
    $message = "Afspraak is succesvol verwijderd";
}

$currentTimestamp = date("U");
$appointmentGetQuery = "SELECT * FROM `appointments` WHERE `userId` = '" . $id . "' AND `timestamp` > '" . $currentTimestamp . "' AND `approved` = 1 ORDER BY `timestamp` ASC ;";
$appointmentGetResult = mysqli_query($connect, $appointmentGetQuery);

$appointmentPendingGetQuery = "SELECT * FROM `appointments` WHERE `userId` = '" . $id . "' AND `timestamp` > '" . $currentTimestamp . "' AND `approved` = 0 ORDER BY `timestamp` ASC ;";
$appointmentPendingGetResult = mysqli_query($connect, $appointmentPendingGetQuery);

$pastAppointmentGetQuery = "SELECT * FROM `appointments` WHERE `userId` = '" . $id . "' AND `timestamp` < '" . $currentTimestamp . "' AND `approved` = 1 ORDER BY `timestamp` DESC ;";
$pastAppointmentGetResult = mysqli_query($connect, $pastAppointmentGetQuery);

$pastAppointmentRow = [];
$appointmentRow = [];
$appointmentPendingRow = [];

while ($appointmentGet = mysqli_fetch_array($appointmentGetResult)) {
    $appointmentRow[] = $appointmentGet;
}

while ($pastAppointmentGet = mysqli_fetch_array($pastAppointmentGetResult)) {
    $pastAppointmentRow[] = $pastAppointmentGet;
}

while ($appointmentPendingGet = mysqli_fetch_array($appointmentPendingGetResult)) {
    $appointmentPendingRow[] = $appointmentPendingGet;
}


?>

    <div class="container">
        <h1>Mijn afspraken</h1>
        <?php if ($message) { ?>
            <span>Afspraak succesvol verwijderd!</span>
        <?php } ?>
        <h2>Bevestigde afspraken</h2>
        <?php if ($appointmentRow) { ?>
            <table class="table table-hover">
                <tr>
                    <th>Dag en maand</th>
                    <th>Tijd</th>
                    <th>Jaar</th>
                </tr>
                <?php foreach ($appointmentRow as $appointment) { ?>
                <tr>
                    <td><?= $appointment['day'] ?> <?= date("F", mktime(0, 0, 0, $appointment['month'], 10)); ?></td>
                    <td><?= $appointment['hour'] ?> uur</td>
                    <td><?= $appointment['year'] ?></td>
                    <td><a class="btn btn-xs btn-error" href=appointmentdelete.php?id=<?= $appointment['id'] ?>> <i
                                class="glyphicon glyphicon-remove"></i></a></td>

                    <?php } ?>
                </tr>
            </table>
        <?php } else { ?>
            <span>U heeft geen afspraken gepland staan.</span>
        <?php } ?>

        <h2>Afspraakverzoeken in behandeling</h2>
        <?php if ($appointmentPendingRow) { ?>
            <table class="table table-hover">
                <tr>
                    <th>Dag en maand</th>
                    <th>Tijd</th>
                    <th>Jaar</th>
                </tr>
                <?php foreach ($appointmentPendingRow as $pendingAppointment) { ?>
                <tr>
                    <td><?= $appointment['day'] ?> <?= date("F", mktime(0, 0, 0, $pendingAppointment['month'], 10)); ?></td>
                    <td><?= $pendingAppointment['hour'] ?> uur</td>
                    <td><?= $pendingAppointment['year'] ?></td>
                    <td><a class="btn btn-xs btn-error" href=appointmentdelete.php?id=<?= $pendingAppointment['id'] ?>>
                            <i
                                class="glyphicon glyphicon-remove"></i></a></td>
                    <?php } ?>
                </tr>
            </table>
        <?php } else { ?>
            <span>U heeft geen afspraakverzoeken openstaan.</span>
        <?php } ?>

        <h2>Afspraken uit het verleden</h2>
        <?php if ($pastAppointmentRow) { ?>

            <table class="table table-hover">
                <tr>
                    <th>Dag en maand</th>
                    <th>Tijd</th>
                    <th>Jaar</th>
                </tr>
                <?php foreach ($pastAppointmentRow as $pastAppointment) { ?>
                <tr>
                    <td><?= $appointment['day'] ?> <?= date("F", mktime(0, 0, 0, $pastAppointment['month'], 10)); ?></td>
                    <td><?= $pastAppointment['hour'] ?> uur</td>
                    <td><?= $pastAppointment['year'] ?></td>


                    <?php } ?>
                </tr>
            </table>
        <?php } else { ?>
            <span>U heeft in het verleden geen afspraak gehad.</span>
        <?php } ?>

        </table>
    </div>

<?php
require_once "footer.php";