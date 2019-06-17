<?//php include_once("header.php");?>
<script>
function RefillwalletSubmit()
{
    $('#error_amount').html("");
    if ($('#amount').val().trim().length==0) {
        $('#error_amount').html("Please Enter Amount");
        $('#amount').focus();
        return false;
    }
     else if ($('#bank').val().trim().length==0) {
        $('#error_bank').html("Please Select a Bank");
        $('#bank').focus();
        return false;
    }
     else if ($('#date').val().trim().length==0) {
        $('#error_date').html("Please Select a Date");
        $('#date').focus();
        return false;
    }    
    else if ($('#transaction').val().trim().length==0) {
        $('#error_transaction').html("Please Enter a transaction ID");
        $('#transaction').focus();
        return false;
    }    
    else if ($('#remark').val().trim().length==0) {
        $('#error_remark').html("Please Enter Remarks");
        $('#remark').focus();
        return false;
    }    
     else if ($('#rtick').val().trim().length==0) {
        $('#error_tick').html("Please select if you agree refill walet");
        $('#tick').focus();
        return false;
    }    
        return true;
    }
</script>
    <form method="post" action="<?php echo SiteUrl?>Member/RefillwalletCompleted" onsubmit=" return RefillwalletSubmit();">
        <div class="container"  id="sp">
           <h2>Refill Wallet</h2><br>
            <div class="form-group">    
                <input type="text" class="form-control" id="amount" name="amount"  placeholder="Refill amount">
                <div id="error_amount" class="inputerror"></div>
            </div>
            <div class="form-group">    
                <select class="form-control" id="bank"  name="bank">
                    <option>Bank Name</option>
                    <option>Indian Bank</option>
                    <option>SBT </option>
                    <option>SBI</option>
                </select>
            <div id="error_bank" class="inputerror"></div>
            </div>
            <div class="form-group">   
            <input type="date" class="form-control" id="date" name="date">
            <div id="error_date" class="inputerror"></div>
            </div>
            <div class="form-group">    
                <input type="text" class="form-control" id="transaction" name="transaction"  placeholder="Transaction ID">
                <div id="error_transaction" class="inputerror"></div>
            </div>
            <div class="form-group">    
                <input type="text" class="form-control" id="remark" name="remark"  placeholder="Remarks">
                <div id="error_remark" class="inputerror"></div>
            </div>
            <div class="form-group">
               <input type="checkbox" value="" >
               <small>I agree Refill wallet form</small> 
            </div><br>
            <div align="center"><button type="submit" class="btn btn-primary">Submit </button></div> 
            </div>
            </form>
<?php //include_once("footer.php");?>

<!--<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                 <h4 class="card-title">Refill Wallet</h4>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="RefillAmount" name="RefillAmount"  placeholder="Refill Amount" aria-label="RefillAmount">
                     <div id="error_RefillAmount" class="inputerror"></div>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-sm" placeholder="Username" aria-label="Username">
                  </div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Selectize</h4>
                  <div class="form-group">
                    <label for="exampleFormControlSelect1">Large select</label>
                    <select class="form-control form-control-lg" id="exampleFormControlSelect1">
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlSelect2">Default select</label>
                    <select class="form-control" id="exampleFormControlSelect2">
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlSelect3">Small select</label>
                    <select class="form-control form-control-sm" id="exampleFormControlSelect3">
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>-->