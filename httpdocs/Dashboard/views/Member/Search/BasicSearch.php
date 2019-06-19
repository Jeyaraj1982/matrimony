<?php
$mainlink="Search";
$page="BasicSearch";
$Info = $webservice->GetBasicSearchElements();
?>
<style>
div, label,a {font-family:'Roboto' !important;}
</style>
<?php include_once("topmenu.php");?>
<div class="col-lg-12 grid-margin stretch-card" >
    <div class="card">
        <div class="card-body">
          <form method="post" action="SearchResult.php" onsubmit="">
        <div class="container"  id="sp">
        <div class="col-sm-6">
            <div class="form-group row">
             <div class="col-sm-4" align="left">Age</div>
             <div class="col-sm-2" align="left" style="width:100px">
                <select class="form-control" id="age" name="age">
                <?php for($i=18;$i<=70;$i++) {?>
                    <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                <?php } ?>
                </select>           
            </div>
            <div class="col-sm-1" align="left" style="padding-top: 6px;">To</div>
            <div class="col-sm-2" align="left" style="width:100px">
             <select class="form-control" id="toage"  name="toage">
                <?php for($i=18;$i<=70;$i++) {?>
                    <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                <?php } ?>
                </select>           
             </div>
            </div>
            <div class="form-group row">
             <div class="col-sm-4" align="left">Marital Status</div>
             <div class="col-sm-6" align="left">
                <select class="form-control" id="MaritalStatus"  name="MaritalStatus">
                    <option value="0">Choose Marital Status</option>
                    <?php foreach($Info['data']['MaritalStatus'] as $MaritalStatus) { ?>
                    <option value="<?php echo $MaritalStatus['SoftCode'];?>" <?php echo ($_POST['MaritalStatus']==$MaritalStatus['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $MaritalStatus['CodeValue'];?></option>
                    <?php } ?>
                </select>           
            </div>
            </div> 
            <div class="form-group row">
             <div class="col-sm-4" align="left">Religion</div>
             <div class="col-sm-6" align="left">
                <select class="form-control" id="Religion"  name="Religion">
                    <option value="0">Choose Religion</option>
                    <?php foreach($Info['data']['Religion'] as $Religion) { ?>
                    <option value="<?php echo $Religion['SoftCode'];?>" <?php echo ($_POST['Religion']==$Religion['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Religion['CodeValue'];?></option>
                    <?php } ?>
                </select>           
            </div>
            </div> 
             
            <div class="form-group row">
             <div class="col-sm-4" align="left">Community</div>
             <div class="col-sm-6" align="left">
                <select class="form-control" id="Community"  name="Community"> 
                    <option value="0">Choose Community</option>
                    <option value="All">All</option>
                    <?php foreach($Info['data']['Community'] as $Community) { ?>
                    <option value="<?php echo $Community['SoftCode'];?>" <?php echo ($_POST['Community']==$Community['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Community['CodeValue'];?></option>
                    <?php } ?>
                </select>           
            </div>
            </div> 
            <hr>
            <div class="form-group row">
                <div class="col-sm-12"><input type="checkbox" id="check" name="check" onclick="saveSearchAgree()" style="width: 2%;" data-toggle="collapse" data-target="#savesearch"><label for="check" style="cursor:pointer;font-size:15px" data-toggle="collapse" data-target="#savesearch" onclick="saveSearchAgree()">Save upto 5 searchs </label></div>
            </div>
            <div id="savesearch" class="collapse">
                <div class="form-group row">
                    <div class="col-sm-4" align="left">Save Search as</div>
                    <div class="col-sm-6" align="left"><input type="text" class="form-control" name="SaveSearchas" id="SaveSearchas" placeholder="Eg : 25to35 christian bride"></div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4" align="left">Email Me</div>
                    <div class="col-sm-2" align="left"><input type="radio" name="emailme" value="Daily" style="padding:5px">&nbsp;Daily</div>
                    <div class="col-sm-2" align="left"><input type="radio" name="emailme" value="Weekly">&nbsp;Weekly</div>
                    <div class="col-sm-2" align="left"><input type="radio" checked="checked" name="emailme" value="Never">&nbsp;Never</div>
                </div>
                
            </div>
            <div class="form-group row">
                   <div class="col-sm-5"><a href="#" id="searchBtn" class="btn btn-primary">Search</a></div>
            </div>
            </div>
            <div class="col-sm-6">
                    <div style="width:200px;height:315px;border:2px solid #d2d2d2;padding:10px">
                        <p style="font-size: 15px;border-bottom:2px solid #d1d1d1;width:97px">Saved Search</p>
                            <?php for($i=1;$i<4;$i++) {?>
                            <p style="font-size: 15px;padding-left:10px;">25to35 christian brides</p>
                            <?php } ?> 
                        <p style="color:#ccc;text-align: center;font-size:15px;margin-top:25px">No records found</p>   
                    </div> 
                 </div>
            </form>  
            <script>
            var _saveSearchAgree=0;
            function saveSearchAgree() {
                if (_saveSearchAgree==0) {
                    _saveSearchAgree=1;
                    $('#searchBtn').html(" Save & Search ");
                } else {
                    _saveSearchAgree=0;
                    $('#searchBtn').html(" Search ");
                }
            }
            </script>   
        </div>
    </div>
</div>
