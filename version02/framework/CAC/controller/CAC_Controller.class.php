<?php

/**
 * @brief Insertion point for Kore program
 * 
 * This method is normally invoked via a simple Kore_Controller::run() call
 * That should begin the cascade for a given request.
 * 
 * Program execution is as follows:
 * @li Kore_Controller::run()
 * @li Kore_Constroller::handleRequest()
 * @li Kore_constroller::invokeView()
 * 
 */
class CAC_Controller {
    
	/**
	 * @brief Make Kore_Controller near-singleton
	 * 
	 * The constructor call is invoked via the Kore_Controller::run() method which
	 * should only ever be called once in the program.
	 */
    protected function __construct(){}
	/**
	 * @brief Main function. Start of program processing. Singleton.
	 * @warn This should only be called once. Instability could ensue for greater numbers
     * 
	 */
    static function run() {
        $class = get_called_class();
		$instance = new $class();
		return $instance->handleRequest();
    }
    
	/**
     *
     * @return CAC_Response
     * @throws KoreException
     * @throws CAC_EXCEPTION 
     */
    protected function handleRequest() {
    	try{
            
            // Generate a request object
    		$http       = new CAC_Client_Request();
            $AppMap     = CAC_Application_Router::route( $http );
            
            // Execute the command based on this request
            $cmd        = CAC_Command_Mapper::getCommand( $http, $AppMap );
			$cmd->execute( $http );
            
            // Get response and execute initialize a view
            $response   = $cmd->getResponse();
            $this->invokeView( $response );
		    
            $this->handleHeaders($response);
            
            return $response;
            
    	} catch ( KoreException $e ){
            throw $e;
    		throw new CAC_EXCEPTION('Request Handle Failure',0, $e );
    	}
    }
    
    protected function handleHeaders(CAC_Response $response){
        $response->headers()->executeHeaders();
    }
    
    /**
     *
     * @param CAC_Response $response 
     */
    protected function invokeView( CAC_Response $response ) {
        try{
            $response->invoke();
		} catch( KoreException $e ){
            echo "\nError while invoking view\n";
            echo $e->getMessage();
		}
        $this->debugOutput();
    }
    
    /**
     *
     * @param Kore_View $view
     * @param CAC_Response $response 
     */
    protected function outputToDisplay( Kore_View $view, CAC_Response $response ){
        try {
            echo $view->render( $response->getView() );	
        } catch( KoreException $e ){
            echo "\nCAC_Controller::outputToDisplay Error outputting To Display\n";
            echo "Message: " . $e->getMessage();
        }
    }
    
    protected function debugOutput(){}
}


?>

