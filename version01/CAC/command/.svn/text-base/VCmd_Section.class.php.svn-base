<?php
/**
 * @brief Display the home-screen for a Section
 */
class VCmd_Section extends Kore_Command {
	
	/**
	 * 
	 */
	public function doExecute( Kore_Context $context ){
		
		
		try{
			$pipe = new p_View_Section(
					new p_View_Serialize(
					));
			$pipe->process( $context );
		} catch( KoreException $e ){
			return self::statuses( 'CMD_ERROR' );
		}
		return self::statuses( 'CMD_OK' );
	}
	
	
}

?>