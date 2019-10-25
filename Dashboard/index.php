<?php 
    include_once("config.php");
    include_once("includes/lang_eng.php");
    //include_once("includes/lang_tam.php");
    include_once("includes/header.php");

    if (isset($_GET['p'])) {
        if (file_exists("views/".UserRole."/".trim($_GET['p']).".php")) {
            include_once("views/".UserRole."/".trim($_GET['p']).".php");    
        } else {
            include_once("views/".UserRole."/Dashboard.php");
        }
    } else {
        include_once("views/".UserRole."/Dashboard.php");
    }
    
    include_once("includes/footer.php");
    
            
    class HtmlDesign {
        
        function InformationNotFound($message) {
            return '
                <div class="col-12 grid-margin">
                    <div class="card">                                                                                                               
                        <div class="card-body">
                            <div class="form-group row">
                                <div style="text-align:center;color:#FF6035;padding:10%" class="col-sm-12">
                                    <img src="'.ImagePath.'info_unavailable.jpg"><br><br>'.$message.'
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        }
        
    }
?>