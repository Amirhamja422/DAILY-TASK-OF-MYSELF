<?php
include '../db.php';

// $results=mysql_query("SELECT `id`,`user_name`,(select group_name from user_group where user_group.id=users.user_group_id),previlege,superior_id,designation,`user_pass`,(select type_name from ticket_type where ticket_type.id=users.concern), user_id FROM `users` ");
$results=mysql_query("SELECT `id`,`user_name`,user_group_id,previlege,superior_id,designation,`user_pass`,concern,user_id FROM `users` ");


while($data_array=mysql_fetch_row($results))
{
	if($data_array[3]==0) {$pre="Administrator";}
	if($data_array[3]==3) {$pre="Report Update";}	
	if($data_array[3]==2) {$pre="Group Admin";}
	if($data_array[3]==1) {$pre="Ticket Create";}	
	if($data_array[3]==4) {$pre="Ticket Admin";}	

	$dept = mysql_query("SELECT * FROM `user_group` WHERE `id` IN (".ltrim($data_array[2], ',').")");
	$service = mysql_query("SELECT * FROM `ticket_type` WHERE `id` IN (".ltrim($data_array[7], ',').")");
      
	?>
	<tr>
		<td align="center"><?php echo $data_array[0];?></td>
		<td><?php echo $data_array[8];?></td>
		<td style="font-size:10px;">
			<?php 
				while ($row1 = mysql_fetch_array($dept)) { 
                     echo $row1['group_name'].", "; 
                 }
			?>	
		</td>
		<td style="font-size:10px;">
			<?php 
				while ($row2 = mysql_fetch_array($service)) { 
                     echo $row2['type_name'].", "; 
                 }
			?>	
		</td>
		<td style="font-size:10px;"><?php echo $pre;?></td>
		<td style="font-size:10px;"><?php echo $data_array[6];?></td>
		<td align="center" style="font-size:10px;color:#0066CC; cursor:pointer;">
			<a onclick="edituser('<?php echo $data_array[0];?>');">Edit</a>
		</td>
		<td align="center">
			<a href="delete.bra2.php?id=<?php echo $data_array[0];?>" onclick="return confirm('Are you really want to delete<?php echo $data_array[1];?>);">
				<img src="idebnath/remove.png" style="cursor:pointer; width:10px; height:10px;">
			</a>
		</td>
	</tr>
	<?php
}

?>