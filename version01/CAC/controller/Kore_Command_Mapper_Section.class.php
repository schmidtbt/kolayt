<?php

/**
 * @brief Maps Kore_Request URL-Params to Internal Command Paths
 * 
 * 
 */
class Kore_Command_Mapper_Section extends Kore_Command_Mapper {
	
	protected static $commandMap = array(
		"view" => array( "GET", array('Cmd_Section_View_Score, VCmd_Section') ),
		"time" => array( "GET", array('Cmd_Section_View_Time, VCmd_Section') )
	);
	
	protected static $defaultGET 		= array( "Section_View_Time_Cmd, VCmd_Section" );
	
}

?>