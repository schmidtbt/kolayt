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
class Kore_Controller {
    
    private $applicationHelper;
	
	private static $debugMode = true;
	
	/**
	 * @brief Make Kore_Controller near-singleton
	 * 
	 * The constructor call is invoked via the Kore_Controller::run() method which
	 * should only ever be called once in the program.
	 */
    private function __construct(){}
	
	/**
	 * @brief Main function. Start of program processing.
	 * @warn This should only be called once. Instability could ensue for greater numbers
	 * @todo If the Kore_Controller::init() method is still unused, consider removing the call to it here
	 */
    static function run() {
        $instance = new Kore_Controller();
        return $instance->handleRequest();
    }
	
	/**
	 * @brief Deals with the request
	 * 
	 * This method sets up a Kore_Context object for the session. It then calls the Kore_App_Controller to access
	 * the necessary Commands for the given context (based on the URL params, POSt params etc). Each command is executed
	 * in sequence and finally the new view is invoked.
	 */
    function handleRequest() {
    	
        $context = Kore_Context_Registry::ctxt();
        $app_c = new Kore_App_Controller();
        
		
        foreach( $app_c->getCommand() as $cmdString ) {
        	$context->setMessage("Executing Command: " . $cmdString );
        	$cmd = new $cmdString;
			$cmd->execute( $context );		// Explcitly pass $context to avoid pipes using registry
        }
		
        $this->invokeView( $context->getView() , $context->getViewData() );
        return $context;
    }
	
	/**
	 * @brief Create a new Kore_View and render it
	 * 
	 * @param $target String of View name
	 * @param $data Array of data to use in the View rendering
	 */
    function invokeView( $target, array $data ) {
        try{
        	// Build and render
			$view = new Kore_View( $data );
			echo $view->render( $target );	
		} catch( KoreException $e ){
			echo "Default View Invoked";
		}
		
		if( self::$debugMode ){
			echo $this->debugOutput();
		}
    }
    
    
    function debugOutput(){
		echo "<br /><br /><br /><h3>Debug Output</h3>";
		echo "<h5>Message Stream</h5>";
		echo Kore_Context_Registry::ctxt()->getMessageString("<br />");
		
		echo "<h5>Command Execution</h5>";
		echo "<table>";
		foreach( Kore_Context_Registry::ctxt()->getCommandStack() as $cmd ){
			
			echo "<tr><td>" . get_class( $cmd[0] ) . " </td><td> " . $cmd[1] . "</td></tr>";
			
			
		}
		echo "</table>";
		
		echo "<h5>Objects Available</h5>";
		echo "<table>";
		foreach( Kore_Context_Registry::ctxt()->getObjects() as $key => $obj ){
			echo "<tr><td>" . $key . " </td><td> " . get_class( $obj ) . "</td></tr>";
		}
		echo "</table>";
		
		echo "<h5>Context Properties</h5>";
		echo "<table>";
		foreach( Kore_Context_Registry::ctxt()->getProperties() as $key => $props ){
			
			if( is_null( $props ) ){ $props = "NULL"; }
			if( $props === false ){ $props = "False"; }
			if( $props === true ){ $props = "True"; }
			
			echo "<tr><td>" . $key . ": </td><td> " . ($props) . "</td></tr>";
		}
		echo "</table>";
		
		echo "<h5>View Properties</h5>";
		echo "<table>";
		foreach( Kore_Context_Registry::ctxt()->getViewData() as $key => $props ){
			
			if( is_null( $props ) ){ $props = "NULL"; }
			if( $props === false ){ $props = "False"; }
			if( $props === true ){ $props = "True"; }
			
			echo "<tr><td>" . $key . ": </td><td> " . $props . "</td></tr>";
		}
		echo "</table>";
    }
}


?>

