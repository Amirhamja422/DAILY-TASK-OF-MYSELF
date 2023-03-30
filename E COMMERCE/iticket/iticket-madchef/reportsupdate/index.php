
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

        setTimeout(function(){
           $('#content').DataTable();
         }, 1000);

    });
</script>

<script type="text/javascript">




    function invoice(id, order_id){
      $.ajax({
        url:"create_pdf/invoice.php",
        type:"POST",
        data:{id:id, order_id:order_id},
        success : function(data){
           document.getElementById("invoice").innerHTML = data;
           $('#invoice').modal('show');
       },
   });
  }



  function update_ticket(id){

        // var customer_name = $('#customer_name').val();
        // var customer_phone = $('#customer_phone').val();
        var status = $('#status').val();
        var note = $('#note').val();
        var update_details = $('#update_details').val();
        // var now_user = <?php echo $_SESSION['usr01937417227']; ?>


        $.ajax({
            url:"ticket_insert.php",
            type:"POST",
            data:{
                id:id,
                status: status,
                note:note,
                update_details:update_details
            },

            success: function(response){
               document.getElementById("update_message").innerHTML = response;
               setTimeout(function () {
                  location.reload();

              }, 3000);
           }
       })




    };

    function close_modal(){
        console.log("okay");
        location.reload();
    }

    function update(id, order_id){
        $.ajax({
            url:"ticket_modal.php",
            type:"POST",
            data:{id:id, order_id:order_id},
            success : function(data){
                document.getElementById("editmodal").innerHTML = data;
                $('#editmodal').modal('show');
            },
        });
    };

</script>






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



function modify(id)
{

    var change_assign = $("#change_assign"+id).val();
    // alert ('change_assign');
    var change_status = $("#change_status"+id).val();
    // alert ('change_status');

    $.ajax({
        data: "id="+id+"&change_assign="+change_assign+"&change_status="+change_status,
        url: "../kullu/changeAssign.php",
        type: "GET",
        success: function(res){
            if (res) {
                // alert(res);
               // location.reload();
               reportJAVA();

               setTimeout(function(){
                  $('#content').DataTable();
                }, 1000);

            }
        }
    });
}

</script>




<?php include 'footer.php';?>
