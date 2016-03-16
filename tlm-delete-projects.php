<?php ob_start();

// authentication
require('tlm-authentication.php');

try {
// identity the record the user wants to delete
    $project_id = null;
    $project_id = $_GET['project_id'];

    if (is_numeric($project_id)) {
        // connecting to the database
        require('tlm-db.php');

        // set up SQL Delete command
        $sql = "DELETE FROM tlmProjects WHERE project_id = :project_id";

        // execute deletion
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':project_id', $project_id, PDO::PARAM_INT);
        $cmd->execute();

        // disconnect from db
        $conn = null;

        // redirect to updated beers page
        header('location:tlm-projects.php');
    }
}
catch (Exception $e) {
    // send ourselves the error
    mail('taralynnemcneil@gmail.com', 'TLM Project Management Error', $e);

    // redirect to error page
    header('location:tlm-error.php');
}

ob_flush(); ?>