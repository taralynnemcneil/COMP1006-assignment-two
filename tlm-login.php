<?php

$pageTitle = 'TLM Project Management | Log In';

require_once('tlm-header.php'); ?>


    <h1>Log In</h1>
    <form method="post" action="tlm-validate.php">
        <div>
            <label for="username">Username:</label>
            <input name="username" />
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" />
        </div>
        <div>
            <input type="submit" value="Login"/>
        </div>
    </form>


<?php require_once('tlm-footer.php'); ?>