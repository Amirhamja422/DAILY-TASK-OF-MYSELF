<?php 
include 'function.php';
include 'db.php';
date_default_timezone_set('Asia/Dhaka');
  echo "<br>";
  echo "Create Time: ".$create_time = date("12:00:34");echo "<br>";
  echo "Create Date: ".$create_date = date("2020-11-05");echo "<br>";
  echo "Create Date Time: ".$create_date_time = date("2020-11-05 12:00:34");echo "<br>";
  echo "SLA Time: ".$sla = 57600;echo "<br>";
  echo "SLA Day: ".$sla = ceil(60000 / 28800);echo "<br>";
  echo "Count Date: ".$day_count = 5;echo "<br>";
    if (($create_time > "10:00:00") && ($create_time < "17:59:59")) {
          echo "Create After 10 AM And Before 6 PM";echo "<br>";
          echo "Unique Start: ".$unique_start = ($create_date." 10:00:00");echo "<br>";
          echo "Unique End: ".$unique_end = ($create_date." 17:59:59");echo "<br>";
          echo "Start Gap: ".$start_gap = (strtotime($create_date_time) - strtotime($unique_start));echo "<br>";
          echo "Create End Gap: ".$create_end_gap = (strtotime($unique_end) - strtotime($create_date_time));echo "<br>";
          echo "After Days: ".$after_days = date("Y-m-d",strtotime($create_date. "+".$day_count." day"));echo "<br>";
          echo "Total SLA: ".$total_sla = $sla * 28800;echo "<br>";
          $Date = getDatesFromRange($create_date, $after_days);
          $date = array_slice($Date, 0, $sla);
          // print_r(array_search(3, array_keys($Date)));
          
          // foreach ($Date['days'] as $key => $value) {
          //     echo $value;echo "<br>";
          // }
          print_r($Date);
          


          



          
    } elseif (($create_time > "17:59:59") && ($create_time < "23:59:59")) {
          echo "Create After 6 PM And Before 12 PM";echo "<br>";
                "Next Day: ".$next_day = date("Y-m-d",strtotime($create_date. "+1 day"));echo "<br>";
                "Next Day Name: ".$next_day_name = date("l", strtotime($next_day));echo "<br>";

          if (($next_day_name != "Friday") && ($next_day_name != "Saturday")) {
              $calculation = (strtotime($next_day." 10:00:00") + $sla);echo "<br>";
          } else if ($next_day_name == "Friday"){
              "Next Day: ".$next_day = date("Y-m-d",strtotime($create_date. "+3 day"));echo "<br>";
              $calculation = (strtotime($next_day." 10:00:00") + $sla);echo "<br>";
          } else if ($next_day_name == "Saturday"){
              "Next Day: ".$next_day = date("Y-m-d",strtotime($create_date. "+2 day"));echo "<br>";
              $calculation = (strtotime($next_day." 10:00:00") + $sla);echo "<br>";
          }
          echo date("Y-m-d H:i:s", $calculation);
    } else if (($create_time > "00:00:01") && ($create_time < "09:59:59")){
          echo "Create After 12 PM And Before 10 AM";echo "<br>";
          echo "To Day Name: ".$to_day_name = date("l", strtotime($create_date));echo "<br>";
          "Next Day: ".$next_day = date("Y-m-d",strtotime($create_date. "+1 day"));echo "<br>";

          if (($to_day_name != "Friday") && ($to_day_name != "Saturday")) {
              $calculation = (strtotime($create_date." 10:00:00") + $sla);echo "<br>";
          } else if ($to_day_name == "Friday"){
             "Next Day: ".$next_day = date("Y-m-d",strtotime($create_date. "+2 day"));echo "<br>";
              $calculation = (strtotime($next_day." 10:00:00") + $sla);echo "<br>";
          } else if ($to_day_name == "Saturday"){
              "Next Day: ".$next_day = date("Y-m-d",strtotime($create_date. "+1 day"));echo "<br>";
              $calculation = (strtotime($next_day." 10:00:00") + $sla);echo "<br>";
          }
          echo date("Y-m-d H:i:s", $calculation);
    }