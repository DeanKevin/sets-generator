<?php
/*
 * Number sets class
 *
 */
 class Sets {
    var $sets = array();
    
    // Randomly generate three sets of six numbers. 
    function generate_sets() {

        // Master loop to interate over sets.
        for($x = 0; $x <= 2; $x++) {

            // Loop to store each set.
            for($i = 0; $i <= 5; $i++) {
                $num = rand(1, 49);
                $this->sets[$x][$i] = $num;
            }

        }

    }
    
    // Get sets
    // Returns an array containing three sets.
    function get_sets() {
        return $this->sets;
    }

}
?>