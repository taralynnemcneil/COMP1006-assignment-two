<?php

$pageTitle = 'TLM Project Management | Register';

require_once('tlm-header.php'); ?>


    <h1>User Registration</h1>
    <form method="post" action="tlm-save-registration.php">
        <div>
            <label for="username">Username:</label>
            <input name="username" />
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" />
        </div>
        <div>
            <label for="confirm">Confirm Password:</label>
            <input type="password" name="confirm" />
        </div>
        <div>
            <input type="submit" value="Register"/>
        </div>
    </form>


<?php require_once('tlm-footer.php'); ?>