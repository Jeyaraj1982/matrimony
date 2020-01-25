<?php 
$page="ReceiptHeaderFooter";
include_once("settings_header.php");

    $response = $webservice->getData("Admin","GetHeaderandFooterInfo",array("Request" =>"Receipt"));
    $Receipt          = $response['data'];
  
?>
<script src="<?php echo SiteUrl?>/assets/tiny_mce/tiny_mce.js"></script>
<script>
$(document).ready(function () {
   $("#ReceiptHeader").blur(function () {
        IsNonEmpty("ReceiptHeader","ErrReceiptHeader","Please Enter Receipt Header");
   });
   $("#ReceiptFooter").blur(function () {
        IsNonEmpty("ReceiptFooter","ErrReceiptFooter","Please Enter Receipt Footer");
   }); 
});
function SubmitReceipt() {
                         $('#ErrReceiptHeader').html("");
                         $('#ErrReceiptFooter').html("");
                         ErrorCount=0;
        
                        IsNonEmpty("ReceiptHeader","ErrReceiptHeader","Please Enter Receipt Header");
                        IsNonEmpty("ReceiptFooter","ErrReceiptFooter","Please Enter Receipt Footer");
                        if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
                 
}
</script>
<div class="col-sm-10 rightwidget">
<form method="post" id="frmfrTemplate">
    <input type="hidden" value="" name="txnPassword" id="txnPassword">
    <h4 class="card-title">Receipt Form Template</h4>                    
        <div class="form-group">
            <label class="col-form-label" style="Background:none !important">Receipt Header</label>
            <textarea id="ReceiptHeader" class="mceEditor" name="ReceiptHeader" style="height:300px;max-width:570px !important;min-width:570px !important"><?php echo (isset($_POST['ReceiptHeader']) ? $_POST['ReceiptHeader'] : $Receipt[0]['HeaderContent']);?></textarea>
            <span class="errorstring" id="ErrReceiptHeader"><?php echo isset($ErrReceiptHeader)? $ErrReceiptHeader : "";?></span>
        </div>
        <div class="form-group">
            <label class="col-form-label" style="Background:none !important">Receipt Footer</label>
            <textarea id="ReceiptFooter" class="mceEditor" name="ReceiptFooter" style="height:300px;max-width:570px !important;min-width:570px !important"><?php echo (isset($_POST['ReceiptFooter']) ? $_POST['ReceiptFooter'] : $Receipt[0]['FooterContent']);?></textarea>
            <span class="errorstring" id="ErrReceiptFooter"><?php echo isset($ErrReceiptFooter)? $ErrReceiptFooter : "";?></span>
        </div>
        <div class="form-group row" >
                <div class="col-sm-12" style="text-align:right">
                    &nbsp;<a href="javascript:void(0)" class="btn btn-default" style="padding:7px 20px" onclick="AppSettings.ConfirmGotoBackFromCreateOrderHeaderFooter()">Cancel</a>&nbsp;
                            <a href="javascript:void(0)" onclick="AppSettings.ConfirmCreateReceiptHeaderFooter()" class="btn btn-primary">Update</a>
                </div>
            </div>
</form>
<div class="modal" id="PubplishNow" data-backdrop="static" >
        <div class="modal-dialog" >
            <div class="modal-content" id="Publish_body"  style="max-height: 360px;min-height: 360px;" >
        
            </div>
        </div>
    </div>
</div>
   <script type="text/javascript">tinyMCE.init({entity_encoding : "raw",mode : "specific_textareas",editor_selector : "mceEditor",theme : "advanced",plugins : "pagebreak,style,layer,table,advhr,advimage,advlink,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,contextmenu,paste,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",resize: false,theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,fontselect,fontsizeselect,cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,|,undo,redo",theme_advanced_buttons2 : "link,unlink,anchor,image,cleanup,code,|,preview,|,forecolor,backcolor,tablecontrols,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions",theme_advanced_buttons3 : "iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",theme_advanced_toolbar_location : "top",theme_advanced_toolbar_align : "left",theme_advanced_statusbar_location : "bottom",theme_advanced_resizing : true,content_css : "css/content.css",template_external_list_url : "lists/template_list.js",external_link_list_url : "lists/link_list.js",external_image_list_url : "lists/image_list.js",media_external_list_url : "lists/media_list.js",style_formats : [{title : 'Bold text', inline : 'b'},{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},{title : 'Table styles'}],template_replace_values : {username : "Some User",staffid : "991234"}});</script>
<?php include_once("settings_footer.php");?>                    