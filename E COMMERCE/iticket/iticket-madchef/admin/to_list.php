<? //include 'db.php';
					$result1 = mysql_query("select *FROM users ");
while($row=mysql_fetch_array($result1)) { ?>
              <option value="<?=$row['id']?>">
              <?=$row['user_name']?>
              </option>
              <? } ?>