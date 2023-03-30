
<?php
session_start();
include '../db.php';
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
        </div>
        <div class="card-body">
          <div class="card-body">
            <div class="col-md-12">
              <?php
              if(isset($_GET['success'])){
                ?>
                <div class="btn-success text-center">
                  <?php
                  echo $_GET['success'];
                  ?>
                </div>
                <?php
              }
              if(isset($_GET['failed'])){
                ?>
                <div class="btn-danger text-center">
                  <?php
                  echo $_GET['failed'];
                  ?>
                </div>
                <?php
              }
              ?>
            </div>
            <table class="table table-bordered" id="tcontent" style="font-size: 12px;">
              <thead class="text-center">
                <tr>
                  <th>SL</th>
                  <th>Title</th>
                  <th>Message</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $data=mysql_query("SELECT * FROM template ORDER BY id DESC;");
                while($row = mysql_fetch_array($data)){
                  ?>
                  <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['title'];?></td>
                    <td style="text-align: justify;"><?php echo $row['massage'];?></td>
                    <td>
                      <a href="update_template.php?updateid=<?php echo $row['id'];?>"><button class="btn"><i class="far fa-edit"></i></button></a>
                      <a href="template_action.php?id=<?php echo $row['id'];?>" onclick="return confirm('Are you sure you want to delete this item?');"><button class="btn"><i class="fas fa-trash"></i></button></a>
                    </td>
                  </tr>
                  <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</main>
<script src="../js/new.js"></script>
<?php include 'footer.php';?>