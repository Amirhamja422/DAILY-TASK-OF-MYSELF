
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<?php
include_once 'database.php';
if (isset($_POST['post_id'])) {







  $id_update = $_POST['post_id'];
  $brand_update = $_POST['post_brand'];
  $branch_update = $_POST['post_branch'];
  $deatails_update = $_POST['post_deatails'];
  $category_update = $_POST['post_category'];


  $sub_category_update = implode(',',$_POST['post_sub_category']);
  $adons_status = implode(',',$_POST['adons_status']);


  $name_update = $_POST['post_name'];
  $price_update = $_POST['post_price'];
  $vat_update = $_POST['post_vat'];
  $sd_update = $_POST['post_sd'];
  $dicount_update = $_POST['post_dicount'];
  


  $sql = "UPDATE `product` SET `brand`='$brand_update',`branch`='$branch_update',`deatails`='$deatails_update',`category`='$category_update',`subcategory`='$sub_category_update',`name`='$name_update',`price`='$price_update',`vat`='$vat_update',`sd`='$sd_update',`dicount`='$dicount_update',`adons_status`='$adons_status' WHERE `id`='$id_update'";

  echo $sql;

  $result = mysqli_query($con,$sql);
  if($sql){
    echo 'data sucessfully updated';
  }
  else{
    echo 'failed to update Record';

  }
}

$id=$_POST['id'];
$sql = "SELECT * FROM  product WHERE `id`='$id'";
$result = mysqli_query($con,$sql);
$assoc=mysqli_fetch_assoc($result);

