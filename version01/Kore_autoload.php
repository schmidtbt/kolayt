<?php
error_reporting(E_ALL & ~ E_DEPRECATED );
ini_set('log_errors', '1' );
ini_set('display_errors', '1' );
ob_start();

/**
 *@file Kore_autoload.php
 *@brief Autoload classes on the fly
 *
 */

/**
 *@brief static class for updating the system path
 *
 *Uses the system specific directory path $initpath to build an includes directory for
 *each member of $path. Then uses the spl_autoload magic function to autoload classes
 *as they are called. This alleviates the need for require_once statements. 
 *
 *@note Be careful with the usage of trailing / in directories.
 */
class autoload
{
    /**
     *@brief static method to perform autoloading
     **/
    static function doautoload()
    {
        //$awspath = "/Volumes/core/service/aws";
        //$initpath = "/Volumes/core/service/php/";
        $awspath = "/var/www/html/kore/trunk/aws";
        //$initpath = "/php/includes/core/service/php/";
        $initpath = "/var/www/html/kore/trunk/server/backend/library/kore/";
        
        $path = array(
        			'CAC/registry/',
        			'CAC/controller/',
        			'CAC/command/',
        			'CAC/pipe/',
        			'Model/domain/',
        			'Model/domain/interface/',
        			'Model/storage/',
        			'Model/parser/',
        			'View/'
                );
        
        foreach( $path as $p )
        {
            set_include_path(get_include_path() . PATH_SEPARATOR . $initpath . $p);
            set_include_path(get_include_path() . PATH_SEPARATOR . $initpath . $p . 'sub');
        }
        
        // Add Amazon Web Services
        set_include_path(get_include_path() . PATH_SEPARATOR . $awspath);
        //set_include_path( get_include_path() . PATH_SEPARATOR . '/var/www/html/kore/trunk/Zend/' );
        spl_autoload_register(array('autoload','doClass'));
        spl_autoload_register(array('autoload','doReg'));
        spl_autoload_register(array('autoload','doInterface'));
        spl_autoload_register(array('autoload','doFactory'));
        spl_autoload_register(array('autoload','doZend'));
    }
    
    static function doClass( $class ){
        @include_once( $class . '.class.php' );
    }
    
    static function doReg( $class ){
	//error_log( $class );
        @include_once( $class . '.php' );
    }
    
    static function doInterface( $class ){
        @include_once( $class . '.interface.php' );
    }
    
    static function doFactory( $class ){
        @include_once( $class . '.factory.php' );
    }
    
    static function doZend( $class ){
    	
    	if( strpos( $class, 'Zend_') == 0 ){
    		@include_once( str_replace( '_', '/', $class) . '.php' );
    	}
    }
    
}


/* Call the autoload::doautoload() method */
autoload::doautoload();
//echo get_include_path();
//require_once('MyExceptions.class.php');

require_once('kore/KoreExceptions.class.php');

// Include AWS API support
require_once('aws/sdk.class.php'); 
require_once('aws/config-sample.inc.php'); 


// Include Thrift Systems
$thrift_root = '/var/www/html/kore/trunk/server/backend/library/thrift';
require_once( $thrift_root.'/Thrift.php' );
require_once( $thrift_root.'/transport/TSocket.php' );
require_once( $thrift_root.'/transport/TBufferedTransport.php' );
require_once( $thrift_root.'/protocol/TBinaryProtocol.php' );
require_once( $thrift_root.'/packages/Hbase/Hbase.php' );

//Include Readability
require_once( 'full-text-rss-master/libraries/readability/Readability.php');
?>