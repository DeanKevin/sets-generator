<?php
include_once("db_lib.php");
include_once("app_lib.php");

/*
 * Process command.
*/
function process_command($cmd, $param) {

    switch ($cmd) {
        case 'generate':
            return generate($cmd, $param);
        break;
        case 'select':
            return select($cmd, $param);
        break;
        case 'reset':
            return restart($cmd, $param);
        break;
    }

}

/*
 * Generate new sets and return info on each set.
 * If there is an error with database returns database error instead.
*/
function generate($cmd, $param) {

    global $db_conn;
    
    $number_sets = new Sets(); // Create instance
    $number_sets->generate_sets(); // Generate sets
    $generated_sets = $number_sets->get_sets(); // Get generated sets

    foreach($generated_sets as $index => $value) {
        
        $i = $index +1;
        $gen = 0;
        $response[$index] = array(
            'set' => $i,
            'values' => $value,
            'unique' => true,
            'regenerated' => $gen,
        );
            
        // Compare sets for any matching values.
        $match = compare($value);
        
        if($match['count'] > 0 && $match['count'] < 3) {

            $response[$index]['unique'] = false;

        } else if($match['count'] > 3) {
            
            // Discard set if more then three matching values.
            do {

                $set = $number_sets->generate_one_set();
                $gen = $gen +1;
                $match = compare($set);
                
            } while ($match['count'] > 3);

            $response[$index]['values'] = $set;
            $response[$index]['regenerated'] = $gen;

        }

    }
    
   return $response;

}

/*
 * Compare generated set to selected sets.
*/
function compare($set) {

    global $db_conn;

    $match = array('match' => false, 'count' => 0);
    
    $stmt = $db_conn['conn']->prepare("SELECT * FROM stored_sets");
    $stmt->execute();

    foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {

        $matching = array_intersect($set, $v);
        $match_count = count($matching);
        if($match_count > 0) {

            $match = array('match' => true, 'count' => $match_count);

        }

    }

    return $match;

}

/*
 * Save selected set.
*/
function select($cmd, $param) {

    global $db_conn;

    if($db_conn['status']) {

        $sql = "INSERT INTO stored_sets (n1, n2, n3, n4, n5, n6)
        VALUES ($param[0], $param[1], $param[2], $param[3], $param[4], $param[5])";
        // use exec() because no results are returned
        $db_conn['conn']->exec($sql);
        
        $message = "Saved selected set.";

    } else {

        $message = "Database connection error.";

    }

    return array('message' => $message);

}

/*
 * Restart application.
*/
function restart($cmd, $param) {
    
    global $db_conn;

    $sql = "DELETE FROM stored_sets";
    $db_conn['conn']->exec($sql);

    $sql = "ALTER TABLE stored_sets AUTO_INCREMENT = 1";
    $db_conn['conn']->exec($sql);

    $message = "success";
    return array('message' => $message);

}

?>