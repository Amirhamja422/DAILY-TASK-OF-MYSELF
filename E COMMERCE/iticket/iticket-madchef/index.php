<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iHelpBD</title>
    <!-- Scripts -->
    <script src="js-new/app.js"></script>
    <link type='text/css' href=' https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css' rel='stylesheet' media='screen' />
    <script type='text/javascript' src='https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js'></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Fonts -->
<!--     <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> -->
    <!-- Styles -->

    <link href="css-new/app.css" rel="stylesheet">
    <link href="css-new/font-awesome.min.css" rel="stylesheet">
</head>
<body style="background-image: url(ab.JPG); background-size: 100% 100%;">
  <div id="app">
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8" style="margin-top: 160px;">
                    <div class="card">
                        <div class="card-header">Login</div>

                        <div class="card-body">
                            <form method="POST" action="">

                                <div class="form-group row">
                                    <label for="uid" class="col-md-4 col-form-label text-md-right">User Name</label>
                                    <div class="col-md-6">
                                        <input id="uid" type="text" placeholder="Enter User Name" class="form-control" name="uid" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="pass" class="col-md-4 col-form-label text-md-right">Password</label>

                                    <div class="col-md-6">
                                        <input id="pass" type="password" placeholder="Enter Password" class="form-control" name="pass" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" name="logbtn" class="btn btn-primary">
                                            Login
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

</body>
</html>

<?php
if(isset($_POST['logbtn']))
{
    include 'db.php';

    // $RES=mysql_query("SELECT count(*),user_group_id,user_name,id,previlege FROM users where user_id='".$_POST['uid']."' && user_pass='".$_POST['pass']."'");
    // $GH=mysql_fetch_array($RES);
    // echo "<pre>";
    // print_r($GH[3]);
    // exit();
    if($GH[0]==1){

        if($GH[4]==2){
            session_start();
            $_SESSION['usr01937417227'] = $_POST['uid'];
            $_SESSION['pswd01937417227'] = $_POST['pass'];
            $_SESSION['usr01937417227'] = $_POST['uid'];
            $_SESSION['pswd01937417227'] = $_POST['pass'];
            $_SESSION['id'] = $GH[3];
            $_SESSION['previlege'] = $GH[4];
            $_SESSION['group_id'] = $GH[1];
            print "<meta http-equiv=\"refresh\" content=\"0; url=reports/?i=".$GH[3]."\" />";
        }
        if($GH[4]==3){
            session_start();
            $_SESSION['usr01937417227'] = $_POST['uid'];
            $_SESSION['pswd01937417227'] = $_POST['pass'];
            $_SESSION['usr01937417227'] = $_POST['uid'];
            $_SESSION['pswd01937417227'] = $_POST['pass'];
            $_SESSION['id'] = $GH[3];
            $_SESSION['previlege'] = $GH[4];
            $_SESSION['group_id'] = $GH[1];
            print "<meta http-equiv=\"refresh\" content=\"0; url=reportsupdate/?i=".$GH[3]."\" />";
        }
        if($GH[4]==1){
            session_start();
            $_SESSION['usr01937417227'] = $_POST['uid'];
            $_SESSION['pswd01937417227'] = $_POST['pass'];
            $_SESSION['usr01937417227'] = $_POST['uid'];
            $_SESSION['pswd01937417227'] = $_POST['pass'];
            $_SESSION['id'] = $GH[3];
            $_SESSION['previlege'] = $GH[4];
            $_SESSION['group_id'] = $GH[1];
            print "<meta http-equiv=\"refresh\" content=\"0; url=../icrm/\" />";
        }
        if($GH[4]==0){
            session_start();
            $_SESSION['usr01937417227'] = $_POST['uid'];
            $_SESSION['pswd01937417227'] = $_POST['pass'];
            $_SESSION['usr01937417227'] = $_POST['uid'];
            $_SESSION['pswd01937417227'] = $_POST['pass'];
            $_SESSION['id'] = $GH[3];
            $_SESSION['previlege'] = $GH[4];
            $_SESSION['group_id'] = $GH[1];
            print "<meta http-equiv=\"refresh\" content=\"0; url=admin/?i=".$GH[3]."\" />";
        }
        if($GH[4]==4){
            session_start();
            $_SESSION['usr01937417227'] = $_POST['uid'];
            $_SESSION['pswd01937417227'] = $_POST['pass'];
            $_SESSION['usr01937417227'] = $_POST['uid'];
            $_SESSION['pswd01937417227'] = $_POST['pass'];
            $_SESSION['id'] = $GH[3];
            $_SESSION['previlege'] = $GH[4];
            $_SESSION['group_id'] = $GH[1];
            print "<meta http-equiv=\"refresh\" content=\"0; url=admin/?i=".$GH[3]."\" />";
        }
        if($GH[4]==5){
            session_start();
            $_SESSION['usr01937417227'] = $_POST['uid'];
            $_SESSION['pswd01937417227'] = $_POST['pass'];
            $_SESSION['usr01937417227'] = $_POST['uid'];
            $_SESSION['pswd01937417227'] = $_POST['pass'];
            $_SESSION['id'] = $GH[3];
            $_SESSION['previlege'] = $GH[4];
            $_SESSION['group_id'] = $GH[1];
            print "<meta http-equiv=\"refresh\" content=\"0; url=admin/?i=".$GH[3]."\" />";
        }
    }
    else
    {
        print "<div align=\"center\"><label class=\"error\">Invalid User-id or Password</label></div>";
    }
}
?>
