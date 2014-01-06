<?php

/**
 * @author Revan
 */
class WWW_Page_Bio extends CAC_Command {
    
    public function doExecute(CAC_Client_Request $http) {
        
        $params = $http->getUrlParams();
        
        try {
            
            App_Params::requireParams( $params , array('handle') );
            $userNode = new UserNode( new GraphKey( $params['handle'] ) );
            
            $this->add( 'disp_handle', $userNode->getDispHandle() );
            $this->add( 'handle', $userNode->getKeyString() );
            $this->add( 'numfollowers', $userNode->getNumFollowers() );
            $this->add( 'numfollowing', $userNode->getNumFollowings() );
            
            $this->getResponse()->setTemplate('www_page_user_bio.tpl');
            
            try {
                $thisUser = App_Authenticate::getLoggedInUser($http);
                $userTags = VicinityScanner::vicinity( $thisUser , 'UserTagEdge' );
                
                $tags = array();
                foreach( $userTags as $ut ){
                    $tags[] = $ut->to()->getKeyString();
                }
                $this->add('tags', $tags );
                
                
            } catch( APP $e ){
                
            }
            
            
            
            
        } catch( APP_AUTH_EXCEPTION $e ){
        } catch( APP_MISSING_PARAMS $e ){
            $this->setResponse( new BADREQUEST() );
        } catch( GRAPH_EXCEPTION $e ){
            $this->setResponse( new BADREQUEST() );
        } catch( KoreException $e ){
            var_dump( $e );
        }
        
    }
    
}

?>
