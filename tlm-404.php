<?php ob_start();
$pageTitle = 'TLM Project Management | Not Found';
// authentication
require('tlm-authentication.php');

// header
require('tlm-header.php');
?>


        <h1><i class="fa fa-exclamation-triangle"></i> We couldn't find that page.</h1>
        <p>Please try a different page.</p>


<?php
/* footer */
require('tlm-footer.php');
ob_flush(); ?>

<?php ob_start();