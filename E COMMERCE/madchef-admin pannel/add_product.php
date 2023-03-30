<?php
session_start();
if ($_SESSION['user_name']==null) {
      header("Location: http://36.255.69.216/madchef-admin/index.php");
}
include_once 'sidebar.php';
include_once 'layouts/add_product_modal.php';
?>
<div id="layoutSidenav_content">
      <div class="container">
            <h1 class="mt-4">Add Product</h1>
            <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item"><a href="http://36.255.69.216/madchef-admin/home.php">Dashboard</a></li>
                  <li class="breadcrumb-item active">Add Product</li>
            </ol>
            <div class="card mb-4">
                  <div class="card-body">
                        <p class="h3  p-2 text-center">Add Product</p>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" style="float: right;margin-top: -48px;">+Product</button>    
                  </div>
            </div>
            <div class="card mb-4">
                  <div class="card-header">
                        <i class="fas fa-table me-1"></i>DataTable Example
                  </div>
                  <div class="card-body" id="data_load"><?php include_once 'product_data.php';?></div>
            </div>
      </div>
</div>
<?php 
include_once 'footer.php';
?>
<script type="text/javascript">
      $('.js-example-basic-single').select2();
      function fetch_products(val){
            $.ajax({
                  type: 'post',
                  url: 'fetch_product.php',
                  data: {
                        get_option:val
                  },
                  success: function (response) {
                        $('.test').trigger('change');
                        $('#adons_status').html(response);
                  }
            });
            fetch_adons(val);
      };


      function fetch_adons(category){
            var brand = $('#brand_name').val();
            var branch = $('#branch_name').val();
            $.ajax({
                  type: 'post',
                  url: 'fetch_product.php',
                  data: {
                        brand:brand,
                        branch:branch,
                        category:category
                  },
                  success: function (response) {
                        $('#adons_status').html(response);
                  }
            });
      }


      $('.js-example-basic-multiple').select2();
      function multi_products(val){
            alert(val);
            $.ajax({
                  type: 'post',
                  url: 'fetch_product.php',
                  data: {
                        all_product:val
                  },
                  success: function (response) {
                        $('.test').trigger('change');
                        alert(response);
                        $('#product_name').html(response);
                        add_product()
                  }
            });
      };


      function add_product(){
            var product_name = document.getElementById('product_name').value;
            var pro_details = document.getElementById('pro_details').value;
            var price = document.getElementById('price').value;
            var brand_name = document.getElementById('brand_name').value;
            var branch_name = document.getElementById('branch_name').value;
            if(product_name == ""){
                  document.getElementById('username').innerHTML =" ** Please fill the product field";
                  return false;
            }

            if(brand_name == ""){
                  document.getElementById('brandall').innerHTML =" ** Please fill the product field";
                  return false;
            }

            if(branch_name == ""){
                  document.getElementById('branchall').innerHTML =" ** Please fill the product field";
                  return false;
            }
            if(pro_details == ""){
                  document.getElementById('Details').innerHTML =" ** Please fill the details field";
                  return false;
            }
            if(price == ""){
                  document.getElementById('priceall').innerHTML =" ** Please fill the price field";
                  return false;
            }

            var brand_name= $('#brand_name').val();
            var branch_name= $('#branch_name').val();
            var category_name= $('#category_name').val();
            var sub_category_name= $('#sub_category_name').val();
            var pro_details= $('#pro_details').val();
            var product_name= $('#product_name').val();
            var size= $('#size').val();
            var price= $('#price').val();
            var vat= $('#vat').val();
            var sd= $('#sd').val();
            var type= $('#type').val();
            var discount= $('#discount').val();
            var status= $('#status').val();
            var adons_status= $('#adons_status').val();
            var form_data = new FormData();
            var file_data = $('#attachment').prop('files')[0];
            form_data.append('attachment', file_data);
            form_data.append('pro_brand_name', brand_name);
            form_data.append('pro_branch_name', branch_name);
            form_data.append('pro_category_name', category_name);
            form_data.append('pro_sub_category_name', sub_category_name);
            form_data.append('pro_details', pro_details);
            form_data.append('pro_product_name', product_name);
            form_data.append('pro_size', size);
            form_data.append('pro_price', price);
            form_data.append('pro_vat', vat);
            form_data.append('pro_sd', sd);
            form_data.append('pro_type', type);
            form_data.append('pro_discount', discount);
            form_data.append('pro_status', status);
            form_data.append('pro_adons_status', adons_status);
            $.ajax({
                  url: "fatch_data.php",
                  type: "POST",
                  data: form_data,
                  cache:false,
                  contentType: false,
                  processData: false,
                  success: function(response){
                        var data=response;
                        alert(response);
                        $('#formValu').trigger('reset');
                        $('.filename').text('No file selected');
                        location.reload();
                  }
            });
      }

      function fetch_branch(val){
            $.ajax({
                  type: 'post',
                  url: 'fetch_product.php',
                  data: {
                        branch:val
                  },
                  success: function (response) {
                        $('#branch_name').html(response);
                  }
            });
      }


      function del_product(id){
            var del_product=id;
            $.ajax({
                  url: "fatch_data.php",
                  type: "POST",
                  data: {
                        del_product:del_product
                  },
                  success: function(response){
                        alert(response);
                        location.reload();
                  }
            });
      }


      $(document).ready(function(){
            $('.quiz_deactivate').click(function (e) {
                  e.preventDefault();
                  let isConfirm = confirm('Are you sure to DEACTIVE this Product?');
                  if (isConfirm) {
                        let userId = $(this).attr('href');
                        $.ajax({
                              url: 'product_deactive.php',
                              type: 'POST',
                              data: {
                                    quiz_deactivate_id: userId
                              },
                              success: function (data) {
                                    $('#message').fadeIn('fast').html(data).addClass('message');
                                    setTimeout(function () {
                                          $('#message').fadeOut(4000);
                                          location.reload();
                                    }, 1000);
                              }
                        });
                  }
            });

            $('.quiz_activate').click(function (e) {
                  e.preventDefault();
                  let isConfirm = confirm('Are you sure to ACTIVE this Product?');
                  if (isConfirm) {
                        let userId = $(this).attr('href');
                        $.ajax({
                              url: 'product_active.php',
                              type: 'POST',
                              data: {
                                    quiz_activate_id: userId
                              },
                              success: function (data) {
                                    $('#message').fadeIn('fast').html(data).addClass('message');
                                    setTimeout(function () {
                                          $('#message').fadeOut(4000);
                                          location.reload();
                                    }, 1000);
                              }
                        });
                  }
            });
      })
</script>



