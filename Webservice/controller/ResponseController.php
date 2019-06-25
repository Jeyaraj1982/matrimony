<?php

    class Response {
        
        function returnError($message) {
            return json_encode(array("status"=>"failed","message"=>$message));
        }
    
        function returnSuccess($message,$data) {
            return json_encode(array("status"=>"success","message"=>$message,"data"=>$data));
        }
    }

?>