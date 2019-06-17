<?php

  echo "done";
  print_r($_FILES);
     {
        echo "done";
 $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $name);
    $extension = end($temp);

if ((($_FILES["file"]["type"][$f] == "image/gif")
|| ($_FILES["file"]["type"][$f] == "image/jpeg")
|| ($_FILES["file"]["type"][$f] == "image/jpg")
|| ($_FILES["file"]["type"][$f] == "image/png"))
&& ($_FILES["file"]["size"][$f] < 2000000)
&& in_array($extension, $allowedExts))
{
  if ($_FILES["file"]["error"][$f] > 0)
  {
    echo "Return Code: " . $_FILES["file"]["error"][$f] . "<br>";
  }
  else
  {

    if (file_exists("uploadimages/" . $name))
    {

    }
    else
    {
        move_uploaded_file($_FILES["file"]["tmp_name"][$f], "uploadimages/" . uniqid() . "_" . $name);
    }
  }
}
else
{
    $error =  "Invalid file";
}
}
?>