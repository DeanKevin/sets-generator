<?php
include_once("interface_functions.php");
// Database check
$db = new DB();
$db_conn = $db->connect();
if(!$db_conn['status']) {
    echo "Database error.";
    exit;
}

if(!empty($_POST)) {
    // Check for command.
    if(array_key_exists('generate', $_POST)) {
        $cmd = 'generate';
        $param = (bool)$_POST['generate'];
        $result = process_command($cmd, $param);
        echo json_encode($result);
    }
    if(array_key_exists('select', $_POST)) {
        $cmd = 'select';
        $param = (string)$_POST['select'];
        $param = json_decode($param);
        $result = process_command($cmd, $param);
        echo json_encode($result);
    }
    if(array_key_exists('reset', $_POST)) {
        $cmd = 'reset';
        $param = (bool)$_POST['reset'];
        $result = process_command($cmd, $param);
        echo json_encode($result);
    }
} else { ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sets Generator</title>

    <link href="css/app.css" rel="stylesheet">
</head>
<body id="app-layout">
    <div id=interface>
        <div id="sets-display">
            <p id="sets-label">Generated Sets</p>
            <p id="sets-info">Click on a set to select once generated.</p>
            <div id="sets">
                <div id="set1" class="set-item">
                    <p class="set-name">Set 1</p>
                    <div class="set-values"></div>
                </div>
                <div id="set2" class="set-item">
                    <p class="set-name">Set 2</p>
                    <div class="set-values"></div>
                </div>
                <div id="set3" class="set-item">
                     <p class="set-name">Set 3</p>
                    <div class="set-values"></div>
                </div>
                <div class="clear-fix"></div>
            </div>
        </div>
        <div id="matched">
            <p id="matched-label">Matched</p>
            <div id="matched-sets"></div>
        </div>
        <form name="App" id="AppForm" method="POST" action="index.php">
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-btn fa-plus"></i>Generate new sets
                    </button>
                </div>
            </div>
            <div class="form-group">
                <button type="button" name="display" id="display" class="btn btn-secondary" value="true">Display sets</button>
            </div>
            <div class="form-group">
                <button type="reset" id="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
        <div id="dashboard">
            <div class="col">
                <p id="generated" class="label">Generated: <span></span></p>
            </div>
            <div class="col">
                <p id="selected" class="label">Selected: <span></span></p>
            </div>
            <div class="clear-fix"></div>
        </div>
    </div>
</body>
<!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="js/app.js"></script>
</html>

<?php } ?>