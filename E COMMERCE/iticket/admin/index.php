<?php include'session.php'; ?>
<title>. : i Tracker : .</title>
<link href="../css/bootstrap.min.css" rel="stylesheet">
<body background="<?php include 'bg.php';?>">

<!-- Main Div -->
<div style="display: inline-block; position: fixed; top: 100px; left:0px; width: 100%; height: 90%; border-size: 2px; border-color:#0099FF; border-style:solid; box-shadow: 6px 7px 11px #080808; background-color:rgba(255, 255, 255, 0.6);" >


<iframe id="loder" src="user.php" style="border:none; width:100%; height:90%; overflow:hidden; position:absolute; top:0px; left:0px;"></iframe> 


<div align="center" style="margin-top:-40px;"><?php include 'menu.php';?></div>
<!-- <div align="left" style="margin-left:15px; margin-top:15px;"><img src="../kullu/Logo.png" width="70" height="70" /></div> -->
</div><!-- End Main Div -->
<?php include 'footer.php';?>
</body>