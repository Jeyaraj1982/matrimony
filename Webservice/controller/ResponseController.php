<?php

    class Response {
        
        function returnError($message,$data=array()) {
            return json_encode(array("status"=>"failed","message"=>$message, "data"=>$data));
        }
    
        function returnSuccess($message,$data=array()) {
            return json_encode(array("status"=>"success","message"=>$message,"data"=>$data),JSON_FORCE_OBJECT);
        }
    }

?> 