<form action="t.box.php" method="post">
<input type="checkbox" id="chaka" name="chaka">
<input type="submit" id="su" name="su">
</form>

<?php
if(isset($_POST['su']))

print $_POST['chaka'];

?>