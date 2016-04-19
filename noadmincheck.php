<?php
if (isset($_SESSION['admin'])) {
    header('Location: secureadmin.php');
    exit;
}?>