<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
  <title>. : : i Tracker : : .</title>
</head>

<body background="admin/<?php include 'bg.php';?>">
  <div class="container" style="background:#CCCCCC; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; ">
    <table width="100%" height="440" border="0" align="center">
         <!--    <?php
      $NAME = $_GET['phone_number'];
      echo $NAME;
      ?> -->
      <!-- <tr>
        <td valign="top"><?php include'menu.php';?>&nbsp;</td>
      </tr> -->

      <input type="hidden" name="phone_number" id="phone_number" value="<?php echo $_GET['phone_number'];?>">
    </tr>
    <tr>
      <td height="66" valign="top">
        <table width="100%" border="0" align="center">
          <tr>
            <td width="662" valign="top">
            <?php
            $now = date('Y-m-d');
            $start_date = $now;
            $end_date = $now;
            ?>            
              <table width="100%" border="0" style="margin-top: 10px;">
                <tr style="font-size:9px;">
                  <td >
                    Start Date : 
                  </td>
                  <td colspan="2"> 
                    <input class="form-control" type="date" id="idate" name="idate" value="<?php echo $start_date;?>" required>
                  </td>	  
                  <td align="right">
                    End Date : 
                  </td>
                  <td colspan="2">
                    <input class="form-control" type="date" id="edate" name="edate" value="<?php echo $end_date;?>" required>
                  </td>
                </tr>
                <tr>
                  <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                  <td>Status :</td>
                  <td>
                    <select name="status" class="form-control" id="status" >
                      <option value="">-Select Status-</option>
                      <option value="Re_order">Re_order</option>
                      <option value="Received">Received</option>
                      <?php include 'db.php';
                      $result1 = mysql_query("select *FROM ticket_status ");
                      while($row=mysql_fetch_array($result1)) { ?>
                        <option value="<?php echo $row['status_name']?>">
                          <?php echo $row['status_name']?>
                        </option>
                      <?php } ?>
                    </select>
                  </td>
                  <td>
                    <input type="submit" name="Submit" value="Submit" class="btn btn-primary btn-sm"/ onclick="status_base()">
                    <input name="all" type="button" class="btn btn-success btn-sm" id="all" value="All"/ onclick="show_all()">
                  </td>
                  <td align="right">Brand : </td>
                  <td>
                    <select name="type" class="form-control" id="brand" >
                      <option value="">-Select Brand-</option>
                      <?php
                      $result11 = mysql_query("select *FROM ticket_type ");
                      while($row=mysql_fetch_array($result11)) { ?>
                        <option value="<?php echo $row['type_name']?>">
                          <?php echo $row['type_name']?>
                        </option>
                      <?php } ?>
                    </select>
                  </td>
                  <td>
                    <input type="submit" name="Submit3" value="Submit" class="btn btn-primary btn-sm" onclick="brand_base()" />
                  </td>
                </tr>
                <tr>
                  <td width="48">Search : </td>
                  <td width="119">
                    <select name="search" class="form-control" id="search">
                      <option>--Select--</option>
                      <option value="id">Ticket ID</option>
                      <option value="cus_contact">Phone</option>
                      <option value="order_id">Order ID</option>
                      <option value="agent">User</option>
                    </select>
                  </td>
                  <td width="111" align="center" style="font-size:8px;">( Empty Value Return's All )</td>
                  <td width="51" align="right">Value : </td>
                  <td width="144"><input name="value" type="text" class="form-control" id="value"/></td>
                  <td width="56"><input type="submit" name="Submit2" value="Submit" class="btn btn-primary btn-sm" onclick="value_base()" /></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td height="345" valign="top">&nbsp;
        <div style="overflow-x:hidden; overflow-y:hidden;  height: auto; font-size:10px;" id="search_result"></div>
      </td>
    </tr>
  </table>
</div>
<script type="text/javascript">
  $( document ).ready(function() {
    phone_base();
  });

  function phone_base(){
    var idate = $('#idate').val();
    var edate = $('#edate').val();
    
    var phone = $('#phone_number').val();
    $.ajax({
      url: 'search_action.php',
      method: 'POST',
      data: {
        phone:phone,
        idate:idate,
        edate:edate

      },
      success: function(response) {
        $("#search_result").html(response);
      }
    });
  }


  function show_all(){
    var type = 'All';
    var idate = $('#idate').val();
    var edate = $('#edate').val();
    $.ajax({
      url: 'search_action.php',
      method: 'POST',
      data: {
        type:type,
        idate:idate,
        edate:edate

      },
      success: function(response) {
        $("#search_result").html(response);
      }
    });
  }
  function status_base(){
    var Submit = 'Submit';
    var idate = $('#idate').val();
    var edate = $('#edate').val();
    var status = $('#status').val();
    $.ajax({
      url: 'search_action.php',
      method: 'POST',
      data: {
        Submit:Submit,
        status:status,
        idate:idate,
        edate:edate
      },
      success: function(response) {
        $("#search_result").html(response);
      }
    });
  }

  function brand_base(){
    var Submit3 = 'Submit3';
    var idate = $('#idate').val();
    var edate = $('#edate').val();
    var brand  = $('#brand').val();
    $.ajax({
      url: 'search_action.php',
      method: 'POST',
      data: {
        Submit3:Submit3,
        idate:idate,
        edate:edate,
        brand:brand
      },
      success: function(response) {
        $("#search_result").html(response);
      }
    });

  }
  function value_base(){
    var Submit2 = 'Submit2';
    var idate = $('#idate').val();
    var edate = $('#edate').val();
    var search = $('#search').val();
    var value = $('#value').val();
    $.ajax({
      url: 'search_action.php',
      method: 'POST',
      data: {
        Submit2:Submit2,
        idate:idate,
        edate:edate,
        search:search,
        value:value
      },
      success: function(response) {
        $("#search_result").html(response);
      }
    });

  }
</script>
</body>
</html>
