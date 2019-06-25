
<form method="post" action="" onsubmit="">
  <div class="main-panel">
       <div class="content-wrapper">
             <div class="col-12 stretch-card">
                  <div class="card">
                       <div class="card-body">
                             <h4 class="card-title">Add Story</h4>
                                 <form class="forms-sample">
                                        <div class="form-group row">
                                                <label for="Story Code" class="col-sm-3 col-form-label"><small>Story Code</small></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="StoryCode" name="StoryCode" value="" placeholder="Story Code">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Story Title" class="col-sm-3 col-form-label">Story Title</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="StoryTitle" name="StoryTitle" value="" placeholder="Story Title">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Story Details" class="col-sm-3 col-form-label">Story Details</label>
                                            <div class="col-sm-9">
                                                <textarea  rows="10" class="form-control" id="StoryDetails" name="StoryDetails" value="" placeholder="Story Details">  </textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Photo" class="col-sm-3 col-form-label">Photo</label>
                                            <div class="col-sm-9">
                                                <input type="File" class="form-control" id="Photo" name="Photo" value="" placeholder="Story Title">
                                            </div>
                                        </div>
                                        <button type="submit" name="BtnSaveStory" class="btn btn-success mr-2">Save Stories</button>
                                        <a href="ManageStories "><small>List of Stories</small> </a>
                                 </form>
                       </div>
                  </div>
             </div>
       </div>
  </div>
</form>