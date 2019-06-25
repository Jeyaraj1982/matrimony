<form method="post" action="<?php echo GetUrl("MyProfile");?>" onsubmit="">
  <div class="main-panel">
       <div class="content-wrapper">
             <div class="col-12 stretch-card">
                  <div class="card">
                       <div class="card-body">
                             <h4 class="card-title">New Profile</h4>
                                 <form class="forms-sample">
                                        <div class="form-group row">
                                                <label for="Member ID" class="col-sm-3 col-form-label">Member ID</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="MemberID" name="MemberID" value="" placeholder="Member ID">
                                            </div>
                                        </div>
                                        <button type="submit" name="" class="btn btn-success mr-2">Create Profile</button>
                                 </form>
                       </div>
                  </div>
             </div>
       </div>
  </div>
</form>