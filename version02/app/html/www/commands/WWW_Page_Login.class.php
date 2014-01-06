<?php

/**
 * @author Revan
 */
class WWW_Page_Login extends CAC_Command {
    
    public function doExecute(CAC_Client_Request $http) {
        $this->getResponse()->setTemplate( 'www_page_login_signup.tpl');
    }
    
}

?>
