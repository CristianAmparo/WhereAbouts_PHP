<?php
session_start();
if (empty($_SESSION['loggedin'])) {
    header("Location: login.php");
} else {

    include('hero.php');
}
