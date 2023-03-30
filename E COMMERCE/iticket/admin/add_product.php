<?php include'session.php'; ?>

<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/osx.js'></script>
<link type='text/css' href='css/osx.css' rel='stylesheet' media='screen' />

<script type="text/javascript">

  function modal_open(){
    var modal = document.getElementById('myModal');
    modal.setAttribute("style", "z-index: 10;background: #FFFFFF;width: 400px;height: 100px;margin-left: 422px;position: relative;border-radius: 10px;visibility: visible;overflow: hidden; Display:block");
  }
  function modal_close(){
    var modal = document.getElementById('myModal');
    modal.setAttribute("style","z-index: 10;background: #FFFFFF;width: 400px;height: 100px;margin-left: 422px;position: relative;border-radius: 10px;visibility: hidden;height: 0px;overflow: hidden;")
  }
</script>

<style type="text/css">
  .modal{
    z-index: 10;
    background: #FFFFFF;
    width: 400px;
    height: 100px;
    margin-left: 422px;
    position: relative;
    border-radius: 10px;
    visibility: hidden;
    height: 0px;
    overflow: hidden;
  }
  .modal-content{
    position: absolute;
    margin: 5px;
    padding: 10px;
    width: 92%;
  }
  .close{
    float: right;
    color: red;
  }
</style>

<div id="myModal" class="modal">
  <div class="modal-content">
    <div class="col-md-12">
      <span class="close" onclick="modal_close()"><button>&times;</button></span>
    </div>
    <table>
      <tr><td><input type="file" name="file" id="file"></td></tr>
      <tr><td><button type="submit" class="btn btn-success" name="uploads" id="upload" style="background: green;">uploads</button></td></tr>
    </table>
  </div>
</div>

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

<div align="center" class="TitleStyle">Manage Product &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><br>


<form action="add_product.php" method="post" enctype="multipart/form-data">

  <table align="center" style="color:#000000; ">
   <tr>

    <td align="right">Brand :</td>
    <td>
      <select name="brand" type="text" id="brand" required="required" onchange="fetch_brand(this.value);" style="width: 200px;">
        <option value="">-Select Brand-</option>
        <?php
        include '../db.php';
        $result1 = mysql_query("select *FROM ticket_type ");
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
    <td align="right"> Name :</td><td><input style="width: 200px;" name="name" type="text" id="type" placeholder="Product Name" /></td>
  </tr>
  <tr>
    <td align="right">Image :</td><td><input style="width: 200px;" name="attachment" type="file" id="type"  /></td>
  </tr>
  <tr>
    <td align="right">Price :</td><td><input style="width: 200px;" name="price" type="text" id="type"  placeholder="Price" /></td>
  </tr>

  <tr>
    <td align="right">Sd % :</td><td><input style="width: 200px;" name="sd" type="text" id="type"  placeholder="SD" /></td>
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000;"> Enter only digit</td>
  </tr>

  <tr>
    <td align="right">Size :</td><td><input style="width: 200px;" name="size" type="text" id="type" placeholder="Size" /></td>
  </tr>
  <tr>
    <td align="right">Type :</td><td>
      <select name="product_type" type="text" id="product_type" style="width: 200px;">
        <option value="">-Select type-</option>
        <option value="half&half">Half & Half</option>
      </select>
    </td>
  </tr>


  <tr>
    <td align="right"></td>
    <td><input type="submit" name="addtype" id="addtype" value="Add" style="border-radius:5px;" /></td>
  </tr>
</table>
</form>
<table style="margin-left:542px">
  <tr>
    <td></td>
    <!-- <td>
      <button onclick="modal_open()">Upload CSV </button>
      <a href="uploads/Sample_Data_For_customer.csv" download="download"><button>Sample CSV </button></a>
    </td> -->
  </tr>
</table>







<?php
session_start();
$now_user = rand(0, 1000);

if(isset($_POST['addtype']))
{
  include '../db.php';
  if (!empty($_FILES['attachment']['name'])) {
    $attachment  = $_FILES['attachment'];
    $attach_name = $_FILES['attachment']['name'];
    $attach_tmp  = $_FILES['attachment']['tmp_name'];
    $attach_type = $_FILES['attachment']['type'];
    $temp = explode(".", $attach_name);
    $new_name = $now_user.'_'.round(microtime(true)) . '.' . end($temp);
    move_uploaded_file($attach_tmp, "admin/product_images/$new_name");
  }

  $chksql = "SELECT * FROM `product` WHERE `product_name` ='".$_POST['name']."' AND `branch`='".$_POST['branch']."' AND `brand`='".$_POST['brand']."' AND `product_size`='".$_POST['size']."'";
  // echo $chksql;
  $product_count = mysql_num_rows(mysql_query($chksql));
  if ($product_count > 0) {
    echo "<center><font face=\"Times New Roman, Times, serif\" color=\"red\">Product Already Added.</font></center>";
  }else{
    $sd = $_POST['sd'];
    $results=mysql_query("INSERT INTO product (`product_name`, `product_price`, `product_size`, `brand`, `branch`,`type`,`sd`, `product_image`) VALUES ('".$_POST['name']."', '".$_POST['price']."', '".$_POST['size']."','".$_POST['brand']."','".$_POST['branch']."','".$_POST['product_type']."','".$sd."','".$new_name."')");
    print "<center><font face=\"Times New Roman, Times, serif\" color=\"#0000CD\">Product Added Successfully.</font></center>";
  }
}
?>
<br>



<div align="center">
  <br><br>
  <table style="border-radius:20px; border:1px; border:solid; width:75%; cursor:pointer; color:#999999;" align="center" class="anlepore">

    <div class="box-header" data-original-title>
      <h2><i class="halflings-icon white time"></i><span class="break"></span>Customer Data Search Result</h2>
    </div>
    <tr style="background-color:#0099CC; color:#FFFFFF;">
      <td align="center">No.</td><td align="center">Name</td><td align="center">Price(BDT)</td><td align="center">VAT</td><td align="center">SD</td><td align="center">Size</td><td align="center">Type</td><td align="center">Branch</td><td align="center">Brand</td><td title="Delete" align="center"><img src="idebnath/delete.png" style="cursor:pointer;"></td><td title="Edit" align="center" style="border-top-right-radius:10px;"><img width="20" height="20" src="idebnath/100px-Gartoon-Gedit-icon.png" style="cursor:pointer;"></td>
    </tr>
    <?php include 'product_list.php'; ?>
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
var src = "edit_product.php?q1="+kuti;
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



$('#upload').on('click', function() {
  alert('ok');
  var file_data = $('#file').prop('files')[0];
  var form_data = new FormData();
  form_data.append('file', file_data);
  $.ajax({
          url: '../admin/uploads/upload.php', // point to server-side PHP script
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function(response){
            document.getElementById('display_status').innerHTML = response;
            document.getElementById("file").reset();
            var modal = document.getElementById('myModal');
            modal.setAttribute("style","z-index: 10;background: #FFFFFF;width: 400px;height: 100px;margin-left: 422px;position: relative;border-radius: 10px;visibility: hidden;height: 0px;overflow: hidden;")
          }
        });
});
</script>
