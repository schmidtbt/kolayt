<?php

/**
 * 
 * @author Revan
 */
class WWW_Page_User_Stream extends CAC_Command {
    
    public function doExecute(CAC_Client_Request $http) {
        
        $params = $http->getUrlParams();
        
        try {
            $user       = App_Authenticate::getLoggedInUser( $http );
            $userData   = App_Authenticate::userBannerData( $user );
            
            $this->getResponse()->smarty()->assign( 'user',         $user->getDispHandle() );
            $this->getResponse()->smarty()->assign( 'userdata',     $userData );
            
            $urls       = VicinityScanner::vicinity( $user,         'UserStreamRankedEdge', 50 );
            $allurls    = App_List_Data::processList( $urls );
            
            $this->getResponse()->smarty()->assign( 'urls',         $allurls );
            $this->getResponse()->smarty()->assign( 'fullurls',     App_List_Data::fullMediaImages( $allurls ) );
            $this->getResponse()->smarty()->assign( 'trend_tags',   App_List_Data::acquireTrendingTags() );
            
            $this->getResponse()->setTemplate( 'www_page_user_stream.tpl' );
        } catch( KoreException $e ){
            $this->getResponse()->headers()->setLocation( '/boot/?p=tag&tag=popular');
        }
        
    }
    
}

?>
