<?php
session_start();

if (empty($_SESSION['user_id'])) {
    header('location:tlm-login.php');
    exit();
}
?>