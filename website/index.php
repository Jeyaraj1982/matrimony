<?php include_once("header.php");?>
        <div id="slideshow" style="background:black;height:600px;">
            <div class="elemnt"></div>
            <div class="elemnt1"></div>
            <div class="col-sm-6"><h2 style="color:white;margin-top: 250px;margin-left: 56px;">No.1 Matrimonial Site<br>Find your Special Someone</h2></div>
            <div class="col-sm-6" style="padding-left:100px">
                <div style="background:white ;height: 500px;width: 453px;margin-top: 50px;padding-top:34px;border-radius: 10px;">
                     <p style="text-align: center;color:#666666;font-size: 15px;margin-bottom: 2px;">Best Matrimonial Services</p>
                     <p style="text-align: center;color: #E3425B;font-size: 21px;"><b>MEMBER REGISTRATION FREE!</b></p>
                     
       <script>

$(document).ready(function () {
   
   $("#MobileNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrMobileNumber").html("Digits Only").fadeIn().fadeIn("fast");
               return false;
    }
   });
   $("#Name").blur(function () {
    
        IsNonEmpty("Name","ErrName","Please Enter Name");
                        
   });
   $("#Gender").blur(function () {
    
        IsNonEmpty("Gender","ErrGender","Please Select gender");
                        
   });
   
   $("#DOB").blur(function () {
    
        IsNonEmpty("DOB","ErrDOB","Please Enter Date of Birth");
                        
   });
   $("#Month").blur(function () {
    
        IsNonEmpty("Month","ErrMonth","Please Enter Date of Birth");
                        
   });
   $("#Year").blur(function () {
    
        IsNonEmpty("Year","ErrYear","Please Enter Date of Birth");
                        
   });
   $("#MobileNumber").blur(function () {
    
        IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter Mobile Number");
                        
   });
  
   $("#Email").blur(function () {
    
        IsNonEmpty("Email","ErrEmail","Please Enter Email ID");
                        
   });
   $("#Captchatext").blur(function () {
    
        IsNonEmpty("Captchatext","ErrCaptchatext","Please enter what you see in image");
                        
   }); 
   
   
   $("#LoginPassword").blur(function () {
                  
       if (IsNonEmpty("LoginPassword","ErrLoginPassword","Please Enter Login Password")) {
       IsPassword("LoginPassword","ErrLoginPassword","Please Enter Alpha Numeric Characters and More than 8 characters");  
                  
                        } 
   });
});
 
function submitregform() {
                         $('#ErrName').html("");
                         $('#ErrGender').html("");
                         $('#ErrMonth').html("");
                         $('#ErrYear').html("");
                         $('#ErrSex').html("");
                         $('#ErrMobileNumber').html("");
                         $('#ErrWhatsappNumber').html("");
                         $('#ErrEmail').html("");
                         $('#ErrLoginPassword').html("");
                         $('#ErrCaptchatext').html("");
                         
                         ErrorCount=0;
                        
                        
                        if (IsNonEmpty("Name","ErrName","Please enter your name")) {
                        IsAlphabet("Name","ErrName","Please enter alpha numeric characters only");
                        }
                        IsNonEmpty("Gender","ErrGender","Please enter valid gender");
                        IsNonEmpty("check","Errcheck","Please agree");
                        if (IsNonEmpty("MobileNumber","ErrMobileNumber","Please enter your mobile number")) {
                        IsMobileNumber("MobileNumber","ErrMobileNumber","Please enter valid Mobile Number");
                        }
                       
                        if (IsNonEmpty("Email","ErrEmail","Please enter email")) {
                            IsEmail("Email","ErrEmail","Please enter valid email id");    
                        }
                        if (IsNonEmpty("LoginPassword","ErrLoginPassword","Please enter login password")) {
                            IsPassword("LoginPassword","ErrLoginPassword","Please Enter alpha numeric characters and more than 8 characters");  
                        }
                         
                        if(document.form1.Captchatext.value==""){
                           document.getElementById("ErrCaptchatext").innerHTML="Please enter what you see in image";
                           return false;
                           }
                        if(document.form1.ran.value!=document.form1.Captchatext.value){
                           document.getElementById("ErrCaptchatext").innerHTML="Captcha Not Matched!";
                           return false;
                           }
                           if(document.form1.check.checked == false){
                               document.getElementById("Errcheck").innerHTML="if yo agree please selcet!";
                                   alert ('if yo agree please select');
                                  return false;}
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 
}                                                
</script>         
<?php                   
                            if (isset($_POST['BtnRegister'])) {         
                                $response = $webservice->Register($_POST);
                                if ($response['status']=="success") {
                                    $_SESSION['MemberDetails']=$response['data'];
                                    ?>
                                    
                                    <script>
                                    setTimeout(function(){location.href='http://nahami.online/sl/Dashboard/'; },1000);
                                    </script>
                                    <?php
                                } else {
                                    $errormessage = $response['message']; 
                                }
                            }
                        ?>
                      <?php
