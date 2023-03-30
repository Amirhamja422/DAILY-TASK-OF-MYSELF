
<?php include 'header.php';?>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
    <script type="text/javascript">

        function reportJAVA(id,ed,dd,kw,skw,sub,dept)
        {
        // id = id + " " +document.getElementById("ihour").value + ":" + document.getElementById("imin").value + ":" + document.getElementById("isec").value;
        // ed = ed + " " +document.getElementById("ehour").value + ":" + document.getElementById("emin").value + ":" + document.getElementById("esec").value;
        // alert(dept);

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
        xmlhttp.open("GET","update/generation.php?q1="+id+"&q2="+ed+"&q3="+dd+"&q4="+kw+"&skw="+skw+"&sub="+sub+"&dept="+dept,true);
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
                                            <?php if(($_SESSION['previlege'] == 4) || ($_SESSION['previlege'] == 5) || ($_SESSION['previlege'] == 2)){?>
                                                <option value="cus_contact">Contact</option>
                                                <option value="cus_ac">Account No</option> 
                                                <option value="cus_amount">Card No</option> 
                                                <option value="id">Ticket ID</option>
                                                <option value="cus_name">Customer Name</option>
                                                <option value="status">Status</option>

                                            <?php } else { ?>
                                                <option value="cus_contact">Contact</option>
                                                <option value="cus_ac">Account No</option> 
                                                <option value="cus_amount">Card No</option> 
                                                <option value="id">Ticket ID</option>
                                                <option value="cus_name">Customer Name</option>
                                                <option value="status">Status</option>
                                                <option value="sub_group">Complain Type</option>
                                                <option value="group">Department</option>
                                            <?php }?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="src_keyword" class="col-form-label text-md-right">Search Keyword</label>
                                        <input type="text" id="skeyword" name="skeyword" class="form-control" placeholder="Enter Search Keyword">

                                        <?php
                                            include '../db.php';
                                            if($_SESSION['previlege'] == 4){
                                                $sql = mysql_query("SELECT * FROM `ticket_status` WHERE `status_name`='Solved'");
                                            } else if($_SESSION['previlege'] == 5){
                                                $sql = mysql_query("SELECT * FROM `ticket_status` WHERE `status_name`='Reject'");
                                            }else{
                                                $sql = mysql_query("SELECT * FROM `ticket_status` ");
                                            }

                                        ?>
                                        <select class="form-control" id="skeyword_status" name="skeyword_status">
                                            <option value="">Select Status</option>
                                            <?php while ($status = mysql_fetch_assoc($sql)) { ?>
                                                <option value="<?php echo $status['status_name']; ?>"><?php echo $status['status_name']; ?></option>
                                            <?php } ?>
                                        </select>

                                        <?php
                                            $sub_sql = mysql_query("SELECT * FROM `sub_group`");

                                        ?>
                                        <select class="form-control" id="skeyword_sub" name="skeyword_sub">
                                                <option value="">Select Complain Type</option>
                                            <?php while ($sub_group = mysql_fetch_assoc($sub_sql)) { ?>
                                                <option value="<?php echo $sub_group['id']; ?>"><?php echo $sub_group['sub_group_name']; ?></option>
                                            <?php } ?>
                                        </select>

                                        <?php
                                            $dept_sql = mysql_query("SELECT * FROM `user_group`");
                                        ?>
                                        <select class="form-control" id="skeyword_dept" name="skeyword_dept">
                                                <option value="">Select Department</option>
                                            <?php while ($group = mysql_fetch_assoc($dept_sql)) { ?>
                                                <option value="<?php echo $group['id']; ?>"><?php echo $group['group_name']; ?></option>
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
                                            <button type="button" onclick="reportJAVA(document.getElementById('idate').value,document.getElementById('edate').value,document.getElementById('sby').value,document.getElementById('skeyword').value,document.getElementById('skeyword_status').value, document.getElementById('skeyword_sub').value, document.getElementById('skeyword_dept').value)" class="btn btn-primary" style="margin-top: 36px;"><i class="fa fa-search" aria-hidden="true">&nbsp;Search</i></button>&nbsp;&nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>


                        <div align="center">
                            <div class="card">
                                <div class="card-header">Update Ticket</div>

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

    <script>
// Display an external page using an iframe
function smcollege(kuti)
{
var X=window.innerWidth/5;//$(window).height()-430;
//document.getElementById("NP").value=X;
var Y=50;
var src = "update/edittieket.php?q1="+kuti;
$.modal('<iframe src="' + src + '" height="480" width="830" style="border:0">', {
    closeHTML:"",
    appendTo: $(window.parent.document).find('body'),
    opacity:70,
    overlayCss: {backgroundColor:"#000"},
    containerCss:{
        backgroundColor:"#fff", 
        borderColor:"#000",
        borderRadius:15,
        height:510, 
        padding:0, 
        width:830
    },
    overlayClose:true,
    position: [Y,X],
    onOpen: function (dialog) {
    dialog.overlay.fadeIn('slow', function () {
        dialog.data.hide();
        dialog.container.fadeIn('slow', function () {
            dialog.data.slideDown('slow');   
        });
    });
},
onClose: function (dialog) {
    dialog.data.fadeOut('slow', function () {
        dialog.container.hide('fast', function () {
            dialog.overlay.slideUp('fast', function () {
                $.modal.close();
            });
        });
    });
}

});

$(window.parent.document).find('#simplemodal-overlay').css('width', '100%');
$(window.parent.document).find('#simplemodal-overlay').css('height', '100%');
}

function view(kuti)
{
var X=window.innerWidth/5;//$(window).height()-430;
//document.getElementById("NP").value=X;
var Y=50;
var src = "../kullu/view.php?q1="+kuti;
$.modal('<iframe src="' + src + '" height="480" width="830" style="border:0">', {
    closeHTML:"",
    appendTo: $(window.parent.document).find('body'),
    opacity:70,
    overlayCss: {backgroundColor:"#000"},
    containerCss:{
        backgroundColor:"#fff", 
        borderColor:"#000",
        borderRadius:15,
        height:510, 
        padding:0, 
        width:830
    },
    overlayClose:true,
    position: [Y,X],
    onOpen: function (dialog) {
    dialog.overlay.fadeIn('slow', function () {
        dialog.data.hide();
        dialog.container.fadeIn('slow', function () {
            dialog.data.slideDown('slow');   
        });
    });
},
onClose: function (dialog) {
    dialog.data.fadeOut('slow', function () {
        dialog.container.hide('fast', function () {
            dialog.overlay.slideUp('fast', function () {
                $.modal.close();
            });
        });
    });
}

});

$(window.parent.document).find('#simplemodal-overlay').css('width', '100%');
$(window.parent.document).find('#simplemodal-overlay').css('height', '100%');
}

function modify(id)
{
    var change_assign = $("#change_assign"+id).val();
    var change_status = $("#change_status"+id).val();

    // alert(change_status + change_assign + id);

    $.ajax({
        data: "id="+id+"&change_assign="+change_assign+"&change_status="+change_status,
        url: "../kullu/changeAssign.php",
        type: "GET",
        success: function(res){
            if (res) {
                alert(res);
            }
        }
    });
}

</script>

<script type="text/javascript">
    $(document).ready(function(e){
        $("#skeyword").show();
        $("#skeyword_status").hide();
        $("#skeyword_sub").hide();
        $("#skeyword_dept").hide();

        $("#skeyword").val('');
        $("#skeyword_sub").val('');
        $("#skeyword_status").val('');
        $("#skeyword_dept").val('');

        $("#sby").change(function(e){
            var sby = $("#sby").val();


            if (sby == 'status') {
                $("#skeyword_sub").hide();
                $("#skeyword_status").show();
                $("#skeyword").hide();
                $("#skeyword_dept").hide();

                $("#skeyword").val('');
                $("#skeyword_sub").val('');
                $("#skeyword_dept").val('');

            } else if(sby == 'sub_group') {
                $("#skeyword_sub").show();
                $("#skeyword_status").hide();
                $("#skeyword").hide();
                $("#skeyword_dept").hide();

                $("#skeyword").val('');
                $("#skeyword_status").val('');
                $("#skeyword_dept").val('');
            } else if(sby == 'group'){
                $("#skeyword_sub").hide();
                $("#skeyword_status").hide();
                $("#skeyword").hide();
                $("#skeyword_dept").show();

                $("#skeyword").val('');
                $("#skeyword_status").val('');
                $("#sub_group").val('');
            } 
            else {
                $("#skeyword_sub").hide();
                $("#skeyword_status").hide();
                $("#skeyword").show();
                $("#skeyword_dept").hide();

                $("#skeyword_status").val('');
                $("#skeyword").val('');
                $("#skeyword_sub").val('');
                $("#skeyword_dept").val('');
                 
            }
            
        });
    })
</script>

<?php include 'footer.php';?>