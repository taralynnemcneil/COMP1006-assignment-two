<?php ob_start();

// auth
require('tlm-authentication.php');

?> <!-- override for dreamhost -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>Beer Saved</title>
</head>
<body>
<?php

// authentication
require('tlm-authentication.php');

try {
    // set title
    $pageTitle = 'TLM Project Management | Manage Projects';
    require('tlm-header.php');

    // connect to he database
    require('tlm-db.php');

    // initialize an empty id variable
    $project_id = null;
    $name = null;
    $description = null;
    $url = null;
    $dateStart = null;
    $timeStart = null;
    $timeFinish = null;
    $totalMins = null;

    // store the form inputs in variables
    $project_id = $_POST['project_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $url = $_POST['url'];
    $dateStart = $_POST['dateStart'];
    $timeStart = $_POST['timeStart'];
    $timeFinish = $_POST['timeFinish'];
    $totalMins = $_POST['totalMins'];

    // validateStart our inputs individually
    $ok = true;

    if (empty($name)) {
        echo 'Name is required<br />';
        $ok = false;
    }

    if (empty($description)) {
        echo 'Project description is required<br />';
        $ok = false;
    }

    if (empty($url)) {
        echo 'Insert project url<br />';
        $ok = false;
    }

    if (empty($dateStart)) {
        echo 'Insert the date. Example: 24/02/2016<br />';
        $ok = false;
    }

    if (empty($timeStart)) {
        echo 'A time in which you started working on the project is required<br />';
        $ok = false;
    }

    if (empty($timeFinish)) {
        echo 'A time in which you finished working on the project is required<br />';
        $ok = false;
    }

    if (empty($totalMins)) {
        echo 'A total amount of time worked on the project is required<br />';
        $ok = false;
    }

    // check if the form is okay to save
    if ($ok == true) {

        // connecting to the database
        require('tlm-db.php');

        // set up the SQL command to save the data
        if (empty($project_id)) {
            $sql = "INSERT INTO tlmProjects (name, description, url, dateStart, timeStart, timeFinish, totalMins) VALUES (:name, :description, :url, :dateStart, :timeStart, :timeFinish, :totalMins)";
        } else {
            $sql = "UPDATE tlmProjects SET name = :name, description = :description, timeStart = :timeStart, url = :url, dateStart = :dateStart, timeFinish = :timeFinish, totalMins = :totalMins WHERE project_id = :project_id";
        }

        //create command object
        $cmd = $conn->prepare($sql);

        // put each input value into the proper field
        $cmd->bindParam(':name', $name, PDO::PARAM_STR);
        $cmd->bindParam(':description', $description, PDO::PARAM_STR);
        $cmd->bindParam(':url', $url, PDO::PARAM_STR);
        $cmd->bindParam(':dateStart', $dateStart, PDO::PARAM_STR);
        $cmd->bindParam(':timeStart', $timeStart, PDO::PARAM_STR);
        $cmd->bindParam(':timeFinish', $timeFinish, PDO::PARAM_STR);
        $cmd->bindParam(':totalMins', $totalMins, PDO::PARAM_INT);

        // add project_id parameter if we are updating
        if (!empty($project_id)) {
            $cmd->bindParam(':project_id', $project_id, PDO::PARAM_INT);
        }

        // execute the save
        $cmd->execute();

        // disconnect
        $conn = null;

        // email the new project
        mail('taralynnemcneil@gmail.com', 'A project has been added to your database <br />', $name . $description . $url . $dateStart . $timeStart . $timeFinish . $totalMins);

        // redirect
        header('location:tlm-projects.php');
    }
}
catch (Exception $e) {
    // send ourselves the error
    mail('taralynnemcneil@gmail.com', 'TLM Project Management Error', $e);

    // redirect to error page
    header('location:tlm-error.php');
}
?>
</body>
</html>
<?php ob_flush(); ?> <!-- override for dreamhost -->