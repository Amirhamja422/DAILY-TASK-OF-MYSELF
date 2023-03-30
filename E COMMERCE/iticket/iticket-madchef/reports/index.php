
<?php include 'header.php';?>
    <script type="text/javascript">

        function reportJAVA()
        {
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
        xmlhttp.open("GET","../admin/update/dash.php", true);
        xmlhttp.send();
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

</style>
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12" id="scontent">
                        
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

<script>
// Display an external page using an iframe
function smcollege(kuti)
{
var X=window.innerWidth/5;//$(window).height()-430;
//document.getElementById("NP").value=X;
var Y=50;
var src = "../admin/update/edittieket.php?q1="+kuti;
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

<?php include 'footer.php';?>