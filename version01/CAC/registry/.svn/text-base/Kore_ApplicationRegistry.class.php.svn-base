<?php

class Kore_ApplicationRegistry extends Kore_Registry {
	
    private static $instance;
    private $freezedir = "/tmp/data";
    private $values = array();
    private $mtimes = array();
    protected $cmap;
	
    private function __construct() { }
	
    static function instance() {
        if ( ! isset(self::$instance) ) { self::$instance = new self(); }
        return self::$instance;
    }
	
    static function setControllerMap( ControllerMap $map  ) {
        self::instance()->cmap = $map;
    }
	
	protected function get( $key ){}
	protected function set( $key, $val ){}
    
    static function getControllerMap() {
        return self::instance()->cmap;
    }
    
    static function appController() {
    	$obj = self::instance();
        $cmap = $obj->getControllerMap();
        $obj->appController = new Kore_AppController( $cmap );
        return $obj->appController;
    }
}

?>