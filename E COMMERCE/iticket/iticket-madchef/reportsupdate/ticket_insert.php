<?php
    include '../db.php';
     session_start();
     
     $status = $_POST['status'];
     $id = $_POST['id'];
     $note = $_POST['note'];
     $now_user =  $_SESSION['usr01937417227']; 
     $update_details = $_POST['update_details']; 
   

    $sql = "UPDATE ticket SET status='".$status."', note='".$note."'  WHERE id='".$id."'";
    
    $update_ticket = mysql_query($sql);

    $results=mysql_query("INSERT INTO `history` (`id`,`status`,`from`, `details`,`date`) VALUES ('".$id."','".$status."', '".$now_user."','".$update_details."',NOW() )");


    if($update_ticket) {
    	echo "Updated Successfully";
    }

    else{
    	echo "Not Updated";
    }
      
?>



        
        


                                 