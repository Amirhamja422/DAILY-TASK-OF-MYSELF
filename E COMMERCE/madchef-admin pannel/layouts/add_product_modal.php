<div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
           <div class="modal-content" style="width: 741px;">
                <div class="modal-header bg-info">
                     <button type="button" class="close" data-dismiss="modal" style="margin-right: 369px;">×</button>           
                     <h4 class="modal-title">Product</h4>
               </div>
               <div class="card mb-4">
                  <div class="card-body">
                          <p class="h3  p-2 text-center">Add Product</p>
                          <form id="formValu">
                              <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Brand</label>
                                    <div class="col-sm-10">
                                          <select name="brand_name" class="form-control input" required  id="brand_name" onchange="fetch_branch(this.value);">
                                                <option>Select A Brand Name</option>
                                                <?php
                                                include_once 'database.php';
                                                $query = "SELECT * FROM  brand";
                                                $result = mysqli_query($con,$query);
                                                while($row = mysqli_fetch_assoc($result)){?>
                                                      <option value="<?php echo $row['brand']; ?>"><?php echo $row['brand']; ?></option>
                                                      <?php
                                                }?>
                                          </select>
                                          <span id="brandall" class="text-danger font-weight-bold"> </span>
                                    </div>
                              </div>
                              <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Branch</label>
                                    <div class="col-sm-10">
                                          <select name="branch_name" class="form-control input" required  id="branch_name"></select>
                                          <span id="branchall" class="text-danger font-weight-bold"> </span>
                                    </div>
                              </div>
                              <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                          <select name="category_name" class="form-control input js-example-basic-single" style="width:589px;" id="category_name" onchange="fetch_products(this.value);">
                                                <option>Select A Category</option>
                                                <?php
                                                include_once 'database.php';
                                                $query = "SELECT * FROM  category";
                                                $result = mysqli_query($con,$query);
                                                while($row = mysqli_fetch_assoc($result)){?>
                                                      <option value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option>
                                                      <?php
                                                }?>
                                          </select>
                                    </div>
                              </div>
                              <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Subcategory</label>
                                    <div class="col-sm-10">
                                          <select name="sub_category_name[]" class="form-control input js-example-basic-multiple" style="width:589px;" id="sub_category_name" multiple="multiple">
                                                <option>Select Sub-Category</option>
                                                <?php
                                                include_once 'database.php';
                                                $query = "SELECT * FROM  subcategory";
                                                $result = mysqli_query($con,$query);
                                                while($row = mysqli_fetch_assoc($result)){?>
                                                      <option value="<?php echo $row['subcategory']; ?>"><?php echo $row['subcategory']; ?></option>
                                                      <?php
                                                }?>
                                          </select>
                                    </div>
                              </div>
                              <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Product Name</label>
                                    <div class="col-sm-10">
                                          <input type="text" class="form-control" id="product_name" placeholder="Enter Your Product name" autocomplete="off">
                                          <span id="username" class="text-danger font-weight-bold"> </span>
                                    </div>
                              </div>
                              <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Details</label>
                                    <div class="col-sm-10">
                                          <textarea class="form-control rounded-0" id="pro_details" rows="8" autocomplete="off"></textarea>
                                          <span id="Details" class="text-danger font-weight-bold"></span>
                                    </div>
                              </div>
                              <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Product Image</label>
                                    <div class="col-sm-10">
                                          <input type="file" id="attachment" name="attachment" placeholder="Enter Your Product image">
                                    </div>
                              </div>
                              <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Size</label>
                                    <div class="col-sm-10">
                                          <input type="text" class="form-control" id="size" placeholder="Enter Your Size" autocomplete="off">
                                          <span id="pass" class="text-danger font-weight-bold"> </span>
                                    </div>
                              </div>
                              <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-10">
                                          <input type="text" class="form-control" id="price" placeholder="Enter Your Price">
                                          <span id="priceall" class="text-danger font-weight-bold"> </span>
                                    </div>
                              </div>
                              <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">VAT</label>
                                    <div class="col-sm-10">
                                          <input type="text" class="form-control" id="vat" placeholder="Enter Your VAT">
                                          <span id="vatall" class="text-danger font-weight-bold"> </span>
                                    </div>
                              </div>
                              <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">SD</label>
                                    <div class="col-sm-10">
                                          <input type="text" class="form-control" id="sd" placeholder="Enter Your SD">
                                          <span id="sdall" class="text-danger font-weight-bold"></span>
                                    </div>
                              </div>
                              <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Type</label>
                                    <div class="col-sm-10">
                                          <select name="category_name" class="form-control input" required  id="type" >
                                                <option>Select A Product Type</option>
                                                <?php
                                                include_once 'database.php';
                                                $query = "SELECT * FROM  product_type";
                                                $result = mysqli_query($con,$query);
                                                while($row = mysqli_fetch_assoc($result)){?>
                                                      <option value="<?php echo $row['type']; ?>"><?php echo $row['type']; ?></option>
                                                      <?php
                                                }?>
                                          </select>
                                    </div>
                              </div>
                              <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Discount</label>
                                    <div class="col-sm-10">
                                          <input type="text" class="form-control" id="discount" placeholder="Enter Your Discount">
                                          <span id="discountall" class="text-danger font-weight-bold"> </span>
                                    </div>
                              </div>
                              <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Adons Product</label>
                                    <div class="col-sm-10">
                                          <select name="states[]" class="js-example-basic-multiple"   id="adons_status" style="width: 588px;" multiple="multiple"></select>
                                    </div>
                              </div>
                              <div class="category" style="text-align:center;">
                                    <input class="form-control btn btn-success" type="sumbit" style="width:122px;" value="Add Product" name="submit" id="submit" onclick="add_product()" autocomplete="off">
                              </div>
                        </form>
                  </div>
            </div>
      </div>
</div>
</div>