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

            $this->sets[$x] = $this->generate_one_set();

        }

    }

    // Randomly generate one sets of six numbers.
    function generate_one_set() {

        $set = array();

        for($i = 0; $i <= 5; $i++) {

            $set[$i] = rand(1, 49);

        }

        return $set;

    }
    
    // Get sets
    // Returns an array containing three sets.
    function get_sets() {
        return $this->sets;
    }

}
?>