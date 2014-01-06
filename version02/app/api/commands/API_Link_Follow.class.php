<?php

/**
 * @author Revan
 */
class API_Link_Follow extends CAC_API_Command {
    
    public function doExecute(CAC_Client_Request $http) {
        
        $params = $http->getUrlParams();
        
        try {
            
            App_Params::requireParams( $params, array('sid') );
            
            $sid = $params['sid'];
            
            $short = new ShortenerNode( new GraphKey( $sid , true ) );
            $urlNode = $short->getURLNode();
            $link = $urlNode->getURLLink();
            $urlNode->incrementViews();
            
            $this->getResponse()->headers()->setLocation( $link );
            
        } catch( APP_AUTH_EXCEPTION $e ){
            $this->status( CAC_API_Command::FAIL );
            $this->reason( CAC_API_Command::NOUSER );
        } catch( APP_MISSING_PARAMS $e ){
            $this->status( CAC_API_Command::FAIL );
            $this->reason( CAC_API_Command::MISSINGPARAM );
            $this->info( 'no sid specified');
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
