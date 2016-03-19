<?php ob_start();
$pageTitle = 'TLM Project Management | Oops!';
// authentication
require('tlm-authentication.php');

// header
require('tlm-header.php');
?>


        <h1><i class="fa fa-exclamation-circle"></i> Something went wrong...</h1>
        <p>We're sorry about that. But don't worry, we're on it and will fix it asap.</p>


<?php
require('tlm-footer.php');
ob_flush(); ?>

<?php ob_start();
