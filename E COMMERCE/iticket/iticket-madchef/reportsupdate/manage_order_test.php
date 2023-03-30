<?php
include'session.php';
include'../db.php';

if (isset($_POST['notification'])) {
	$nsql = "SELECT count(*) as total FROM ticket WHERE `group`='".$_SESSION['brand']."' AND `branch_name`='".$_SESSION['branch']."' AND `status` = 'New' ORDER BY `id` DESC  LIMIT  10";
	$new_ticket = mysql_fetch_assoc(mysql_query($nsql));
	echo $new_ticket['total'];
}

if (isset($_POST['ticket_id'])) {
	$ticket_id = $_POST['ticket_id'];
	$sql = "UPDATE `ticket` SET `status`='Processing' WHERE `id`='$ticket_id'";
	if(mysql_query($sql)){
		echo "Order Accepted";
	}else{
		echo "Order Decline";
	}
}
if (isset($_POST['new_ticket'])) {?>
	<table class="table table-striped">
		<tbody>
			<?php
			$new_ticket = 0;
			$sl=0;
			$sql = "SELECT * FROM ticket WHERE `group`='".$_SESSION['brand']."' AND `branch_name`='".$_SESSION['branch']."' AND `status` = 'New' ORDER BY `id` DESC  LIMIT  10";
			$data = mysql_query($sql);
			while ($row = mysql_fetch_assoc($data)) {
				$new_ticket = $new_ticket+1;
				?>
				<tr onclick="request_receive(<?php echo $row['id'];?>)">
					<td> <?php echo ++$sl; ?></td>
					<td> <?php echo $row['agent']; ?></td>
					<td> <?php echo $row['cus_contact']; ?></td>
					<td> <?php echo $row['cus_name']; ?></td>
					<td> <?php echo $row['superiors']; ?></td>
					<td>
						<?php echo  $row['status']; ?>
					</td>
					<td> <?php echo $row['date']; ?></td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
	<?php
}
?>