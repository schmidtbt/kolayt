<?php

/**
 *@brief Read Only object containing elements of HTTP request
 *
 *Method calls internal convertServerRequest method and then exposes
 *all values via public API
 *
 *@see http://php.net/manual/en/reserved.variables.server.php for $_SERVER information
 */
class Kore_HTTP_Request {
	
	protected $_server;
	protected $_get;
	protected $_post;
	protected $_request;
	protected $_cookies;
	
	public function __construct(){
		// Convert SERVER and REQUEST variables into stored elements
		$this->convertServerRequest();
	}
	
	public function httpMethod(){
		if( isset( $this->_server['REQUEST_METHOD'] ) ){
			return $this->_server['REQUEST_METHOD'];
		}
	}
	
	public function getCookies(){
		if( isset( $this->_cookies ) ){
			return $this->_cookies;
		}
	}
	
	public function getUrlParams(){
		if( isset( $this->_get ) ){
			return $this->_get;
		}
	}
	
	public function getPostData(){
		if( isset( $this->_post ) ){
			return $this->_post;
		}
	}
	
	
	
	protected function setField( $field, $value ){
		$this->_server[ $field ] = $value;
	}
	
	
	/**
	 * @brief Convert the Server variables and settings into properties of the object
	 */
	protected function convertServerRequest(){
		// URL execution
		if ( isset( $_SERVER ) ) {
		    foreach( $_SERVER as $key => $value ){
			$this->setField( $key, $value );
		    }
		}
		
		$this->_request = $_REQUEST;
		$this->_get 	= $_GET;
		$this->_post 	= $_POST;
		$this->_cookies = $_COOKIE;
		
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
	
	
	
	
/**
 *@fn httpMethod
 *
 *@brief Some information on httpMethod
 */
}




?>