<?php
    $page="EducationDetails";
   ?>
<?php include_once("settings_header.php");?>
<div class="col-sm-10" style="margin-top: -8px;">
    <h4 class="card-title">Education Details</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Document Type</th>
                    <th>Attach Menu File</th>
                    <th>Attached On</th>
                    <th>Viewed On</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <br>
        <div align="left">
            <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#myModal">Attach</button>
        </div>
        <div class="modal fade" id="myModal" style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
    <div class="modal-dialog" style="width: 367px;">
        <div class="modal-content">
            <div class="modal-body">
                    <div style="height: 315px;">
                     <form method="post" action="" onsubmit="">
                     <h4 class="card-title">Educational Iformation</h4>
                        <div class="form-group row">
                            <label for="Community" class="col-sm-4 col-form-label">Education<span id="star">*</span></label>
                            <div class="col-sm-8">
                                <select class="selectpicker form-control" data-live-search="true" id="Education" name="Education">
                                    <option value="School">School</option>
                                    <option value="UG">UG</option>
                                    <option value="PG">PG</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Community" class="col-sm-4 col-form-label">School<span id="star">*</span></label>
                            <div class="col-sm-8">
                                <select class="selectpicker form-control" data-live-search="true" id="School" name="School">
                                    <option value="1 to 12">1 to 12</option>
                                    <option value="1 to 10">1 to 10</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row" style="margin-bottom:0px;">
                            <div class="col-sm-3">
                                <button type="submit" name="BtnSaveProfile" class="btn btn-success mr-2">Save</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
<?php include_once("settings_footer.php");?>                    