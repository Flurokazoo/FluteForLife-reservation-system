<!doctype html>
<html>
<head>
    <title></title>
    <meta name="description" content=""/>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/css/style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div class="container">
    <div class="jumbotron">

    </div>
    <ul id="navbar" class="nav nav-pills nav-justified">
        <li><a href="index.php">Home</a></li>
        <li><a href="karenlavie.php">Karen Lavie</a></li>
        <li><a href="suzukimethode.php">Suzuki</a></li>
        <li><a href="lessen.php">Lessen</a></li>
        <li><a href="docentopleiding.php">Docentopleiding</a></li>
        <li><a href="video.php">Video's</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="questions.php">Vragen</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle"
               data-toggle="dropdown"> <?php if (isset($_SESSION['id']) && isset($_SESSION['name'])) {
                    echo $userName;
                } else {
                    echo "Mijn account";
                } ?> <span class="caret"></span> </a>
            <ul class="dropdown-menu pull-right">
                <li><a href="<?php if (isset($_SESSION['admin'])) { ?>secureadmin.php">Admin
                        panel</a><?php } else if (isset($_SESSION['id'])) { ?>secure.php">Mijn account</a><?php } else { ?>login.php">Log in</a> <?php } ?>
                </li>
                <li><a href="<?php if (isset($_SESSION['id'])) { ?>logout.php">Log
                        uit</a><?php } else { ?>registration.php">Registreer</a> <?php } ?></li>
            </ul>
        </li>
    </ul>
</div>