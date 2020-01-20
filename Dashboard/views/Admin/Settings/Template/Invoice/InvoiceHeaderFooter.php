<script src="<?php echo SiteUrl?>/assets/tiny_mce/tiny_mce.js"></script>
<?php 
	$response = $webservice->getData("Admin","GetHeaderandFooterInfo",array("Request" =>"Invoice"));
    $Invoice          = $response['data'];
 ?>
<script>
$(document).ready(function () {
   $("#InvoiceHeader").blur(function () {
        IsNonEmpty("InvoiceHeader","ErrInvoiceHeader","Please Enter Invoice Header");
   });
   $("#InvoiceFooter").blur(function () {
        IsNonEmpty("InvoiceFooter","ErrInvoiceFooter","Please Enter Invoice Footer");
   }); 
});
function SubmitInvoice() {
                         $('#ErrInvoiceHeader').html("");
                         $('#ErrInvoiceFooter').html("");
                         ErrorCount=0;
        
                        IsNonEmpty("InvoiceHeader","ErrInvoiceHeader","Please Enter Invoice Header");
                        IsNonEmpty("InvoiceFooter","ErrInvoiceFooter","Please Enter Invoice Footer");
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
						<h4 class="card-title">Invoice Header Footer</h4>                    
						<div class="form-group">
                            <label class="col-form-label" style="Background:none !important">Invoice Header</label>
                            <textarea id="InvoiceHeader" class="mceEditor" name="InvoiceHeader" style="height:300px;max-width:570px !important;min-width:570px !important"><?php echo (isset($_POST['InvoiceHeader']) ? $_POST['InvoiceHeader'] : $Invoice[0]['HeaderContent']);?></textarea>
                            <span class="errorstring" id="ErrInvoiceHeader"><?php echo isset($ErrInvoiceHeader)? $ErrInvoiceHeader : "";?></span>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" style="Background:none !important">Invoice Footer</label>
							<textarea id="InvoiceFooter" class="mceEditor" name="InvoiceFooter" style="height:300px;max-width:570px !important;min-width:570px !important"><?php echo (isset($_POST['InvoiceFooter']) ? $_POST['InvoiceFooter'] : $Invoice[0]['FooterContent']);?></textarea>
							<span class="errorstring" id="ErrInvoiceFooter"><?php echo isset($ErrInvoiceFooter)? $ErrInvoiceFooter : "";?></span>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="form-group row" >
                <div class="col-sm-12" style="text-align:right">
                    &nbsp;<a href="javascript:void(0)" class="btn btn-default" style="padding:7px 20px" onclick="AppSettings.ConfirmGotoBackFromCreateInvoiceHeaderFooter()">Cancel</a>&nbsp;
                            <a href="javascript:void(0)" onclick="AppSettings.ConfirmCreateInvoiceHeaderFooter()" class="btn btn-primary">Update</a>
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