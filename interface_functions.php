<?php
include("app_lib.php");
/*
 * Process set command.
*/
function process_command($param) {
    switch ($param) {
        case 0:
            $sets = generate();
            return $sets;
        break;
        case 1:
            echo "Request to select set 1";
        break;
        case 2:
            echo "Request to select set 2";
        break;
        case 3:
            echo "Request to select set 3";
        break;
    }
}

/*
 * Generate new sets.
*/
function generate() {

    $number_sets = new Sets(); // Create instance
    $number_sets->generate_sets(); // Generate sets

    return $number_sets->get_sets(); // Get sets

}

?>