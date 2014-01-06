<?php

/**
 * @brief A Kore_Command object performs a single linear processing stream given a context
 * 
 * Sub-classes of Kore_Command override the Kore_Command::doExecute() method and perform specific
 * processing on the Kore_Context object. That object is given as a reference to the global Kore_Context via
 * the Kore_Controller
 * 
 * @note Most Kore_Command sub-classes will use a Kore_Pipe object pipeline to build successive command
 * sequences
 * 
 */
abstract class Kore_Command {

    private static $STATUS_STRINGS = array (
        'CMD_DEFAULT'			=>0,
        'CMD_OK' 				=> 1,
        'CMD_ERROR' 			=> 2,
        'CMD_INSUFFICIENT_DATA' => 3
    );
	
    private $status = 0;
	
	
    final function __construct() { }
	
	
	/**
	 * @brief Overriden in sub-classes. Called by public call to Kore_Command::execute()
	 * @return Status? @see execute()
	 */
    abstract function doExecute( Kore_Context $context );
    
	
	/**
	 * @brief Public method to excute the command sequence
	 * 
	 * @return INT Status of the command
	 * @see Kore_Command::getStatusString() to return the status as a string
	 */
    public function execute( Kore_Context $context ) {
        $this->status = $this->doExecute( $context );
        $context->addToCommandStack( $this->getStatusString(), $this );
       	return $this->status;
    }
	
	
	
	
	
	/**
	 * @return INT status
	 */
    public function getStatus() {
        return $this->status;
    }
    
	/**
	 * @return String status
	 */
    public function getStatusString(){
    	return array_search( $this->status, self::$STATUS_STRINGS );
    }
    
	/**
	 * @brief Used by sub-classes to access status values via Strings
	 * 
	 * @return INT status string
	 * @return INT default status string if the provided status is not valid
	 */
    static function statuses( $str='CMD_DEFAULT' ) {
        if ( empty( $str ) ) { $str = 'CMD_DEFAULT'; }
        return self::$STATUS_STRINGS[$str];
    }
	
}


?>