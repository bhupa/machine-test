<div class="modal" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Edit Edit</h5>
        </div>
       
        <div class="modal-body">
            <form action=""  id="edit-email-form" class="form-inline">
                {{ csrf_field() }}
            <div class="modal-body">
                <div id="add-more-div">
                    <div class="row" style="margin-bottom:20px;">
                        <div class="col-lg-8">
                          <div class="input-group">
                            <input type="email" class="form-control" name="address" value={{ $email->address }}>
                          </div>
                          <!-- /input-group -->
                          <input type="hidden" name="id" value={{ $email->id }} id="emailId">
                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-4">
                          
                          <!-- /input-group -->
                        </div>
                        <!-- /.col-lg-6 -->
                      </div>
                            
                </div>
                           
                
            </div>   
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary modal-close-btn" data-dismiss="modal">Close</button>
            </div>
            </form>
             
            
        </div>
        
            </form>
      </div>
    </div>
 </div>