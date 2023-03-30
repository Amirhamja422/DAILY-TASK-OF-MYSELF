
<?php
$suc=NULL;
$fail=NULL;

if(isset($_POST['addser']))
{
  include '../db.php';

  if(mysql_query("INSERT INTO nature_complaint (`nature`,`type_id`) VALUES ('".$_POST['nature']."','".$_POST['type_id']."')")){
    $suc="Nature Inserted Successfully";
  }else{
    $fail="Faild to create Nature";
  }

} 
include 'header.php';?>
<main class="py-4">
  <div class="modal fade" id="addservice" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <form class="form-horizontal" action="#" method="POST" id="myform">
            <div class="col-md-12" style="float: left; padding: 10px;">
              <div class="col-sm-4 control-label" style="float: left;">Service:</div>
              <div class="col-sm-8" style="float: left;">
                <select class="form-control" name="type_id" id="type_id">
                  <option>Select A Service</option>
                  <?php
                  $result1 = mysql_query("select * FROM ticket_type ORDER BY type_name ASC");
                  while ($row = mysql_fetch_array($result1)) {
                    ?>
                    <option value="<?= $row['id'] ?>">
                      <?= $row['type_name'] ?>
                    </option>
                  <? } ?>
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-12" style="float: left; padding: 10px;">
              <div class="col-sm-4" style="float: left;">Nature:</div>
              <div class="col-sm-8" style="float: left;">
                <input type="text" class="form-control" id="nature" placeholder="Enter Nature" name="nature" required="required">
              </div>
            </div>

            <div class="col-md-12" style="float: left; padding: 10px;">
              <div class="col-sm-4" style="float: left; visibility: hidden;">Button</div>
              <div class="col-sm-8" style="float: left;">
                <input type="submit" name="addser" value="Submit" class="btn btn-success">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">

        <div class="col-md-12">
          <div class="card">
            <div class="card-header">Nature  <button class="btn btn-outline-primary btn-sm float-right" data-toggle="modal" data-target="#addservice">Add Nature</button>&nbsp;<span class="float-right" id="msg" style="color: red; margin-right: 16px;"></span></div>

            <div class="card-body" id="table" class="table-editable">
              <?php
              if($suc != NULL){?>
                <div class="btn-success text-center" style="font-size: 25px;">
                  <?php 
                  echo $suc;
                  unset($suc);
                  echo "<script>
                  setTimeout(function () {
                    window.location.replace('". $_SERVER['REQUEST_URI']."')
                    }, 3000);
                    </script>";
                    ?>
                  </div>
                  <?php
                }
                if ($fail != NULL) {?>
                  <div class="btn-danger text-center" style="font-size: 25px;">
                    <?php 
                    echo $fail;
                    unset($fail);
                    echo "<script>setTimeout(function () {
                      window.location.replace('". $_SERVER['REQUEST_URI']."')
                    }, 3000);</script>";
                    ?>
                  </div>
                  <?php
                }

                ?>
                <table class="table table-bordered" id="testing">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Service</th>
                      <th scope="col">Nature</th>
                      <th scope="col"><img src="idebnath/delete.png" style="cursor:pointer;"></th>
                    </tr>
                  </thead>
                  <tbody> 
                    <tr>
                      <?php include 'bralist2nature.php'; ?>
                    </tr>
                  </tbody>
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
  $('#group').change(function(e){
    var id = $("#group").val();

    $.ajax({
      data: "id="+id,
      url: "../kullu/change2.php",
      type: "GET",
      success: function(data){
        document.getElementById("type").innerHTML = data;
      }
    });                                
  });

  $('#type').change(function(e){
    var id = $("#group").val();
    var type_id = $("#type").val();

    $.ajax({
      data: "id="+id+"&type="+type_id,
      url: "../kullu/change3.php",
      type: "GET",
      success: function(data){
        document.getElementById("sub_group").innerHTML = data;
      }
    });

    $.ajax({
      data: "id="+id+"&type_id="+type_id,
      url: "../kullu/change.php",
      type: "GET",
      success: function(data){
        document.getElementById("to").innerHTML = data;
      }
    });
  });
</script>

