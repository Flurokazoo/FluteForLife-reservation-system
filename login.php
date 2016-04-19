<?php
require_once "config.php";
require_once "session.php";
require_once "header.php";

$message = false;

/*
 * Checks login data and if it checks out logs you in
 */

//Redirect messages

if (isset($_GET['success'])){
    $message = "Uw account is succesvol aangemaakt. U kunt nu inloggen.";
}

if (isset($_GET['logout'])){
    $message = "U bent succesvol uitgelogd.";
}

if (isset($_POST['submit'])) {
    $email = mysqli_escape_string($connect, $_POST["email"]);
    $password = mysqli_escape_string($connect, $_POST["password"]);
    $userLoginQuery = "SELECT `id`, `firstname`, `password`, `admin` FROM `users` WHERE `email` = '" . $email . "';";
    $userLoginResult = mysqli_query($connect, $userLoginQuery) or die(mysqli_error($db));
    $userLoginFetched = mysqli_fetch_assoc($userLoginResult);

    //Checks if the submitted mk5 password matches the one in database

    if ($userLoginFetched['password'] == md5($password)) {
        $_SESSION['id'] = $userLoginFetched['id'];
        $_SESSION['name'] = $userLoginFetched['firstname'];

        //Creates a session for the admin if user is an admin and relocates user to their account page (user or admin)

        if ($userLoginFetched['admin']) {
            $_SESSION['admin'] = true;
            header('Location: secureadmin.php');
        } else {
            header('Location: secure.php');
        }

        //Sets error message if entered information is invalid
    } else {
        $message = "Het ingevoerde wachtwoord of gebruikersaccount klopt niet.";
    }
}
?>

    <div class="container">
        <div class="col-lg-6 col-lg-offset-3">
            <h1>Log in.</h1>

            <?php if ($message) { ?>
                <span> <?= $message; ?></span>
            <?php } ?>

            <form id="nyepform" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                <div class="form-group">
                    <label for="emailInput">E-mail</label>
                    <input type="email" class="form-control" name="email" id="emailInput" required/>
                </div>

                <div class="form-group">
                    <label for="passwordInput">Password</label>
                    <input type="password" class="form-control" name="password" id="passwordInput" required/>
                </div>

                <input type="submit" name="submit" class="btn btn-success" value="Verstuur" id="submitButton">
            </form>
        </div>
    </div>

<?php
include "footer.php";
?>