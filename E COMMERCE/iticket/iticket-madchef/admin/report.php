
<?php include 'header.php';?>
    <script type="text/javascript">

        function reportJAVA(id,ed,dd,kw)
        {
        // id = id + " " +document.getElementById("ihour").value + ":" + document.getElementById("imin").value + ":" + document.getElementById("isec").value;
        // ed = ed + " " +document.getElementById("ehour").value + ":" + document.getElementById("emin").value + ":" + document.getElementById("esec").value;


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
        xmlhttp.open("GET","reports/generation.php?q1="+id+"&q2="+ed+"&q3="+dd+"&q4="+kw,true);
        xmlhttp.send();

        //showProducts("1");
        }

    </script>
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">

                        <form method="GET">
                            <div class="row">
                                <div class="col-md-10 form-row">
                                    <div class="form-group col-md-3">
                                        <label for="src_type" class="col-form-label text-md-right">Search Type</label>
                                        <select class="form-control" id="sby" name="src_type">
                                            <option value="cus_contact">Contact</option>
                                            <option value="cus_ac">Account Number</option>  
                                            <option value="cus_amount">Card Number</option>  
                                            <option value="id">Ticket ID</option>
                                            <option value="cus_name">Customer Name</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="src_keyword" class="col-form-label text-md-right">Search Keyword</label>
                                        <input type="text" id="skeyword" name="skeyword" class="form-control" placeholder="Enter Search Keyword">
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
                                            <button type="button" onclick="reportJAVA(document.getElementById('idate').value,document.getElementById('edate').value,document.getElementById('sby').value,document.getElementById('skeyword').value)" class="btn btn-primary" style="margin-top: 36px;"><i class="fa fa-search" aria-hidden="true">&nbsp;Search</i></button>&nbsp;&nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>


                        <div align="center">
                            <div class="card">
                                <div class="card-header">Report Download</div>

                                <div class="card-body" id="scontent" >
                                    <!-- <table class="table table-bordered" id="scontent" style="font-size: 12px;">
                                        
                                    </table> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
<?php include 'footer.php';?>