<?php

session_start();

if (isset($_SESSION['id']) && isset($_SESSION['name'])) {
    $id = $_SESSION['id'];
    $userName = $_SESSION['name'];
}

?>