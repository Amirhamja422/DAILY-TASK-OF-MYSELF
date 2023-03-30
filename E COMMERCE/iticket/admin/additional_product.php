<?php include'session.php'; ?>
<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/osx.js'></script>
<link type='text/css' href='css/osx.css' rel='stylesheet' media='screen' />
<style type="text/css">
  .TitleStyle {
   color: #666666;
   font-weight: bold;
   font-size:24px;
 }
 .dropdown{
  border-top-left-radius:5px;
  border-top-right-radius:5px;
  border-bottom-left-radius:5px;
  border-bottom-right-radius:5px;
}
.anlepore tr:hover{
  background-color:#999999;
}
.anlepore tr{
  background-color:rgba(49, 94, 64, 0.6);
  color:#FFFFFF;
}
.userdapa{
  border-radius:5px;
}
.userdapa1 {border-radius:5px;
}
</style>
<script src="dipu.js"></script>
<div align="center" class="TitleStyle">Manage Additional Product &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><br>
<form action="additional_product.php" method="post" >
  <table align="center" style="color:#000000; ">
    <tr>
      <td align="right">Brand :</td>
      <td>
        <select name="brand" type="text" id="brand" required="required"  onchange="fetch_brand(this.value);" style="width: 200px;">
          <option value="">-Select Brand-</option>
          <?php
          include '../db.php';
          $result1 = mysql_query("select * FROM ticket_type WHERE `type_name` != 'Madchef'");
          while ($row = mysql_fetch_array($result1)) {
            ?>
            <option value="<?php echo $row['type_name']; ?>">
              <?php echo $row['type_name']; ?>
            </option>
          <?php } ?>
        </select>
      </td>
    </tr>

    <tr>
    <td align="right">Branch :</td>
    <td>
      <select name="branch" type="text" id="branch" required="required" style="width: 200px;">

      </select>
    </td>
  </tr>

    <tr>
      <td align="right"> Name :</td><td><input style="width: 200px;" name="name" type="text" id="name" placeholder="Product Name" /></td>
    </tr>
    <tr>
      <td align="right">Image :</td><td><input style="width: 200px;" name="image" type="file" id="image"  /></td>
    </tr>
    <tr>
      <tr>
        <td align="right">Price :</td><td><input style="width: 200px;" name="price" type="text" id="price"  placeholder="Price" /></td>
      </tr>

      <tr>
        <td align="right">Size :</td><td><input style="width: 200px;" name="size" type="text" id="size" placeholder="Size" /></td>
      </tr>
      <tr>
        <td align="right">VAT % :</td><td><input style="width: 200px;" name="vat" type="number" id="vat"  placeholder="VAT" /></td>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000;"> Enter only digit</td>
      </tr>
      <tr>
        <td align="right">Sd % :</td><td><input style="width: 200px;" name="sd" type="text" id="sd"  placeholder="SD" /></td>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000;"> Enter only digit</td>
      </tr>
      <tr>
        <td align="right"></td>
        <td><input type="submit" name="addtype" id="add" value="Add" style="border-radius:5px;" /></td>
      </tr>
    </table>
  </form>
  <?php
  if(isset($_POST['addtype']))
  {
    include '../db.php';
    $chksql = "SELECT * FROM `add_ons` WHERE `product_name` ='".$_POST['name']."' AND `brand`='".$_POST['brand']."' AND `branch`='".$_POST['branch']."' AND `product_size`='".$_POST['size']."'";
    $product_count = mysql_num_rows(mysql_query($chksql));
    if ($product_count > 0) {
      echo "<center><font face=\"Times New Roman, Times, serif\" color=\"red\">Product Already Added.</font></center>";
    }else{
      $sd = $_POST['sd'];
      $vat = $_POST['vat'];
      $results=mysql_query("INSERT INTO add_ons (`brand`,`branch`, `product_name`, `product_price`, `product_size`,`sd`,`vat`) VALUES ( '".$_POST['brand']."','".$_POST['branch']."', '".$_POST['name']."','".$_POST['price']."','".$_POST['size']."','".$sd."','".$vat."' )");
      print "<center><font face=\"Times New Roman, Times, serif\" color=\"#0000CD\">Product Inserted Successfully.</font></center>";
    }
  }
  ?>
  <br>
  <div align="center">
    <br><br>
    <table style="border-radius:20px; border:1px; border:solid; width:75%; cursor:pointer; color:#999999;" align="center" class="anlepore">
      <tr style="background-color:#0099CC; color:#FFFFFF;">
        <td align="center">No.</td><td align="center">Name</td><td align="center">Price(BDT)</td><td align="center">VAT % </td><td align="center">SD % </td><td align="center">Size</td><td align="center">Brand</td><td align="center">Branch</td><td title="Delete" align="center"><img src="idebnath/delete.png" style="cursor:pointer;"></td><td title="Edit" align="center" style="border-top-right-radius:10px;"><img width="20" height="20" src="idebnath/100px-Gartoon-Gedit-icon.png" style="cursor:pointer;"></td>
      </tr>
      <?php include 'additional_product_list.php'; ?>
    </table>
  </div>
  <script>

    function fetch_brand(val)
  {

    $.ajax({
      type: 'post',
      url: 'fetch_branch.php',
      data: {
        get_option:val
      },
      success: function (response) {
        document.getElementById("branch").innerHTML=response;
      }
    });
  };

// Display an external page using an iframe
function smcollege(kuti)
{
var X=window.innerWidth/5;//$(window).height()-430;
//document.getElementById("NP").value=X;
var Y=50;
var src = "edit_additional_product.php?q1="+kuti;
$.modal('<iframe src="' + src + '" height="480" width="830" style="border:0">', {
  closeHTML:"",
  appendTo: $(window.parent.document).find('body'),
  opacity:70,
  overlayCss: {backgroundColor:"#000"},
  containerCss:{
    backgroundColor:"#fff",
    borderColor:"#000",
    borderRadius:15,
    height:380,
    padding:0,
    width:830
  },
  overlayClose:true,
  position: [Y,X],
  onOpen: function (dialog) {
    dialog.overlay.fadeIn('slow', function () {
      dialog.data.hide();
      dialog.container.fadeIn('slow', function () {
        dialog.data.slideDown('slow');
      });
    });
  },
  onClose: function (dialog) {
    dialog.data.fadeOut('slow', function () {
      dialog.container.hide('fast', function () {
        dialog.overlay.slideUp('fast', function () {
          $.modal.close();
        });
      });
    });
  }

});
$(window.parent.document).find('#simplemodal-overlay').css('width', '100%');
}
</script>
