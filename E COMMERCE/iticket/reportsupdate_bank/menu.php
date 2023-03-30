<?php include'session.php'; ?>
<div>

    <input name="menu2" type="submit"  class="btn btn-warning btn-sm" id="menu2" onclick="document.getElementById('loder').src='update/update.php'" value="Update Ticket"/>
    <input name="menu2" type="submit"  class="btn btn-warning btn-sm" id="menu2" onclick="document.getElementById('loder').src='pass.php'" value="Change Pass"/>
	<!-- <button class="btn btn-danger btn-sm" onclick="location.href='out.php?i=<?php print $_GET['i'];?>'" > <span class="glyphicon glyphicon-off" aria-hidden="true"></span>&nbsp;Log out</button> -->
	<button class="btn btn-danger btn-sm" onclick="location.href='../admin/out.php?i=<?php print $_GET['i'];?>'" > <span class="glyphicon glyphicon-off" aria-hidden="true"></span>&nbsp;Log out / <?php echo $_SESSION['usr01937417227']; ?></button>
</div>

