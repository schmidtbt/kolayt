<?php

/**
 * @author Revan
 */
class WWW_Page_Account extends CAC_Command {
    public function doExecute(CAC_Client_Request $http) {
        
        try {
            
            $user       = App_Authenticate::getLoggedInUser($http);
            $userData   = App_Authenticate::userBannerData( $user );
            
            $this->getResponse()->smarty()->assign( 'userdata', $userData );
            
            $userTags = VicinityScanner::vicinity( $user, 'UserTagEdge' );
            
            $userTagArr = App_List_Data::userTagsList($userTags);
            $this->getResponse()->smarty()->assign( 'usertags', $userTagArr );
            
            
            $this->getResponse()->setTemplate( 'www_page_account.tpl' );
            
        } catch( KoreException $e ){
            
            $userData   = null;
            
        }
        
    }
}

?>
