<?php
  $iconimgArray = array("image/x-icon");
  $MusicArray = array("audio/mp3","audio/mpeg","audio/wav");
  $musicMaxSize = 20000000;
  $DownloadArray = array("image/jpeg","image/jpg","image/gif","image/png","application/pdf","application/doc","application/zip","application/oda","application/odt","application/x-zip-compressed");
  $downloadMaxSize = 20000000;
  
  class JFrame{
      
            function getAppSetting($property){
                
                global $mysql,$settings;
              
                $f = 0;
                
            switch($property) {
                case 'sitetitle'                : $keyvalue = 0; break;
                case 'sitename'                 : $keyvalue = 1; break;
                case 'backgroundimage'          : $keyvalue = 2; break;
                case 'backgroundcolor'          : $keyvalue = 3; break;
                case 'menubackgroundimage'      : $keyvalue = 23; break;
                case 'logo'                     : $keyvalue = 24; break;
                case 'isenablevideo'            : $keyvalue = 5; break;
                case 'isenablephoto'            : $keyvalue = 6; break;
                case 'isenablenews'             : $keyvalue = 13; break;
                case 'isenableevents'           : $keyvalue = 14; break;
                case 'isenablemusic'            : $keyvalue = 7; break;
                case 'isenabledownloads'        : $keyvalue = 8; break;
                case 'isenablefaq'              : $keyvalue = 9; break;
                case 'isenablesuccessstory'     : $keyvalue = 10; break;
                case 'isenabletestimonial'      : $keyvalue = 11; break;
                case 'isenablesubscriber'       : $keyvalue = 12; break;
                case 'sharepage'                : $keyvalue = 19; break;
                case 'googletranslator'         : $keyvalue = 20; break;
                case 'isenableproduct'          : $keyvalue = 25; break;
                case 'facebookurl'              : $keyvalue = 15; break;
                case 'twitterurl'               : $keyvalue = 16; break;
                case 'youtubeurl'               : $keyvalue = 17; break;
                case 'googleplusurl'            : $keyvalue = 18; break;
                case 'noimg'                    : $keyvalue = 29; break;
                case 'newsperpage'              : $keyvalue = 30; break;
                case 'eventsperpage'            : $keyvalue = 31; break;
                case 'storyperpage'             : $keyvalue = 32; break;
                case 'testmperpage'             : $keyvalue = 33; break;
                case 'menubgcolor'              : $keyvalue = 42; break;
                case 'menufontcolor'            : $keyvalue = 34; break;
                case 'menufont'                 : $f = $mysql->select("select * from _jfonts where fontid=".$settings[35]['paramvalue']);
                                                  $settings[$keyvalue]['paramvalue']=$f[0]['fontname'];break;
                case 'menufontsize'             : $keyvalue = 36; break;
                case 'footerbgimage'            : $keyvalue = 37; break;
                case 'footerbgcolor'            : $keyvalue = 38; break;
                case 'footerfontcolor'          : $keyvalue = 39; break;
                case 'footerfont'               : $f = $mysql->select("select * from _jfonts where fontid=".$settings[40]['paramvalue']);
                                                  $settings[$keyvalue]['paramvalue']=$f[0]['fontname'];break;
                case 'footerfontsize'           : $keyvalue = 41; break;
                case 'layout'                   : $keyvalue = 43; break;  
                case 'menu_hover_font_color'              : $keyvalue = 44; break;  
                case 'footerhover'              : $keyvalue = 45; break;  
                case 'linkedpage'               : $keyvalue = 46; break;  
                case 'emailto'                  : $keyvalue = 47; break;
                case 'isenablecontact'          : $keyvalue = 26; break;
                case 'sitebgposition'           : $keyvalue = 48; break;
                case 'sharesize'                : $keyvalue = 49; break; 
                case 'siteurl'                  : $keyvalue = 50; break;
                case 'seometadesc'              : $keyvalue = 51; break; 
                case 'seometakey'               : $keyvalue = 52; break; 
                case 'seometacontent'           : $keyvalue = 53; break;
                case 'footerbanner'             : $keyvalue = 54; break;
                case 'displaycontactusonhome'   : $keyvalue = 55; break;
                case 'displaycontactus'         : $keyvalue = 56; break;
                case 'headerbgimg'              : $keyvalue = 57; break;
                case 'headerbgcolor'            : $keyvalue = 58; break;
                case 'sliderhideicon'           : $keyvalue = 59; break;   
                case 'favoriteicon'             : $keyvalue = 4; break;   
                case 'headernoimagenocolor'     : $keyvalue = 60; break;   
                case 'headerheight'             : $keyvalue = 61; break;   
                case 'showheader'               : $keyvalue = 62; break;  
                case 'menu_font_bold'           : $keyvalue = 63; break;  
                case 'menu_font_italic'                : $keyvalue = 64; break;  
                case 'menu_font_underline'             : $keyvalue = 65; break;  
                case 'menu_hover_font_bold'            : $keyvalue = 66; break;  
                case 'menu_hover_font_italic'          : $keyvalue = 67; break;  
                case 'menu_hover_font_underline'       : $keyvalue = 68; break;  
                case 'menu_hover_backgroundcolor'      : $keyvalue = 69; break;  
                case 'menu_border_left_size'           : $keyvalue = 70; break;  
                case 'menu_border_right_size'          : $keyvalue = 71; break;  
                case 'menu_border_top_size'            : $keyvalue = 72; break;  
                case 'menu_border_bottom_size'         : $keyvalue = 73; break;  
                case 'menu_border_left_style'          : $keyvalue = 74; break;  
                case 'menu_border_right_style'         : $keyvalue = 75; break;  
                case 'menu_border_top_style'           : $keyvalue = 76; break;  
                case 'menu_border_bottom_style'        : $keyvalue = 77; break;  
                case 'menu_border_left_color'          : $keyvalue = 78; break;  
                case 'menu_border_right_color'         : $keyvalue = 79; break;  
                case 'menu_border_top_color'           : $keyvalue = 80; break;  
                case 'menu_border_bottom_color'        : $keyvalue = 81; break;  
                case 'menu_radius_left_top'            : $keyvalue = 82; break;  
                case 'menu_radius_right_top'           : $keyvalue = 83; break;  
                case 'menu_radius_left_bottom'         : $keyvalue = 84; break;  
                case 'menu_radius_right_bottom'        : $keyvalue = 85; break;  
                case 'menu_radius_left_top_scale'      : $keyvalue = 86; break;  
                case 'menu_radius_right_top_scale'     : $keyvalue = 87; break;  
                case 'menu_radius_left_bottom_scale'   : $keyvalue = 88; break;  
                case 'menu_radius_right_bottom_scale'  : $keyvalue = 89; break;  
                case 'menu_height'                     : $keyvalue = 90; break;  
                case 'need_menu_hover_backgroundcolor' : $keyvalue = 91; break; 
                case 'menu_text_padding_left'          : $keyvalue = 92; break;  
                case 'menu_text_padding_right'         : $keyvalue = 93; break;  
                case 'menu_text_padding_top'           : $keyvalue = 94; break;  
                case 'menu_text_padding_bottom'        : $keyvalue = 95; break;  
                
                case 'menu_background_image_color_noneed'  : $keyvalue = 96; break;  
                
                
                 
                case 'menu_seperator_need'  : $keyvalue = 97; break;  
                case 'menu_seperator_size'  : $keyvalue = 98; break;  
                case 'menu_seperator_color'  : $keyvalue = 99; break;  
                
                
                case 'slider_border_top_size'  : $keyvalue = 100; break;  
                case 'slider_border_bottom_size'  : $keyvalue = 101; break;  
                case 'slider_border_left_size'  : $keyvalue = 102; break;  
                case 'slider_border_right_size'  : $keyvalue = 103; break;  
                case 'slider_border_top_color'  : $keyvalue = 104; break;  
                case 'slider_border_bottom_color'  : $keyvalue = 105; break;  
                case 'slider_border_left_color'  : $keyvalue = 106; break;  
                case 'slider_border_right_color'  : $keyvalue = 107; break;  
                case 'slider_top_space'  : $keyvalue = 108; break;  
                case 'slider_bottom_space'  : $keyvalue = 109; break;  
             
                
                
                
                case 'menu_text_transform'  : $keyvalue = 110; break;  
                case 'menu_text_hover_transform'  : $keyvalue = 111; break;  
                
                case 'slider_border_radius_left_top'  : $keyvalue = 112; break;  
                case 'slider_border_radius_right_top'  : $keyvalue = 113; break;  
                case 'slider_border_radius_left_bottom'  : $keyvalue = 114; break;  
                case 'slider_border_radius_right_bottom'  : $keyvalue = 115; break;  
                
                case 'showslider'  : $keyvalue = 116; break;  
                case 'slider_height'  : $keyvalue = 117; break;
                
                
                  
                case 'slider_top_space_need_color'  : $keyvalue = 118; break;  
                case 'slider_top_space_color'  : $keyvalue = 119; break;  
                case 'slider_bottom_space_need_color'  : $keyvalue = 120; break;  
                case 'slider_bottom_space_color'  : $keyvalue = 121; break;  
                
                case 'video_page_video_height'  : $keyvalue = 122; break;  
                case 'video_page_video_width'  : $keyvalue = 123; break;  
                case 'video_page_video_layout'  : $keyvalue = 124; break;  
                case 'video_page_clicktoplay'  : $keyvalue = 125; break;  
                case 'video_page_details_open_neworself'  : $keyvalue = 126; break;  
                case 'video_page_content'  : $keyvalue = 127; break;  
                case 'header_logo_padding_right'  : $keyvalue = 128;break;  
                case 'header_logo_padding_left'  : $keyvalue = 129;break;  
                case 'header_logo_padding_top'  : $keyvalue = 130;break; 
                case 'header_logo_padding_bottom'  : $keyvalue = 131;break;
                case 'header_background_repeat'  : $keyvalue = 132;break;
                
                
                case 'currencysymbol'  : $keyvalue = 133;break;
                case 'copyright_text'  : $keyvalue = 134;break;
               
                
                
                
                
                
                
                
                
                 
            } 
            return $settings[$keyvalue]['paramvalue'];
        }
    }
    
   class MenuItems{
       
       function addMenu($param){
          global $mysql; 
          $m = ($param['isHeader']==1) ? $mysql->select("select * from _jmenu where isheader=1") : $mysql->select("select * from _jmenu where isheader=0");   
          $param['orderf']=sizeof($m)+1;
          return $mysql->insert("_jmenu",array("menuname"=>$param['menuname'],"pageid"=>$param['pagenameid'],"isheader"=>$param['isHeader'],"target"=>$param['target'],"customurl"=>$param['customurl'],"linkedto"=>$param['linkedto'],"orderf"=>$param['orderf'])); 
       }
       
       function updateMenu($param,$menuid=""){
          global $mysql;         
          return $mysql->execute("UPDATE _jmenu SET menuname='".$param['menuname']."',pageid='".$param['pagenameid']."',isheader='".$param['isHeader']."',target='".$param['target']."',customurl='".$param['customurl']."',orderf='".$param['orderf']."',linkedto='".$param['linkedto']."' WHERE menuid='".$param['menuid']."'"); 
       }
       
       function getMenu($menuid){
          global $mysql;
          return $mysql->select("select * from _jmenu where menuid='".$menuid."'");
       }
       
       function deleteMenu($menuid){
          global $mysql;
          return $mysql->execute("delete from _jmenu where menuid='".$menuid."'");
       }
       
       function getHeaderMenuItems(){
          global $mysql;
          return $mysql->select("SELECT * FROM _jmenu LEFT JOIN _jpages ON _jmenu.pageid=_jpages.pageid where _jmenu.isheader=1 order by _jmenu.orderf"); 
       }
       
       function getFooterMenuItems(){
          global $mysql;
          return $mysql->select("SELECT * FROM _jmenu LEFT JOIN _jpages ON _jmenu.pageid=_jpages.pageid where _jmenu.isheader=0 order by _jmenu.orderf"); 
       } 
  }
  
  class JSubscriber{
      
        function getSubscriber($subscriberid){ 
            global $mysql;
            return ($subscriberid==0) ?  $mysql->select("select * from _jsubscriber") : $mysql->select("select * from _jsubscriber where subscriberid='".$subscriberid."'");   
        }
      
       function addSubscriber($subscribername,$subscriberemail,$subscribermobile,$others){
            global $mysql; 
            return $mysql->insert("_jsubscriber",array("subscribername"=>$subscribername,"subscriberemail"=>$subscriberemail,"subscribermobile"=>$subscribermobile,"others"=>$others)); 
       }
        
       function deleteSubscriber($rowid){
           global $mysql;
           return $mysql->execute("delete from _jsubscriber where subscriberid='".$rowid."'");
       }
        
       function updateSubscriber($subscribername,$subscriberemail,$subscribermobile,$others,$rowid) {
           global $mysql;
           return $mysql->execute("update _jsubscriber set subscribername='".$subscribername."',subscriberemail='".$subscriberemail."',subscribermobile='".$subscribermobile."',others='".$others."' where subscriberid='".$rowid."'");
       }
  }
  
  class JProduct{
            
       function getProduct($productid){ 
           global $mysql;
           return ($productid==0) ?  $mysql->select("select * from _jproduct") : $mysql->select("select * from _jproduct where productid='".$productid."'");   
       }
       
       function addProduct($itemname,$itemdescription,$itemprice,$ispublished){
           global $mysql; 
           return $mysql->insert("_jproduct",array("itemname"=>$itemname,"itemdesc"=>$itemdescription,"itemprice"=>$itemprice,"ispublished"=>$ispublished,"postedon"=>date("Y-m-d H:i:s"))); 
       }
       
       function deleteProduct($rowid){
           global $mysql;
           return $mysql->execute("delete from _jproduct where productid='".$rowid."'");
       }
     
       function updateProduct($itemname,$itemdescription,$itemprice,$ispublished,$rowid){
           global $mysql;
           return $mysql->execute("update _jproduct set itemname='".$itemname."',itemdesc='".$itemdescription."',itemprice='".$itemprice."',ispublished='".$ispublished."' where productid='".$rowid."'");
       }
  }
  
  class JProductSubCategory{
        
       function getProductSubcategory($prodsubid){ 
            global $mysql;
            return ($prodsubid==0) ?  $mysql->select("select * from _jsubcategoryproduct") : $mysql->select("select * from _jsubcategoryproduct where subcateid='".$prodsubid."'");  
        }
        
       function addProductSubcategory($subcategoryname){
           global $mysql; 
           return $mysql->insert("_jsubcategoryproduct",array("subcatename"=>$subcategoryname)); 
       }
       
       function deleteProductSubcategory($rowid) {
           global $mysql;
           return $mysql->execute("delete from _jsubcategoryproduct where subcateid='".$rowid."'");
       }
     
       function updateProductSubcategory($subcategoryname,$rowid){
           global $mysql;
           return $mysql->execute("update _jsubcategoryproduct set subcatename='".$subcategoryname."' where subcateid='".$rowid."'");
       }
  }
  
  class JProductMainCategory{
            
      function getProductMaincategory($prodmainid){ 
           global $mysql;
           return ($prodmainid==0) ?  $mysql->select("select * from _jmaincateproduct") : $mysql->select("select * from _jmaincateproduct where maincateid='".$prodmainid."'");  
      }
      
      function addProductMaincategory($maincatename){
           global $mysql; 
           return $mysql->insert("_jmaincateproduct",array("maincatename"=>$maincatename)); 
       }
       
       function deleteProductMaincategory($rowid){
           global $mysql;
           return $mysql->execute("delete from _jmaincateproduct where maincateid='".$rowid."'");
       }
     
       function updateProductMaincategory($maincatename,$rowid){
           global $mysql;
           return $mysql->execute("update _jmaincateproduct set maincatename='".$maincatename."' where maincateid='".$rowid."'");
       }
  }
  
  class JContactus{
        
       function getContactus($contactid=0){
           global $mysql;
           return ($contactid==0) ?  $mysql->select("select * from _jcontactus") : $mysql->select("select * from _jcontactus where contid='".$contactid."'");   
       }
      
       function addContactus($param){
           global $mysql; 
           return $mysql->insert("_jcontactus",array("contmob"=>$param["mobileno"],"contemail"=>$param["email"],"personname"=>$param["personname"],"subject"=>$param["subject"],"content"=>$param["content"],"convtime"=>$param["convtime"],"postedon"=>date("Y-m-d H:i:s"))); 
       }
       
       function deleteContactus($contactid){
           global $mysql;
           return $mysql->execute("delete from _jcontactus where contid='".$contactid."'");
       }
     
       function updateContactus($param,$contactid){
           global $mysql;
           return $mysql->execute("update _jcontactus set contmob='".$param["mobileno"]."',contemail='".$param["email"]."',personname='".$param["personname"]."',subject='".$param["subject"]."',content='".$param["content"]."',convtime='".$param["convtime"]."' where contid='".$contactid."'");
       }
  }
  
  class JCustomize{
      
       function getCustomize($customid=0){
           global $mysql;
           return ($customid==0) ?  $mysql->select("select * from _jdayevent") : $mysql->select("select * from _jdayevent where eventid='".$customid."'");   
       }
      
       function addCustomize($datepicker,$desctamil,$desceng,$descmal,$eventcate){
           global $mysql; 
           return $mysql->insert("_jdayevent",array("edate"=>$datepicker,"descT"=>$desctamil,"descE"=>$desceng,"descM"=>$descmal,"eventcate"=>$eventcate)); 
       }
       
       function deleteCustomize($rowid){
           global $mysql;
           return $mysql->execute("delete from _jdayevent where eventid='".$rowid."'");
       }
     
       function updateCustomize($datepicker,$desctamil,$desceng,$descmal,$eventcate,$rowid){
           global $mysql;
           return $mysql->execute("update _jdayevent set edate='".$datepicker."',descT='".$desctamil."',descE='".$desceng."',descM='".$descmal."',eventcate='".$eventcate."' where eventid='".$rowid."'");
       }
  }
  
  class JUsertable{
      
      function getUser($userid=0){ 
           global $mysql;
           return($userid==0) ?  $mysql->select("select * from _jusertable"):  $mysql->select("select * from _jusertable where userid='".$userid."'");
      }
       
      function addUser($personname,$username,$pwd,$isactive){
          global $mysql; 
          return $mysql->insert("_jusertable",array("personname"=>$personname,"uname"=>$username,"pwd"=>$pwd,"createdon"=>date("Y-m-d H:i:s"),"isactive"=>$isactive)); 
          
      }
       
      function updateUser($personname,$username,$pwd,$isactive,$rowid){
           global $mysql;
           return $mysql->execute("update _jusertable set personname='".$personname."',uname='".$username."',pwd='".$pwd."',isactive='".$isactive."' where userid='".$rowid."'");
      }
  }
  
  class JReading{
      
      function getReading($readingid=0){
          global $mysql;
          return ($readingid==0)? $mysql->select("select * from _jreading"): $mysql->select("select * from _jreading where readingid='".$readingid."'");
      }
      
      function addReading($param){
          global $mysql;
          return $mysql->insert("_jreading",array("date"=>$param['date'],"title"=>$param['title'],"details"=>$param['details'],"title_t"=>$param['title_t'],"details_t"=>$param['details_t']));
      }
       
      function updateReading($param,$readingid=""){
          global $mysql;
          return $mysql->execute("update _jreading set date='".$param['date']."',title='".$param['title']."',details='".$param['details']."',title_t='".$param['title_t']."',details_t='".$param['details_t']."' where readingid='".$param['readingid']."'");
      }
      
      function deleteReading($readingid){
          global $mysql;
          return $mysql->execute("delete from _jreading where readingid='".$readingid."'");
      }
  }
   
  class CommonController{
      
      public $err=0;
      public $errmsg = array();
      
      function formatFileName($filename){
          return str_replace(" ","_",strtolower("_".time()."_".$filename));
      }
      
      function isEmptyField($string){
          return (strlen(trim($string))>0) ? false : true;
      }
      
      function printSuccess($message){
        return "<div id='success' style='font-size:11px;font-family:arial;background:lightgreen;;margin:10px;padding:10px;border-radius: 5px;color:green;font-weight: bold;text-align:center'>".$message."</div>";
      }
    
      function printError($message){
        $this->err++;
        $this->errmsg[]=$message;
        return "<div style='font-size:11px;font-family:arial;background:#FCB8B8;;margin:10px;padding:10px;border-radius: 5px;color:brown;font-weight: bold;text-align:center'>".$message."</div>";
      }
    
      function isLogin(){
        return  $_SESSION['USER']['userid']>0 ? true : false;
      }

      function fileUpload($file,$uploadTo,$typeArray,$fileSize,&$filename){
        
        $filename = $this->formatFileName(basename($file['name']));
      
        if($file["size"]>$fileSize){
            $this->printError("File Size should have greater ".number_format($fileSize/8/1024/1024,2)." MB");       
            return false;
        }

        if(!(in_array($file["type"],$typeArray))){
            $this->printError("File Format Not Support");    
            return false;
        }
                
        if(!(move_uploaded_file($file['tmp_name'],strtolower($uploadTo.$filename)))){
            $this->printError("There was an error uploading the file, please try again!");
            return false;
        }
            return true;
    }
    
    function printErrors(){
        
        $return = "";
        foreach($this->errmsg as $e){
            $return .= "<div style='font-size:11px;font-family:arial;background:#FCB8B8;;margin:10px;padding:10px;border-radius: 5px;color:brown;font-weight: bold;text-align:center'>".$e."</div>";
        }
        return $return;
    }
  } 
  
  
  Class JListing {
                
      function getCategories($categoryid=0){ 
           global $mysql;
           return ($categoryid==0) ?  $mysql->select("select * from _jitemcategory") : $mysql->select("select * from _jitemcategory where categoryid='".$categoryid."'");  
      }
      
      function addCategory($categoryname,&$returnString){
           global $mysql; 
           $categoryname = str_replace("'","\'",trim($categoryname));
           $categoryname = str_replace('"','\"',$categoryname);
           $categoryname = str_replace('$','\$',$categoryname);
           $oldData = $mysql->select("Select * from _jitemcategory where categoryname='".$categoryname."'");
           if (sizeof($oldData)>0) {
               $returnString = "This Category name is already exists";
               return -1; 
           }
           $returnString = "Category saved successfully";
           return $mysql->insert("_jitemcategory",array("categoryname"=>$categoryname)); 
       }
       
       function deleteCategory($rowid){
           global $mysql;
           return $mysql->execute("delete from _jitemcategory where categoryid='".$rowid."'");
       }
     
       function updateCategory($categoryname,$rowid){
           global $mysql;
           return $mysql->execute("update _jitemcategory set categoryname='".$categoryname."' where categoryid='".$rowid."'");
       }
       
         function getFeatures($featureid=0){ 
           global $mysql;
           return ($featureid==0) ?  $mysql->select("select * from _jfeature") : $mysql->select("select * from _jfeature where featureid='".$featureid."'");  
      }
      
      function addFeatures($featurename,&$returnString){
           global $mysql; 
           $featurename = str_replace("'","\'",trim($featurename));
           $featurename = str_replace('"','\"',$featurename);
           $featurename = str_replace('$','\$',$featurename);
           $oldData = $mysql->select("Select * from _jfeature where featurename='".$featurename."'");
           if (sizeof($oldData)>0) {
               $returnString = "This Feature name is already exists";
               return -1; 
           }
            $returnString = "Feature saved successfully";
           return $mysql->insert("_jfeature",array("featurename"=>$featurename)); 
       }
       
       
        function getItem($itemid=0){ 
           global $mysql;
           return ($itemid==0) ?  $mysql->select("select * from _jlisting left join _jitemcategory on _jitemcategory.categoryid=_jlisting.categoryid") : 
                                     $mysql->select("select * from _jlisting  as list, _jitemcategory as lcategory where lcategory.categoryid=list.categoryid and list.itemid='".$itemid."'");   
       }  
       
       function getItemByCategory($categoryid=0){ 
           global $mysql;
           return  $mysql->select("select * from _jlisting left join _jitemcategory on _jitemcategory.categoryid=_jlisting.categoryid where _jlisting.categoryid='".$categoryid."'");
                                     
       }
       
       function getItemByTitle($itemtitle){ 
           global $mysql;
           return $mysql->select("select * from _jlisting  as list, _jitemcategory as lcategory where lcategory.categoryid=list.categoryid and list.itemfilename='".$itemtitle."'");   
       }
       
        function getPublishedItems($sql=""){ 
           global $mysql;
           return  $mysql->select("select * from _jlisting as list, _jitemcategory as lcategory where list.ispublished=1 and lcategory.categoryid=list.categoryid ".$sql);
                                    
       }
       
        function getLatestPublishedItems(){ 
           global $mysql;
           return  $mysql->select("select * from _jlisting as list, _jitemcategory as lcategory where list.ispublished=1 and lcategory.categoryid=list.categoryid order by list.itemid desc limit 0,5");
                                    
       }
       
          
        function getMostViewedPublishedItems(){ 
           global $mysql;
           return  $mysql->select("select * from _jlisting as list, _jitemcategory as lcategory where list.ispublished=1 and lcategory.categoryid=list.categoryid order by list.itemid desc limit 0,5");
                                    
       }
       
       function addItem($param) {
       
           global $mysql; 
           
           $itemdesc = str_replace("'","\'",$param['itemdesc']);
           $itemdesc = str_replace('"','\"',$itemdesc);
           
           $itemname = str_replace("'","\'",$param['itemname']);
           $itemname = str_replace('"','\"',$itemname);
           $itemname = str_replace('  ',' ',$itemname);
                     
           return $mysql->insert("_jlisting",array("categoryid"         => $param['categoryid'],
                                                   "itemname"           => $itemname,
                                                   "itemdesc"           => $itemdesc,
                                                   "filename"           => $param['filename'],
                                                   "keywords"           => $param['keywords'],
                                                   "shortdescription"   => $param['shortdescription'],
                                                   "itemfilename"       => String2FileName($itemname),
                                                   "itemprice"          => $param['itemprice'],
                                                   "ContactNumbers"          => $param['ContactNumbers'],
                                                   "ispublished"        => $param['ispublished'],
                                                   "postedon"           => date("Y-m-d H:i:s"))); 
       }
       
           
       function updateItem($param) { 
           
           global $mysql; 
           
           $itemdesc = str_replace("'","\'",$param['itemdesc']);
           $itemdesc = str_replace('"','\"',$itemdesc);
           
           $itemname = str_replace("'","\'",$param['itemname']);
           $itemname = str_replace('"','\"',$itemname);
           $itemname = str_replace('  ',' ',$itemname);
           
           $sql = "update _jlisting set categoryid='".$param['categoryid']."',
                                        itemname='".$itemname."',
                                        itemdesc='".$itemdesc."',
                                        ispublished='".$param['ispublished']."',
                                        keywords='".$param['keywords']."',
                                        shortdescription='".$param['shortdescription']."',
                                        itemfilename='".String2FileName($itemname)."',
                                        itemprice='".$param['itemprice']."',
                                        
                                        ispublished='".$param['ispublished']."' " ;
           $sql .= (isset($param['filename']) && strlen($param['filename'])>5) ? " , filename='".$param['filename']."' " : "";
           $sql .= " where itemid=".$param['itemid'];
          // echo $sql;
           return $mysql->execute($sql);
       }
       
       
        function DeleteItem($itemid) { 
           global $mysql; 
           return $mysql->execute("delete from _jlisting where itemid=".$itemid);
           
       }
       
       
       
       function addItemImage($param) {
             global $mysql; 
             return $mysql->insert("_jlistingimg",array("itemid"    => $param['itemid'],
                                                        "filename"    => $param['filename'],
                                                        "ispublished" => '1',
                                                        "postedon"    => date("Y-m-d H:i:s"))); 
       }
       
         function getItemImages($itemid){ 
           global $mysql;
           return $mysql->select("select * from _jlistingimg where itemid=".$itemid);
       }
       
           function deleteItemImages($itemid){ 
           global $mysql;
           return $mysql->select("delete from _jlistingimg where itemid=".$itemid);
       }
       
       function deleteProduct($rowid){
           global $mysql;
           return $mysql->execute("delete from _jproduct where productid='".$rowid."'");
       }
     
       function updateProduct($itemname,$itemdescription,$itemprice,$ispublished,$rowid){
           global $mysql;
           return $mysql->execute("update _jproduct set itemname='".$itemname."',itemdesc='".$itemdescription."',itemprice='".$itemprice."',ispublished='".$ispublished."' where productid='".$rowid."'");
       }
  }
  
  
  function Type_001($r) {
        
        global $config;
        
        $result = '<div class="listitems">
                        <div><a href="browse.php?/='.$r['itemid'].'-'.$r["itemname"].' class="iistitemTitleLink">'.$r["itemname"].'</a></div>
                        <div class="listitemSubTitle">'.$r["categoryname"].'&nbsp;-&nbsp;'.$r["postedon"].'</div>
                            <table width="100%" cellpadding="0" cellspacing="0" style="font-family:arial;font-size:12px">
                                <tr>
                                    <td style="vertical-align:top;text-align:justify;padding-right:10px;font-family:arial;font-size:12px;">'.substr(strip_tags($r["itemdesc"]),0,500).'</td>
                                    <td style="width:150px;"> <img src="assets/'.$config['thumb'].'/'.$r["filename"].'" style="height:120px;width:150px;"></td>
                                </tr>
                                <tr>
                                    <td style="padding-top:5px;padding-top:5px;">
                                        <div>
                                            <div style="float: left; background: #ccc none repeat scroll 0 0;border: 1px solid #ccc;float: left;font-weight: bold;padding: 5px 15px;width: auto;">
                                                <a href="enquiry.php?/='.$r['itemid'].'-'.trim($r["itemname"]).'" >Enquiry Now</a>
                                            </div>
                                            <div style="margin-left:20px;float: left; background: #ccc none repeat scroll 0 0;border: 1px solid #ccc;float: left;font-weight: bold;padding: 5px 15px;;width: auto;">
                                                <a href="browse.php?/='.$r['itemid'].'-'.trim($r["itemname"]).'" >View Details</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding-top:5px;padding-top:5px;">
                                        <div style="width: 100%; background: #ccc none repeat scroll 0 0;border: 1px solid #ccc;float: left;font-weight: bold;text-align: center;padding-top:5px;padding-bottom:5px">'.$r["itemprice"].'</div>
                                    </td>
                                </tr>
                            </table>
                        </div>';
        return $result;
    
    }
    
     function Type_002($r) {
        
        global $config,$_SITEPATH;
        
        $result = '<div class="listitems">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="text-align:center;height:50px;"><a title="'.$r["itemname"].'" href="'.$_SITEPATH.'item/'.$r['itemfilename'].'.html" class="iistitemTitleLink">'.$r["itemname"].'</a></td>
                            </tr>
                            <tr>
                                <td>
                                    <a title="'.$r["itemname"].'" href="'.$_SITEPATH.'item-'.$r['itemid'].'-'.String2FileName($r["itemname"]).'.html" class="iistitemTitleLink">
                                    <img class="itemimage" src="'.$_SITEPATH.'assets/'.$config['thumb'].'/'.$r["filename"].'"></a>
                                </td>
                            </tr>';
         $displayPrice=false;
        if ($displayPrice) { 
            $result .= '<tr>
                                <td class="itemprice">'.JFrame::getAppSetting("currencysymbol")." ".$r["itemprice"].'</td>
                            </tr>';
                            }
                            
                        $result .='      <tr>
                                <td style="padding:5px;text-align:center">
                                    <a title="Send Enquiry for '.$r["itemname"].'" style="color:#555;font-family:airal;font-size:12px"   href="'.$_SITEPATH.'enquiry/'.$r['itemfilename'].'.html">Enquiry Now</a>&nbsp;&nbsp;
                                    <a title="View Details of '.$r["itemname"].'" style="color:#555;font-family:airal;font-size:12px"  href="'.$_SITEPATH.'item/'.$r['itemfilename'].'.html">View Details</a>
                                </td>
                            </tr>
                        </table>
                   </div>';
        return $result;
    }
                    
    
      function Type_002A($r) {
        
        global $config,$_SITEPATH;
        
        $result = '<div style="border:1px solid #ccc;padding:5px;margin-top:5px;margin-bottom:5px">
                        <table cellpadding="0" cellspacing="0" style="width:100%">
                          
                            <tr>
                                <td style="vertical-align:top;width:140px">
                                    <a title="'.$r["itemname"].'" href="'.$_SITEPATH.'item/'.$r['itemfilename'].'.html" class="iistitemTitleLink">
                                    <img  src="'.$_SITEPATH.'assets/'.$config['thumb'].'/'.$r["filename"].'" style="height:90px"></a>
                                   
                                </td>
                            
                                <td style="text-align:left;vertical-align:top">
                                    <a title="'.$r["itemname"].'" href="'.$_SITEPATH.'item/'.$r['itemfilename'].'.html" class="iistitemTitleLink" style="color:blue">'.$r["itemname"].'</a>
                                    <div style="padding-top:5px;padding-bottom:5px;font-size:11px;font-family:arial;color:#666">
                                        '.substr(strip_tags($r['itemdesc']),0,400).'
                                    </div>
                                   
                                </td>
                            
                            </tr>
                            <tr>
                                <td  class="itemprice" style="font-family:arial;font-size:12px;;font-weight:bold">'.JFrame::getAppSetting("currencysymbol").' '.$r["itemprice"].'</td>
                                <td style="text-align:right;">
                                                                             <a title="Send Enquiry for '.$r["itemname"].'" style="color:#555"   href="'.$_SITEPATH.'enquiry/'.$r['itemfilename'].'.html">Enquiry Now</a>&nbsp;&nbsp;
                                        <a title="View Details of '.$r["itemname"].'" style="color:#555"  href="'.$_SITEPATH.'item/'.$r['itemfilename'].'.html">View Details</a>

                                </td>
                            </tr>
                        </table>
                   </div>';
        return $result;
    }
    
    function Type_003($r) {
        
        global $config,$_SITEPATH;
        
        $result = '<div class="listitems"  style="border-left:0px solid #ccc;border-right:0px solid #ccc;margin:0px !important">
                            <table width="100%" cellpadding="2" cellspacing="0" style="font-family:arial;font-size:12px;">
                                <tr>
                                    <td style="width:100px;">
                                        <a style="color:#666;" href="'.$_SITEPATH.'item/'.$r['itemfilename'].'.html" class="iistitemTitleLink"><img src="'.$_SITEPATH.'assets/'.$config['thumb'].'/'.$r["filename"].'" style="height:75px;width:100px;"></a>
                                    </td>
                                    <td style="height:50px;vertical-align:top">
                                        <div style="font-family:arial;font-size:12px;color:#555">
                                            <a style="color:#666;" href="'.$_SITEPATH.'item/'.$r['itemfilename'].'.html" class="iistitemTitleLink">'.trim($r["itemname"]).'</a>
                                        </div>
                                    </td>
                                </tr>
                               
                            </table>
                        </div>';
        return $result;
        $q = ' <tr>
                                    <td>
                                        <div class="subMenu" style="display:none;font-weight: bold;text-align: center;padding-top:3px;padding-bottom:3px;font-family:arial;font-size:12px;color:#fff;height:auto">'.JFrame::getAppSetting("currencysymbol")." ".$r["itemprice"].'</div>
                                    </td>
                                    <td style="text-align:right">
                                    <a style="color:#666;" href="'.$_SITEPATH.'item/'.$r['itemfilename'].'.html" class="iistitemTitleLink">More</a> 
                                    </td>
                                </tr>';
    
    }
    
     function Type_enquiry($r) {
        
        global $config,$_SITEPATH;
        
        $result = '<div class="listitems" style="float:left;width:auto;margin-left:5px;margin-bottom:5px;">
                       
                        
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="text-align:center;height:50px;">
                                        <div style="width:240px;text-align:center;">
                                    <a style="font-weight:bold;font-family:arial;font-size:13px;color:#444" href="'.$_SITEPATH.'item/'.$r['itemfilename'].'.html" class="iistitemTitleLink">'.$r["itemname"].'</a>
                                    </div>
                                    </td>
                                <tr>
                                    <td style="width:240px;"> <img src="'.$_SITEPATH.'assets/'.$config['thumb'].'/'.$r["filename"].'" style="height:180px;width:240px;"></td>
                                </tr>
                                <tr>
                                    <td style="padding-top:5px;padding-top:5px;display:none">
                                        <div style="width: 100%; background: #ccc none repeat scroll 0 0;border: 1px solid #ccc;float: left;font-weight: bold;text-align: center;padding-top:5px;padding-bottom:5px">'.$r["itemprice"].'</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top:5px;padding-top:5px;text-align:center">
                                       
                                        <a style="font-family:arial;font-size:12px;color:#444"   href="'.$_SITEPATH.'item/'.$r['itemfilename'].'.html">View Details</a>
                                    </td>
                                </td>
                                
                            </table>
                        </div>';
        return $result;
    
    }
?>