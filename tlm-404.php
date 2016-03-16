<?php ob_start();
$pageTitle = 'TLM Project Management | Not Found';
require('tlm-header.php');
?>

<div>
    <h1><i class="fa fa-exclamation-triangle"></i> We couldn't find that page.</h1>
    <p>Please try a different page.</p>
</div>

<?php
require('tlm-footer.php');
ob_flush(); ?>
