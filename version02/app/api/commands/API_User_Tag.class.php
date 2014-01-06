<?php

/**
 * 
 * @author Revan
 */
class API_User_Tag extends CAC_API_Command {
	
	public function doExecute(CAC_Client_Request $http) {
		
        $params = $http->getUrlParams();
        
        try {
            $userNode = App_Authenticate::getLoggedInUser($http);
            
            if( ! isset( $params['tag'] ) ){
                throw new APP_MISSING_PARAMS('Missing Param');
            } else {
                $tag = $params['tag'];
                $tagNode = new TagNode( new GraphKey( $tag ) );
            }
            
            
            if( array_search('follow', $params) ){

                $userTag = UserTagEdge::create( $userNode, $tagNode );
                $this->status( CAC_API_Command::SUCCESS );
                $this->info( 'following');
                
                
            } elseif( array_search('unfollow', $params) ){
                
                $userTagEdge = new UserTagEdge( $userNode, $tagNode );
                $userTagEdge->delete();
                $this->status( CAC_API_Command::SUCCESS );
                $this->info( 'unfollowing');
                
            }


        } catch( APP_AUTH_EXCEPTION $e ){
            $this->status( CAC_API_Command::FAIL );
            $this->reason( CAC_API_Command::NOUSER );
        } catch( APP_MISSING_PARAMS $e ){
            $this->status( CAC_API_Command::FAIL );
            $this->reason( CAC_API_Command::MISSINGPARAM );
            $this->info( 'no tag specified');
        } catch( GRAPH_EXCEPTION $e ){
            $this->status( CAC_API_Command::FAIL );
            $this->info( 'graph failure');
        } catch( KoreException $e ){
            var_dump( $e );
            $this->status( CAC_API_Command::FAIL );
            $this->reason( CAC_API_Command::UNKNOWN );
        }
        
	}
	
}

?>
