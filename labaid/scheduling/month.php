<?php

    if($month_number=="01"){$month_name = "January";$month_day_count="31";}
    if($month_number=="02"){$month_name = "February";if($year%4 == 0){$month_day_count="29";}else{$month_day_count="28";}}
    if($month_number=="03"){$month_name = "March";$month_day_count="31";}
    if($month_number=="04"){$month_name = "April";$month_day_count="30";}
    if($month_number=="05"){$month_name = "May";$month_day_count="31";}
    if($month_number=="06"){$month_name = "June";$month_day_count="30";}
    if($month_number=="07"){$month_name = "July";$month_day_count="31";}
    if($month_number=="08"){$month_name = "August";$month_day_count="31";}
    if($month_number=="09"){$month_name = "September";$month_day_count="30";}
    if($month_number=="10"){$month_name = "October";$month_day_count="31";}
    if($month_number=="11"){$month_name = "November";$month_day_count="30";}
    if($month_number=="12"){$month_name = "December";$month_day_count="31";}

?>