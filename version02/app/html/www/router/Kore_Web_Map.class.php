<?php

/**
 * @author Revan
 */
class Kore_Web_Map extends CAC_App_Map {
    
    protected $defaultCommand = 'CAC_WWW_Default_Command';
    
    protected $methods = array (
        
        'page'      => array(   'WWW_Page_URL' ),
        'tag'       => array(   'WWW_Page_Tag' ),
        'alltags'   => array(   'WWW_Page_All_Tags' ),
        'stream'    => array(   'WWW_Page_User_Stream' ),
        'login'     => array(   'WWW_Page_Login' ),
        'contact'   => array(   'WWW_Page_Contact' ),
        'about'     => array(   'WWW_Page_About' ),
        'bio'       => array(   'WWW_Page_Bio' ),
        'account'   => array(   'WWW_Page_Account' )
    );
    
}

?>
