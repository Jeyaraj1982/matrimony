<?php include_once("header.php");?>
<script>
function ProfileFormSubmit()
{
    $('#error_name').html("");
    if ($('#name').val().trim().length==0) {
        $('#error_name').html("Please Enter yor name");
        $('#name').focus();
        return false;
    }
    $('#error_date').html("");
    if ($('#date').val().trim().length==0) {
        $('#error_date').html("Please select your date of birth");
        $('#date').focus();
        return false;
    }
    $('#error_aadhar').html("");
    if ($('#aadhar').val().trim().length==0) {
        $('#error_aadhar').html("Please enter your adhar number");
        $('#aadhar').focus();
        return false;
    }
     $('#error_fname').html("");
    if ($('#fname').val().trim().length==0) {
        $('#error_fname').html("Please enter your father name");
        $('#fname').focus();
        return false;
    }
    $('#error_mname').html("");
    if ($('#mname').val().trim().length==0) {
        $('#error_mname').html("Please enter your mother name");
        $('#mname').focus();
        return false;
    }
    $('#error_sister').html("");
    if ($('#sister').val().trim().length==0) {
        $('#error_sister').html("Please enter a no of sisters");
        $('#sister').focus();
        return false;
    }
     $('#error_sister').html("");
    if ($('#sister').val().trim().length==0) {
        $('#error_sister').html("Please enter a no of sisters");
        $('#sister').focus();
        return false;
    }
    $('#error_brother').html("");
    if ($('#brother').val().trim().length==0) {
        $('#error_brother').html("Please enter a no of brothers");
        $('#brother').focus();
        return false;
    }
    
        return true;
    }
</script>
<form method="post" action="" onsubmit="return ProfileFormSubmit()">
        <div class="container"  id="sp">
           <h2>Profile Information</h2><br>
              <?php echo"Member ID";  echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";echo":"; echo"XXXXXXXXXX";?><br>
              <?php echo"Member Name:XXXXXXXXXX";?>
              <br>
              <hr>
              <br>
              <br>
              <div class="form-group">
             <div class="row">
             <div class="col-sm-3">Name:</div>
             <div class="col-sm-9"><input type="text" class="form-control" id="name" name="name"></div>
             <div id="error_name" class="inputerror"></div> 
             </div>
             </div>
             
            <div class="form-group">
            <div class="row">
               <div class="col-sm-3" align="left">Date of birth:</div>
               <div class="col-sm-3" align="right"><input type="date" class="form-control" id="date" name="date"></div>
               <div id="error_date" class="inputerror"></div>
               <div class="col-sm-3" align="left">sex</div>
               <div class="col-sm-3" align="right">
                    <select class="form-control" id="sex"  name="sex">
                       <option>Select</option>
                       <option>Male</option>
                       <option>Female</option>
                    </select>
                    <div id="error_name" class="inputerror"></div></div>
                   </div>   
                   </div>         
                                     
            <div class="form-group">
               <div class="row">
               <div class="col-sm-3" align="left">Religion:</div>
               <div class="col-sm-3" align="right">
                    <select class="form-control" id="religion"  name="religion">
                       <option>Select</option>
                       <option>Hindhu</option>
                       <option>Christian</option>
                       <option>Muslim</option>
                    </select>
                    <div id="error_name" class="inputerror"></div>
                    </div>
               <div class="col-sm-3" align="left">Caste:</div>
               <div class="col-sm-3" align="right">
                    <select class="form-control" id="district"  name="district">
                       <option>Select</option>
                       <option>BC</option>
                       <option>MBC</option>
                       <option>SC</option>
                    </select></div>
                   </div>   
                   </div>      
                   
             <div class="form-group">
               <div class="row">
               <div class="col-sm-3" align="left">Community:</div>
               <div class="col-sm-3" align="right">
                    <select class="form-control" id="community"  name="community">
                       <option>Select</option>
                       <option>XX</option>
                       <option>XX</option>
                       <option>XX</option>
                    </select></div>
               <div class="col-sm-3" align="left">Nationality:</div>
               <div class="col-sm-3" align="right">
                    <select class="form-control" id="nationality"  name="nationality">
                       <option>Select</option>
                       <option>Indian</option>
                       <option>Others</option>
                    </select></div>
                   </div>   
                   </div>      
                   
             <div class="form-group">
               <div class="row">
                <div class="col-sm-3" align="leftt">Adhaar No :</div>         
                <div class="col-sm-3" align="right"><input type="text" class="form-control" id="aadhar" name="aadhaar"></div>
                <div id="error_aadhar" class="inputerror"></div>
                <div class="col-sm-3" align="left"><input type="checkbox" value="" > is handicapped?</div>
                    
               </div>
               </div>
              
               <div class="form-group">
               <div class="row">
                <div class="col-sm-6" align="left"></div>
                <div class="col-sm-3" align="right"><input type="text" class="form-control" id="aadhar1" name="aadhaar1"></div>
                <div id="error_aadhar1" class="inputerror"></div>     
               </div>
               </div>
             <div class="form-group">
                <div class="row">
                <div class="col-sm-3">Fathers Name:</div>
                <div class="col-sm-7"><input type="text" class="form-control" id="fname" name="fname"></div>
                <div id="error_fname" class="inputerror"></div>
                <div class="col-sm-1" align="right"><input type="checkbox" value="" > no more</div>
                
                </div>
             </div>
             
              <div class="form-group">
                <div class="row">
                <div class="col-sm-3">Mothers Name:</div>
                <div class="col-sm-7"><input type="text" class="form-control" id="mname" name="mname"></div>
                <div id="error_mname" class="inputerror"></div>
                <div class="col-sm-1" align="right"><input type="checkbox" value="" >no more</div>
                 
                </div>
             </div>
             
             <div class="form-group">
                <div class="row">
                <div class="col-sm-3" align="left">No of sister:</div>
                <div class="col-sm-1" align="right"><input type="text" class="form-control" id="sister" name="sister"></div> 
                <div id="error_sister" class="inputerror"></div>
                <div class="col-sm-5" align="left">No of brother:</div>
                <div class="col-sm-1" align="left"><input type="text" class="form-control" id="brother" name="brother" width="5px"></div>
                <div id="error_brother" class="inputerror"></div> 
                </div>
             </div>
             <br>
                  <div id="link"><button type="submit" class="btn btn-primary">Save & Continue</button> </div>              
               </div>
               </form>
<?php include_once("footer.php");?>