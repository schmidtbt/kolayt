<?php

/**
 * @author Revan
 */
class API_Tag_Create extends CAC_API_Command {
    
	public function doExecute(CAC_Client_Request $http) {
		
        $params = $http->getUrlParams();
        
        try {
            
            $userNode = App_Authenticate::getLoggedInUser( $http );
            
            if( ! isset( $params['newtag'] ) || $params['newtag'] === '' ){
                throw new APP_MISSING_PARAMS('Missing Param');
            } else {
                
                TagNodeBuilder::create( $params['newtag'] );
                $this->status( CAC_API_Command::SUCCESS );
            }
            
            
        } catch( APP_AUTH_EXCEPTION $e ){
            $this->status( CAC_API_Command::FAIL );
            $this->reason( CAC_API_Command::NOUSER );
        } catch( APP_MISSING_PARAMS $e ){
            $this->status( CAC_API_Command::FAIL );
            $this->reason( CAC_API_Command::MISSINGPARAM );
            $this->info( 'no new tag specified');
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
