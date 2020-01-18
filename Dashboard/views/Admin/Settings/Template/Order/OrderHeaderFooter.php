<?php 
    if (isset($_POST['BtnOrderHeaderFooter'])) {   
        
            $response = $webservice->getData("Admin","CreateOrderHeaderFooter",$_POST);
            if ($response['status']=="success") {
               $successmessage = $response['message']; 
            } else {
                $errormessage = $response['message']; 
            }
        }
?>
<script src="<?php echo SiteUrl?>/assets/tiny_mce/tiny_mce.js"></script>
<script>
$(document).ready(function () {
   $("#OrderHeader").blur(function () {
        IsNonEmpty("OrderHeader","ErrOrderHeader","Please Enter Order Header");
   });
   $("#OrderFooter").blur(function () {
        IsNonEmpty("OrderFooter","ErrOrderFooter","Please Enter Order Footer");
   }); 
});
function SubmitOrderHeaderFooter() {
                         $('#ErrOrderHeader').html("");
                         $('#ErrOrderFooter').html("");
                         ErrorCount=0;
        
                        IsNonEmpty("OrderHeader","ErrOrderHeader","Please Enter Order Header");
                        IsNonEmpty("OrderFooter","ErrOrderFooter","Please Enter Order Footer");
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 
}
</script>
<form method="post" id="frmfrTemplate">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
	<div class="row">
		<div class="col-sm-9">
            <div class="card">
				<div class="card-body">
					<div style="max-width:770px !important;">
						<h4 class="card-title">Order Form Template</h4>                    
						<div class="form-group">
                            <label class="col-form-label" style="Background:none !important">Order Header</label>
                            <textarea id="OrderHeader" class="mceEditor" name="OrderHeader" style="height:400px;max-width:100% !important;min-width:570px !important"><?php echo (isset($_POST['OrderHeader']) ? $_POST['OrderHeader'] : "");?></textarea>
                            <span class="errorstring" id="ErrOrderHeader"><?php echo isset($ErrOrderHeader)? $ErrOrderHeader : "";?></span>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" style="Background:none !important">Order Footer</label>
							<textarea id="OrderFooter" class="mceEditor" name="OrderFooter" style="height:400px;max-width:100% !important;min-width:570px !important"><?php echo (isset($_POST['OrderFooter']) ? $_POST['OrderFooter'] : "");?></textarea>
                            <span class="errorstring" id="ErrOrderFooter"><?php echo isset($ErrOrderFooter)? $ErrOrderFooter : "";?></span>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="form-group row" >
				<div class="col-sm-12" style="text-align:right">
					&nbsp;<a href="javascript:void(0)" class="btn btn-default" style="padding:7px 20px" onclick="AppSettings.ConfirmGotoBackFromCreateOrderHeaderFooter()">Cancel</a>&nbsp;
                            <a href="javascript:void(0)" onclick="AppSettings.ConfirmCreateOrdersHeaderFooter()" class="btn btn-primary">Update</a>
				</div>
			</div>
		</div>
	</form>
<div class="modal" id="PubplishNow" data-backdrop="static" >
        <div class="modal-dialog" >
            <div class="modal-content" id="Publish_body"  style="max-height: 350px;min-height: 350px;" >
        
            </div>
        </div>
    </div>	
<script type="text/javascript">tinyMCE.init({entity_encoding : "raw",mode : "specific_textareas",editor_selector : "mceEditor",theme : "advanced",plugins : "pagebreak,style,layer,table,advhr,advimage,advlink,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,contextmenu,paste,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",resize: false,theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,fontselect,fontsizeselect,cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,|,undo,redo",theme_advanced_buttons2 : "link,unlink,anchor,image,cleanup,code,|,preview,|,forecolor,backcolor,tablecontrols,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions",theme_advanced_buttons3 : "iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",theme_advanced_toolbar_location : "top",theme_advanced_toolbar_align : "left",theme_advanced_statusbar_location : "bottom",theme_advanced_resizing : true,content_css : "css/content.css",template_external_list_url : "lists/template_list.js",external_link_list_url : "lists/link_list.js",external_image_list_url : "lists/image_list.js",media_external_list_url : "lists/media_list.js",style_formats : [{title : 'Bold text', inline : 'b'},{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},{title : 'Table styles'}],template_replace_values : {username : "Some User",staffid : "991234"}});</script>
