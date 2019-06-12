<?php include_once("header.php");?>
<form method="post" action="" onsubmit="">
        <div class="row">
            <div class="col-12 grid-margin">
            <div align="right">Published</div>
              <div class="card">
                <div class="card-body">
                  
                  <div class="fluid-container">
                    <div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3">
                      <div class="col-md-1">
                        <img class="img-sm rounded-circle mb-4 mb-md-0" src="<?php echo SiteUrl?>images/faces/face1.jpg" alt="profile image">
                      </div>
                      <div class="ticket-details col-md-9">
                        <div class="d-flex">
                          <p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap">Name Of the Candidate:</p>
                          <p class="text-primary mr-1 mb-0"></p>
                          </div>
                        <div class="row text-gray d-md-flex d-none">
                          <div class="col-4 d-flex">
                            <small class="mb-0 mr-2 text-muted text-muted">Age :</small>
                            <small class="Last-responded mr-2 mb-0 text-muted text-muted"></small>
                          </div>
                          <div class="col-4 d-flex">
                            <small class="mb-0 mr-2 text-muted text-muted">Date of Birth:</small>
                            <small class="Last-responded mr-2 mb-0 text-muted text-muted"></small>
                          </div>
                        </div>
                        <div class="row text-gray d-md-flex d-none">
                          <div class="col-4 d-flex">
                            <small class="mb-0 mr-2 text-muted text-muted">Created:</small>
                            <small class="Last-responded mr-2 mb-0 text-muted text-muted"></small>
                          </div>
                          <div class="col-4 d-flex">
                            <small class="mb-0 mr-2 text-muted text-muted">Activated:</small>
                            <small class="Last-responded mr-2 mb-0 text-muted text-muted"></small>
                          </div>
                        </div>
                        </div>
                      <div class="ticket-actions col-md-2"><br>
                      <p><a hre="#">View profile</a></p>
                            <small class="Last-responded mr-2 mb-0 text-muted text-muted"></small>
                        <div class="btn-group dropdown">
                          <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Select Profile
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">
                              <i class="fa fa-reply fa-fw"></i>Quick reply</a>
                            <a class="dropdown-item" href="#">
                              <i class="fa fa-history fa-fw"></i>Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                              <i class="fa fa-check text-success fa-fw"></i>Resolve Issue</a>
                            <a class="dropdown-item" href="#">
                              <i class="fa fa-times text-danger fa-fw"></i>Close Issue</a>
                          </div>
                        </div>
                      </div>
                    </div> 
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
            </form>
<?php include_once("footer.php");?>