//Random Number Generation
$rand=substr(rand(),0,4);//only show 4 numbers
?>
                     <form method="POST" action="<?php $_SERVER['PHP_SELF']?>" name="form1" onsubmit="return submitregform();">
                        <div class="col-sm-12" style="margin-bottom:6px">
                                <div class="col-sm-4"><div style="float: right;">Name</div></div>
                                <div class="col-sm-8"><input type="text" name="Name" id="Name" placeholder="Name" value="<?php echo isset($_POST['Name']) ? $_POST['Name'] : '';?>">
                                <span class="errorstring" id="ErrName"><?php echo isset($ErrName)? $ErrName : "";?></span></div>
                        </div>
                        <div class="col-sm-12" style="margin-bottom:6px">
                                <div class="col-sm-4"><div style="float: right">Gender</div></div>
                                <div class="col-sm-8">
                                    <select name="Gender" id="Gender">
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                    <span class="errorstring" id="ErrMemberCode"><?php echo isset($ErrGender)? $ErrGender : "";?></span>
                                </div>
                        </div>
                          <div class="col-sm-12" style="margin-bottom:0px">
                                <div class="col-sm-4"><div style="float: right;">Mobile Number</div></div>
                                <div class="col-sm-3" style="width: 35%;margin-right: -87px;">
                                    <select name="CountryCode" id="CountryCode" style="padding-left: 2px;width: 45%;font-size: 12px;">
                                        <option value="+91">+91</option>
                                        <option value="+1">+1</option>
                                        <option value="+44">+44</option>
                                    </select>
                                </div> 
                                <div class="col-sm-3" style="width: 35%;"><input type="text" name="MobileNumber" id="MobileNumber" maxlength="10" placeholder="Mobile Number" value="<?php echo isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : '';?>" style="width:136%;">
                                </div>
                          </div>
                          <div class="col-sm-12" style="margin-bottom:6px">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-8"><span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span></div>
                          </div>
                          <div class="col-sm-12" style="margin-bottom:6px">
                                <div class="col-sm-4"><div style="float: right;">Email</div></div>
                                <div class="col-sm-8"><input type="text" name="Email" id="Email" placeholder="Email" autocomplete="off" value="<?php echo isset($_POST['Email']) ? $_POST['Email'] : '';?>">
                                <span class="errorstring" id="ErrEmail"><?php echo isset($ErrEmail)? $ErrEmail : "";?></span></div>
                          </div>
                          <div class="col-sm-12" style="margin-bottom:6px">
                                <div class="col-sm-4"><div style="float: right;">Login Password</div></div>
                                <div class="col-sm-8"><input type="password" name="LoginPassword" id="LoginPassword" placeholder="Password" value="<?php echo isset($_POST['LoginPassword']) ? $_POST['LoginPassword'] : '';?>">
                                <span class="errorstring" id="ErrLoginPassword"><?php echo isset($ErrLoginPassword)? $ErrLoginPassword : "";?></span></div>
                          </div>
                          <div class="col-sm-12" style="margin-bottom:6px">
                                <div class="col-sm-4"><div style="float: right;">Captcha</div></div>
                                <div class="col-sm-8"><input type="text" value="<?=$rand?>" id="ran" readonly="readonly" class="captcha" style="background-image: url(assets/images/captcha_background.png);margin-bottom: 6px;border: none;width: 160px;height: 60px;text-align: center;font-size: 49px;"><br><input type="text" name="Captchatext" id="Captchatext" placeholder="Enter Code" value="<?php echo isset($_POST['Captchatext']) ? $_POST['Captchatext'] : '';?>">
                                <span class="errorstring" id="ErrCaptchatext"><?php echo isset($ErrCaptchatext)? $ErrCaptchatext : "";?></span></div>
                          </div>
                          <div class="col-sm-12" style="text-align: center;color:red"><?php echo $errormessage ;?></div>
                          <div class="col-sm-12" style="margin-bottom:6px;margin-top: 10px;">
                                <input type="checkbox" style="width: 8%;" id="check" name="check"><label for="check" style="cursor:pointer;font-weight: 400;">I agree to this </label><a href="terms-and-conditions" style="cursor: pointer;outline: 0">T&C </a>and <a href="privacy" style="cursor: pointer;outline:0">Privacy Policy</a>
                                <span class="errorstring" id="Errcheck"><?php echo isset($Errcheck)? $Errcheck : "";?></span></div>
                          <div class="col-sm-12" style="margin-bottom:6px;text-align:right">
                          <div class="col-sm-4"></div>
                          <div class="col-sm-8"><button type="submit" name="BtnRegister" id="BtnRegister" class="btn btn-primary" ><b>REGISTER NOW</b></button></div>
                          </div>
                     </form>
                </div>
            </div>


        </div>
    <div style="background: linear-gradient(45deg, rgba(184,36,117,1) 0%, rgba(218,52,77,1) 100%);height:90px;margin-top:-5px;color:white">
    <div class="clearfix banner-quote-wrap hidden-xs cz-color-3355443">
        <div class="container cz-color-3355443" style="padding-left: 228px;">
            <div class="row cz-color-3355443">
                <div class="col-xs-12 col-md-12 cz-color-3355443">
                    <div class="tab-quick-search cz-color-3355443" style="margin-top: 15px;">
                        <form method="post" name="searchfrm" class="cz-color-3355443" action="search-result">
                            <div class="row cz-color-3355443">
                                <div id="qc-field1" class="col-xs-5 col-sm-2 padright0 cz-color-3355443">
                                    <div class="form-group cz-color-3355443">
                                        <label class="control-label cz-color-16777215" style="color: white;">I'm looking for a</label>
                                        <select class="form-control cz-color-5592405 cz-color-16777215" name="gender">
                                            <option value="M" class="cz-color-16777215 cz-color-16750899">Male</option>
                                            <option value="F" class="cz-color-5592405">Female</option>
                                        </select>
                                        <span class="arrow-cusbm cz-color-0"><i class="fa fa-angle-down cz-color-0"></i></span> </div>
                                </div>
                                <div id="qc-field2" class="col-xs-7 col-sm-3 padright0 cz-color-3355443">
                                    <div class="row cz-color-3355443">
                                        <div id="qc-field2-1" class="col-xs-6 col-sm-6 padright0 cz-color-3355443">
                                            <div class="form-group cz-color-3355443">
                                                <label class="control-label cz-color-16777215" style="color: white;">Aged</label>
                                                <select class="form-control cz-color-5592405 cz-color-16777215" name="fromAge">
                                                    <option value="18" selected="" class="cz-color-16777215 cz-color-16750899">18</option>
                                                    <option value="19" class="cz-color-5592405">19</option>
                                                    <option value="20" class="cz-color-5592405">20</option>
                                                    <option value="21" class="cz-color-5592405">21</option>
                                                    <option value="22" class="cz-color-5592405">22</option>
                                                    <option value="23" class="cz-color-5592405">23</option>
                                                    <option value="24" class="cz-color-5592405">24</option>
                                                    <option value="25" class="cz-color-5592405">25</option>
                                                    <option value="26" class="cz-color-5592405">26</option>
                                                    <option value="27" class="cz-color-5592405">27</option>
                                                    <option value="28" class="cz-color-5592405">28</option>
                                                    <option value="29" class="cz-color-5592405">29</option>
                                                    <option value="30" class="cz-color-5592405">30</option>
                                                    <option value="31" class="cz-color-5592405">31</option>
                                                    <option value="32" class="cz-color-5592405">32</option>
                                                    <option value="33" class="cz-color-5592405">33</option>
                                                    <option value="34" class="cz-color-5592405">34</option>
                                                    <option value="35" class="cz-color-5592405">35</option>
                                                    <option value="36" class="cz-color-5592405">36</option>
                                                    <option value="37" class="cz-color-5592405">37</option>
                                                    <option value="38" class="cz-color-5592405">38</option>
                                                    <option value="39" class="cz-color-5592405">39</option>
                                                    <option value="40" class="cz-color-5592405">40</option>
                                                    <option value="41" class="cz-color-5592405">41</option>
                                                    <option value="42" class="cz-color-5592405">42</option>
                                                    <option value="43" class="cz-color-5592405">43</option>
                                                    <option value="44" class="cz-color-5592405">44</option>
                                                    <option value="45" class="cz-color-5592405">45</option>
                                                    <option value="46" class="cz-color-5592405">46</option>
                                                    <option value="47" class="cz-color-5592405">47</option>
                                                    <option value="48" class="cz-color-5592405">48</option>
                                                    <option value="49" class="cz-color-5592405">49</option>
                                                    <option value="50" class="cz-color-5592405">50</option>
                                                    <option value="51" class="cz-color-5592405">51</option>
                                                    <option value="52" class="cz-color-5592405">52</option>
                                                    <option value="53" class="cz-color-5592405">53</option>
                                                    <option value="54" class="cz-color-5592405">54</option>
                                                    <option value="55" class="cz-color-5592405">55</option>
                                                    <option value="56" class="cz-color-5592405">56</option>
                                                    <option value="57" class="cz-color-5592405">57</option>
                                                    <option value="58" class="cz-color-5592405">58</option>
                                                    <option value="59" class="cz-color-5592405">59</option>
                                                    <option value="60" class="cz-color-5592405">60</option>
                                                    <option value="61" class="cz-color-5592405">61</option>
                                                    <option value="62" class="cz-color-5592405">62</option>
                                                    <option value="63" class="cz-color-5592405">63</option>
                                                    <option value="64" class="cz-color-5592405">64</option>
                                                    <option value="65" class="cz-color-5592405">65</option>
                                                    <option value="66" class="cz-color-5592405">66</option>
                                                    <option value="67" class="cz-color-5592405">67</option>
                                                    <option value="68" class="cz-color-5592405">68</option>
                                                    <option value="69" class="cz-color-5592405">69</option>
                                                    <option value="70" class="cz-color-5592405">70</option>
                                                </select>
                                                <span class="arrow-cusbm cz-color-0"><i class="fa fa-angle-down cz-color-0"></i></span> </div>
                                        </div>
                                        <div id="qc-field2-2" class="col-xs-6 col-sm-6 cz-color-3355443">
                                            <div class="form-group cz-color-3355443">
                                                <label class="control-label cz-color-16777215">&nbsp;</label>
                                                <select class="form-control cz-color-5592405 cz-color-16777215" name="toAge">
                                                    <option value="18" class="cz-color-5592405">18</option>
                                                    <option value="19" class="cz-color-5592405">19</option>
                                                    <option value="20" class="cz-color-5592405">20</option>
                                                    <option value="21" class="cz-color-5592405">21</option>
                                                    <option value="22" class="cz-color-5592405">22</option>
                                                    <option value="23" class="cz-color-5592405">23</option>
                                                    <option value="24" class="cz-color-5592405">24</option>
                                                    <option value="25" selected="" class="cz-color-16777215 cz-color-16750899">25</option>
                                                    <option value="26" class="cz-color-5592405">26</option>
                                                    <option value="27" class="cz-color-5592405">27</option>
                                                    <option value="28" class="cz-color-5592405">28</option>
                                                    <option value="29" class="cz-color-5592405">29</option>
                                                    <option value="30" class="cz-color-5592405">30</option>
                                                    <option value="31" class="cz-color-5592405">31</option>
                                                    <option value="32" class="cz-color-5592405">32</option>
                                                    <option value="33" class="cz-color-5592405">33</option>
                                                    <option value="34" class="cz-color-5592405">34</option>
                                                    <option value="35" class="cz-color-5592405">35</option>
                                                    <option value="36" class="cz-color-5592405">36</option>
                                                    <option value="37" class="cz-color-5592405">37</option>
                                                    <option value="38" class="cz-color-5592405">38</option>
                                                    <option value="39" class="cz-color-5592405">39</option>
                                                    <option value="40" class="cz-color-5592405">40</option>
                                                    <option value="41" class="cz-color-5592405">41</option>
                                                    <option value="42" class="cz-color-5592405">42</option>
                                                    <option value="43" class="cz-color-5592405">43</option>
                                                    <option value="44" class="cz-color-5592405">44</option>
                                                    <option value="45" class="cz-color-5592405">45</option>
                                                    <option value="46" class="cz-color-5592405">46</option>
                                                    <option value="47" class="cz-color-5592405">47</option>
                                                    <option value="48" class="cz-color-5592405">48</option>
                                                    <option value="49" class="cz-color-5592405">49</option>
                                                    <option value="50" class="cz-color-5592405">50</option>
                                                    <option value="51" class="cz-color-5592405">51</option>
                                                    <option value="52" class="cz-color-5592405">52</option>
                                                    <option value="53" class="cz-color-5592405">53</option>
                                                    <option value="54" class="cz-color-5592405">54</option>
                                                    <option value="55" class="cz-color-5592405">55</option>
                                                    <option value="56" class="cz-color-5592405">56</option>
                                                    <option value="57" class="cz-color-5592405">57</option>
                                                    <option value="58" class="cz-color-5592405">58</option>
                                                    <option value="59" class="cz-color-5592405">59</option>
                                                    <option value="60" class="cz-color-5592405">60</option>
                                                    <option value="61" class="cz-color-5592405">61</option>
                                                    <option value="62" class="cz-color-5592405">62</option>
                                                    <option value="63" class="cz-color-5592405">63</option>
                                                    <option value="64" class="cz-color-5592405">64</option>
                                                    <option value="65" class="cz-color-5592405">65</option>
                                                    <option value="66" class="cz-color-5592405">66</option>
                                                    <option value="67" class="cz-color-5592405">67</option>
                                                    <option value="68" class="cz-color-5592405">68</option>
                                                    <option value="69" class="cz-color-5592405">69</option>
                                                    <option value="70" class="cz-color-5592405">70</option>
                                                </select>
                                                <span class="arrow-cusbm cz-color-0"><i class="fa fa-angle-down cz-color-0"></i></span> </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="qc-field3" class="col-xs-5 col-sm-2 padright0 cz-color-3355443">
                                    <div class="form-group cz-color-3355443">
                                        <label class="control-label cz-color-16777215" style="color: white;">Religion</label>
                                        <select class="form-control cz-color-5592405 cz-color-16777215" name="partnerReligion" style="text-align: left;">
                                            <option value="" class="cz-color-5592405">Select</option>
                                            <option value="3" selected="" class="cz-color-16777215 cz-color-16750899">Hindu</option>
                                            <option value="6" class="cz-color-5592405">Christian</option>
                                            <option value="7" class="cz-color-5592405">Parsi</option>
                                            <option value="8" class="cz-color-5592405">Buddhist</option>
                                            <option value="10" class="cz-color-5592405">Jain</option>
                                            <option value="11" class="cz-color-5592405">Muslim</option>
                                            <option value="12" class="cz-color-5592405">Sick</option>
                                            <option value="13" class="cz-color-5592405">Sindhi</option>
                                            <option value="102" class="cz-color-5592405">Oriya</option>
                                        </select>
                                        <span class="arrow-cusbm cz-color-0"><i class="fa fa-angle-down cz-color-0"></i></span> </div>
                                </div>
                                <div id="qc-field5" class="col-xs-12 col-sm-3 col-md-2 cz-color-3355443">
                                    <div class="form-group cz-color-3355443">
                                        <label class="control-label color-transparent hidden-xs cz-color-16777215">&nbsp;</label>
                                        <button type="submit" name="search" class="btn btn-primary btn-block btn-darkgrey cz-color-16777215" id="btn-quich-search" onclick="">Start Search</button>
                                    </div>
                                </div>
                                <div class="col-sm-2 cz-color-3355443"> </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div style="background: linear-gradient(to right, rgba(191,50,128,1) 0%, rgba(227,66,90,1) 100%);min-height:551px;margin-top:-5px;color:white;padding-top:15px">                                      
        <h2 style="text-align:center;font-size: 37px;">Best Matrimonial Service</h2>
        <p style="text-align: center;color:#dbdbdb;font-size: 23px;margin-bottom: -2px;">No Hidden Charges</p>
        <p style="text-align: center;color: #dbdbdb;font-size: 26px;">Provide a pleasant, satisfying, and superior matchmaking experience</p>
        <div class="kvline-1"></div>
        <div class="kvline-2"></div>
        <div class="kvline-3"></div>
        <div class="col-sm-12" style="margin-top:50px">
            <div class="col-sm-1" style="width: 11.333%;"></div>
            <div class="col-sm-3" class="Reg" style="text-align: center;"><div class="memberinner"><img src="assets/images/bt-icon-free-to-reg.png"><br><h3>Sign up</h3><p>Register for free <br>&amp; Create Unlimited Profiles</p></div></div>
            <div class="col-sm-3" class="Reg" style="text-align: center;"><div class="memberinner"><img src="assets/images/bt-icon-free-to-search.png"><br><h3>Select your Match</h3><p>Send Interest to<br> Matches you like</p></div></div>
            <div class="col-sm-3" class="Reg" style="text-align: center;"><div class="memberinner"><img src="assets/images/bt-icon-free-to-talk.png"><br><h3>Contact</h3><p>Talk them directly <br>through phone</p></div></div>
        </div>
    </div>
    <div style="background:#F2F2F2;height:1005px;margin-top:-5px;padding-top:30px">
          <h2 style="text-align:center;font-size: 37px;color: #BF3280;">Brides & Grooms</h2>
          <p style="text-align: center;color:#333333;margin-bottom: -2px;display: block;font-weight: 300;color: #333;font-size: 24px;">Find your Life Partner from thousands of profiles.</p>
          <div class="kvline-1"></div>
          <div class="kvline-2"></div>
          <div class="kvline-3"></div>
          <div style="padding-left:15px;padding-right:15px">
          <?php                
     for($i=1;$i<4;$i++) { ?>
          <div class="col-sm-12" style="margin-left: 17px;">
            <div class="col-sm-4" style="background: white;height: 221px;width:365px;margin-right: 30px;margin-bottom: 35px;">
                <div class="col-sm-2" style="margin-right: 76px;"><img src="assets/images/girl1.jpg" style="margin-left: -23px;width: 533%;margin-top: 6px;"></div>
                <div class="col-sm-2" style="width:35.667%; ;">
                <h3 style="color: #81187f;">ISWARIYA</h3>
                <h5 style="padding-bottom: 10px;">23 years</h5>
                <h4 style="font-size: 17px;line-height: 22px">BDS ,</h4><h4 style="font-size: 17px;line-height:0px">Madurai</h4>
                <a style="color:#3897f0;font-size: 17px;line-height:46px">View Profile</a>
                </div>
            </div>
            <div class="col-sm-4" style="background: white;height: 221px;width:365px;margin-right: 30px;margin-bottom: 35px;">
                <div class="col-sm-2" style="margin-right: 76px;"><img src="assets/images/boy1.jpg" style="margin-left: -23px;width:533%;height:195px; margin-top: 6px;"></div>
                <div class="col-sm-2" style="width:35.667%; ;">
                <h3 style="color: #81187f;">Akash</h3>
                <h5 style="padding-bottom: 10px;">28 years</h5>
                <h4 style="font-size: 17px;line-height: 22px">BDS ,</h4><h4 style="font-size: 17px;line-height:0px">Madurai</h4>
                <a style="color:#3897f0;font-size: 17px;line-height:46px">View Profile</a>
                </div>
            </div>
            <div class="col-sm-4" style="background: white;height: 221px;width:365px;margin-right: 30px;margin-bottom: 35px;">
                <div class="col-sm-2" style="margin-right: 76px;"><img src="assets/images/girl1.jpg" style="margin-left: -23px;width: 533%;margin-top: 6px;"></div>
                <div class="col-sm-2" style="width:35.667%; ;">
                <h3 style="color: #81187f;">ISWARIYA</h3>
                <h5 style="padding-bottom: 10px;">23 years</h5>
                <h4 style="font-size: 17px;line-height: 22px">BDS ,</h4><h4 style="font-size: 17px;line-height:0px">Madurai</h4>
                <a style="color:#3897f0;font-size: 17px;line-height:46px">View Profile</a>
                </div>
            </div>
          </div>
          
          <?php
     } ?>
    </div> 
