<?php ob_start();

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

    // check if we have an ID in the querystring
    if (is_numeric($_GET['project_id'])) {

        // if we have and ID, store in a variable
        $project_id = $_GET['project_id'];

        // connect to the database
        require('tlm-db.php');

        // select all the data for the selected project
        $sql = "SELECT * FROM tlmProjects WHERE project_id = :project_id";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':project_id', $project_id, PDO::PARAM_INT);
        $cmd->execute();
        $result = $cmd->fetchAll();

        // disconnect
        $conn = null;

        // store each value from the db into variables
        foreach ($result as $row) {
            $name = $row['name'];
            $description = $row['description'];
            $url = $row['url'];
            $dateStart = $row['dateStart'];
            $timeStart = $row['timeStart'];
            $timeFinish = $row['timeFinish'];
            $totalMins = $row['totalMins'];
        }
    }
    ?>

    <h1>Manage Projects</h1>
    <p>* Indicates Required Fields</p>

    <form method="post" action="tlm-save-projects.php">
        <fieldset>
            <label for="name">Name: *</label>
            <input name="name" id="name" required placeholder="COMP1006 Assignment 2" value="<?php echo $name; ?>"/>
        </fieldset>
        <fieldset>
            <label for="description">Description: *</label>
            <input name="description" id="description" required value="<?php echo $description; ?>"/>
        </fieldset>
        <fieldset>
            <label for="url">URL: *</label>
            <input name="url" id="url" type="url" placeholder="https://www.gc200197303.computerstud.ies/COMP1006-assignment-two" required value="<?php echo $url; ?>"/>
        </fieldset>
        <fieldset>
            <label for="dateStart">Date: *</label>
            <input name="dateStart" id="dateStart" placeholder="dd/mm/yyyy" required value="<?php echo $dateStart; ?>"/>
        </fieldset>
        <fieldset>
            <label for="timeStart">Time Started: *</label>
            <input name="timeStart" id="timeStart" placeholder="9:45am" required value="<?php echo $timeStart; ?>"/>
        </fieldset>
        <fieldset>
            <label for="timeFinish">Time Finished: *</label>
            <input name="timeFinish" id="timeFinish" placeholder="7:50pm" required value="<?php echo $timeFinish; ?>"/>
        </fieldset>
        <fieldset>
            <label for="totalMins">Total Time <em>(Minutes)</em>: *</label>
            <input name="totalMins" id="totalMins" placeholder="605" required value="<?php echo $totalMins; ?>"/>
        </fieldset>
        <input type="hidden" name="project_id" value="<?php echo $project_id; ?>"/>
        <button>Save</button>
    </form>

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