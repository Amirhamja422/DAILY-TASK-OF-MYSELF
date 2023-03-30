<?php
session_start();
$username = "root"; 
$password = "iHelpBD@2017";
$hostname = "localhost";	
$connect = mysql_connect($hostname, $username, $password) 
or die("Unable to connect to MySQL");
$select = mysql_select_db("ticket_dev",$connect);

$sql=mysql_query("SELECT `id`, `ticket_type`, `from`, `assignd`, `group`, `sub_group`, `cus_contact`, `cus_name`, `cus_ac`, `cus_product`, `cus_amount`, `status`, `details`, `date`, `stamp`, `priority`, `superiors`, `hour_time`, `stat` FROM `ticket` WHERE `from`='".$_SESSION['usr01937417227']."'");

?>
<div align="center" class="datagrid" style="width:99%; height:auto; overflow:auto;">
  <table class="anlepore">
    <thead align="center">
      <tr>
        <th>ID</th>
        <th>TYPE</th>
        <th>Raised</th>
        <th>Assigned</th>
        <th>Department</th>
        <th>Service</th>
        <th>Phone</th>
        <th>Customer Name</th>
        <th>Customer Account</th>
        <th>Producr</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Details</th>
        <th>Date</th>
        <!-- <th title="UPDATE">
          <img src="update/update.png" width="20" height="20">
        </th> -->
      </tr>
    </thead>
    <tbody align="center">
      <?php
      while($row=mysql_fetch_assoc($sql)){
        $dept = mysql_fetch_assoc(mysql_query("SELECT * FROM `user_group` WHERE `id`='".$row['group']."'"));
        $type = mysql_fetch_assoc(mysql_query("SELECT * FROM `ticket_type` WHERE `id`='".$row['ticket_type']."'"));
        $service = mysql_fetch_assoc(mysql_query("SELECT * FROM `sub_group` WHERE `id`='".$row['sub_group']."'"));
        ?>
        <tr>
          <td><?php echo $row['id'];?></td>
          <td><?php echo $type['type_name'];?></td>
          <td><?php echo $row['from'];?></td>
          <td><?php echo $row['assignd'];?></td>
          <td><?php echo $dept['group_name'];?></td>
          <td><?php echo $service['sub_group_name'];?></td>
          <td><?php echo $row['cus_contact'];?></td>
          <td><?php echo $row['cus_name'];?></td>
          <td><?php echo $row['cus_ac'];?></td>
          <td><?php echo $row['cus_product'];?></td>
          <td><?php echo $row['cus_amount'];?></td>
          <td><?php echo $row['status'];?></td>
          <td><?php echo $row['details'];?></td>
          <td><?php echo $row['date'];?></td>
          <!-- <td>
            <a href=""><button><i class="far fa-edit"></i></button></a>
            <a href=""><button><i class="fas fa-trash-alt"></i></button></a>
          </td> -->
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
</div>