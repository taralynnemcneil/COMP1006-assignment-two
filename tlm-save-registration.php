<?php

$pageTitle = 'TLM Project Management | Saving your Registration...';
require_once('tlm-header.php');

// store the form inputs in a variable
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;

// validation
if (empty($username)) {
    echo 'Username is required<br />';
    $ok = false;
}

if (empty($password)) {
    echo 'Password is required<br />';
    $ok = false;
}

if ($password != $confirm) {
    echo 'Passwords must match<br />';
    $ok = false;
}

// if the form is ok
if ($ok == true) {
    require_once('tlm-db.php'); // connect to db

    $sql = "INSERT INTO tlmUsers (username, password) VALUES (:username, :password)";

    // hash the password
    $hashedPassword = hash('sha512', $password);

    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->bindParam(':password', $hashedPassword, PDO::PARAM_STR, 128);
    $cmd->execute();

    // disconnect
    $conn = null;

    echo '<div>Your registration has been saved. Click to <a href="tlm-login.php" title="Login"><i class="fa fa-sign-in"></i> Login</a></div>';

}

require('tlm-footer.php'); ?>