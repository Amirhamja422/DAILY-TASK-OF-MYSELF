<?php include'session.php'; ?>
<div>
  <!--<input name="menu1" type="submit" class="btn btn-primary btn-sm" id="menu1" onclick="document.getElementById('loder').src='type.php'" value="Ticket Type"/> -->
  <!--<input name="menu2" type="submit"  class="btn btn-primary btn-sm" id="menu2" onclick="document.getElementById('loder').src='status.php'" value="Ticket Status"/> -->
<!--    <input name="menu3" type="submit"  class="btn btn-primary btn-sm" id="menu3" onclick="document.getElementById('loder').src='../admin/template.php'" value="Templates"/>   -->
 <!-- <input name="menu1" type="submit" class="btn btn-primary btn-sm" id="menu4" onclick="document.getElementById('loder').src='ug.php'" value="User Group"/>  -->
 <!-- <input name="menu1" type="submit" class="btn btn-primary btn-sm" id="menu5" onclick="document.getElementById('loder').src='user.php'" value="Users"/>  -->
  <!--<input name="menu1" type="submit" class="btn btn-primary btn-sm" id="menu6" onclick="document.getElementById('loder').src='search.php?i=<?php print $_GET['i'];?>'" value="Search"/>-->
  <input name="menu1" type="submit" class="btn btn-primary btn-sm" id="menu7" onclick="document.getElementById('loder').src='../admin/reportsOnly/report.php'" value="Reports"/>
<!--   <input name="menu1" type="submit" class="btn btn-Success btn-sm" id="menu8" onclick="document.getElementById('loder').src='../admin/notice.php'" value="Notice"/> -->
<!--     <input name="menu1" type="submit" class="btn btn-primary btn-sm" id="menu8" onclick="document.getElementById('loder').src='upload.php'" value="Theme"/> -->
<!--	<input name="menu1" type="submit" class="btn btn-primary btn-sm" id="menu8" onclick="document.getElementById('loder').src='vi_filter.php'" value="Number Filter"/> -->
	<!--<input name="menu1" type="submit" class="btn btn-primary btn-sm" id="menu8" onclick="" value="Log-Out"/> -->
	<button class="btn btn-danger btn-sm" onclick="location.href='../admin/out.php?i=<?php print $_GET['i'];?>'" > <span class="glyphicon glyphicon-off" aria-hidden="true"></span>&nbsp;Log out</button>
</div>

