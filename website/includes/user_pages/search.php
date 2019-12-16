 
<style>
    .navbar-inverse {

    background-color: transparent;
    border-color: transparent;
         color:#fff;
}
.navbar-inverse .navbar-nav > li > a {

    color: white;

}
.errorstring{
	color:red;
}
</style>
<?php
    $isShowSlider = false;
    $layout=0;
    include_once("includes/header.php");
?>  <br><br><br>
          
         
         <section class="page-container" style="margin-top: -19px">
            <div class="container">
                <div class="page-title breadcrumb-top">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
                        <div class="page-main">
                            <div class="article-detail">
                            <?php 
include_once(application_config_path);
$Info = $webservice->getData("Member","GetBasicSearchElements"); 

  ?>
 <script>
function submitSearch() {
                         $('#Errtoage').html("");
                         $('#Errage').html("");
                         $('#ErrReligion').html("");
                         $('#ErrCaste').html("");

                         ErrorCount=0;
                         
                         if(($("#age").val() > $("#toage").val())){
                            document.getElementById("Errtoage").innerHTML="Please select greater than from age"; 
                            ErrorCount++;
                         }
                        
                        if ($('#Religion option:selected').length==0){
                                document.getElementById("ErrReligion").innerHTML="Please select Religion"; 
                                ErrorCount++;
                         }
                        if($('#Caste option:selected').length==0){
                            document.getElementById("ErrCaste").innerHTML="Please select Caste"; 
                             ErrorCount++;
                         }
                            
                        if (ErrorCount==0) {
                            return true;                        
                        } else{
                            return false;
                        }
                        
    
    
}
</script>                      
<form method="post" action="SearchResult" onsubmit="return submitSearch();">                                                                 
<div class="col-12 grid-margin"> 
    <div class="card" style="border:none">
        <div class="card-body">
        <h2>Basic Search</h2><br>
              <div class="form-group row">
                <div class="col-sm-12">
                    <div class="form-group row">
                       <div class="col-sm-3">Looking For<span style="color:red;">*</span></div>
                                <div class="col-sm-8">
                                     <select class="form-control" id="LookingFor"  name="LookingFor">
                                            <option value="SX001">Groom</option>
                                            <option value="SX002">Bride</option>
                                        </select> 
                                </div>
                       </div>
                    <div class="form-group row">
                       <div class="col-sm-3">Age<span style="color:red;">*</span></div>
                                <div class="col-sm-3">
                                    <select name="age" id="age" class="form-control" >
                                             <?php for($i=18;$i<=70;$i++) {?>
                                            <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-2">To</div>
                                <div class="col-sm-3">
                                    <select name="toage" id="toage" class="form-control" >
                                             <?php for($i=18;$i<=70;$i++) {?>
                                            <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                                        <?php } ?>
                                    </select>
									<span class="errorstring" id="Errtoage"><?php echo isset($Errtoage)? $Errtoage : "";?></span>
                                </div>
                       </div>
                    <div class="form-group row">
                         <div class="col-sm-3">Religion<span style="color:red;">*</span></div>
                                <div class="col-sm-8">
                                     <select class="form-control" id="Religion"  name="Religion[]" size="5" multiple="multiple">
                                            <?php foreach($Info['data']['Religion'] as $Religion) { ?>
                                            <option value="<?php echo $Religion['SoftCode'];?>" <?php echo ($_POST['Religion']==$Religion['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Religion['CodeValue'];?></option>
                                            <?php } ?>
                                        </select> 
										<span class="errorstring" id="ErrReligion"><?php echo isset($ErrReligion)? $ErrReligion : "";?></span>
                                </div>
                    </div>
                    <div class="form-group row">  
                         <div class="col-sm-3">Caste<span style="color:red;">*</span></div>
                                <div class="col-sm-8">
                                    <select class="form-control" id="Caste"  name="Caste[]" size="5" multiple="multiple">
                                            <option value="All" selected>All</option>
                                            <?php foreach($Info['data']['Caste'] as $Caste) { ?>
                                            <option value="<?php echo $Caste['SoftCode'];?>" <?php echo ($_POST['Caste']==$Caste['SoftCode']) ? " selected='selected' " : "";?>> <?php echo $Caste['CodeValue'];?></option>
                                            <?php } ?>
                                        </select>
                                <span class="errorstring" id="ErrCaste"><?php echo isset($ErrCaste)? $ErrCaste : "";?></span>   										
                         </div> 
                    </div>
                        <button type="submit" class="btn btn-primary" name="BasicSearch">Search</button>
                    
                    
              </div>
              </div>
         </div>
</div>
</div>
</form>
</div>
               
                            </div>
                        </div> 
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 container-sidebar">
                        <aside id="sidebar">
                            <div class="widget widget-categories">
                                <div class="widget-top">
                                    <h3 class="widget-title">General Search</h3>
                                </div>
                                <div class="widget-body">
                                    <ul class="widget-list">
                                        <li><a href="search.php">Basic Search</a></li>
                                        <li><a href="advancesearch.php">Advance Search</a></li>
                                        <li><a href="searchbyid">Search By ID</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="widget widget-categories">
                                <div class="widget-top">
                                    <h3 class="widget-title">Matrimony Service</h3>
                                </div>
                                <div class="widget-body">
                                    <ul class="widget-list">
                                        <li><a href="javascript:;">Wedding Directory</a></li>
                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
         
           <?php include_once("includes/header.php");;?>