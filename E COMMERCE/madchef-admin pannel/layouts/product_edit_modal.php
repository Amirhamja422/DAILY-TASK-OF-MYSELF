 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Product Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: 345px;color: red;"> 
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div id="details"></div>
     </div>
     <div class="modal-footer">
      <button type="button"  onclick="Update(<?php echo $row['id']; ?>)" class="btn btn-primary btnReload" data-dismiss="modal">Update</button>
    </div>
  </div>
</div>
</div>