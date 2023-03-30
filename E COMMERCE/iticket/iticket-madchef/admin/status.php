
<?php
$suc=NULL;
$fail=NULL;

if(isset($_POST['addStatus']))
{
  include '../db.php';

  $second = ($_POST['hour_time']*3600);
  $check=mysql_fetch_assoc(mysql_query("SELECT status_name FROM ticket_status WHERE status_name='".$_POST['name']."'"));
  if($check == NULL){
    if(mysql_query("INSERT INTO ticket_status (status_name) VALUES ('".$_POST['name']."')")){
      $suc="Status Inserted Successfully";
    }else{
      $fail="Faild to create Status";
    }
  }else{
    $fail="Status Already Added...";
  }

}
 include 'header.php';?>



<main class="py-4">
    <div class="container">

        <div class="modal fade" id="addStatus" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-body">
                    <form class="form-horizontal" action="#" method="POST" id="myform">

                        <div class="col-md-12" style="float: left; padding: 10px;">
                            <div class="col-sm-4" style="float: left;">Status:</div>
                            <div class="col-sm-8" style="float: left;">
                              <input type="text" class="form-control" id="name" placeholder="Enter Sub-group Name" name="name" required="required">
                          </div>
                      </div>

                      <div class="col-md-12" style="float: left; padding: 10px;">
                        <div class="col-sm-4" style="float: left; visibility: hidden;">Button</div>
                        <div class="col-sm-8" style="float: left;">
                            <input type="submit" name="addStatus" value="Submit" class="btn btn-success">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Status<button class="btn btn-outline-primary btn-sm float-right" data-toggle="modal" data-target="#addStatus" onclick="addStatus()">Add Status</button><span class="float-right" id="msg" style="color: red; margin-right: 16px;"></span></div>

                <div class="card-body">
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
                  <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Status</th>
                            <!-- <th scope="col">Edit</th> -->
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php include 'bralist2status.php'; ?>
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

      $.ajax({
        data: "id="+id+"&service="+service,
        url: "../kullu/updateStatus.php",
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
<?php include 'footer.php';?>