<?php include_once("header.php");?>
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
    <form method="post" action="RefillCompleted.php" onsubmit=" return RefillwalletSubmit();">
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
                I agree Refill wallet form
            </div><br>
            <div id="link"><button type="submit" class="btn btn-primary">Submit </button></div> 
            </div>
            </form>
<?php include_once("footer.php");?>