<?php

/**
 * @author Revan
 */
class ViewSwitch {
    
    
    protected static $_WWWpath = '/kore/server/backend/lib/kore/app/html/www/smarty/';
    protected static $_APIpath = '/kore/server/backend/lib/kore/app/api/smarty/';
    protected static $_MOBpath = '/kore/server/backend/lib/kore/app/html/mob/smarty/';
    
	/**
	 *
	 * @return Smarty
	 */
    public static function smartyWWW(){
        return static::changePath(static::$_WWWpath);
    }
    
	/**
	 *
	 * @return Smarty
	 */
    public static function smartyMOB(){
        return static::changePath(static::$_MOBpath);
    }
    
	/**
	 *
	 * @return Smarty
	 */
    public static function smartyAPI(){
        return static::changePath(static::$_APIpath);
    }
    
    protected static function changePath( $path ){
        $smarty = new Smarty();
        
        $smarty->setTemplateDir(    $path . 'templates');
        $smarty->setCompileDir(     $path . 'templates_c');
        $smarty->setCacheDir(       $path . 'cache');
        $smarty->setConfigDir(      $path . 'configs');
        //$smarty->force_compile = true;
        
        return $smarty;
    }
    
    
}

?>
