<?php
    include '../db.php';
    session_start();
 
    $sql = mysql_query("SELECT * FROM ticket WHERE date > ( date + INTERVAL 10 MINUTE)   AND ( `status` = 'New' OR `status`= 'Re_order') AND `branch_name`='".$_SESSION['branch']."' AND `group`='".$_SESSION['brand']."' ");

    while ($row = mysql_fetch_assoc($sql)){
        echo $row['cus_name'];
        echo $row['branch_name'];
        echo $row['group'];
    }

?>    

    



    


    
     

      



    

     







