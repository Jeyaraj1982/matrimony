<?php
    $large = "";
    if (JFrame::getAppSetting('sharesize')=='large') {
        $large = "_large";
    }
?>
<span class='st_sharethis<?php echo $large;?>' displayText='ShareThis'></span>
<span class='st_facebook<?php echo $large;?>' displayText='Facebook'></span>
<span class='st_twitter<?php echo $large;?>' displayText='Tweet'></span>
<span class='st_linkedin<?php echo $large;?>' displayText='LinkedIn'></span>
<span class='st_pinterest<?php echo $large;?>' displayText='Pinterest'></span>
<span class='st_email<?php echo $large;?>' displayText='Email'></span>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "51d43a05-92cf-4629-bc98-4faf34a3ba9d", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
