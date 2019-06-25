<form method="post" action="<?php echo GetUrl("Accounts/Receipt/ReceiptReport");?>" onsubmit="return SubmitNewStaff();">            
<div class="col-12 grid-margin">                                    
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Receipt Reports</h4>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Receipt Date<span id="star">*</span></label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" id="ReceiptDateF" name="ReceiptDateF" style="line-height:15px !important" value="<?php echo (isset($_POST['ReceiptDateF']) ? $_POST['ReceiptDateF'] : "");?>">
                        <span class="errorstring" id="ErrReceiptDateF"><?php echo isset($ErrReceiptDateF)? $ErrReceiptDateF: "";?></span>
                    </div>
                    <label class="col-sm-1 col-form-label">To<span id="star">*</span></label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" id="ReceiptDateT" name="ReceiptDateT" style="line-height:15px !important" value="<?php echo (isset($_POST['ReceiptDateT']) ? $_POST['ReceiptDateT'] : "");?>">
                        <span class="errorstring" id="ErrReceiptDateT"><?php echo isset($ErrReceiptDateT)? $ErrReceiptDateT: "";?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Receipt For<span id="star">*</span></label>
                    <div class="col-sm-3">
                        <select class="form-control" id="ReceiptFor"  name="ReceiptFor" value="<?php echo (isset($_POST['ReceiptFor']) ? $_POST['ReceiptFor'] : "");?>">
                            <option value="">Select</option>
                        </select>
                        <span class="errorstring" id="ErrReceiptFor"><?php echo isset($ErrReceiptFor)? $ErrReceiptFor: "";?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Member Code<span id="star">*</span></label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="MemberCode" name="MemberCode" value="<?php echo (isset($_POST['MemberCode']) ? $_POST['MemberCode'] : "");?>">
                        <span class="errorstring" id="ErrMemberCode"><?php echo isset($ErrMemberCode)? $ErrMemberCode: "";?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2"><button type="submit" name="BtnGetReport" class="btn btn-primary mr-2">Ger Report</button></div>
                   </div>
             </div>
          </div>
    </div>
</form>        