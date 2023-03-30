<?php
include'session.php';
include'../db.php';
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>iHelpBD</title>

    <script type='text/javascript' src='../js-new/jquery.js'></script>
    <!-- <script type='text/javascript' src='js/jquery.simplemodal.js'></script> -->
    <script type='text/javascript' src='../js-new/app.js'></script>
    <script type='text/javascript' src='js/osx.js'></script>
    <link type='text/css' href='css/osx.css' rel='stylesheet' media='screen' />

    <link type='text/css' href=' https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css' rel='stylesheet' media='screen' />
    <script type='text/javascript' src='https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js'></script>


    <!--
    <link href="datatables/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="datatables/1.4.1/css/colReorder.dataTables.min.css" rel="stylesheet">
    <link href="datatables/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet"> -->


    <!-- Styles -->
    <link href="../css-new/app.css" rel="stylesheet">
    <link href="../css-new/font-awesome.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/418e01176d.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="col-md-12">
      <?php
      if(isset($_SESSION['msg'])){?>
        <div class="btn-success text-center">
            <?php echo $_SESSION['msg'];?>
        </div>
        <?php
    }
    if(isset($_SESSION['err'])){?>
        <div class="btn-danger text-center">
            <?php echo $_SESSION['err'];?>
        </div>
        <?php
    }
    ?>
    <style type="text/css">
    #new_ticket{
        background: red;
        color: #FFFFFF;
        border-radius: 25px;
        text-align: center;
        width: 22px;
        height: 21px;
        margin-top: -4px;
        margin-left: -9px;
        font-size: 12px;
    }
</style>
</div>
<?php
include '../ticket_notification/modal.php';
include '../ticket_notification/audio.php';
?>
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
            <a href="index.php" class="navbar-brand">
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
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php" style="cursor: pointer;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="update.php" style="cursor: pointer;">Update Order</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="product_list.php" style="cursor: pointer;">Product List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addons_product_list.php" style="cursor: pointer;">Addons Product List</a>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link" onclick="new_ticket()" style="cursor: pointer;"><i class="fas fa-bell"></i></div>
                    </li>
                    <span id="new_ticket"></span>
                    <li class="nav-item" id="sound_control">
                        <?php
                        if ($_SESSION['notification_status'] == 0) {
                            ?>
                            <div class="nav-link" onclick="audio_control('play')" style="cursor: pointer;"><i class="fas fa-volume-mute"></i></div>
                            <?php
                        }else{
                            ?>
                            <div class="nav-link" onclick="audio_control('pause')" style="cursor: pointer;"><i class="fas fa-volume-up"></i></div>
                            <?php
                        }
                        ?>
                    </li>


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
