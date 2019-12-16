<?php session_start(); ?>
<?php
 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        $targ_w = $targ_h = 150;
        $jpeg_quality = 90;
        $filename=time().md5(time());
        
        $src = "./".$_SESSION['filepath'];
        $dst_r = ImageCreateTrueColor( $_POST['w'], $_POST['h'] );
        
        //header('Content-type: image/png');
        //imagepng($dst_r,null);

        if (strtolower(substr($src,strlen($src)-3))=="png") {
            
            $img_r = imagecreatefrompng(realpath($src));
            imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],$_POST['w'],$_POST['h'],$_POST['w'],$_POST['h']);
            imagealphablending($dst_r, true);
            imagepng($dst_r, $_POST['thumbpath'].$filename.'.png');
            $_SESSION['filename']=$filename.".png";
            echo $_SESSION['filename'];
        
        } else if (strtolower(substr($src,strlen($src)-3))=="jpg") {
            
            $img_r = imagecreatefromjpeg(realpath($src));
            imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],$_POST['w'],$_POST['h'],$_POST['w'],$_POST['h']);
            imagejpeg($dst_r, $_POST['thumbpath'].$filename.'.jpg',$jpeg_quality);
            $_SESSION['filename']=$filename.".jpg";
            echo $_SESSION['filename']; 
              
        } else if (strtolower(substr($src,strlen($src)-4))=="jpeg") {
            
            $img_r = imagecreatefromjpeg(realpath($src));
            imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],$_POST['w'],$_POST['h'],$_POST['w'],$_POST['h']);
            imagejpeg($dst_r, $_POST['thumbpath'].$filename.'.jepg',$jpeg_quality);
            $_SESSION['filename']=$filename.".jpeg";
            echo $_SESSION['filename'];
            
        } else {
            echo "Error";
        }
        imagedestroy($dst_r);
        exit;
}
?>
<div class="container">
    <div class="row">
        <div class="span12">
            <div class="jc-demo-box">
                <img src="../<?php echo $_SESSION['filepath'];?>" id="cropbox"  />
                <div style="background:#ccc;padding:10px 0px;text-align:center">
                    <form  method="post"  id="cropform" style="margin:0px;">
                        <input type="hidden" id="thumbpath" name="thumbpath" value="">
                        <input type="hidden" id="x" name="x" />
                        <input type="hidden" id="y" name="y" />
                        <input type="hidden" id="w" name="w" />
                        <input type="hidden" id="h" name="h" />
                        <input type="button" id="image_done" name="image_done" onclick="CropImage()" value="Crop & Save" class="btn btn-large btn-inverse" />
                        <input type="submit" value="Cancel" class="btn btn-large btn-inverse" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>