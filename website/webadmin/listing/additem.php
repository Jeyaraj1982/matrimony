<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php 
        include_once("../../config.php");
                if (!(CommonController::isLogin())){
                echo CommonController::printError("Login Session Expired. Please Login Again");
                exit;
            }
            if (isset($_POST{"save"})) {
                
                  $obj = new CommonController();
            //     if (isset($_FILES['filepath']['name'])&& (strlen(trim($_FILES["filepath"]["name"])))) {
                        
             //       $obj->fileUpload($_FILES['filepath'],"../../assets/".$config['thumb'],$config['imageArray'],$config['imgMaxSize'],$filename);
             //   } else {
                //       echo $obj->printError("Please Attach Slider Image");     
               // }
                //$filename = $_POST['uploadedfilename'];
                 if ($obj->err==0) {
                 
                $param = array("categoryid"         => $_POST['categoryid'],
                               "itemname"           => $_POST['itemname'],
                               "itemdesc"           => $_POST['itemdescription'],
                               "itemprice"          => $_POST['itemprice'],
                               "shortdescription"   => $_POST['shortdescription'],
                               "keywords"           => $_POST['keywords'],
                               "filename"           => $_POST['uploadedfilename'],
                               "ispublished"        => $_POST['ispublished']); 
                               
                  if(CommonController::isEmptyField($_POST['itemname']) || CommonController::isEmptyField($_POST['itemdescription'])||CommonController::isEmptyField($_POST['itemprice'])) {
                         echo CommonController::printError ("All Product Fields are Required"); 
                  } else if(JListing::addItem($param)>0){
                        echo CommonController::printSuccess("Item Items Added successfully");       
                  } else {
                    echo CommonController::printError("Error Adding Items");
                }
                 }
     }
?>
<script src="./../../assets/js/tiny_mce/tiny_mce.js"></script>
<script src="./../../assets/js/jquery-1.7.2.js"></script>
    
       <script src="http://malsup.github.io/jquery.blockUI.js"></script>
