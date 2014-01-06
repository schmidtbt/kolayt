<?php

/**
 * 
 * @author Revan
 */
class API_Tag_Search extends CAC_API_Command {
	
	public function doExecute(CAC_Client_Request $http) {
		
        $params = $http->getAllParams();
        
        try {
            
            if( ! isset( $params['q'] ) ){
                throw new APP_MISSING_PARAMS('Missing Param');
            } else {
                
                $query = $params['q'];
                $partialKey = new GraphKey( $query, true );
                $results = ( VicinityScanner::partialNodeScan($partialKey, 'TagNode' ) );
                
                
                $output = array();
                foreach( $results as $res ){
                    $output[] = array( 'tag_key' => $res->getKeyString(), 'tag_disp' => $res->getDispName() );
                }
                $this->add( 'results', $output );
                
            }
            
            
        } catch( APP_AUTH_EXCEPTION $e ){
            $this->status( CAC_API_Command::FAIL );
            $this->reason( CAC_API_Command::NOUSER );
        } catch( APP_MISSING_PARAMS $e ){
            $this->status( CAC_API_Command::FAIL );
            $this->reason( CAC_API_Command::MISSINGPARAM );
            $this->info( 'no query specified');
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
