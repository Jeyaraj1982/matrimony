<?php
//  l -- list
//  o -- Order by     old to new, new to old
//  p -- page
//  s -- search key
     
?>
<div style="padding:10px 0px;background:#f1f1f1">
    <table style="width: 100%;" cellpadding="5" cellspacing="0">
        <tr>
            <td style="padding-left:0px;">
                <div style="border:1px solid #ccc;background:#fff;width:438px">
                    <input value="<?php echo isset($_REQUEST['s']) ? $_REQUEST['s'] : '';?>" type="text" name="searchkeyword" id="searchkeyword" placeholder="Search" style="border:1px solid #fff; background:#fff url('assets/images/searchicon.png') no-repeat scroll 7px 7px;padding:5px 10px 7px 30px;width:360px;">
                    <img src="assets/images/searchbtn.png" align="top" onclick="gobrowsepage()">
                </div>
            </td>
            <td style="width:300px;text-align:center;text-align:right;padding-right:0px;">
                 <select onchange="gobrowsepage()" id="browse_allitems_categorywise" style="border:1px solid #ccc;padding:4px;">
                    <option value="0">All Items</option>
                    <?php foreach($categories as $category) { ?>
                        <option value="<?php echo $category['categoryid'];?>" <?php echo ($_REQUEST['l']==$category['categoryid']) ? " selected='selected'" : "";?> ><?php echo $category['categoryname'];?></option>
                    <?php } ?>
                 </select>&nbsp;
                 <select id="browse_allitems_orderby"  onchange="gobrowsepage()"  style="border:1px solid #ccc;padding:4px;">
                    <option value="l">Latest</option>
                    <option value="m">Most Popular</option>
                 </select>
            </td>
        </tr>
    </table>
</div>
<div style='padding-left:2px;'>
    
<?php foreach ($result as $r) {
          
      if ( strtolower($_SERVER['HTTP_HOST'])=="www.nagercoilproperties.in" || strtolower($_SERVER['HTTP_HOST'])=="nagercoilproperties.in" ) {
          
          echo Type_002A($r);
      } else {
        echo Type_002($r);  
      }
    
        
}
?>
</div>
<div style='clear:both'>
    <?php for($i=0;$i<=intval($records/$recordsperpage);$i++) { ?>
        <a href="browse.php?p=<?php echo $i+1;?>"><?php echo $i+1;?></a>
    <?php } ?> 
</div>
 