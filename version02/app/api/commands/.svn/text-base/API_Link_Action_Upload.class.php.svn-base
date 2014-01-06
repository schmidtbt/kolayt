<?php

/**
 * @author Revan
 */
class API_Link_Action_Upload extends CAC_API_Command {
    
    public function doExecute(CAC_Client_Request $http) {
        
        
        $params = $http->getUrlParams();
        
        try {
            
            if( ! isset( $params['url'] ) || $params['url'] === ''  ){
                throw new APP_MISSING_PARAMS('Missing Param');
            } else {
                
                $url = $params['url'];
                
                try {
                    $urlNode = new URLNode( new GraphKeySHA256( $url ) );
                } catch( KoreException $e ){}
                
                $msg = Message::create( array( 'WorkerURLBuilder', 'URLBuilder' ), $url );
                Pub::sendMsg( ExchangePool::singleton()->safeGet('processors') , $msg );
                
            }
            
            
        } catch( APP_AUTH_EXCEPTION $e ){
            $this->status( CAC_API_Command::FAIL );
            $this->reason( CAC_API_Command::NOUSER );
        } catch( APP_MISSING_PARAMS $e ){
            $this->status( CAC_API_Command::FAIL );
            $this->reason( CAC_API_Command::MISSINGPARAM );
            $this->info( 'no url specified');
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
