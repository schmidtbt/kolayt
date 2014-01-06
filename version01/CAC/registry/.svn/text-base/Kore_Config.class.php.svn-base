<?php

class Kore_Config extends Kore_Registry {
	
	
	/************************************************************************************************
	 * 		Change this value to the location of the config.ini file for this server setup
	 ************************************************************************************************/
	private static $config_location = "/var/www/html/kore/trunk/server/conf/config.ini";
	
    private static $instance;
	
	private $_config;
	
    private function __construct() {
    	$this->_config = new Zend_Config_Ini( static::$config_location );
    }
	
    static function instance() {
        if ( ! isset(self::$instance) ) { self::$instance = new self(); }
        return self::$instance;
    }
	
	static function getConfig(){
		return self::instance()->_config;
	}
	
	protected function get( $key ){}
	protected function set( $key, $val ){}
    
}

?>