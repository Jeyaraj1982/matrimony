
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.accordion {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.active, .accordion:hover {
  background-color: #ccc; 
}

.panel {
  padding: 0 0px;
  display: none;
  background-color: white;
  overflow: hidden;
}
</style>
</head>

<button class="accordion">General Information</button>
<div class="panel">
  <?php include_once("GeneralInformation.php");?>
</div>

<button class="accordion">Profile Information</button>
<div class="panel">
 <?php include_once("ProfileInformation.php");?>
</div>

<button class="accordion">Education details</button>
<div class="panel">  
</div>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>

</body>
</html>
