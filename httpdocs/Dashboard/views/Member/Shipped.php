<?php include_once("header.php");?>
<form method="post" action="" onsubmit="">
        <div class="container"  id="sp">           
            <div class="form-group">
            <div class="row">
               <div class="col-sm-3" align="left">Job id</div>
               <div class="col-sm-3" align="right"><input type="name" class="form-control" id="jobid" name="jobid"></div>
               <div class="col-sm-3" align="left">From</div>
               <div class="col-sm-3" align="right"><input type="name" class="form-control" id="from" name="from"></div>
                </div>                    
                   </div>   
                   <br>                          
            <div class="form-group">
                <div class="row">
                <div class="col-sm-3" align="left">Job Title</div>
                <div class="col-sm-3" align="right"><input type="text" class="form-control" id="jobtitle" name="jobtitle" ></div>
                <div class="col-sm-3" align="left">To</div>            
                <div class="col-sm-3" align="right"><input type="text" class="form-control" id="to" name="to"></div>
                </div>
             </div>
             <br>
             <table class="table table-hover">
             <thead>
                <tr>
                    <th>Shipper Name</th>
                    <th>Quoted on</th>
                    <th>Quote Value</th>
                    <th>Days</th>
                    <th></th>
                </tr>
                </thead>
             <tbody>
                <tr>
                    <td>demo shipper</td>
                    <td>Aug 20,2018</td>
                    <td>$250</td>
                    <td>10</td>
                    <td><button type="submit" class="btn btn-primary">Accept</button> </td>
                </tr>
                <tr>
                   <td>demo shipper 2</td>
                    <td>Aug 20,2018</td>
                    <td>$300</td>
                    <td>10</td>
                    <td><button type="submit" class="btn btn-primary">Accept</button>
                    <button type="submit" class="btn btn-primary">Reject</td>
                </tr>
             </tbody>
             </table>
             <div id="link"><button type="submit" class="btn btn-primary">Show more</button> </div>              
               </div>
               </form>
<?php include_once("footer.php");?>