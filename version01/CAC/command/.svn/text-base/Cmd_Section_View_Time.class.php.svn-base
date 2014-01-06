
<?php

/**
 * @brief View a section based upon 'time'
 */
class Cmd_Section_View_Time extends Kore_Command {
	
	public function doExecute( Kore_Context $context ){
		
		$context->setProperty('orderby', 'time' );
		
		try{
			$pipe = new p_Get_Section(
					new p_Set_Section(
					new p_Create_Section_List(
					new p_Section_View(
				))));
			
			$pipe->process( $context );
				
		} catch( KoreException $e ){
			$context->setMessage( __CLASS__ . ": " . $e->getMessage() );
			return self::statuses( 'CMD_ERROR' );
		}
		
		return self::statuses( 'CMD_OK' );
	}
	
	
}

?>