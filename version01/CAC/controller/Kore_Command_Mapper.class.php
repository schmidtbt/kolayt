<?php

/**
 * @brief Maps Kore_Request URL-Params to Internal Command Paths
 * 
 * @note This Class expects a mod_rewrite type setting to turn all the trailing characters after the domain,
 * into separate URL param values. Typically, we'll expect that a url contains, when sent via a client, a
 * method name using the path specifiers with any other qualifying marking using dedicated URL params setforth in
 * an API for that method. i.e. www.kolayt.com/element/vote/?eid=1422342&v=1 which would get translated
 * to the URL params [0] => element, [1] => vote, followed by teh more standard url params. eid, v etc.
 * 
 * Uses the order of the $_GET parameter (via the context->http_request object) to recursively search
 * various command mappers. At each level, each new index of $_GET will retrieve the command path for that
 * level. If a sub-command path is available, it will go to that lower-mapper and access those elements.
 * 
 * This is accomplished via recursively accessing getCommand.
 *  
 * @section NewPathWay New Path Way
 * 
 * To create a new pathway, specify a "method" which is simple the first trailing segment
 * following the domain name. For instance, www.kolayt.com/method1 would be "method1".
 * 
 * To specify the desired HTTP type, either GET or POST and then an array of commands which
 * should be executed for that command.
 * 
 * To have "method1" on GET, execute log_cmd2 and log_cmd15, add a line to Kore_Command_Mapper::$commandMap
 * array with the following: "method1" => array( "GET", array("log_cmd2",'log_cmd15') )
 * 
 * [methodname] => array( <HTTPtype> , <"command" | array( "cmd1", "cmd2" ... )> )
 * or
 * [methodname] =>  "Sub-class_Kore_Command_Mapper"
 * 
 * Hierarchical commands can also be created, if you want, www.kolayt.com/majormethod/minormethod to execute a 
 * specific command pathway, you must create a sub-class of Kore_Command_Mapper, and add a record into the array
 * Kore_Command_Mapper::$commandMap with the name of that sub-class. For instance, "elements" => "Kore_Command_Mapper_Elements"
 * This will make www.kolayt.com/elements/<subcommand> go into the Kore_Command_Mapper_Elements class to be dealt with
 * and specific methods can be created there.
 * 
 * @section Defaults Default Values
 * Default values for GET/POST can be accessed via the static properties. They specify an array structure of commands to execute. 
 * Use this to create default pages for various types.
 * 
 */
class Kore_Command_Mapper {
	
	protected static $commandMap = array(
		"login" 	=> array( "GET",  array( "Cmd_Login", "VCmd_Section" ) ),
		"logout" 	=> array( "GET", "Cmd_Logout" ),
		"element" 	=> "Kore_Command_Mapper_Element",
		"section" 	=> "Kore_Command_Mapper_Section"
	);
	
	// Default Methods for command returns
	protected static $defaultGET 		= array( "log_cmd" );
	protected static $defaultPOST 		= array( "log_cmd" );
	protected static $defaultOTHER		= array( "log_cmd" );
	// Mismatch HTTP Type Command
	protected static $mismatchCommand 	= array( "log_cmd" );
	
	/**
	 * @todo maybe should throw an exception if method provided is different? Right now uses Kore_Command_Mapper::$mismatchCommand
	 * @todo Update the context messaging to include further information
	 * @param $idx Is used to allow recursive calls into sub-class getCommand() functions to use successive indexes of hte
	 * URL parameters as testing values.
	 * @warning DO NOT explicitly set $idx parameter unless you know what you're doing
	 * 
	 * @return Array Of command class names
	 */
	public static function getCommand( $idx = 0 ){
		
		$context = Kore_Context_Registry::ctxt();
		$cmdArray = null;
		
		$params = $context->httpRequest()->getUrlParams();
		$pvalues = array_keys( $params );
		
		if( sizeof( $pvalues ) > 0 
		 && isset( $pvalues[$idx] ) 
		 && isset( $params[ $pvalues[$idx] ] ) 
		 && isset( static::$commandMap[$params[ $pvalues[$idx] ] ] ) ){
			
			// The method name
			$value = static::$commandMap[$params[ $pvalues[$idx] ] ];
			
			if( is_string( $value ) ){
				// Use a sub-mapper
				$cmdArray = $value::getCommand( $idx+1 );
				Kore_Context_Registry::ctxt()->setMessage('Command-Mapping to: ' . $value );
			} else {
				// Use this mapper
				if( ! self::checkHttpType( $value, $context ) ){
					$cmdArray = self::$mismatchCommand();
					// ? // throw new Kore_Command_Mapper_Exception("Kore_Command_Mapper::getCommand Mismatched HTTP type" );
				}
				$context->setMessage('Command-Mapping to: ' . __CLASS__ );
				//			value is an array
				$cmdArray = $value[1];		// <<< CHANGE THIS VALUE FOR VIEW MOD
			}
			
		} else {
			// Default
			$cmdArray = self::switchHTTPDefault( $context );
			Kore_Context_Registry::ctxt()->setMessage('Command-Mapping Default in: ' . __CLASS__ );
		}
		
		// Make output an array
		if( !is_array( $cmdArray) ){
			return array( $cmdArray );
		} else {
			return $cmdArray;
		}
	}
	
	/**
	 * @brief Return the default command structure
	 * 
	 * @param Kore_Context $context which reports the HTTP method used
	 * @return Array of Kore_Commands as strings (Class names of commands)
	 */
	protected static function switchHTTPDefault( Kore_Context $context ){
		
		$http = $context->httpRequest()->httpMethod();
		
		switch( $http ){
			case "GET":
				return static::$defaultGET;
				break;
			case "POST":
				return static::$defaultPOST;
				break;
			default:
				return static::$defaultOther;	
				break;
		}
	}
	
	/**
	 * @brief Check if the HTTP method provided is the same as that expected
	 */
	protected static function checkHttpType( $value, Kore_Context $context ){
		
		if( $value[0] === $context->httpRequest()->httpMethod() ){
			return true;
		} else {
			return false;
		}
		
	}
	
	
}

?>