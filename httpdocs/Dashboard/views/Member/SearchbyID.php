<?php include_once("header.php");?>
<form method="post" action="" onsubmit="">
       <div class="container"  id="sp">
           <h3>Search Profile</h3>
           <h3>(By Profile Id)</h3><br>
            <div class="form-group">
            <div class="row">
               <div class="col-sm-6" align="left">Profile ID</div>
               <div class="col-sm-3" align="left"><input type="name" class="form-control" id="name" name="name"></div> 
            </div>
            </div>
            <br>
            <div id="link"><button type="submit" class="btn btn-primary">Get Profile</button> </div>              
        </div>
        </form>
<?php include_once("footer.php");?>