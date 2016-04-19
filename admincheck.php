<?php
if (!isset($_SESSION['admin'])) {
    header('Location: secure.php');
    exit;
}?>