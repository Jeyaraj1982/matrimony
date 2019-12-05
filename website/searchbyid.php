 
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
      <script>
function submitSearch() {
                        $('#Errprofileid').html("");

                         ErrorCount=0;
                         
                         if($("#profileid").val()==""){
                            document.getElementById("Errprofileid").innerHTML="Please enter Profile ID"; 
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
        <h2>Search By ProfileID</h2><br>
              <div class="form-group row">
                <div class="col-sm-12">
                    <div class="form-group row">
                       <div class="col-sm-3">Profile ID</div>
                                <div class="col-sm-8">
                                     <input type="text" class="form-control" placeholder="Eg:Profile Id" name="profileid" id="profileid">
<span class="errorstring" id="Errprofileid"><?php echo isset($Errprofileid)? $Errprofileid : "";?></span>									 
                                </div>
                       </div>
                    <button type="submit" class="btn btn-primary" name="SearchByID">Search</button>
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
                                        <li><a href="advancsearch.php">Advance Search</a></li>
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