<?php

class Kore_Context {
	
	private $_httpRequestObj; 			/**< @brief An object of type: Kore_HTTP_Request */
	private $appreg;
    private $properties;
    private $_objects 		= array();
    private $_messages 		= array();
    private $_commandStack 	= array();
	private $_view;
	private $_viewData;
	
	public function __construct() {
		$this->_httpRequestObj = new Kore_HTTP_Request();
	}
	
	
	
	
	
	/**
	 * @name Property Access / Retrieve
	 */
	//@{
	public function getProperty( $key ) {
	    if ( isset( $this->properties[$key] ) ) {
	        return $this->properties[$key];
	    }
	}
	
	public function setProperty( $key, $val ) {
		
		if( isset( $this->properties[$key] ) ){
			$this->setMessage( "CTXT: Overriding existing property value at key: " . $key );
		}
	    $this->properties[$key] = $val;
	}
	//@}
	
	/**
	 * @name View Access/Retrieval
	 */
	//@{
	public function getView(){
		if ( isset( $this->_view ) ) {
	        return $this->_view;
	    }
	}
	
	public function setView( $view ){
		if( isset( $this->_view ) ){
			$this->setMessage( "CTXT: Overriding existing View: " . $this->_view . " with new View: " . $view );
		}
	    $this->_view = $view;
	}
	
	public function setViewData( array $data ){
		$this->_viewData = $data;
	}
	
	public function getViewData(){
		return isset( $this->_viewData ) ? $this->_viewData : array();
	}
	//@}
	
	
	
	/**
	 * @brief Return Kore_HTTP_Request object
	 */
	public function httpRequest(){
		return $this->_httpRequestObj;
	}
	
	
	
	/**
	 * @name Message Storage
	 */
	//@{
		
	/**
	 * @param $msg String message
	 */
	public function setMessage( $msg ) {
	    array_push( $this->_messages, $msg );
	}
	
	/**
	 * @brief Return array of messages
	 * @return Array of messages
	 */
    public function getMessages() {
        return $this->_messages;
    }
	
	/**
	 * @brief Print the String of messages on the context object
	 * @return String of messages separated by $separator (default \n)
	 */
    public function getMessageString( $separator="\n" ) {
        return implode( $separator, $this->_messages );
    }
	
	//@}
		
	
	
	/**
	 * @name Object Storing and Retrieval
	 */
	//@{
    public function setObject( $name, $object ) {
    	
		if( isset( $this->_objects[$name] ) ){
			$this->setMessage( "CTXT: Overriding existing object value at key: " . $name );
		}
        $this->_objects[$name] = $object;
    }
	
    public function getObject( $name ) {
        if ( isset( $this->_objects[$name] ) ) {
            return $this->_objects[$name];
        }
    }
	//@}
	
	public function getProperties(){
		return $this->properties;
	}
	public function getObjects(){
		return $this->_objects;
	}
	
	/**
	 * @name Command Stack History
	 */
	//@{
		
	/**
	 * @brief Stores Status / Kore_Command in an array
	 */
    public function addToCommandStack( $status, Kore_Command $command ) {
        array_push( $this->_commandStack, array( $command, $status ) );
    }
	
	/**
	 * @brief Returns the current command history
	 */
    public function getCommandStack() {
        return $this->_commandStack;
    }
	//@}
	
	
	public function setCookie( $name, $value ){
		$expire = Kore_Config::getConfig()->cookies->expire;
		setcookie( $name, $value, time()+$expire, "/");
    }
	
	public function __clone() {
	    $this->properties = array();
	}
	
	
	
}
?>