<script type="text/javascript">
      // Display an external page using an iframe
      function addService()
      {
    var X=window.innerWidth/5;//$(window).height()-430;
    //document.getElementById("NP").value=X;
    //alert("OK");
    var Y=50;
    var src = "addService.php";
    $.modal('<iframe src="' + src + '" height="430" width="830" style="border:0">', {
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
  }

  const $tableID = $('#table');
  const $BTN = $('#export-btn');
  const $EXPORT = $('#export');

  const newTr = `
  <tr class="hide">
  <td class="pt-3-half" contenteditable="true">Example</td>
  <td class="pt-3-half" contenteditable="true">Example</td>
  <td class="pt-3-half" contenteditable="true">Example</td>
  <td class="pt-3-half" contenteditable="true">Example</td>
  <td class="pt-3-half" contenteditable="true">Example</td>
  <td class="pt-3-half">
  <span class="table-up"><a href="#!" class="indigo-text"><i class="fas fa-long-arrow-alt-up" aria-hidden="true"></i></a></span>
  <span class="table-down"><a href="#!" class="indigo-text"><i class="fas fa-long-arrow-alt-down" aria-hidden="true"></i></a></span>
  </td>
  <td>
  <span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0 waves-effect waves-light">Remove</button></span>
  </td>
  </tr>`;

  $('.table-add').on('click', 'i', () => {

   const $clone = $tableID.find('tbody tr').last().clone(true).removeClass('hide table-line');

   if ($tableID.find('tbody tr').length === 0) {

     $('tbody').append(newTr);
   }

   $tableID.find('table').append($clone);
 });

  $tableID.on('click', '.table-remove', function () {

   $(this).parents('tr').detach();
 });

  $tableID.on('click', '.table-up', function () {

   const $row = $(this).parents('tr');

   if ($row.index() === 0) {
     return;
   }

   $row.prev().before($row.get(0));
 });

  $tableID.on('click', '.table-down', function () {

   const $row = $(this).parents('tr');
   $row.next().after($row.get(0));
 });

     // A few jQuery helpers for exporting only
     jQuery.fn.pop = [].pop;
     jQuery.fn.shift = [].shift;

     $BTN.on('click', () => {

       const $rows = $tableID.find('tr:not(:hidden)');
       const headers = [];
       const data = [];

       // Get the headers (add special header logic here)
       $($rows.shift()).find('th:not(:empty)').each(function () {

         headers.push($(this).text().toLowerCase());
       });

       // Turn all existing rows into a loopable array
       $rows.each(function () {
         const $td = $(this).find('td');
         const h = {};

         // Use the headers from earlier to name our hash keys
         headers.forEach((header, i) => {

           h[header] = $td.eq(i).text();
         });

         data.push(h);
       });

       // Output the result
       $EXPORT.text(JSON.stringify(data));
     });



     function update_service(el)
     {
      var id = el.getAttribute('service_id');
      var service = $("#service"+id).text();
      var dept_id = el.getAttribute('dept_id');
      

      $.ajax({
        data: "id="+id+"&service="+service+"&dept_id="+dept_id,
        url: "../kullu/updateSrvice.php",
        type: "GET",
        success: function(res){
          $("#msg").text(res);

          setTimeout(function() {
            $('#msg').text(" ");
          }, 3000);
        }
      });
    }

    function update_hour_time(id)
    {
      var hour_time = $("#hour_time"+id).text();

      $.ajax({
        data: "id="+id+"&hour_time="+hour_time,
        url: "../kullu/updateSrvice.php",
        type: "GET",
        success: function(res){
          $("#msg").text(res);

          setTimeout(function() {
            $('#msg').text(" ");
          }, 3000);
        }
      });
    }

  </script>

    <script>

    $(document).ready(function () {

        /* username validation */
        $('#uid').keyup(function () {
            let uid = $(this).val();

            if (uid !== '') {
                $.ajax({
                    data: "uid="+uid,
          url: "../kullu/user_id_check.php",
          type: "GET",
          success: function(data){
            if (data != '') {
              $("#uid").val(" ");
              alert("User Alreay In Database!!");
            }
          }
                });
            }
        });
    });

</script>

<script>

    $(document).ready(function () {

        /* username validation */
        $('#nature').keyup(function () {
            let type_id = $("#type_id").val();
            let nature = $("#nature").val();

            // alert(type_id + nature); 


            if ((type_id !== '') && (nature != '')) {
                $.ajax({
                    data: "nature="+nature+"&type_id="+type_id,
                    url: "../kullu/nature_check.php",
                    type: "GET",
                    success: function(data){
                      if (data != '') {
                        $("#nature").val(" ");
                        // alert(data);
                        alert("Nature Alreay In Database!!");
                      }
                    }
                });
            }
        });
    });

</script>
  <?php include 'footer.php';?>