</div>
<div class="backgroundbanersection">
   <div class="col-sm-6"></div> 
   <div class="col-sm-6" style="color: white;text-align: center;margin-top: 129px;"><h2>Register with us <br>To choose life partner from your own Community.</h2><br>
        <img src="">
   </div> 
</div>
 <div style="background:#ffffff;height:480px;margin-top:-5px;padding-top:30px">
          <h2 style="text-align:center;font-size: 37px;color: #BF3280;">Success Stories</h2>
          <p style="text-align: center;color:#333333;margin-bottom: -2px;display: block;font-weight: 300;color: #333;font-size: 24px;">Happy Stories of Marriages.</p>
          <div class="kvline-1"></div>
          <div class="kvline-2"></div>
          <div class="kvline-3"></div>
          <div style="padding-left:30px;margin-top: 50px;">
            <div class="col-sm-4" style="margin-right:10px;width: 31.333%;"><img src="assets/images/brideimage1.jpg" class="img-responsive" height="250" width="100%"></div>
            <div class="col-sm-4" style="margin-right:10px;width: 31.333%;"><img src="assets/images/brideimage1.jpg" class="img-responsive" height="250" width="100%"></div>
            <div class="col-sm-4" style="margin-right:10px;width: 31.333%;"><img src="assets/images/brideimage1.jpg" class="img-responsive" height="250" width="100%"></div>
          </div>
          <div class="happy-album-info" style="display: none;">
