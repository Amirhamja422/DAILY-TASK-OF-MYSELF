<?php
session_start();
include '../db.php';
if (isset($_GET['updateid'])) {
  $data=mysql_query("SELECT * FROM template WHERE id = '".$_GET['updateid']."'");
}
if (isset($_POST['update_template'])) {
  $title = $_POST['title'];
  $massage = $_POST['editor1'];

  if (mysql_query("UPDATE `template` SET `title`='".$title."',`massage`='".$massage."' WHERE id = '".$_GET['updateid']."'")) {
    $success="Record Updated Successfully..";
    echo "<script>window.location.replace('http://116.193.217.4:8089/iticket-bank/admin/template1.php?success=$success')</script>";

  }else{
    $failed="record Can not Update....try Again later...";
    echo "<script>window.location.replace('http://116.193.217.4:8089/iticket-bank/admin/template1.php?failed=$failed')</script>";
  }
}
include 'header.php';?>
<script src="../ck/ckeditor.js"></script>
<main class="py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="col-md-2 text-center" style="float: right;">
              <button class="btn btn-success text-white" onclick="location.href='template1.php'">Template <span class="badge"><?php
              include 'db.php';
              mysql_query("SET CHARACTER SET utf8");
              mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
              $results9=mysql_query("SELECT count(*) FROM template ");
              $count = mysql_fetch_array($results9);
              echo $count[0];
              ?></span>
            </button>
          </div>
            <div class="col-md-2 text-center" style="float: right;">
              <button class="btn btn-warning" id="crt_btn" onclick="location.href='create_template.php'"><i class="fas fa-plus-square"></i> Create Template</button>
            </div>
            <!-- <div class="col-md-2 text-center" style="float: right;">
              <button class="btn btn-info" id="src_btn" onclick="location.href='search_ticket.php'"><i class="fas fa-eye"></i> Search Template</button>
            </div>
             -->
          </div>
          <div class="card-body">
            <div id="create">
              <div class="col-md-12">
                <?php
                if($success != NULL){?>
                  <div class=" text-success text-center" style=" font-size: 30px;">
                    <?php 
                      echo $success;
                      unset($success);
                      echo "<script>
                              setTimeout(function () {
                                  window.location.replace('". $_SERVER['REQUEST_URI']."')
                              }, 3000);
                          </script>";
                    ?>
                  </div>
                  <?php
                }
                if($failed != NULL){?>
                  <div class=" text-danger text-center" style=" font-size: 30px;">
                    <?php 
                      echo $failed;
                      unset($failed);
                      echo "<script>
                              setTimeout(function () {
                                  window.location.replace('". $_SERVER['REQUEST_URI']."')
                              }, 3000);
                          </script>";
                    ?>
                  </div>
                  <?php
                }

                ?>
                <form class="form-horizontal" action="#" method="POST" id="myform">
                  <?php
                  while ($row = mysql_fetch_assoc($data)) {
                  ?>
                  <div class="col-md-12" style="float: left; padding: 10px;">
                    <div class="col-sm-2" style="float: left;">Update Template Title:</div>
                    <div class="col-sm-10" style="float: left;">
                      <input class="form-control" type="text" name="title" id="title" value="<?php echo $row['title'];?>" required>
                    </div>
                  </div>
                  <div class="col-md-12" style="float: left; padding: 10px;">
                    <div class="col-sm-2" style="float: left;">Tamplates:</div>
                    <div class="col-sm-10" style="float: left;">
                      <textarea class="form-control" id="editor1" name="editor1" style="color: black; " rows="4" required><?php echo $row['massage'];?></textarea>
                      <script>
                        CKEDITOR.replace('editor1');
                        CKEDITOR.config.height = 90;
                      </script>
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left; visibility: hidden;">Button</div>
                    <div class="col-sm-8" style="float: left;">
                      <input type="submit" name="update_template" value="Update" class="btn btn-success">
                    </div>
                  </div>
                  <?php
                    }

                  ?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script src="../js/new.js"></script>
<?php include 'footer.php';?>