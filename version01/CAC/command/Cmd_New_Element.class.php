<?php
/**
 * @brief Create a new element
 * 
 */
class Cmd_New_Element extends Kore_Command {
	
	/**
	 * @postcondition Set an 'AK' cookie on browser
	 * 
	 * Expects a 'url' URL parameter
	 */
	public function doExecute( Kore_Context $context ){
		
		try{
			$pipe = new p_User_Via_Token(
					new p_Parse_URL(
					new p_Get_Section(
					new p_Set_Section(
					new p_New_Element(
					)))));
			$pipe->process( $context );
		} catch( KoreException $e ){
			return self::statuses( 'CMD_ERROR' );
		}
		return self::statuses( 'CMD_OK' );
	}
	
	
}

?>