<h3>Nandha Kumar &amp; Sumathi Renuga</h3>
<p>
Best of Luck, Thanks a lot for helping me find my best life partner. We really benefited from all the services provided by you.... </p>
<a class="a-btn-2 button" href="javascript:void(0)">More Profiles <i class="fa fa-long-arrow-right"></i></a> </div>
</div>
   <div style="height:100px;background: linear-gradient(to right, rgba(15,182,82,1) 0%, rgba(10,206,163,1) 100%);color:white">
    <div style="margin-left:30px">
        <div class="col-sm-4" style="width: 36.333%;"><h3 style="color: #fff;font-size: 20px;text-align: left;line-height: normal;padding-top: 13px;font-family: 'Crafty Girls', cursive;">Trusted by Brides & Grooms</h3></div>
        <div class="col-sm-1" style="padding-top:23px;width:6.333%"><p class="sp mt-icon4"></p></div>
        <div class="col-sm-1" style="padding-top:38px;width: 14.333%;font-size: 18px;"><p>Genuine Contacts</p></div>
        <div class="col-sm-1" style="padding-top:23px;width:6.333%"><p class="sp mt-icon5"></p></div>
        <div class="col-sm-1" style="padding-top:38px;width: 15.333%;font-size: 18px;"><p>Secured Matrimony </p></div>
        <div class="col-sm-1" style="padding-top:23px;width:6.333%"><p class="sp mt-icon3"></p></div>
        <div class="col-sm-1" style="padding-top:38px;width: 14.333%;font-size: 18px;"><p>Register Free</p></div>
        <div class="col-sm-1"></div>
    </div>
   </div>
   <div style="margin-top: 50px;margin-bottom: 50px;">
        <div class="square-logo"> <img src="" class="img-responsive"> </div>
        <div class="col-sm-12">
            <h2 style="color: #e3425b;font-size: 30px;margin: 0 0 25px;margin-bottom: 25px;text-align: center;font-weight: 400;margin-bottom: 20px;line-height: normal;">For Successful Marriages</h2>
            <div class="kvline-1"></div>
            <div class="kvline-2"></div>
            <div class="kvline-3" style="margin-bottom:50px"></div>
        </div>
        <div style="margin-left:59px;margin-right: 30px;height: 300px;margin-top: 50px;">
            <div class="col-sm-5" style="margin-right: -32px;"><img src="assets/images/brideimage1.jpg" width="96%" height="300px"></div>
            <div class="col-sm-7" style="background:#f2f2f2;height: 300px;">
                <div class="intro-details">
                    <h5 class="subtitle">1000s of successful Marriages trusted by Brides &amp; Grooms</h5>
                    <div class="h1-title">
                        <div class="h1-title-icon"><p class="sp icon-intrust"></p></div>
                            No.1 Matrimonial Site.
                        </div>
                    <div class="text">We make happy marriages providing the most secure and convenient matchmaking experience to all its members. We help you to find your right and best Life Partner.</div>
                </div>
            </div>
        </div>
   </div>                                                                                                                         
   <div style="margin-top: 150px;background: #f5f5f5;">     
     <div class="section-downloadapp">
        <div class="container" style="padding-right: 15px;padding-left: 15px;">
            <div class="row" style="margin-right: -60px;margin-left: -3px;">
                <div class="col-xs-12 col-md-5">
                    <div class="mobile-app-content">
                        <h2>No need to install mobile matrimony app</h2>
                        <h4>Access our website from smartphone browser without installing mobile apps</h4>
                        <p>You can use our mobile website wherever you are, without having to download anything, mobile-friendly websites which look great on all mobile browsers and all screen sizes, including mobile phones, tablets and desktops. The fastest way to find your perfect life partner.</p>
                    </div>
                </div>
              <div class="col-xs-12 col-md-7"> <img src="assets/images/bt-android-app-screen.jpg" class="img-responsive"> </div>
            </div>
        </div>
     </div>
   </div>
   <!--<div class="banner-ads" style="padding-left: 79px;padding-right: 72px;">
    <div class="row">
        <div class="col-sm-6"> <a href="http://kammavarkalyanamalai.com/"><img src="images/banner-kammavar.jpg" class="img-responsive" width="100%"></a> </div>
        <div class="col-sm-6"> <a href="http://www.angelmatrimony.com/"><img src="images/banner-angel.jpg" class="img-responsive" style="width:100%;height: 142px;border-radius: 12px;"></a> </div>
    </div>
   </div>-->

  <?php include_once("footer.php");?>
   
  