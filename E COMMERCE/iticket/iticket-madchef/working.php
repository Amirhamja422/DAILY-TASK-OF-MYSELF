<?php
function get_working_hours($from,$to)
{
    // timestamps
    $from_timestamp = strtotime($from);
    $to_timestamp = strtotime($to);

    // work day seconds
    $workday_start_hour = 10;
    $workday_end_hour = 18;
    $workday_seconds = ($workday_end_hour - $workday_start_hour)*3600;

    // work days beetwen dates, minus 1 day
    $from_date = date('Y-m-d',$from_timestamp);
    $to_date = date('Y-m-d',$to_timestamp);
    $workdays_number = count(get_workdays($from_date,$to_date))-1;
    $workdays_number = $workdays_number<0 ? 0 : $workdays_number;

    // start and end time
    $start_time_in_seconds = date("H",$from_timestamp)*3600+date("i",$from_timestamp)*60;
    $end_time_in_seconds = date("H",$to_timestamp)*3600+date("i",$to_timestamp)*60;

    // final calculations
    $working_hours = ($workdays_number * $workday_seconds + $end_time_in_seconds - $start_time_in_seconds) / 86400 * 24;

    return $working_hours;
}

function get_workdays($from,$to) 
{
    // arrays
    $days_array = array();
    $skipdays = array("Friday", "Saturday");
    $skipdates = get_holidays();

    // other variables
    $i = 0;
    $current = $from;

    if($current == $to) // same dates
    {
        $timestamp = strtotime($from);
        if (!in_array(date("l", $timestamp), $skipdays)&&!in_array(date("Y-m-d", $timestamp), $skipdates)) {
            $days_array[] = date("Y-m-d",$timestamp);
        }
    }
    elseif($current < $to) // different dates
    {
        while ($current < $to) {
            $timestamp = strtotime($from." +".$i." day");
            if (!in_array(date("l", $timestamp), $skipdays)&&!in_array(date("Y-m-d", $timestamp), $skipdates)) {
                $days_array[] = date("Y-m-d",$timestamp);
            }
            $current = date("Y-m-d",$timestamp);
            $i++;
        }
    }

    return $days_array;
}

function get_holidays() 
{
    // arrays
    $days_array = array();

    // You have to put there your source of holidays and make them as array...
    // For example, database in Codeigniter:
    // $days_array = $this->my_model->get_holidays_array();

    return $days_array;
}

   echo get_working_hours("2020-11-11", "2020-11-17")/8;echo "<br>";
   echo "Create Date: ". $create = "2020-11-11 12:30:30";echo "<br>";
   echo "SLA Time: ". $sla = (61200/3600);echo "<br>";
   // echo "SLA Time: ". $sla = gmdate("H:i:s", "25200");echo "<br>";
   echo "Time After Add SLA And Create: ". $sla_create = date('Y-m-d H:i:s', strtotime("+".($sla*3)." hour +00 minutes", strtotime($create)));echo "<br>";
   echo "Start Gap: ". $start_gap = gmdate("H:i:s", (strtotime($create) - strtotime("2020-11-11 10:00:00")));echo "<br>";
   echo "Result: ". $result = date('Y-m-d 10:00:00', strtotime($sla_create));echo "<br>";
   echo "Date: ". $date = date('Y-m-d H:i:s', strtotime("+00 hour +".$start_gap." minutes", strtotime($result)));echo "<br>";
?>
