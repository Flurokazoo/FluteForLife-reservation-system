<?php

require_once "config.php";
require_once "session.php";
require_once "admincheck.php";
require_once "redirectloggedout.php";
require_once "header.php";

//Gets info on all clients

$clientQuery = "SELECT * FROM `users` WHERE `admin` = 0 ORDER BY `id` ASC;";
$clientResults = mysqli_query($connect, $clientQuery);
while ($clientResult = mysqli_fetch_array($clientResults)) {
    $clientRow[] = $clientResult;
}
?>
    <div class="container">

        <h1>Alle gebruikers</h1>
        <table class="table table-hover">
            <tr>
                <th>Gebruikersid</th>
                <th>Volledige naam</th>
                <th>E-mail</th>
                <th>Adres</th>
                <th>Postcode</th>
                <th>Gegevens/E-mail wijzigen</th>
            </tr>
            <?php foreach ($clientRow as $client) { ?>
                <tr>
                    <td><?= $client['id'] ?></td>
                    <td><?= $client['firstname'] ?> <?= $client['lastname'] ?></td>
                    <td><?= $client['email'] ?></td>
                    <td><?= $client['streetname'] ?> <?= $client['streetnr'] ?><?= $client['streetnrsuffix'] ?></td>
                    <td><?= $client['zipcode'] ?></td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-xs btn-primary" href=clientinfo.php?id=<?= $client['id'] ?>>
                                <i class="glyphicon glyphicon-edit"></i>Gegevens</a>
                            <a class="btn btn-xs btn-primary" href=emailchange.php?id=<?= $client['id'] ?>>
                                <i class="glyphicon glyphicon-edit"></i>E-mail</a>

                        </div>

                    </td>
                </tr>

            <?php } ?>
        </table>
        <a class="btn btn-primary" href=secureadmin.php>Terug naar admin panel</a>
    </div>

<?php
require_once "footer.php";