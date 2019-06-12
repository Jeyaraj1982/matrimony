<?php include_once("header.php");?>
<form method="post" action="RefillwalletCompleted.php" onsubmit=" return RefillwalletSubmit();">
        <div class="container"  id="sp">
           <h3>Search Profile</h3><br>
            <div class="form-group">
            <div class="row">
             <div class="col-sm-3" align="left">Search for</div>
             <div class="col-sm-3" align="left">
                <select class="form-control" id="searchfor"  name="searchfor">
                    <option>Profile</option>
                    <option>aaaaa</option>
                    <option>bbbbb </option>
                    <option>ccccc</option>
                </select>           
            </div>
            </div> 
            </div>
            <div class="form-group">
            <div class="row">
             <div class="col-sm-3" align="left">Age</div>
             <div class="col-sm-3" align="left">
                <select class="form-control" id="age"  name="age">
                    <option>20</option>
                    <option>21</option>
                    <option>22 </option>
                    <option>23</option>
                </select>           
            </div>
            <div class="col-sm-1" align="left">To</div>
            <div class="col-sm-3" align="left">
             <select class="form-control" id="toage"  name="toage">
                    <option>20</option>
                    <option>21</option>
                    <option>22 </option>
                    <option>23</option>
                </select>           
             </div>
            </div> 
            </div>
             <div class="form-group">
            <div class="row">
             <div class="col-sm-3" align="left">Religion</div>
             <div class="col-sm-3" align="left">
                <select class="form-control" id="relegion"  name="relegion">
                    <option>Religion</option>
                    <option>aaaaa</option>
                    <option>bbbbb </option>
                    <option>ccccc</option>
                </select>           
            </div>
            </div> 
            </div>
            
            <div id="link"><button type="submit" class="btn btn-primary">Go Profile </button></div> 
            </div>
            </form>
<?php include_once("footer.php");?>