if (isset($_POST['id'])) {

  ?>
  <div class="form-group">
    <div class="col-sm-9">
      <input type="hidden" class="form-control" name="id" id="id_update" type="text" value="<?php echo $assoc['id']; ?>" placeholder="Enter Youser Name" required="required" readonly>
    </div>
  </div>
  <br><br>

  <div class="form-group">
    <label for="input" class="col-sm-3 control-label">Brand</label>
    <div class="col-sm-9">
      <select name="brand_update" class="form-control input" required  id="brand_update" onchange="fetch_branch(this.value);">
        <option>Select A Brand Name</option>
        <?php
        $query = "SELECT * FROM  brand";
        $result = mysqli_query($con,$query);
        while($row = mysqli_fetch_assoc($result)){?>
          <option value="<?php echo $row['brand']; ?>" <?php if($assoc['brand'] == $row['brand']){ echo "selected";}?>><?php echo $row['brand']; ?></option>
          <?php
        }?>
      </select>
    </div>
  </div>
  <br><br>

  <div class="form-group">
    <label for="input" class="col-sm-3 control-label">Branch</label>
    <div class="col-sm-9" id="branch">
      <select name="branch_update" class="form-control input" required  id="branch_update">
        <option>Select A Brand Name</option>
        <?php
        $query = "SELECT * FROM  branch WHERE brand = '".$assoc['brand']."'";
        $result = mysqli_query($con,$query);
        while($row = mysqli_fetch_assoc($result)){?>
          <option value="<?php echo $row['branch']; ?>" <?php if($assoc['branch'] == $row['branch']){ echo "selected";}?>><?php echo $row['branch']; ?></option>
          <?php
        }?>
      </select>
    </div>
  </div>
  <br><br> 

  <div class="form-group">
    <label for="input" class="col-sm-3 control-label">Details</label>
    <div class="col-sm-9">
      <input type="text" class="form-control"name="deatails_update" id="deatails_update" type="text" value="<?php echo $assoc['deatails']; ?>" placeholder="Enter Youser Name" required="required">
    </div>
  </div>
  <br><br>
  
  <div class="form-group">
    <label for="input" class="col-sm-3 control-label">Name</label>
    <div class="col-sm-9">
      <input type="text" class="form-control"name="name_update" id="name_update" type="text" value="<?php echo $assoc['name']; ?>" placeholder="Enter Youser Name" required="required">
    </div>
  </div>
  <br><br>
  <div class="form-group">
    <label for="input" class="col-sm-3 control-label">Category</label>
    <div class="col-sm-9">
      <select  selected="<?php echo $assoc['category']; ?>" class="form-control input js-example-basic-single" style="width:323px;" id="category_update"  onchange="fetch_adons(this.value);">
        <?php 
        $category = mysqli_query($con,"SELECT * FROM `restaurant`.`category` ORDER BY `category` ASC");              
        while ($status_row = mysqli_fetch_assoc($category)) {?>
          <option value="<?php echo $status_row['category'];?>" <?php if($assoc['category'] == $status_row['category']){ echo "selected";}?>><?php echo $status_row['category'];?></option>
          <?php
        }?>
      </select>
    </div>
  </div>
  <br><br>
  <div class="form-group">
    <label for="input" class="col-sm-3 control-label">Subcategory</label>
    <div class="col-sm-9">
      <select name="sub_category_update[]" class="chosen-select" style="width:323px;" id="sub_category_update" multiple="multiple">
        <?php
        $sub_category_array = explode(',', $assoc['subcategory']);
        $category = mysqli_query($con,"SELECT * FROM `restaurant`.`subcategory`  ORDER BY `subcategory` ASC");
        while($row = mysqli_fetch_assoc($category)){?>
          <option
          <?php if (in_array($row['subcategory'], $sub_category_array)) { echo "selected";}?> value="<?php echo $row['subcategory'];?>"><?php echo $row['subcategory'];?></option>
          <?php
        }?>
      </select>
    </div>
  </div>
  <br><br>
  <div class="form-group">
    <label for="input" class="col-sm-3 control-label">Price</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="price_update" id="price_update" type="text" value="<?php echo $assoc['price']; ?>" placeholder="Enter Youser Name" required="required">
    </div>
  </div>
  <br><br> 
  <div class="form-group">
    <label for="input" class="col-sm-3 control-label">Vat</label>
    <div class="col-sm-9">
      <input type="text" class="form-control"name="vat_update" id="vat_update" type="text" value="<?php echo $assoc['vat']; ?>" placeholder="Enter Youser Name" required="required">
    </div>
  </div>
  <br><br>  
  <div class="form-group">
    <label for="input" class="col-sm-3 control-label">Sd</label>
    <div class="col-sm-9">
      <input type="text" class="form-control"name="sd_update" id="sd_update" type="text" value="<?php echo $assoc['sd']; ?>" placeholder="Enter Youser Name" required="required">
    </div>
  </div>
  <br><br> 
  <div class="form-group">
    <label for="input" class="col-sm-3 control-label">Dsicount</label>
    <div class="col-sm-9">
      <input type="text" class="form-control"name="dicount_update" id="dicount_update" type="text" value="<?php echo $assoc['dicount']; ?>" placeholder="Enter Youser Name" required="required">
    </div>
  </div>
  <br><br>
  <div class="form-group">
    <label for="input" class="col-sm-3 control-label">Adons Product</label>
    <div class="col-sm-9" id="adons_list">      
      <?php        

      if($assoc['adons_status'] != null ){
        $adons_id = explode(',', $assoc['adons_status']);
        ?>
        <select name="adons_id[]" class="js-example-basic-multiple"   id="adons_id" style="width: 320px;" multiple="multiple">
          <?php
          foreach ($adons_id as $key => $id) {
            $adons_data = mysqli_fetch_assoc(mysqli_query($con,"SELECT `id`, `name` FROM `adons_product` WHERE `id`='$id'"));
            ?>
            <option value="<?php echo $adons_data['id'];?>" selected ><?php echo $adons_data['name']?></option>
            <?php
          }
          ?> 
        </select>
        <?php
      }else{
        ?>
        <select name="adons_id[]" class="js-example-basic-multiple"   id="adons_id" style="width: 320px;" multiple="multiple">
          <option>No add ons product selected </option>
        </select>
        <?php
      }
      ?>
    </div>
  </div>

  <?php
}

?>


<script type="text/javascript">
  $('.js-example-basic-single').select2();
  $(".chosen-select").chosen()
  function fetch_branch(val){
    $.ajax({
      type: 'post',
      url: 'pages/product/product_action.php',
      data: {
        branch:val,
        fetch_branch:'fetch_branch'
      },
      success: function (response) {        
        $('#branch').html(response);
      }
    });
  }

  function fetch_adons(category){
    var brand = $('#brand_update').val();
    var branch = $('#branch_update').val();
    $.ajax({
      type: 'post',
      url: 'pages/product/product_action.php',
      data: {
        brand:brand,
        branch:branch,
        category:category,
        fetch_adons:'fetch_adons'
      },
      success: function (response) {
        $('#adons_list').html(response);
        $(".chosen-select").trigger("chosen:updated");
      }
    });
  }

</script>