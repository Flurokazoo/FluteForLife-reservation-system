<?php

//Logs user out by destroying session

session_start();
session_destroy();
header('Location: login.php?logout=1');

?>