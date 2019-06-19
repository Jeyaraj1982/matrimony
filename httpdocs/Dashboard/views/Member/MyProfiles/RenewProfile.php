<?php include_once("header.php");?>
    <form action="" class="form">
        <div class="container"  id="sp">
            <h2>Renew Profile</h2><br>
             <div class="form-group">
            <div class="row">
               <div class="col-sm-2">Profile ID:</div>
               <div class="col-sm-10">XXXXXXXXX </div>
               </div>
               </div>
               <div class="form-group">
               <div class="row">
               <div class="col-sm-2">Name:</div>
               <div class="col-sm-10">XXXXXXXXX</div>
               </div>
               </div>
               <div class="form-group">
               <div class="row">
               <div class="col-sm-2">Select Plan:</div>
               <div class="col-sm-10"><select name="plan" size="4" multiple>
                    <option>aaaaaa</option>
                    <option>bbbbbb</option>
                    <option>cccccc</option>
                    <option>dddddd</option>
                     </select></div>
               </div>
               </div>
               <div class="form-group">
               <div class="row">
               <div class="col-sm-2"></div>
               <div class="col-sm-10">View plan into</div>
               </div>
               </div><br>
               <div class="form-group">
                <div class="row">
                <div class="col-sm-3" align="left">Cost</div>
                <div class="col-sm-1" align="right"><input type="text" class="form-control" id="cost" name="cost"></div> 
                <div class="col-sm-5" align="left">Current Balance</div>
                <div class="col-sm-1" align="left"><input type="text" class="form-control" id="current balance" name="current balance" width="5px"></div>
                </div>
             </div>
             <br>
             <div class="form-group">
                <div class="row">
                <div class="col-sm-6" align="center"><a href="" class="btn btn-primary" role="button">Renew now </a></div>
                <div class="col-sm-6" align="center"><a href="">add fund to wallet</a></div> 
                </div>
             </div>
           </div>
            </form>
<?php include_once("footer.php");?>