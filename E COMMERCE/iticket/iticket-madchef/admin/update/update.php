
<?php include '../header.php';?>

<link href="../../css-new/app.css" rel="stylesheet">
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">Status<button class="btn btn-outline-primary btn-sm float-right" data-toggle="modal" data-target="#createUser" onclick="addStatus()">Add Status</button></div>

                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Edit</th>
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

<script>
// Display an external page using an iframe
function editStatus(kuti)
{
var X=window.innerWidth/5;//$(window).height()-430;
//document.getElementById("NP").value=X;
//alert("OK");
var Y=50;
var src = "editStatus.php?q1="+kuti;
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
}

// Display an external page using an iframe
function addStatus()
{
var X=window.innerWidth/5;//$(window).height()-430;
//document.getElementById("NP").value=X;
//alert("OK");
var Y=50;
var src = "addStatus.php";
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
</script>
<?php include '../footer.php';?>