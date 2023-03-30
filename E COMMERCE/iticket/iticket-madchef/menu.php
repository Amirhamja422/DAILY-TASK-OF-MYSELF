<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>iDialer</title>
</head>

<body>
	<?php
	include 'db.php';
	mysql_query("SET CHARACTER SET utf8");
	mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
	$results9=mysql_query("SELECT COUNT(status) FROM  `ticket` WHERE  `status` =  'New'");
	$count = mysql_fetch_array($results9);
	//echo $count[0];
	?>
	<div>
		<table width="665" height="70" border="0">
			<tr>
				<td width="108" height="55" valign="bottom"><img src="kullu/Logo.png" width="70" height="70" /></td>
				<td width="396"  valign="bottom" >
					<button class="btn btn-primary btn-sm" onclick="location.href='agent_ticket_create.php'" >
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create
					</button>
					<button class="btn btn-primary btn-sm" onclick="location.href='search.php'" >
						<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Search
					</button> 
				<!-- <button class="btn btn-primary btn-sm" onclick="location.href='reminder.php?tid=<?php
				$result = mysql_query("SELECT id FROM ticket where `from`= '$agent89' order by id desc limit 1");
				$id_no=mysql_result($result,0); echo $id_no; ?>'" > 
				<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> E-mail</button> -->

				<!-- <button class="btn btn-primary btn-sm" onclick="location.href='sms_kobla_baba_mona_kobi_vabi_Gudi_begum.php'" > <span class="glyphicon glyphicon-phone" aria-hidden="true"></span> SMS</button> -->

			</td>
			<td width="147" valign="bottom">
				<button class="btn btn-warning btn-sm" type="button">
					New Ticket <span class="badge"><?php
					include 'db.php';
					mysql_query("SET CHARACTER SET utf8");
					mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
					$results9=mysql_query("SELECT COUNT(status) FROM  `ticket` WHERE  `status` =  'New'");
					$count = mysql_fetch_array($results9);
					echo $count[0];
					?></span>
				</button>
			&nbsp;</td>
		</tr>
	</table>
</div>
</body>
</html>
