
<?php include 'header.php';?>
<script type="text/javascript">
    function reportJAVAC(id,ed,dd,kw,rrt,con)
    {
        // alert(con);

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
    xmlhttp.open("GET","../admin/reportsOnly/generation.php?q1="+id+"&q2="+ed+"&q3="+dd+"&q4="+kw+"&q5="+rrt+"&ska="+con,true);
    xmlhttp.send();
    }

</script>

        <?php
            $pad_user = $_GET['i'];
            include '../db.php';

            $results3=mysql_query("SELECT user_name, concern, user_group_id,concern FROM users WHERE id=".$pad_user);
            $row222 = mysql_fetch_array($results3);
        ?>
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">

                        <form method="GET">
                            <div class="row">
                                <div class="col-md-10 form-row">
                                    <div class="form-group col-md-3">
                                        <label for="src_type" class="col-form-label text-md-right">Search Type</label>
                                        <select class="form-control" id="sby" name="sby">
                                            <option value="cus_contact">Contact</option>
                                            <option value="cus_ac">Account Number</option>  
                                            <option value="cus_amount">Card Number</option>  
                                            <option value="id">Ticket ID</option>
                                            <option value="assignd">Agent</option>
                                            <option value="cus_name">Customer Name</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="src_keyword" class="col-form-label text-md-right">Search Keyword</label>
                                        <input type="text" id="skeyword" name="skeyword" class="form-control" placeholder="Enter Search Keyword">

                                        <?php

                                        $sql = mysql_query("SELECT * FROM `users` WHERE `user_group_id`='".$row222[2]."' AND `previlege`='3'");

                                        ?>
                                        <select class="form-control" id="skeyword_assignd" name="skeyword_assignd">
                                            <?php while ($assignd = mysql_fetch_assoc($sql)) { ?>
                                                <option value="<?php echo $assignd['id']; ?>"><?php echo $assignd['user_id']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="start_date" class="col-form-label text-md-right">Start Date</label>
                                        <input type="date" id="idate" name="start_date" required class="form-control" value="<?php echo date("Y-m-d"); ?>">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="end_date" class="col-form-label text-md-right">End Date</label>
                                        <input type="date" id="edate" name="end_date" required class="form-control" value="<?php echo date("Y-m-d"); ?>">
                                    </div> 
                                </div>
                                
                                <div class="col-md-2">
                                    <div class="form-group col-md-3">
                                        <div class="btn-group" role="group" aria-label="Basic example" style="margin-left: -39px;">
                                            <button type="button" onclick="reportJAVAC(document.getElementById('idate').value,document.getElementById('edate').value,document.getElementById('sby').value,document.getElementById('skeyword').value, '<?php print $row222[2]; ?>',document.getElementById('skeyword_assignd').value)" class="btn btn-primary" style="margin-top: 36px;"><i class="fa fa-search" aria-hidden="true">&nbsp;Search</i></button>&nbsp;&nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>


                        <div align="center">
                            <div class="card">
                                <div class="card-header">Report Download</div>

                                <div class="card-body" id="scontent" >
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script type="text/javascript">
        $(document).ready(function(e){
            $("#skeyword").show();
            $("#skeyword_assignd").hide();
            $("#sby").change(function(e){
                var sby = $("#sby").val();


                if (sby == 'assignd') {
                    $("#skeyword_assignd").show();
                    $("#skeyword").hide();
                } else {
                   $("#skeyword_assignd").hide();
                   $("#skeyword").show(); 
                }
                
            });
        })
    </script>
<?php include 'footer.php';?>