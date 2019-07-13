              </div>
            </div>                               
          </div>
        </div>
      </div>
   </div>
  </div>
  <?php
    if (isset($_POST['Publish'])) {
        
        $response = $webservice->getData("Member","MemberProfilePublishNow",$_POST);
        if ($response['status']=="success") {
             $successmessage = $response['message']; 
        } else {
            $errormessage = $response['message']; 
        }
    }
   ?>
  
    <div style="text-align: right">
        <button type="submit" class="btn btn-primary" name="Preview" style="font-family:roboto">Preview</button>&nbsp;
        <button type="submit" class="btn btn-success" name="Publish" style="font-family:roboto">Publish Now</button>
    </div>

