<?php

/**
 * @author Revan
 */
class WWW_Page_Tag extends CAC_Command {
    
    public function doExecute(CAC_Client_Request $http) {
        
        $params = $http->getUrlParams();
        
        if( isset( $params['tag'] ) ){
            
            $tagNode    = new TagNode( new GraphKey( $params['tag'] ) );
            $urls       = VicinityScanner::vicinity( $tagNode, 'TagURLEdge', 50 );
            
            $this->getResponse()->smarty()->assign( 'tag',  $tagNode->getDispName());
            
            $allurls    = App_List_Data::processList( $urls );
            
            $this->getResponse()->smarty()->assign( 'urls',             $allurls );
            $this->getResponse()->smarty()->assign( 'fullurls',         App_List_Data::fullMediaImages( $allurls ) );
            $this->getResponse()->smarty()->assign( 'trend_tags',       App_List_Data::acquireTrendingTags() );
            $this->getResponse()->smarty()->assign( 'tag_num_followers',$tagNode->getNumFollowers() );
            
            
            try {
                $user = App_Authenticate::getLoggedInUser($http);
                $userData = App_Authenticate::userBannerData( $user );
                
                try {
                    $userTag = new UserTagEdge( $user, $tagNode );
                    $this->getResponse()->smarty()->assign( 'following', true );
                } catch( KoreException $e ){
                    $this->getResponse()->smarty()->assign( 'following', false );
                }
                
                
                
            } catch( KoreException $e ){
                $userData = null;
            }
            $this->getResponse()->smarty()->assign( 'userdata', $userData );
            
            
            
            
            
            $this->getResponse()->setTemplate( 'www_page_tag.tpl' );
        }
        
    }
    
    
}

?>
