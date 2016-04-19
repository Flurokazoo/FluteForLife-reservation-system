<?php
if (isset($_SESSION['id'])) {
    header('Location: secure.php');
    exit;
}
?>