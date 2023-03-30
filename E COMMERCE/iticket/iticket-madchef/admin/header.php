<?php
session_start();
include'session.php';
include '../db.php'; 
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iHelpBD</title>
    
    <script type='text/javascript' src='../js-new/app.js'></script>
    <?php if(($_SESSION['previlege'] == 4) || ($_SESSION['previlege'] == 5)) { ?>
        <script type='text/javascript' src='js/jquery.simplemodal.js'></script>
    <?php } ?>
    <script type='text/javascript' src='js/osx.js'></script>
    <!-- Styles -->
    <link href="../css-new/app.css" rel="stylesheet">
    <!-- <link href="../css-new/bootstrap.min.css" rel="stylesheet"> -->
    <link href="../css-new/font-awesome.min.css" rel="stylesheet">
    <link type='text/css' href='css/osx.css' rel='stylesheet' media='screen' />
</head>
<body>
    <div class="col-md-12">
      <?php
      if(isset($_SESSION['msg'])){
        ?>
        <div class="btn-success text-center">
          <?php
          echo $_SESSION['msg'];
          ?>
      </div>
      <?php
  }
  if(isset($_SESSION['err'])){
    ?>
    <div class="btn-danger text-center">
      <?php
      echo $_SESSION['err'];
      ?>
  </div>
  <?php
}
?>
</div>
<div class="modal fade" id="changepass" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
            <form class="form-horizontal" action="change_pass.php" method="POST" id="myform">
                <div class="col-md-12" style="float: left; padding: 10px;">
                    <div class="col-sm-2" style="float: left;">Old Password:</div>
                    <div class="col-sm-10" style="float: left;">
                        <input class="form-control" type="Password" name="oldpass" id="oldpass" required>
                    </div>
                </div>
                <div class="col-md-12" style="float: left; padding: 10px;">
                    <div class="col-sm-2" style="float: left;">New Password:</div>
                    <div class="col-sm-10" style="float: left;">
                        <input class="form-control" type="password" name="newpass" id="newpass" required>
                    </div>
                </div>
                <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left; visibility: hidden;">Button</div>
                    <div class="col-sm-8" style="float: left;">
                        <input type="submit" name="changepass" value="Change" class="btn btn-success">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>


<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                iHelpBD
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <?php
                    if($_SESSION['previlege'] == 0){
                        ?>
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="sub_type.php" style="cursor: pointer;">Complaint Type</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="type.php" style="cursor: pointer;">Service</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ug.php" style="cursor: pointer;">Department</a>
                        </li>
                        <!--   <li class="nav-item">
                            <a class="nav-link" href="nature.php" style="cursor: pointer;">Complaint Nature</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="status.php" style="cursor: pointer;">Status</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php" style="cursor: pointer;">User</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="template1.php" style="cursor: pointer;">Templates</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="update.php" style="cursor: pointer;">Update Ticket</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="report.php" style="cursor: pointer;">Report</a>
                        </li>
                    <?php } 

                    if($_SESSION['previlege'] == 4){ 

                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php" style="cursor: pointer;">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="update.php" style="cursor: pointer;">Update Ticket</a>
                        </li>
                    <?php } if($_SESSION['previlege'] == 2){ ?>

                        <li class="nav-item">
                            <a class="nav-link" href="../reports/index.php" style="cursor: pointer;">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../reports/report.php" style="cursor: pointer;">Report</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="update.php" style="cursor: pointer;">Update Ticket</a>
                        </li>

                    <?php } if($_SESSION['previlege'] == 5){ ?>

                        <li class="nav-item">
                            <a class="nav-link" href="index.php" style="cursor: pointer;">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="update.php" style="cursor: pointer;">Update Ticket</a>
                        </li>
                    <?php } ?>
                    <li class="nav-item dropdown" style="color: red;">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            <?php echo $_SESSION['usr01937417227']; ?>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" data-toggle="modal" data-target="#changepass">Change Password</a>
                            <a class="dropdown-item" onclick="location.href='out.php?i=<?php print $_GET['i'];?>'">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>