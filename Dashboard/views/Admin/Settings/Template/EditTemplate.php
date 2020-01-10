<script src="<?php echo SiteUrl?>/assets/tiny_mce/tiny_mce.js"></script>
<?php 
     $TempInfo = $webservice->getData("Admin","GetTemplateInfo");
	 $Temp =$TempInfo['data']['Template'];
	
?>
<script>
function SubmitTemplate() {
                         $('#ErrCategory').html("");
                         $('#ErrCategoryDescription').html("");
						 
						 ErrorCount=0;
        
                        if (IsNonEmpty("Category","ErrCategory","Please Enter Category")) {
                        IsAlphaNumeric("Category","ErrCategory","Please Enter Alpha Numeric characters only");
                        }
						IsNonEmpty("CategoryDescription","ErrCategoryDescription","Please Enter Description");
						
						if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                        
}
</script>
<form method="post" id="frmfrn" >
	<input type="hidden" value="" name="txnPassword" id="txnPassword">
    <input type="hidden" value="<?php echo $_GET['Code'];?>" name="TCode" id="TCode">
    
	<div class="row">
		<div class="col-sm-9">
            <div class="card">
				<div class="card-body">
					<div style="max-width:770px !important;">
						<h4 class="card-title">Manage Templates</h4>                    
						<h5 class="card-title">Edit Template</h5>
						<div class="form-group">
							<label class="col-form-label" style="Background:none !important">Category<span id="star">*</span></label>
							 <input type="text" value="<?php echo $Temp['Category'];?>" class="form-control" id="Category" name="Category">
								<span class="errorstring" id="ErrCategory"><?php echo isset($ErrCategory)? $ErrCategory : "";?></span>
						</div>
						<div class="form-group">
							<label class="col-form-label" style="Background:none !important">Description<span id="star">*</span></label>
							 <input type="text" value="<?php echo $Temp['CategoryDescription'];?>" class="form-control" id="CategoryDescription" name="CategoryDescription">
								<span class="errorstring" id="ErrCategoryDescription"><?php echo isset($ErrCategoryDescription)? $ErrCategoryDescription : "";?></span>
						</div>
						<div class="form-group row">                                     
							<label class="col-sm-10 col-form-label">Sms</label>
							<div class="col-sm-2" style="text-align:right">
								<div class="custom-control custom-checkbox mb-3" style="float:right">
									<input type="checkbox" class="custom-control-input" id="IsActiveMobileSms" name="IsActiveMobileSms" <?php echo ($Temp['IsActiveMobileSMS']==1) ? ' checked="checked" ' :'';?>>
									<label class="custom-control-label" for="IsActiveMobileSms" style="margin-top: 7px;">&nbsp;Active</label>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-12">
								<input type="text" value="<?php echo isset($_POST['MobileSMSContent']) ? $_POST['MobileSMSContent'] : $Temp['MobileSMSContent'];?>" class="form-control" id="MobileSMSContent" name="MobileSMSContent">
								<span class="errorstring" id="ErrMobileSMSContent"><?php echo isset($ErrMobileSMSContent)? $ErrMobileSMSContent : "";?></span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-10 col-form-label">Email</label>
							<div class="col-sm-2" style="text-align:right">
								<div class="custom-control custom-checkbox mb-3" style="float:right">
									<input type="checkbox" class="custom-control-input" id="IsActiveEmail" name="IsActiveEmail" <?php echo ($Temp['IsActiveEmail']==1) ? ' checked="checked" ' :'';?>>
									<label class="custom-control-label" for="IsActiveEmail" style="margin-top: 7px;">&nbsp;Active</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-form-label" style="Background:none !important">Subject</label>
							<input type="text" value="<?php echo (isset($_POST['EmailSubject']) ? $_POST['EmailSubject'] : $Temp['Title']);?>" class="form-control" id="EmailSubject" name="EmailSubject">
							<span class="errorstring" id="ErrEmailSubject"><?php echo isset($ErrEmailSubject)? $ErrEmailSubject : "";?></span>
						</div>
						<div class="form-group">
							<label class="col-form-label" style="Background:none !important">Content</label>
							<textarea id="EmailContent" class="mceEditor" name="EmailContent" style="height:300px;max-width:570px !important;min-width:570px !important"><?php echo $Temp['Content'];?></textarea>
							<span class="errorstring" id="ErrEmailContent"><?php echo isset($ErrEmailContent)? $ErrEmailContent : "";?></span>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="form-group row" >
				<div class="col-sm-12" style="text-align:right">
					&nbsp;<a href="javascript:void(0)" class="btn btn-default" style="padding:7px 20px" onclick="ConfirmGotoBackFromCreateAdminStaff()">Cancel</a>&nbsp;
					<a href="javascript:void(0)" onclick="ConfirmEditTemplate()" class="btn btn-primary" name="BtnupdateStaff">Update</a>
				</div>
			</div>
		</div>
		 
	</form>
	
<div class="modal" id="PubplishNow" data-backdrop="static" >
		<div class="modal-dialog" >
			<div class="modal-content" id="Publish_body"  style="max-height: 344px;min-height: 344px;" >
		
			</div>
		</div>
	</div>
<script type="text/javascript">
tinyMCE.init({entity_encoding : "raw", mode : "specific_textareas",editor_selector : "mceEditor",theme : "advanced",plugins : "pagebreak,style,layer,table,advhr,advimage,advlink,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,contextmenu,paste,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,fontselect,fontsizeselect,cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,preview,|,forecolor,backcolor",theme_advanced_buttons2 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",theme_advanced_toolbar_location : "top",theme_advanced_toolbar_align : "left",theme_advanced_statusbar_location : "bottom",theme_advanced_resizing : true,content_css : "css/content.css",template_external_list_url : "lists/template_list.js",external_link_list_url : "lists/link_list.js",external_image_list_url : "lists/image_list.js",media_external_list_url : "lists/media_list.js",style_formats : [{title : 'Bold text', inline : 'b'},{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},{title : 'Example 1', inline : 'span', classes : 'example1'},{title : 'Example 2', inline : 'span', classes : 'example2'},{title : 'Table styles'},{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}],template_replace_values : {username : "Some User",staffid : "991234"}});
</script>
