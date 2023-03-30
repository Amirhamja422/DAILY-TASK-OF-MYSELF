<?php 
include 'function.php';
include 'db.php';
date_default_timezone_set('Asia/Dhaka');

$sql = mysql_query("SELECT * FROM `ticket_dev`.`ticket` WHERE `hour_time`!='0' AND `status` != 'Closed' ORDER BY `id` DESC LIMIT 4");

while ($row = mysql_fetch_assoc($sql)) {
  echo "<br><pre>";
   "Create Time: ".$create_time = date("H:i:s", strtotime($row['date']));echo "<br>";
  // After 10 AM Before 6 PM
  if ((($create_time > "10:00:00") && ($create_time < "17:59:59")) && ((date("H:i:s") > "10:00:00") && (date("H:i:s") < "17:59:59"))) {
    echo "Create After 10 AM And Before 6 PM";echo "<br>";
    echo "Create Date-Time: ".$create = $row['date'];echo "<br>";
    echo "Create Date: ".$create_date = date("Y-m-d", strtotime($row['date']));echo "<br>";
    echo "SLA: ".$sla = 28800;echo "<br>";
    echo "Now Date - Time: ".$now_date_time = date("Y-m-d H:i:s");echo "<br>";
    echo "Now Time: ".$now_time = date("H:i:s");echo "<br>";
    echo "Now Date: ".$end_date = date("Y-m-d");echo "<br>";
    echo "Unique Start: ".$unique_start = ($create_date." 10:00:00");echo "<br>";
    echo "Today Start: ".$today_start = (date("Y-m-d")." 10:00:00");echo "<br>";
    echo "Today End: ".$today_end = (date("Y-m-d")." 17:59:59");echo "<br>";
    $Date = getDatesFromRange($create_date, $end_date);
    echo "Day Count: ".$day_count = count($Date);echo "<br>";
    echo "Day Name: ".$dayname = date('D', strtotime($row['date']));echo "<br>";

    print_r($Date);
    echo "------Calculation------<br>";

     echo "Total Hour By Day: ".$tot_hour = (($day_count * 8) * 3600);echo "<br>"; 
     "Start Gap: ".$start_gap = (strtotime($create) - strtotime($unique_start));echo "<br>";
      if ($dayname == "Fri") {
        echo $start_gap = 0;echo "<br>";
      }
     echo "Start Gap: ".$start_gap;echo "<br>";
     echo "Today End Gap: ".$today_end_gap = (strtotime($today_end) - strtotime(date("Y-m-d H:i:s")));echo "<br>"; 
     echo "Total Gap: ".$calculation = ($tot_hour - ($start_gap + $today_end_gap));echo "<br>"; 
       if ($calculation > $sla) {
          echo "SLA OVER";echo "<br>";
       } else {
        echo "SLA NOT OVER";echo "<br>";
       }
    } else if ((($create_time > "17:59:59") && ($create_time < "23:59:59")) && ((date("H:i:s") > "10:00:00") && (date("H:i:s") < "17:59:59"))) {
      echo "Create After 6 PM And Before 12 PM";echo "<br>";
      echo "Create Date-Time: ".$create = $row['date'];echo "<br>";
      echo "Create Date: ".$create_date = date("Y-m-d", strtotime($row['date']));echo "<br>";
      echo "SLA: ".$sla = 28800;echo "<br>";
      echo "Now Date - Time: ".$now_date_time = date("Y-m-d H:i:s");echo "<br>";
      echo "Now Time: ".$now_time = date("H:i:s");echo "<br>";
      echo "Now Date: ".$end_date = date("Y-m-d");echo "<br>";
      echo "Unique Start: ".$unique_start = ($create_date." 10:00:00");echo "<br>";
      echo "Today Start: ".$today_start = (date("Y-m-d")." 10:00:00");echo "<br>";
      echo "Today End: ".$today_end = (date("Y-m-d")." 17:59:59");echo "<br>";
      $Date = getDatesFromRange($create_date, $end_date);
      echo "Day Count: ".$day_count = count($Date);echo "<br>";
      print_r($Date);
      echo "------Calculation------<br>";
      echo "Day Name: ".$dayname = date('D', strtotime($row['date']));echo "<br>";
      if ($dayname != "Fri") {
        echo $day_count = $day_count - 1;echo "<br>";
      }
       echo "Total Hour By Day: ".$tot_hour = (($day_count * 8) * 3600);echo "<br>";
       echo "Today End Gap: ".$today_end_gap = (strtotime($today_end) - strtotime(date("Y-m-d H:i:s")));echo "<br>"; 
       echo "Total Gap: ".$calculation = ($tot_hour - $today_end_gap);echo "<br>"; 
         if ($calculation > $sla) {
            echo "SLA OVER";echo "<br>";
         } else {
          echo "SLA NOT OVER";echo "<br>";
         }
    } else if ((($create_time > "00:00:01") && ($create_time < "09:59:59")) && ((date("H:i:s") > "10:00:00") && (date("H:i:s") < "17:59:59"))) {
      echo "Create After 12 PM And Before 10 AM";echo "<br>";
      echo "Create Date-Time: ".$create = $row['date'];echo "<br>";
      echo "Create Date: ".$create_date = date("Y-m-d", strtotime($row['date']));echo "<br>";
      echo "SLA: ".$sla = 28800;echo "<br>";
      echo "Now Date - Time: ".$now_date_time = date("Y-m-d H:i:s");echo "<br>";
      echo "Now Time: ".$now_time = date("H:i:s");echo "<br>";
      echo "Now Date: ".$end_date = date("Y-m-d");echo "<br>";
      echo "Unique Start: ".$unique_start = ($create_date." 10:00:00");echo "<br>";
      echo "Today Start: ".$today_start = (date("Y-m-d")." 10:00:00");echo "<br>";
      echo "Today End: ".$today_end = (date("Y-m-d")." 17:59:59");echo "<br>";
      $Date = getDatesFromRange($create_date, $end_date);
      echo "Day Count: ".$day_count = count($Date);echo "<br>";
      print_r($Date);
        echo "------Calculation------<br>";

       echo "Total Hour By Day: ".$tot_hour = (($day_count * 8) * 3600);echo "<br>"; 
       echo "Today End Gap: ".$today_end_gap = (strtotime($today_end) - strtotime(date("Y-m-d H:i:s")));echo "<br>"; 
       echo "Total Gap: ".$calculation = ($tot_hour - $today_end_gap);echo "<br>"; 
         if ($calculation > $sla) {
            echo "SLA OVER";echo "<br>";
         } else {
          echo "SLA NOT OVER";echo "<br>";
         }
    }
    
  echo "-------------------------------".$row['id']."-------------------------------";
}


?> s