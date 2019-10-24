<style>
    .ft-left-nav li a{color:#333}
    .ft-left-nav li:hover{background: #dee7fc;} 
    .ft-left-nav li {color:black;}
    .linkactive1{color:#fff  !important;cursor:pointer;border-bottom:transparent;background:#5983e8;}
    .linkactive1:hover{background:#5983e8;color:#333}
    .linkactive1 a{color:#fff !important;font-weight: bold;} 
</style>

<div class="col-md-12 d-flex align-items-stretch grid-margin" style="padding:0px !important">
    <div class="row flex-grow">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group-row">
                        <div class="col-sm-12">
                            <div class="col-sm-3" style="width: 15%;">
                                <div class="sidemenu" style="width: 170px;margin-left: -58px;margin-bottom: -41px;margin-top: -30px;border-right: 1px solid #eee;">
                                    <ul class="ft-left-nav fusmyacc_leftnav" style="padding: 0px;list-style: none;">
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="BankDeposite") ? ' linkactive1 ':'';?>" id="BankDeposite" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="javascript:loadPaymentOption('BankDeposite')" class="Notification" style="text-decoration:none"><span>Bank Deposite</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="Paypal") ? ' linkactive1 ':'';?>" id="Paypal" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="javascript:loadPaymentOption('Paypal')" class="Notification" style="text-decoration:none"><span>Paypal</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="CreditCard") ? ' linkactive1 ':'';?>" id="CreditCard" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="javascript:loadPaymentOption('CreditCard')" class="Notification" style="text-decoration:none"><span>Credit Card</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="Wallet") ? ' linkactive1 ':'';?>" id="Wallet" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('Wallet')" class="Notification" style="text-decoration:none"><span>Wallet</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="OffLineRequest") ? ' linkactive1 ':'';?>" id="OffLineRequest" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6"  href="javascript:loadPaymentOption('OffLineRequest')" class="Notification" style="text-decoration:none"><span>Offline Request</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>