
<?php include 'header.php';?>
    <script type="text/javascript">

        function reportJAVA()
        {
        // id = id + " " +document.getElementById("ihour").value + ":" + document.getElementById("imin").value + ":" + document.getElementById("isec").value;
        // ed = ed + " " +document.getElementById("ehour").value + ":" + document.getElementById("emin").value + ":" + document.getElementById("esec").value;

        na = '<?php echo $_SESSION['usr01937417227']; ?>';


        if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
          }
        else
          {// code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
        xmlhttp.onreadystatechange=function()
          {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
            document.getElementById("scontent").innerHTML=xmlhttp.responseText;
            }
          }
        xmlhttp.open("GET","update/dash.php", true);
        xmlhttp.send();

        //showProducts("1");
        }

    </script>
    <style type="text/css">
        .my-card {
            position: absolute;
            left: 40%;
            top: -20px;
            border-radius: 50%;
        }
    </style>

    <?php
        include "../db.php";
        session_start();
        $total = mysql_fetch_assoc(mysql_query("SELECT count(*) AS 'total' FROM `ticket_dev`.`ticket` WHERE `assignd` = '".$_SESSION['id']."'"));
        $open = mysql_num_rows(mysql_query("SELECT * FROM `ticket_dev`.`ticket` WHERE `assignd` = '".$_SESSION['id']."' AND `status`!='Solved' AND `status`!='Closed'"));
        $solved = mysql_fetch_assoc(mysql_query("SELECT count(*) AS 'solved' FROM `ticket_dev`.`ticket` WHERE `assignd` = '".$_SESSION['id']."' AND (`status`='Solved' OR `status`='Closed')"));

    ?>
<script language="javascript" type="text/javascript" src="tcal.js"></script>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<link rel="stylesheet" type="text/css" href="dipu.css" />
<link rel="stylesheet" type="text/css" href="report.css" />


<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/osx.js'></script>
<link type='text/css' href='css/osx.css' rel='stylesheet' media='screen' />


<style type="text/css">
.chotoTime{
width:30px;
border-radius:1px;
}
.TitleStyle {
    color: #333333;
    font-weight: bold;
    font-size:24px;
}
.form-consex{
width:190px !important;
height:30px;
border-radius:3px;
}
.form-consex:focus{
box-shadow: 0px 0px 8px #04124D;
}
.firsttr{
background-color:#99CCFF;
color:#0000FF;
font-style:oblique;
text-align:center;
text-shadow: 4px 4px 2px rgba(150, 150, 150, 1);
}
.porertr{
background-color:#006600;
color:#FFFFFF;
text-align:center;
}
.chotoicon
{
cursor:pointer;
background:#00CC99;
border-radius:2px;
}
.chotoicon:hover{
background:#00FF66;
}
</style>
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="row w-100" style="margin-top: -13px;">
                                <div class="col-md-3">
                                    <div class="card border-info mx-sm-1 p-3">
                                        <div class="card border-info shadow text-info p-3 my-card" ><span class="fa fa-calculator" aria-hidden="true"></span></div>
                                        <div class="text-info text-center mt-3"><h4>Total Ticket</h4></div>
                                        <div class="text-info text-center mt-2"><h1><?php echo $total['total']; ?></h1></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card border-danger mx-sm-1 p-3">
                                        <div class="card border-danger shadow text-danger p-3 my-card" ><span class="fa fa-eye-slash" aria-hidden="true"></span></div>
                                        <div class="text-danger text-center mt-3"><h4>Open Ticket</h4></div>
                                        <div class="text-danger text-center mt-2"><h1><?php echo $open; ?></h1></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card border-success mx-sm-1 p-3">
                                        <div class="card border-success shadow text-success p-3 my-card"><span class="fa fa-eye" aria-hidden="true"></span></div>
                                        <div class="text-success text-center mt-3"><h4>Solved Ticket</h4></div>
                                        <div class="text-success text-center mt-2"><h1><?php echo $solved['solved']; ?></h1></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div align="center">
                            <div class="card">
                                <div class="card-header">Ticket</div>

                                <div class="card-body">
                                    <table class="table table-bordered" id="scontent" style="font-size: 12px;">
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script type="text/javascript">
        $( document ).ready(function() {
            reportJAVA();
        });
    </script>

<?php include 'footer.php';?>