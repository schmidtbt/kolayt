<?php

/**
 * @brief A Kore_Command object performs a single linear processing stream given a http
 * 
 */
abstract class CAC_Command {

    /**
     *
     * @var CAC_Response
     */
	protected $response;
    
	
    function __construct() {
        $this->response = new CAC_Response();
    }
	
	
	/**
	 * @brief Overriden in sub-classes. Called by public call to Kore_Command::execute()
	 * @return
	 */
    abstract function doExecute( CAC_Client_Request $http );
    
	
	/**
	 * @brief Public method to excute the command sequence
	 * 
	 * @return INT Status of the command
	 * @see Kore_Command::getStatusString() to return the status as a string
	 */
    public function execute( CAC_Client_Request $http ) {
        $this->doExecute( $http );
    }
    
    public function setResponse( CAC_Response $response ){
        $this->response = $response;
    }
    
	public function getResponse(){
        return $this->response;
    }
    
    protected function add( $key, $value ){
        $this->getResponse()->smarty()->assign($key, $value);
    }
    
}


?>