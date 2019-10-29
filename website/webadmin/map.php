<?php

?>

<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["map"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Lat', 'Long', 'Name'],
          [39.4232, -102.0853, 'Work'],
          [37.4289, -122.1697, 'University'],
          [46.4232, -102.0853, 'Work']
        
        ]);

        var map = new google.visualization.Map(document.getElementById('map_div'));
        map.draw(data, {showTip: true});
      }

    </script>
  </head>

  <body>
    <div id="map_div" style="width: 400px; height: 300px"></div>
  </body>
</html>

<!-- TranslateClient BEGIN -->
<script type="text/javascript" src="http://www.google.com/jsapi"></script><script language="javascript">var gtc_stl='http://translateclient.com/js/widget/gtc.css';</script><script type="text/javascript" src="http://translateclient.com/js/widget/gtc.js"></script><script language="javascript">translateclient.srclang="en";translateclient.checkload();gtc_ws=1;</script><div id="gtc_pan"><div id="gtc_t">Select a text on the page and get translation from Google Translate!</div><label><input id="gtc_chk" type="checkbox" checked="checked" />Translate to </label><select id="gtc_lang"></select><br><a id="gtc_w" href=""></a> <a id="gtc_d" href="http://translateclient.com">Google Translate Client</a></div>
<!-- TranslateClient END --> 










