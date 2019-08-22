<style>
    .ft-left-nav li a{color:#333}
    .ft-left-nav li:hover{background: #dee7fc;} 
    .ft-left-nav li {color:black;}
    .linkactive1{color:#fff  !important;cursor:pointer;border-bottom:transparent;background:#5983e8;}
    .linkactive1:hover{background:#5983e8;color:#333}
    .linkactive1 a{color:#fff !important;font-weight: bold;} 
</style>

<div class="col-12 grid-margin" style="padding:0px !important">
    <div class="card">
        <div class="card-body" style="padding:15px !important">
            <h4 class="card-title" style="font-size: 22px;margin-top:0px;margin-bottom:15px">My Accounts</h4>
            <h5 style="color:#666">Financial Transactions, Invoices and Refill your wallet all in one place.</h5>
            <h6 style="color:#999;margin-bottom:0px">This page gives you quick access to topup your wallets and tools that let you manage the transactions.</h6>
        </div>
    </div>
</div>

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
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="MyWallet") ? ' linkactive1 ':'';?>"style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("MyAccounts/MyWallet");?>" class="Notification" style="text-decoration:none"><span>My Wallet</span></a>
                                        </li>
                                        <?php if ($page=="MyWallet") { ?> 
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 " style="<?php echo ($spage=="RefillWallet") ? ' font-weight:bold; ':'';?>;padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("MyAccounts/RefillWallet");?>" class="Notification" style="text-decoration:none;"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Refill Wallet</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 " style="<?php echo ($spage=="RefillWallet" && $sp=="Bank") ? '  background:#e3eafc;color:#333  ':'';?>;padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("MyAccounts/RefillBank");?>" class="Notification" style="text-decoration:none;"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Using Bank</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 " style="<?php echo ($spage=="RefillWallet" && $sp=="Paypal") ? ' background:#e3eafc;color:#333  ':'';?>;padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("MyAccounts/RefillPaypal");?>" class="Notification" style="text-decoration:none;"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Using Paypal</span></a>
                                        </li>
                                        <?php } ?>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon2 <?php echo ($page=="MyTransactions") ? ' linkactive1 ':'';?>"style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">
                                            <a id="myaccount_leftnav_a_6" href="<?php echo GetUrl("MyAccounts/MyTransactions");?>" class="Notification" style="text-decoration:none"><span>My Transactions</span></a>
                                        </li>
                                        <li class="ft-left-nav-list fusmyacc_leftnavicon1 <?php echo ($page=="MyInvoices") ? ' linkactive1 ':'';?>" style="padding: 8px 0px 8px 14px;border-bottom:1px solid #eee;">   
                                            <a id="myaccount_leftnav_a" href="<?php echo GetUrl("MyAccounts/MyInvoices");?>" class="" style="text-decoration:none"><span>My Invoices</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>