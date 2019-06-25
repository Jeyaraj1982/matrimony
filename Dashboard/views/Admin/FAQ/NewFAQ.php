<?php
  //  if (isset($_POST['BtnSaveFAQ'])) {
        
     //   $FAQID = $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "FAQS",
                                                              // "SoftCode"   => $_POST['FAQCode'],
                                                              // "CodeValue"  => $_POST['Question'],
                                                              // "ParamA"     => $_POST['Answer'] ));
      // if ($FAQID>0) {
        //    echo "Successfully Added";
            unset($_POST);
      //  } else {
        //    echo "Error occured. Couldn't save FAQ";
       // }
 //  }  
?>
<form method="post" action="" onsubmit="">
  <div class="main-panel">
       <div class="content-wrapper">
             <div class="col-12 stretch-card">
                  <div class="card">
                       <div class="card-body">
                             <h4 class="card-title">Add FAQ</h4>
                                 <form class="forms-sample">
                                        <div class="form-group row">
                                                <label for="FAQ Code" class="col-sm-3 col-form-label"><small>FAQ Code</small></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="FAQCode" name="FAQCode" value="<?php //echo (isset($_POST['FAQCode']) ? $_POST['FAQCode'] : GetNextNumber('FAQS'));?>" placeholder="FAQ Code">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Question" class="col-sm-3 col-form-label">Question</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="Question" name="Question" value="<?php // echo (isset($_POST['Question']) ? $_POST['Question'] : "");?>" placeholder="Question">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="Answer" class="col-sm-3 col-form-label">Answer</label>
                                            <div class="col-sm-9">
                                                <textarea  rows="10" class="form-control" id="Answer" name="Answer" value="<?php //echo (isset($_POST['Answer']) ? $_POST['Answer'] : "");?>" placeholder="Question">  </textarea>
                                            </div>
                                        </div>
                                        <button type="submit" name="BtnSaveFAQ" class="btn btn-success mr-2">Save FAQ</button>
                                        <a href="ManageFAQ "><small>List of FAQ</small> </a>
                                 </form>
                       </div>
                  </div>
             </div>
       </div>
  </div>
</form>