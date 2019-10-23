<?php

    class Response {
        
        function returnError($message,$data=array()) {
            return json_encode(array("status"=>"failed","message"=>$message, "data"=>$data));
        }
    
        function returnSuccess($message,$data=array()) {
            $return = array();
            $return["status"]  = "success";
            $return["message"] = isset($message) ? $message : "no message";
            if (is_array($data) && sizeof($data)>0) {
                $return["data"] = $data;
            }
            //return json_encode(array("status"=>"success","message"=>$message,"data"=>$data),JSON_FORCE_OBJECT);
            return json_encode($return,JSON_FORCE_OBJECT);
        }
    }

?> 