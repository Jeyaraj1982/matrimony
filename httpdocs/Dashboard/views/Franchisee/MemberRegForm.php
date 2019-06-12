<?php include_once("header.php");?>
<script>
function RegFormSubmit()
{
    $('#error_name').html("");
    if ($('#name').val().trim().length==0) {
        $('#error_name').html("Please Enter yor name");
        $('#name').focus();
        return false;
    }
    $('#error_sex').html("");
    if ($('#sex').val().trim().length==0) {
        $('#error_sex').html("Please select a Gender");
        $('#sex').focus();
        return false;
    }
    $('#error_email').html("");
    if ($('#email').val().trim().length==0) {
        $('#error_email').html("Please enter your valid email address");
        $('#email').focus();
        return false;
    }
    $('#error_date').html("");
    if ($('#date').val().trim().length==0) {
        $('#error_date').html("Please select a date");
        $('#date').focus();
        return false;
    }
    $('#error_mobilenumber').html("");
    if ($('#mobilenumber').val().trim().length==0) {
        $('#error_mobilenumber').html("Please enter your mobile number");
        $('#mobilenumber').focus();
        return false;
    }
    $('#error_whatsapp').html("");
    if ($('#whatsapp').val().trim().length==0) {
        $('#error_whatsapp').html("Please enter your whatsapp number");
        $('#whatsapp').focus();
        return false;
    }
    $('#error_password').html("");
    if ($('#password').val().trim().length==0) {
        $('#error_password').html("Please enter your password");
        $('#password').focus();
        return false;
    }
    $('#error_aadhar').html("");
    if ($('#aadhar').val().trim().length==0) {
        $('#error_aadhar').html("Please enter your Adhar number");
        $('#aadhar').focus();
        return false;
    }
    $('#error_comunication').html("");
    if ($('#comunication').val().trim().length==0) {
        $('#error_comunication').html("Please enter your address");
        $('#comunication').focus();
        return false;
    }
    $('#error_address').html("");
    if ($('#address').val().trim().length==0) {
        $('#error_address').html("Please enter your address");
        $('#address').focus();
        return false;
    }
    $('#error_address1').html("");
    if ($('#address1').val().trim().length==0) {
        $('#error_address1').html("Please enter your address");
        $('#address1').focus();
        return false;
    }
     $('#error_pincode').html("");
    if ($('#pincode').val().trim().length==0) {
        $('#error_pincode').html("Please enter your pincode");
        $('#pincode').focus();
        return false;
    }
        return true;
    }
</script>
<form method="post" action="MemberRegformCompleted.php" onsubmit="return RegFormSubmit();">
        <div class="container"  id="sp">
           <h2>Member Registration Form</h2><br>
            <div class="form-group">
            <div class="row">
               <div class="col-sm-3" align="left">Person  Name</div>
               <div class="col-sm-3" align="right"><input type="name" class="form-control" id="name" name="name"></div>
               <div id="error_name" class="inputerror"></div>
               <div class="col-sm-3" align="left">sex:</div>
               <div class="col-sm-3" align="right">
                    <select class="form-control" id="sex"  name="sex">
                       <option>Select</option>
                       <option>Male</option>
                       <option>Female</option>
                    </select>
                    <div id="error_sex" class="inputerror"></div>
                    </div>                    
                   </div>   
                   </div>         
             <br>                          
            <div class="form-group">
                <div class="row">
                <div class="col-sm-3" align="left">Email  Address:</div>
                <div class="col-sm-3" align="right"><input type="email" class="form-control" id="email" name="email" ></div>
                <div id="error_email" class="inputerror"></div>                       
                <div class="col-sm-3" align="left">Date of birth:</div>            
                <div class="col-sm-3" align="right"><input type="date" class="form-control" id="date" name="date"></div>
                <div id="error_date" class="inputerror"></div>
             </div>
             </div>
             <br>
             <div class="form-group">
              <div class="row">
                <div class="col-sm-3" align="left">Mobile Number:</div>
                <div class="col-sm-3" align="right"><input type="text" class="form-control" id="mobilenumber" name="mobilenumber"></div>
                <div id="error_mobilenumber" class="inputerror"></div>       
                <div class="col-sm-3" align="left">Whatsapp :</div>         
                <div class="col-sm-3" align="right"><input type="text" class="form-control" id="whatsapp" name="whatsapp"></div>
                <div id="error_whatsapp" class="inputerror"></div>
             </div>
             </div>
             <br>
             <div class="form-group">
               <div class="row">
                <div class="col-sm-3" align="left">Password:</div>
                <div class="col-sm-3" align="right"><input type="password" class="form-control" id="password" name="password"></div>
                <div id="error_password" class="inputerror"></div>        
                <div class="col-sm-3" align="left">Adhaar No :</div>         
                <div class="col-sm-3" align="right"><input type="text" class="form-control" id="aadhar" name="aadhaar"></div>
                <div id="error_aadhar" class="inputerror"></div>
             </div>
             </div>
             <br>
            <!--<div class="form-group">
            <label class="col-md-4 control-label">Password</label>
            <div class="col-md-6">
              <input id="password-field" type="password" class="form-control" name="password" value="secret">
              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
          </div>
            <br>-->
             <div class="form-group">
             <div class="row">
             <div class="col-sm-3">CommunicationAddress:</div>
             <div class="col-sm-9"><input type="text" class="form-control" id="comunication" name="comunication"></div>
             <div id="error_comunication" class="inputerror"></div> 
             </div>
             </div>
             <br>
             <div class="form-group">
             <div class="row">
             <div class="col-sm-3"></div>
             <div class="col-sm-9"><input type="text" class="form-control" id="address" name="address"></div>
             <div id="error_address" class="inputerror"></div> 
             </div>
             </div>
             <br>
             <div class="form-group">
               <div class="row">
                <div class="col-sm-3" align="left"></div>
                <div class="col-sm-3" align="right"><input type="text" class="form-control" id="address1" name="address1"></div> 
                <div id="error_address1" class="inputerror"></div>       
                <div class="col-sm-3" align="left">Pincode :</div>         
                <div class="col-sm-3" align="right"><input type="text" class="form-control" id="pincode" name="pincode"></div>
                <div id="error_pincode" class="inputerror"></div>
             </div>
             </div>
             <br>
             <div class="form-group">
               <div class="row">
               <div class="col-sm-3" align="left">State  Name:</div>
               <div class="col-sm-3" align="right">
                    <select class="form-control" id="state"  name="state">
                       <option>Select</option>
                       <option>TamilNadu</option>
                       <option>Kerala</option>
                       <option>Karnataka</option>
                    </select>
                    <div id="error_state" class="inputerror"></div>
                    </div>
               <div class="col-sm-3" align="left">District:</div>
               <div class="col-sm-3" align="right">
                    <select class="form-control" id="district"  name="district">
                       <option>Select</option>
                       <option>Kanyakumari</option>
                       <option>Trinelveli</option>
                       <option>Tuticorn</option>
                    </select>
                    <div id="error_district" class="inputerror"></div>
                    </div>
                   </div>   
                   </div>      
                   <br>   
                  
                  <div id="link"><button type="submit" class="btn btn-primary">Create Member</button> </div>              
               </div>
               </form>
<?php include_once("footer.php");?>