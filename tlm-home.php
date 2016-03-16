<?php ob_start();

// authentication
require('tlm-authentication.php');

$pageTitle = 'TLM Project Management | Home';
require('tlm-header.php');
?>

<div>
    <h1>Hello</h1>
    <p>Don't forget to log your projects.</p>
</div>

<?php
require('tlm-footer.php');
ob_flush(); ?>
