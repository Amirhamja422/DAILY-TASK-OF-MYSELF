  <?php
  include 'db.php';
  mysql_query("SET CHARACTER SET utf8");
  mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
  $results9=mysql_query("SELECT COUNT(status) FROM  `ticket` WHERE  `status` =  'New'");
  $count = mysql_fetch_array($results9);
  ?>
  <table width="665" height="70" border="0" style="margin-top: -22px;" align="center">
    <tr>
      <td width="108" height="55" valign="bottom"></td>
      <td width="296"  valign="bottom" >



        <a href="agent_ticket_create.php"><button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button></a>
        <a href="search.php"><button class="btn btn-primary btn-sm" onclick="location.href='search.php'" ><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Search</button></a>


      </td>
      <td width="247" valign="bottom">
       <button class="btn btn-warning btn-sm" type="button">
        New Ticket
        <span class="badge">
          <?php
          include 'db.php';
          mysql_query("SET CHARACTER SET utf8");
          mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
          $results9=mysql_query("SELECT COUNT(status) FROM  `ticket` WHERE  `status` =  'New'");
          $count = mysql_fetch_array($results9);
          echo $count[0];
          ?>
        </span>
      </button>&nbsp;
    </td>
  </tr>
</table>