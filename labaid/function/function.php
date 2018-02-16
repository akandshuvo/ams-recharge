<?php


    // CONVERT TIME TO SECONDS    
        $first_session_start_in_seconds = strtotime("1970-01-01 $first_session_start UTC");
        
    // FUNCTION FOR SPLITING TIME PERIOD    

        function hoursRange( $lower = 0, $upper = 86400, $step = 3600, $format = '' ) {
            $times = array();
        
            if ( empty( $format ) ) {
                $format = 'g:i a';
            }
        
            foreach ( range( $lower, $upper, $step ) as $increment ) {
                $increment = gmdate( 'H:i', $increment );
        
                list( $hour, $minutes ) = explode( ':', $increment );
        
                $date = new DateTime( $hour . ':' . $minutes );
        
                $times[(string) $increment] = $date->format( $format );
            }
        
            return $times;
        }

        $ranges = hoursRange( 28800, 61200, 60 * 15, 'h:i a' );
        //var_dump($ranges);


?>
