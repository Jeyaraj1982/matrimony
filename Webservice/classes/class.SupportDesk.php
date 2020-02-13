<?php
 class SupportDesk {
    function SupportDeskLogin() {

            global $mysql,$j2japplication;  

            if (!(strlen(trim($_POST['UserName']))>0)) {
                return Response::returnError("Please enter login name ");
            }

            if (!(strlen(trim($_POST['Password']))>0)) {
                return Response::returnError("Please enter password ");
            }

            $data=$mysql->select("select * from _tbl_support_desk_user where UserLogin='".$_POST['UserName']."' and UserPassword='".$_POST['Password']."'") ;
            if (sizeof($data)==0) {
                return Response::returnError("Invalid login name and password");
            }
                
            $clientinfo = $j2japplication->GetIPDetails($_POST['qry']);
            $loginid    = $mysql->insert("_tbl_logs_logins",array("LoginOn"       => date("Y-m-d H:i:s"),
                                                                  "LoginFrom"     => "Web",
                                                                  "Device"        => $clientinfo['Device'],
                                                                  "SupportDeskUserID"=> $data[0]['UserID'],
                                                                  "LoginName"     => $_POST['UserName'],
                                                                  "BrowserIP"     => $clientinfo['query'],
                                                                  "CountryName"   => $clientinfo['country'],
                                                                  "BrowserName"   => $clientinfo['UserAgent'],
                                                                  "APIResponse"   => json_encode($clientinfo),
                                                                  "LoginPassword" => $_POST['Password']));
            $data[0]['LoginID']=$loginid;
            return ($data[0]['IsActive']==1) ? Response::returnSuccess("success",$data[0]) : Response::returnError("Access denied. Please contact support");
        }
}

//2801
?> 