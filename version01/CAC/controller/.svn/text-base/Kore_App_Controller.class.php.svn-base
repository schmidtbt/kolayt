<?php

/**
 * @todo Make a singleton so only one instance per session
 */
class Kore_App_Controller {
	
	protected $count = 0;
	
	
	public function __construct(){}
	
	
	
	public function getCommand(){
		$cmdArray = Kore_Command_Mapper::getCommand();
		return $cmdArray;
	}
	
	
	public function getView(){
		return Kore_View_Mapper::getView( Kore_Context_Registry::ctxt() );
	}
	
}


?>