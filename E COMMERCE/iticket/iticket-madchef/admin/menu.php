<?php include'session.php'; ?>
<div>
   <input name="menu1" type="submit" class="btn btn-primary btn-sm" id="menu1" onclick="document.getElementById('loder').src='sub_type.php'" value="Issue"/>

  <input name="menu1" type="submit" class="btn btn-primary btn-sm" id="menu1" onclick="document.getElementById('loder').src='type.php'" value="Service"/>


  <input name="menu2" type="submit"  class="btn btn-primary btn-sm" id="menu2" onclick="document.getElementById('loder').src='status.php'" value="Ticket Status"/>

    <input name="menu2" type="submit"  class="btn btn-warning btn-sm" id="menu2" onclick="document.getElementById('loder').src='update/update.php'" value="Update Ticket"/>
<!--     <input name="menu2" type="submit"  class="btn btn-warning btn-sm" id="menu2" onclick="document.getElementById('loder').src='SMS/update.php'" value="SMS API"/> -->
  <input name="menu3" type="submit"  class="btn btn-primary btn-sm" id="menu3" onclick="document.getElementById('loder').src='template.php'" value="Templates"/>
  <input name="menu1" type="submit" class="btn btn-primary btn-sm" id="menu4" onclick="document.getElementById('loder').src='ug.php'" value="Department"/>
  <input name="menu1" type="submit" class="btn btn-primary btn-sm" id="menu5" onclick="document.getElementById('loder').src='user.php'" value="Usersssss"/>
  <!--<input name="menu1" type="submit" class="btn btn-primary btn-sm" id="menu6" onclick="document.getElementById('loder').src='search.php?i=<?php print $_GET['i'];?>'" value="Search"/>-->
  <input name="menu1" type="submit" class="btn btn-primary btn-sm" id="menu7" onclick="document.getElementById('loder').src='reports/report.php'" value="Reports"/>
  <input name="menu1" type="submit" class="btn btn-primary btn-sm" id="menu7" onclick="document.getElementById('loder').src='pass.php'" value="Change Pass"/>
<!--   <input name="menu1" type="submit" class="btn btn-Success btn-sm" id="menu8" onclick="document.getElementById('loder').src='notice.php'" value="Notice"/> -->
<!--     <input name="menu1" type="submit" class="btn btn-primary btn-sm" id="menu8" onclick="document.getElementById('loder').src='upload.php'" value="Theme"/> -->
<!--	<input name="menu1" type="submit" class="btn btn-primary btn-sm" id="menu8" onclick="document.getElementById('loder').src='vi_filter.php'" value="Number Filter"/> -->
	<!--<input name="menu1" type="submit" class="btn btn-primary btn-sm" id="menu8" onclick="" value="Log-Out"/> -->
	<button class="btn btn-danger btn-sm" onclick="location.href='out.php?i=<?php print $_GET['i'];?>'" > <span class="glyphicon glyphicon-off" aria-hidden="true"></span>&nbsp;Log out / <?php echo $_SESSION['usr01937417227']; ?></button>
</div>

