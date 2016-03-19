<?php ob_start();

// authentication
require('tlm-authentication.php');

// set title
$pageTitle = 'TLM Project Management | Project Details';
require('tlm-header.php');
?>

<h2>Project Details</h2>

<?php

try {
    // connect to the database
    require('tlm-db.php');

    // set up SQL query
    $sql = "SELECT * FROM tlmProjects ORDER BY name";
    $cmd = $conn -> prepare($sql);

    // execute the query and store results
    $cmd->execute();
    $results = $cmd->fetchAll();

    // disconnect
    $conn = null;

    // start table and add headings
    echo '<table><thead><th>Name</th><th>Description</th><th>URL</th><th>Date</th><th>Time Started</th>
         <th>Time Finished</th><th>Total Time(Minutes)</th><th>Edit</th><th>Delete</th></thead><tbody>';

    // loop through the query results
    foreach ($results as $row) {

        // display - create rows and columns for each record
        echo '<tr><td>' . $row['name'] . '</td>
            <td>' . $row['description'] . '</td>
		    <td>' . $row['url'] . '</td>
		    <td>' . $row['dateStart'] . '</td>
		    <td>' . $row['timeStart'] . '</td>
		    <td>' . $row['timeFinish'] . '</td>
		    <td>' . $row['totalMins'] . '</td>
		    <td><a href="tlm-manage-projects.php?project_id=' . $row['project_id'] . '" title="Edit">Edit</a></td>
		    <td><a href="tlm-delete-projects.php?project_id=' . $row['project_id'] . '"
		    onclick="return confirm(\'Are you sure you want to delete this?\');">Delete</a></td></tr>';
    }


    // close table
    echo '</tbody></table>';
    ?>


    <?php
}
catch (Exception $e) {
    // send ourselves the error
    mail('taralynnemcneil@gmail.com', 'TLM Project Management Error', $e);

    // redirect to error page
    header('location:tlm-error.php');
}

// footer
require('tlm-footer.php');
ob_flush(); ?>