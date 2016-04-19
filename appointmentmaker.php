<?php

//Includes and sets locale to NL to display dates in Dutch

require_once "config.php";
require_once "session.php";
require_once "redirectloggedout.php";
require_once "noadmincheck.php";
require_once "header.php";
date_default_timezone_set('Europe/Amsterdam');
setlocale(LC_ALL, 'nld_nld');

//Checks if get is set, makes dateSelector the number from get, and checks if the selected get is within bounds

$message = false;

if (isset($_GET['id'])) {
    $dateSelector = ($_GET['id']);
    if ($dateSelector >= 14 || $dateSelector <= -1) {
        header('Location: appointmentmaker.php');

    }
} else {
    $dateSelector = 0;
}

//vars for day month and year

$day = date("d", strtotime("+1 day +$dateSelector days")); //The selected day
$month = date("m", strtotime("+1 day +$dateSelector days")); //Of the selected month
$year = date("Y", strtotime("+1 day +$dateSelector days")); // Of the selected year
$todaysDate = strftime("%A %d %B %Y", mktime(0, 0, 0, $month, $day, $year)); //The date to make the appointment in Dutch notation
$count = 0;

// Writes data to the database

if (isset($_POST['submit'])) {
    $time = mysqli_escape_string($connect, $_POST['time']); //The exact hour at which the appointment is made
    if ($time > 16 || $time < 9) {
        $message = "Deze tijd valt niet binnen de beschikbare tijd";
    } else {
        $timestamp = date("U", strtotime("$day-$month-$year + $time hours")); //Timestamp generated from the other time inputs
        //Checks if appointment exists as double check
        $backendCheckquery = "SELECT `timestamp` FROM `appointments` WHERE `timestamp` = '" . $timestamp . "';";
        $backendCheckResult = mysqli_query($connect, $backendCheckquery);
        $backendCheckFetched = mysqli_fetch_assoc($backendCheckResult);
        if ($backendCheckFetched) {
            $message = "Op deze tijd staat al een andere afspraak ingepland";
        } else {
            //Query to create appointment

            $appointmentquery = "INSERT INTO `appointments` (`id`, `userId`, `hour`, `day`, `month`, `year`, `timestamp`)
    VALUES (NULL, '" . $id . "', '" . $time . "', '" . $day . "', '" . $month . "', '" . $year . "', '" . $timestamp . "');";
            mysqli_query($connect, $appointmentquery);
            $message = "Uw afspraak is succesvol gemaakt. U kunt de status van uw afspraak bekijken bij uw afspraakpagina.";
        }
    }
}
//gets all pre-existing appointments for the current day

$checkquery = "SELECT `hour` FROM `appointments` WHERE `day` = '" . $day . "' AND `month` = '" . $month . "' AND `year` = '" . $year . "';";
$loginResult = mysqli_query($connect, $checkquery);
$matchesString = '';

//Puts pre existing data in readable array
while ($matches = mysqli_fetch_array($loginResult)) {
    $matchesString .= $matches['hour'] . ",";
}
$matchesArray = explode(",", $matchesString);

?>
    <div class="container text-center">
        <div class="col-lg-8 col-lg-offset-2">
            <h1>Afspraak maken op <?= $todaysDate; ?></h1>
            <?php if ($message) { ?>
                <span> <?= $message; ?></span>
            <?php } ?>
        </div>

        <div class="col-lg-4 col-lg-offset-2">
            <?php if ($dateSelector >= 1) {
                ?><a class="btn btn-default pull-right" href="appointmentmaker.php?id=<?= $dateSelector - 1; ?>">Vorige
                    dag</a><?php ;
            } ?>

        </div>
        <div class="col-lg-4">
            <?php if ($dateSelector <= 12) {
                ?><a class="btn btn-default pull-left" href="appointmentmaker.php?id=<?= $dateSelector + 1; ?>">Volgende
                    dag</a><?php ;
            } ?>
        </div>


        <div class="col-lg-4 col-lg-offset-4">
            <form id="apppointmentpicker" method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
                <ul class="list-group">
                    <?php foreach (range(9, 16) as $hour) {
                        ?>
                        <li class="list-group-item <?php if (in_array("$hour", $matchesArray)) {
                            echo "list-group-item-danger";
                        } ?>">
                            <label for="timeInput<?= $hour; ?>">
                                <input <?php if (in_array($hour, $matchesArray)) {
                                    echo "disabled";

                                    $count++;
                                }
                                ?> required type="radio" name="time" id="timeInput<?= $hour; ?>" value="<?= $hour; ?>">
                                <?= $hour; ?> uur
                            </label>
                        </li>
                    <?php } ?>
                </ul>
                <hr>
                <?php if ($count == 8) { ?>
                    <strong><?= "Helaas, de dag is volgepland."; ?></strong>
                <?php } else { ?>
                    <input type="submit" name="submit" class="btn btn-success" value="Afspraak maken"
                           id="submitButton"> <?php ;
                } ?>
            </form>
        </div>
    </div>
<?php
require_once "footer.php";