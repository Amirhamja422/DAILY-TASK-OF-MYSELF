
<?php include 'header.php';?>

<?php
include '../db.php';


$sql = mysql_query("SELECT * FROM `add_ons` WHERE `brand`='".$_SESSION['brand']."' AND `branch`='".$_SESSION['branch']."'");


?>
    
	<main class="py-4">
	    <div class="container">
	    	<!-- <div id="message"></div> -->
	        <div class="row justify-content-center">
	            <div class="col-md-12">

	  
	                <div align="center">
	                    <div class="card">
	                        <div class="card-header">Product List </div>

	                        <div class="card-body">

	                            <table class="table table-bordered"  style="font-size: 12px;">

	                                <thead>
	                                   <tr>
	                                      <th scope="col">SL</th>
	                                      <th scope="col">Product Name</th>
	                                      <th scope="col">Product Price</th>
	                                      <th scope="col">VAT(BDT) % </th>
	                                      <th scope="col">SD % </th>
	                                      <th scope="col">Product Size</th>
	                                      <th scope="col">Brand</th>
	                                      <th scope="col">Branch</th>
	                                      <th scope="col">Status</th>
	                                       <th scope="col">Action</th>
	                                  </tr>

	                              </thead>

	                              <tbody>

	                              	<?php 
	                              	 $i = 1;
	                              	while($product=mysql_fetch_assoc($sql)){ ?>

	                              		<tr>
	                              		<th scope="row"><?php echo $i++; ?></th>
	                              		<td><?php echo $product['product_name']; ?></td>
	                              		<td>BDT <?php echo $product['product_price']; ?></td>
	                              	    <td> <?php echo $product['vat']; ?></td>
	                              		<td> <?php echo $product['sd']; ?></td>
	                              		<td><?php echo $product['product_size']; ?></td>
	                              		<td><?php echo $product['brand']; ?></td>
	                              		<td><?php echo $product['branch']; ?></td>
	                              		<td>
                                        	<?php 
                                             if($product['status']==1){
                                             	echo "Active";
                                             }
                                             else{
                                             	echo "Deactive";
                                             }
                                            
                                        	?>

                                        </td>
	                              		

	                              		


	                              		<td class="center">
	                              			<?php
	                              			if($product['status']==1){
	                              				?>
	                              				<a title="Deactive Quiz" class=" quiz_deactivate" href="<?php echo $product['id']; ?>">
	                              					<center><button type="button" style="width: 150px;"  class="btn btn-success">Activate</button></center></a>
	                              					<?php
	                              				}
	                              				else{
	                              					?>
	                              					<a title="Active Quiz" class=" quiz_activate" href="<?php echo $product['id']; ?>">
	                              					 <center><button type="button"  style="width: 150px;" class="btn btn-danger">Deactivate</button></center></a>
	                              					<?php } ?>

	                              				</td>
	                              	</tr>

	                              	
	                              	<?php } ?>
	                              	

	                              	



	                              </tbody>
	                          </table>
	                      </div>
	                  </div>
	              </div>
	          </div>
	      </div>
	  </div>
	</main>
	    

<script>

	$(document).ready(function(){
          
          $('.quiz_deactivate').click(function (e) {
              e.preventDefault();
              let isConfirm = confirm('Are you sure to DEACTIVE this Product?');
              if (isConfirm) {

                  let userId = $(this).attr('href');

                  // Ajax request

                  $.ajax({
                      'url': 'action1.php',
                      'method': 'POST',
                      'data': {'quiz_deactivate_id': userId},
                      'success': function (data) {
                          $('#message').fadeIn('fast').html(data).addClass('message');
                          setTimeout(function () {
                              $('#message').fadeOut(4000);
                              location.reload();
                          }, 1000);
                      }
                  }); // ajax end
              }
          });

          /* Deactive user end */



          /* Active user */

          $('.quiz_activate').click(function (e) {
              e.preventDefault();
              let isConfirm = confirm('Are you sure to ACTIVE this Product?');
              if (isConfirm) {

                  let userId = $(this).attr('href');

                  // Ajax request

                  $.ajax({
                      'url': 'action1.php',
                      'method': 'POST',
                      'data': {'quiz_activate_id': userId},
                      'success': function (data) {
                          $('#message').fadeIn('fast').html(data).addClass('message');
                          setTimeout(function () {
                              $('#message').fadeOut(4000);
                              location.reload();
                          }, 1000);
                      }
                  }); // ajax end
              }
          });

	})

               

</script>


<?php include 'footer.php';?>