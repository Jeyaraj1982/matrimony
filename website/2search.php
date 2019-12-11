<?php
    $isShowSlider = false;
    $layout=0;
    include_once("includes/header.php");
?>  <br><br><br>
    <div class="row">
        <div class="status alert alert-success" style="display: none"></div>
        <div class="col-sm-3"></div>    
        <div class="col-sm-6" style="text-align: center;">
            <div style="text-align: center;">
                <h2>Search</h2>
            </div>
            <div id="sendmessage"></div>
            <div id="errormessage"></div>
            <form action="login" method="post" role="form" class="contactForm">
                <table style="margin: 0px auto;line-height: 28px;color: #333;min-width: 250px;">
                    <tr>
                            <td colspan="3">
                                <div class="form-group">
                                Looking For<br>
                                    <select name="LookingFor" class="form-control" id="Gender" style="padding: 4px;">
                                        <option>Bride</option>
                                        <option>Groom</option>
                                    </select> 
                                </div>
                            </td>
                        </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                Age <br>
                               <select name="Age" class="form-control" id="Age" style="padding: 4px;">
                                      <?php for($i=18;$i<=70;$i++) {?>
                                            <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                                        <?php } ?>
                                    </select>
                            </div>
                        </td>
                        <td style="text-align: center;">
                            <div class="form-group">
                                To <br>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                 <br>
                               <select name="Age" class="form-control" id="Age" style="padding: 4px;">
                                      <?php for($i=18;$i<=70;$i++) {?>
                                            <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                                        <?php } ?>
                                    </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                            <td colspan="3">
                                <div class="form-group">
                                Religion<br>
                                    <select name="Religion" class="form-control" id="Religion" style="padding: 4px;">
                                        <option>All</option>
                                    </select> 
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="form-group">
                                Caste<br>
                                    <select name="Caste" class="form-control" id="Caste" style="padding: 4px;">
                                        <option>All</option>
                                    </select> 
                                </div>
                            </td>
                        </tr> 
                    <tr>
                        <td style="text-align:left">
                                <button type="submit" name="Search" class="btn btn-primary" required="required">Search</button>
                        </td>
                    </tr>
             </table>
        </form>
    </div>
        <div class="col-sm-3"></div>
    </div>
    <br><br><br>
<?php include_once("includes/footer.php");?>