<link rel="stylesheet" href="./../../assets/css/demo.css">
<script type="text/javascript">
//mode : "textareas",
tinyMCE.init({entity_encoding : "raw",mode:"specific_textareas",editor_selector:"mceEditor",theme:"advanced",plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",theme_advanced_toolbar_location : "top",theme_advanced_toolbar_align : "left",theme_advanced_statusbar_location : "bottom",theme_advanced_resizing : true,content_css : "css/content.css",template_external_list_url : "lists/template_list.js",external_link_list_url : "lists/link_list.js",external_image_list_url : "lists/image_list.js",media_external_list_url : "lists/media_list.js",style_formats : [{title : 'Bold text', inline : 'b'},{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},{title : 'Example 1', inline : 'span', classes : 'example1'},{title : 'Example 2', inline : 'span', classes : 'example2'},{title : 'Table styles'},{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}],template_replace_values : {username : "Some User",staffid : "991234"}});</script>

<style>
    table {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
    textarea {font-family:'Trebuchet MS';font-size:13px;color:#222;width:100%}
    .title_Bar {background:url(../images/blue/titlebackground.png);padding:5px;color:#6db2bc;font-family:'Trebuchet MS';font-size:13px !important;font-weight: bold;padding:11px !important;}   
    input[type=text],select {border:1px solid #b3d7e2;font-family:'Trebuchet MS';font-size:12px !important;color:#444}
</style>

  <body style="margin:0px;background:#e3f3f7">
  <div class="title_Bar">Add Item</div> 
 

<style>
.form-wrap{
    max-width: 500px;
    padding: 30px;
    background: #f1f1f1;
    margin: 20px auto;
    border-radius: 4px;
    text-align: center;
    
}
.form-wrap form{
    border-bottom: 1px dotted #ddd;
    padding: 10px;
}
.form-wrap #output{
    margin: 10px 0;
}
.form-wrap .error{
    color: #d60000;
}
.form-wrap .images {
    width: 100%;
    display: block;
    border: 1px solid #e8e8e8;
    padding: 5px;
    margin: 5px 0;
}
.form-wrap .thumbnails {
    width: 32%;
    display: inline-block;
    margin: 3px;
}

/* progress bar */
#progress-wrp {
    border: 1px solid #0099CC;
    padding: 1px;
    position: relative;
    border-radius: 3px;
    margin: 10px;
    text-align: left;
    background: #fff;
    box-shadow: inset 1px 3px 6px rgba(0, 0, 0, 0.12);
}
#progress-wrp .progress-bar{
    height: 20px;
    border-radius: 3px;
    background-color: #f39ac7;
    width: 0;
    box-shadow: inset 1px 1px 10px rgba(0, 0, 0, 0.11);
}
#progress-wrp .status{
    top:3px;
    left:50%;
    position:absolute;
    display:inline-block;
    color: #000000;
}
</style>
 
    <form action="" method="post" style="height: 20px;" enctype="multipart/form-data">
        <input type="hidden" name="uploadedfilename" id="uploadedfilename" value="">
        <table cellpadding="5" cellspacing="0" align="center" >
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="categoryid">
                            <?php
                                  $result = JListing::getCategories();                                        
    foreach ($result as $r)
    {
        ?>
        <option value="<?php echo $r['categoryid'];?>"><?php echo $r['categoryname'];?></option>
        <?php
    }
    ?>
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                     <td style="width:120px;">Item Name</td>
                     <td colspan="3"><input type="text" name="itemname"  size="40" style="width:100%;"><br></td> 
                      
                         
               </tr>
                 <tr>
                            <td>Short Description</td>
                            <td><textarea name="shortdescription" style="height:60px;width:100%"></textarea></td> 
                              <td  >
                              Item Price<br><br>
                              Is Published
                              
                              </td>
                            <td>
                            <select><option><?php echo JFrame::getAppSetting("currencysymbol");?></option></select><input type="text" name="itemprice"  size="40" style="width:150px;"><br><br>
                            <select name="ispublished"><option value="1">Yes</option><option value="0">No</option></select></td> 
                        </tr>
                <tr>
                    <td colspan="4"><textarea name="itemdescription" class="mceEditor"  id="itemdescription" style="height: 350px;width:100%"></textarea></td>
               </tr>
    
               <tr>
                <td>Thumb </td>
                
                <td>
                <div style="height:210px;width:280px">
                    <img src="" id="pagethumb" style="height: 210px;width:280px;">
                     
                </div>
                (<a href="javascript:void()" id="wspa">Add Thumb</a>) 
                </td>
                
                <td colspan="2" style="vertical-align:top;">
                    <table>
                       
                    
                        <tr>
                            <td>Keywords</td>
                            <td><textarea name="keywords" style="height:60px;width:100%"></textarea></td> 
                        </tr>
                        
                    </table>
                </td>                                                                             
    </tr>
              
               <tr>
                    <td colspan="2"><input type="submit" name="save" value="Save" bgcolor="grey">  
                    <input type="button" name="cancel" value="Cancel" bgcolor="grey" onclick="location.href='manageproducts.php'"></td></td>
              </tr> 
        </table>
    </form>
        <div style="display: none;" id="domMessage">
            <div id="1pop_result">
                 
                <div class="form-wrap">
                    <form action="../service.php" method="post" enctype="multipart/form-data" id="upload_form">
                        <input name="__files[]" type="file" multiple />
                        <input name="__submit__" type="submit" value="Upload" class="myButton"/>
                    </form>
                    <div id="progress-wrp">
                        <div class="progress-bar"></div >
                        <div class="status">0%</div>
                    </div>
                    <div id="output"><!-- error or success results --></div>
                </div>
            </div>
            </div>
       <div id="pop_result" style="display:none;">
       
       </div>      
       

       <script type="text/javascript">
         $('#wspa').click(function() {
            $.unblockUI();
           
           $("html,body").animate({scrollTop: 10}, 1000);
           $.blockUI({ message: $('#domMessage'),css: {border:'0px solid #fff', top:'70px', padding:'0px 20px'}});
            
       
           
       });
       
       
       
          function returnPage() {
            $.unblockUI();
        }  

       </script>
       
       <script type="text/javascript">    
//configuration
var max_file_size             = 2048576; //allowed file size. (1 MB = 1048576)
var allowed_file_types         = ['image/png', 'image/gif', 'image/jpeg', 'image/pjpeg']; //allowed file types
var result_output             = '#output'; //ID of an element for response output
var my_form_id                 = '#upload_form'; //ID of an element for response output
var progress_bar_id         = '#progress-wrp'; //ID of an element for response output
var total_files_allowed     = 3; //Number files allowed to upload



//on form submit
$(my_form_id).on( "submit", function(event) { 
    event.preventDefault();
    var proceed = true; //set proceed flag
    var error = [];    //errors
    var total_files_size = 0;
    
    //reset progressbar
    $(progress_bar_id +" .progress-bar").css("width", "0%");
    $(progress_bar_id + " .status").text("0%");
                            
    if(!window.File && window.FileReader && window.FileList && window.Blob){ //if browser doesn't supports File API
        error.push("Your browser does not support new File API! Please upgrade."); //push error text
    }else{
        var total_selected_files = this.elements['__files[]'].files.length; //number of files
        
        //limit number of files allowed
        if(total_selected_files > total_files_allowed){
            error.push( "You have selected "+total_selected_files+" file(s), " + total_files_allowed +" is maximum!"); //push error text
            proceed = false; //set proceed flag to false
        }
         //iterate files in file input field
        $(this.elements['__files[]'].files).each(function(i, ifile){
            if(ifile.value !== ""){ //continue only if file(s) are selected
                if(allowed_file_types.indexOf(ifile.type) === -1){ //check unsupported file
                    error.push( "<b>"+ ifile.name + "</b> is unsupported file type!"); //push error text
                    proceed = false; //set proceed flag to false
                }

                total_files_size = total_files_size + ifile.size; //add file size to total size
            }
        });
        
        //if total file size is greater than max file size
        if(total_files_size > max_file_size){ 
            error.push( "You have "+total_selected_files+" file(s) with total size "+total_files_size+", Allowed size is " + max_file_size +", Try smaller file!"); //push error text
            proceed = false; //set proceed flag to false
        }
        
        var submit_btn  = $(this).find("input[type=submit]"); //form submit button    
        
        //if everything looks good, proceed with jQuery Ajax
        if(proceed){
            //submit_btn.val("Please Wait...").prop( "disabled", true); //disable submit button
            var form_data = new FormData(this); //Creates new FormData object
            var post_url = $(this).attr("action"); //get action URL of form
            
            //jQuery Ajax to Post form data
$.ajax({
    url : post_url,
    type: "POST",
    data : form_data,
    contentType: false,
    cache: false,
    processData:false,
    xhr: function(){
        //upload Progress
        var xhr = $.ajaxSettings.xhr();
        if (xhr.upload) {
            xhr.upload.addEventListener('progress', function(event) {
                var percent = 0;
                var position = event.loaded || event.position;
                var total = event.total;
                if (event.lengthComputable) {
                    percent = Math.ceil(position / total * 100);
                }
                //update progressbar
                $(progress_bar_id +" .progress-bar").css("width", + percent +"%");
                $(progress_bar_id + " .status").text(percent +"%");
            }, true);
        }
        return xhr;
    },
    mimeType:"multipart/form-data"
}).done(function(res){ //
if (res=="done") {
    //alert('done');
      //  boxHeight: 400,    1 : 1:1, 2: 16:9 
      // 
    $.ajax({
      url: '../crop.php', 
      success: function(data) {
          $('#pop_result').html(data);
          $.unblockUI(); 
           $.blockUI({ message: $('#pop_result'),css: {border:'0px solid #fff', top:'70px', width:'650px'}}); 
           
           $('#cropbox').Jcrop({
               setSelect:   [ 100, 100, 200, 150 ],
           
      aspectRatio: 4 / 3,
          boxWidth: 650,
  
      onSelect: updateCoords
    });
        
      }
    });
}
    $(my_form_id)[0].reset(); //reset form
    $(result_output).html(res); //output response from server
    submit_btn.val("Upload").prop( "disabled", false); //enable submit button once ajax is done
});
            
        }
    }                                                                     
    
    $(result_output).html(""); //reset output 
    $(error).each(function(i){ //output any error to output element
        $(result_output).append('<div class="error">'+error[i]+"</div>");
    });
        
});

function CropImage() {
     if (parseInt($('#w').val())) {
         $('#thumbpath').val("<?php echo '../assets/'.$config['thumb'];?>");
     $.post(
      '../crop.php', 
      $('#cropform').serialize(), 
        function(data) {
            $('#pagethumb').attr({"src": "../"+$('#thumbpath').val()+data});
            $('#uploadedfilename').val(data);
            alert(data);
              $.unblockUI(); 
      });
     } else {
       alert('Please select a crop region then press submit.');   
     }
}
</script>
 <script src="../nicus_cropping/js/jquery.Jcrop.js"></script>
  <link rel="stylesheet" href="../nicus_cropping/css/jquery.Jcrop.css" type="text/css" />

<script type="text/javascript">

  $(function(){

   

  });

  function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };

  function checkCoords()
  {
    if (parseInt($('#w').val())) return true;
    alert('Please select a crop region then press submit.');
    return false;
  };

</script>
<style type="text/css">
  #target {
    background-color: #ccc;
    width: 500px;
    height: 330px;
    font-size: 24px;
    display: block;
  }


</style>
</body>
