<?php
    include("interface_functions.php");
    if(!empty($_POST)) {
        // Check for command.
        if(array_key_exists('set', $_POST)) {

            // Process command.
            $param = (int)$_POST['set'];
            $result = process_command($param);
            $sets = json_encode($result);
            echo $sets;
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
            <div id="sets">
                <div id="set1"></div>
                <div id="set2"></div>
                <div id="set3"></div>
            </div>
        </div>
        <form name="App" id="AppForm" method="POST" action="index.php">
            <div class="form-group">
                <label for="set" class="col-sm-3 control-label">Sets</label>
                <div class="col-sm-6">
                    <select name="set" id="set">
                        <option value="0">Generate new sets</option>
                        <option value="1">Select set 1</option>
                        <option value="2">Select set 2</option>
                        <option value="3">Select set 3</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-btn fa-plus"></i>Select set or generate new sets
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
    </div>
</body>
<!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="js/app.js"></script>
</html>

  <?php  } ?>