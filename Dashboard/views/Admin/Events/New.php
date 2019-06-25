<form method="post" action="" onsubmit="">
  <div class="main-panel">
       <div class="content-wrapper">
             <div class="col-12 stretch-card">
                  <div class="card">
                       <div class="card-body">
                             <h4 class="card-title">Add Events</h4>
                                 <form class="forms-sample">
                                        <div class="form-group row">
                                                <label for="Events Code" class="col-sm-3 col-form-label"><small>Events Code</small></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="EventsCode" name="EventsCode" value="" placeholder="Events Code">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Events Title" class="col-sm-3 col-form-label">Events Title</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="EventsTitle" name="EventsTitle" value="" placeholder="Events Title">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Events For" class="col-sm-3 col-form-label">Event For</label>
                                          <div class="col-sm-9">
                                              <select class="form-control" id="EventsFor"  name="EventsFor" >
                                                <option value="">Franchisee</option>
                                                <option>Member</option>
                                                <option>Franchisee & Member</option>
                                              </select>
                                        </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Events Date" class="col-sm-3 col-form-label">Events Date</label>
                                            <div class="col-sm-9">
                                                <input type="Date" class="form-control" id="EventsDate" name="EventsDate" value="" placeholder="Events Date">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Events Details" class="col-sm-3 col-form-label">Events Details</label>
                                            <div class="col-sm-9">
                                                <textarea  rows="10" class="form-control" id="EventsDetails" name="EventsDetails" value="" placeholder="Events Details">  </textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Photo" class="col-sm-3 col-form-label">Photo</label>
                                            <div class="col-sm-9">
                                                <input type="File" class="form-control" id="Photo" name="Photo" value="" placeholder="Events Title">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <div class="col-sm-4"><button type="submit" name="BtnSaveStory" class="btn btn-success mr-2">Save</button></div>
                                        <div class="col-sm-4"><button type="submit" name="BtnSaveStory" class="btn btn-success mr-2">Save & Publish</button></div>
                                        <div class="col-sm-4"><a href="ManageNews "><small>List of Events</small> </a></div>
                                        </div>
                                 </form>
                       </div>
                  </div>
             </div>
       </div>
  </div>
</form>