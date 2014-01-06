<?php

class Kore_Context_Registry extends Kore_Registry {
	
    private static $instance;
	
	private $_config;
	
    private function __construct() {
    	$this->_config = new Kore_Context();
    }
	
    static function instance() {
        if ( ! isset(self::$instance) ) { self::$instance = new self(); }
        return self::$instance;
    }
	
	protected function get( $key ){}
	protected function set( $key, $val ){}
    
	static function ctxt(){
		return self::instance()->_config;
	}
	
	
	
}

?>