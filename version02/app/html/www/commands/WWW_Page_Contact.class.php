<?php

/**
 * @author Revan
 */
class WWW_Page_Contact extends CAC_Command {
    public function doExecute(CAC_Client_Request $http) {
        $this->getResponse()->setTemplate( 'www_page_contact.tpl');
    }
}

?>
