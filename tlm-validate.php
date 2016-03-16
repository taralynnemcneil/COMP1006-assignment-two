<?php ob_start();
include('tlm-header.php');

// variables
$username = $_POST['username'];
$password = hash('sha512', $_POST['password']);

// connect
require('tlm-db.php');

// set up sql query
$sql = "SELECT user_id FROM tlmUsers WHERE username = :username AND password = :password";

// prepare
$cmd = $conn->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
$cmd->bindParam(':password', $password, PDO::PARAM_STR, 128);
$cmd->execute();
$users = $cmd->fetchAll();


$count = $cmd->rowCount();

// disconnect
$conn = null;

// validate
if ($count == 0) {
    echo 'Invalid login, please try again or sign up. <a href="tlm-login.php">Login</a> or <a href="tlm-register.php">Register</a>';

}
else {
    session_start();
    foreach  ($users as $user) {

        $_SESSION['user_id'] = $user['user_id'];

        header('location:tlm-home.php');
    }
}

include('tlm-footer.php');
ob_flush(); ?>
