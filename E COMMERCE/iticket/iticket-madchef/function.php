<?php 
date_default_timezone_set('Asia/Dhaka');

   function addRollover($givenDate, $addtime, $dayStart, $dayEnd, $weekDaysOnly) {
    //Break the working day start and end times into hours, minuets
    $dayStart = explode(',', $dayStart);
    $dayEnd = explode(',', $dayEnd);
    //Create required datetime objects and hours interval
    $datetime = new DateTime($givenDate);
    $endofday = clone $datetime;
    $endofday->setTime($dayEnd[0], $dayEnd[1]); //set end of working day time
    $interval = 'PT'.$addtime.'H';
    //Add hours onto initial given date
    $datetime->add(new DateInterval($interval));
    //if initial date + hours is after the end of working day
    if($datetime > $endofday)
    {
        //get the difference between the initial date + interval and the end of working day in seconds
        $seconds = $datetime->getTimestamp()- $endofday->getTimestamp();

        //Loop to next day
        while(true)
        {
            $endofday->add(new DateInterval('PT24H'));//Loop to next day by adding 24hrs
            $nextDay = $endofday->setTime($dayStart[0], $dayStart[1]);//Set day to working day start time
            //If the next day is on a weekend and the week day only param is true continue to add days
            if(in_array($nextDay->format('l'), array('Friday','Saturday')) && $weekDaysOnly)
            {
                continue;
            }
            else //If not a weekend
            {
                $tmpDate = clone $nextDay;
                $tmpDate->setTime($dayEnd[0], $dayEnd[1]);//clone the next day and set time to working day end time
                $nextDay->add(new DateInterval('PT'.$seconds.'S')); //add the seconds onto the next day
                //if the next day time is later than the end of the working day continue loop
                if($nextDay > $tmpDate)
                {
                    $seconds = $nextDay->getTimestamp()-$tmpDate->getTimestamp();
                    $endofday = clone $tmpDate;
                    $endofday->setTime($dayStart[0], $dayStart[1]);
                }
                else //else return the new date.
                {
                    return $endofday;

                }
            }
        }
    }
    return $datetime;
} 


include 'db.php';
function slaSTatus($id)
{
    $sql = mysql_fetch_assoc(mysql_query("SELECT * FROM `ticket_dev`.`ticket` WHERE `id`='".$id."'"));
    $history_last = mysql_fetch_assoc(mysql_query("SELECT * FROM `history` WHERE `id`='".$id."' AND `status`='Solved' ORDER BY `date` DESC LIMIT 1"));
    $history_first = mysql_fetch_assoc(mysql_query("SELECT * FROM `history` WHERE `id`='".$id."' ORDER BY `date` ASC LIMIT 1"));

    $today = date('Y-m-d H:i:s');
    $exit = $sql['total_sla'];
    $last_closed = $history_last['date'];
    $status = $sql['status'];

    if (($today > $exit) && ($status != 'Solved')) {  
      $res = "Not Resolved & SLA Expired"; 
      $tr  = "<tr style=\"background-color: #EC981F;\">";
      $tr2  = "<tr class=\"altav\" style=\"background-color: #EC981F;\">";
    } else if (($last_closed > $exit) && ($status == 'Solved')) {
      $res = "Resolved After SLA Expired"; 
      $tr  = "<tr style=\"background-color: #789CFA;\">";
      $tr2  = "<tr class=\"altav\" style=\"background-color: #789CFA;\">";
    } else if(($last_closed < $exit) && ($status == 'Solved')) {
      $res = "Solved within SLA"; 
      $tr  = "<tr style=\"background-color: #789CFA;\">";
      $tr2  = "<tr class=\"altav\" style=\"background-color: #789CFA;\">";
    } else if(($today < $exit) && ($status != 'Solved')) { 
      $res = "Not Resolved & SLA Not Expired"; 
      $tr  = "<tr>";
      $tr2  = "<tr class=\"altav\">";
    }

    return $res;

}

?> 