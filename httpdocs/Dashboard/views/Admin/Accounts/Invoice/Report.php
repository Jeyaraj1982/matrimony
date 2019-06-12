<form method="post" action="<?php echo GetUrl("Accounts/Invoice/InvoicesReport");?>" onsubmit="return SubmitNewStaff();">            
<div class="col-12 grid-margin">                                    
    <div class="card">
        <div class="card-body">                                                
            <h4 class="card-title">Invoice Report</h4>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Invoice Date<span id="star">*</span></label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" id="InvoiceDateF" name="InvoiceDateF" style="line-height:15px !important" value="<?php echo (isset($_POST['InvoiceDateF']) ? $_POST['InvoiceDateF'] : "");?>">
                        <span class="errorstring" id="ErrInvoiceDateF"><?php echo isset($ErrInvoiceDateF)? $ErrInvoiceDateF: "";?></span>
                    </div>
                    <label class="col-sm-1 col-form-label">To<span id="star">*</span></label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" id="InvoiceDateT" name="InvoiceDateT" style="line-height:15px !important" value="<?php echo (isset($_POST['InvoiceDateT']) ? $_POST['InvoiceDateT'] : "");?>">
                        <span class="errorstring" id="ErrInvoiceDateT"><?php echo isset($ErrInvoiceDateT)? $ErrInvoiceDateT: "";?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Invoice For<span id="star">*</span></label>
                    <div class="col-sm-3">
                        <select class="form-control" id="InvoiceFor"  name="InvoiceFor" value="<?php echo (isset($_POST['InvoiceFor']) ? $_POST['InvoiceFor'] : "");?>">
                            <option value="">Select</option>
                        </select>
                        <span class="errorstring" id="ErrInvoiceFor"><?php echo isset($ErrInvoiceFor)? $ErrInvoiceFor: "";?></span>
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