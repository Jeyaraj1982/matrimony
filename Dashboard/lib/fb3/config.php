<?php


 require 'api/facebook.php';


 $config['App_ID'] = '1994187757521116';

 $config['App_Secret'] = 'dedba77479909732a5a5f06754cda55c';


 $facebook = new Facebook(array(

  'appId'  => $config['App_ID'],

  'secret' => $config['App_Secret']

 ));


?>