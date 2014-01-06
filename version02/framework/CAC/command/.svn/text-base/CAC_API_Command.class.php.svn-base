<?php

/**
 * @author Revan
 */
abstract class CAC_API_Command extends CAC_Command {
    
    const SUCCESS = 'success';
    const FAIL = 'failure';
    const UNKNOWN = 'unkown';
    const UNINIT = 'uninitialized';
    
    
    const NOUSER = 'notloggedin';
    const MISSINGPARAM = 'missingparams';
    
    /**
     * @var CAC_Api_Response
     */
    protected $response;
    
    function __construct() {
        $this->response = new CAC_Api_Response();
    }
    
    public function execute(CAC_Client_Request $http) {
        $this->method( get_called_class() );
        parent::execute($http);
    }
    
    public function setResponse(CAC_Api_Response $response ){
        parent::setResponse($response);
    }
    
    protected function add($key, $value){
        $this->response->add($key, $value);
    }
    
    protected function status( $value ){
        $this->add( 'status', $value );
    }
    
    protected function reason( $value ){
        $this->add( 'reason', $value );
    }
    
    protected function info( $value ){
        $this->add( 'info', $value );
    }
    
    protected function method( $value ){
        $this->add( 'method', $value );
    }
    
}

?>
