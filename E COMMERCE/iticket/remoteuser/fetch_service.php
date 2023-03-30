<?php

include '../db.php';

if (isset($_POST['get_option'])) {
	$type = $_POST['get_option'];

	$sql=mysql_query("SELECT issue_type FROM ticket.issue_type WHERE type_name='$type'");

	while($row=mysql_fetch_array($sql))
	{
		?>
		<select name="issue_type" id="issue_type" class="form-control"  style="padding: 0px;" >
			<option value="<?php echo $row['issue_type']; ?>"><?php echo $row['issue_type']; ?></option>
		</select>
		<?php
	}
}
