<?php

/**
 * @brief Read Only object containing elements of HTTP request
 *
 * Method calls internal convertServerRequest method and then exposes
 * all values via public API
 *
 * @see http://php.net/manual/en/reserved.variables.server.php for $_SERVER information
 */
class CAC_Client_Request {

    protected $_server;
    protected $_get;
    protected $_post;
    protected $_request;
    protected $_cookies;
    protected $_params;

    public function __construct() {
        // Convert SERVER and REQUEST variables into stored elements
        $this->convertServerRequest();
    }

    public function httpMethod() {
        if (isset($this->_server['REQUEST_METHOD'])) {
            return $this->_server['REQUEST_METHOD'];
        }
    }

    public function getCookies() {
        if (isset($this->_cookies)) {
            return $this->_cookies;
        }
    }

    public function getUrlParams() {
        if (isset($this->_get)) {
            return $this->_get;
        }
    }
    
    public function unsetURLParam( $param ){
        $search = array_search( $param, $this->_get );
        if( $search !== false ){
            $get = $this->_get;
            if( isset( $get[$search] ) ){
                unset( $get[$search] );
            }
            $this->_get = $get;
        }
    }

    public function getPostData() {
        if (isset($this->_post)) {
            return $this->_post;
        }
    }

    public function getAllParams() {
        if (isset($this->_params)) {
            return $this->_params;
        }
    }

    public function paramGETExists($param) {
        return isset($this->_get[$param]) ? $this->_get[$param] : false;
    }

    public function paramPOSTExists($param) {
        return isset($this->_post[$param]) ? $this->_post[$param] : false;
    }

    public function paramExists($param) {
        return isset($this->_params[$param]) ? $this->_params[$param] : false;
    }

    protected function setField($field, $value) {
        $this->_server[$field] = $value;
    }

    /**
     * @brief Convert the Server variables and settings into properties of the object
     */
    protected function convertServerRequest() {
        // URL execution
        if (isset($_SERVER)) {
            foreach ($_SERVER as $key => $value) {
                $this->setField($key, $value);
            }
        }

        $this->_request = $_REQUEST;
        $this->_get = $_GET;
        $this->_post = $_POST;
        $this->_cookies = $_COOKIE;
        $this->_params = array_merge($this->_get, $this->_post);

        // Command Line Execution
        /*
          foreach( $_SERVER['argv'] as $arg ) {
          if ( strpos( $arg, '=' ) ) {
          list( $key, $val )=explode( "=", $arg );
          $this->setProperty( $key, $val );
          }
          }
         */
    }

}

?>