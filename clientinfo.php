<?php

require_once "config.php";
require_once "session.php";
require_once "admincheck.php";
require_once "redirectloggedout.php";
require_once "header.php";

//Gets user from the GET id

if (isset ($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('Location:clients.php');
}

//Gets all the information from user in an array

$clientInfoQuery = "SELECT * FROM `users` WHERE `id` = $id";
$clientInfoResult = mysqli_query($connect, $clientInfoQuery);
$clientArray = mysqli_fetch_assoc($clientInfoResult);

?>

    <div class="container">
        <div class="col-lg-8 col-lg-offset-2">
            <h2>Gegevens voor <?= $clientArray['firstname'] ?> <?= $clientArray['lastname'] ?> </h2>
            <table class="table table-hover">
                <tr>
                    <th>Gebruikersid</th>
                    <td><?= $clientArray['id'] ?></td>
                </tr>
                <tr>
                    <th>Voornaam</th>
                    <td><?= $clientArray['firstname'] ?></td>
                </tr>
                <tr>
                    <th>Achternaam</th>
                    <td><?= $clientArray['lastname'] ?></td>
                </tr>
                <tr>
                    <th>Straatnaam en huisnummer</th>
                    <td><?= $clientArray['streetname'] ?> <?= $clientArray['streetnr'] ?> <?= $clientArray['streetnrsuffix'] ?></td>
                </tr>
                <tr>
                    <th>Postcode</th>
                    <td><?= $clientArray['zipcode'] ?></td>
                </tr>
                <tr>
                    <th>Stad</th>
                    <td><?= $clientArray['city'] ?></td>
                </tr>
                <tr>
                    <th>E-mail</th>
                    <td><?= $clientArray['email'] ?></td>
                </tr>
                <tr>
                    <th>IP adres</th>
                    <td><?= $clientArray['ip'] ?></td>
                </tr>
                <tr>
                    <th>Aanmelddatum</th>
                    <td><?= $clientArray['date'] ?></td>
                </tr>

            </table>
        </div>
    </div>

<?php
require_once "footer.php";


