<?php ob_start();
$pageTitle = 'TLM Project Management | Oops!';
require('tlm-header.php');
?>

<div>
    <h1><i class="fa fa-exclamation-circle"></i> Something went wrong...</h1>
    <p>We're sorry about that. But don't worry, we're on it and will fix it asap.</p>
</div>

<?php
require('tlm-footer.php');
ob_flush(); ?>
