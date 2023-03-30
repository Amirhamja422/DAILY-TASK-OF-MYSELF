
<?php
$suc=NULL;
$fail=NULL;

if(isset($_POST['addgroup']))
{
  include '../db.php';

  $second = ($_POST['hour_time']*3600);
  if(mysql_query("INSERT INTO `ticket_dev`.`user_group` (`id`, `group_name`) VALUES (NULL, '".$_POST['uname']."')")){
    $suc="User Group Inserted Successfully";
  }else{
    $fail="Faild to create User Group";
  }

}
include 'header.php';?>
<main class="py-4">
  <div class="container">
    <div class="modal fade" id="addUg" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-body">
            <form class="form-horizontal" action="#" method="POST" id="myform">

              <div class="col-md-12" style="float: left; padding: 10px;">
                <div class="col-sm-4" style="float: left;">Status:</div>
                <div class="col-sm-8" style="float: left;">
                  <input type="text" class="form-control" id="uname" placeholder="Enter group Name" name="uname" required="required">
                </div>
              </div>

              <div class="col-md-12" style="float: left; padding: 10px;">
                <div class="col-sm-4" style="float: left; visibility: hidden;">Button</div>
                <div class="col-sm-8" style="float: left;">
                  <input type="submit" name="addgroup" value="Submit" class="btn btn-success">
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
            <div class="card-header">Department<button class="btn btn-outline-primary btn-sm float-right" data-toggle="modal" data-target="#addUg">Add Department</button><span class="float-right" id="msg" style="color: red; margin-right: 16px;"></span></div>

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
                      <th scope="col">Department</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php include 'uglist.php'; ?>
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
    	// Display an external page using an iframe
      function addUg()
      {
		var X=window.innerWidth/5;//$(window).height()-430;
		//document.getElementById("NP").value=X;
		//alert("OK");
		var Y=50;
		var src = "addUg.php";
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

     function update_dept(id)
     {
      var dept_id = $("#dept_id"+id).text();

      $.ajax({
        data: "id="+id+"&dept_id="+dept_id,
        url: "../kullu/updateDept.php",
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