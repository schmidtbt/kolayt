
<?php

/**
 * @brief User logs in via a username/password combo
 */
class Cmd_Login extends Kore_Command {
	
	/**
	 * @postcondition Set an 'AK' cookie on browser
	 */
	public function doExecute( Kore_Context $context ){
		
		try{
			$pipe = new p_Login_User( 
					new p_Token_Cookie(
					new p_Fetch_User_View(
					new p_Set_Section(
					new p_Create_Section_List(
					new p_Section_View()
					)))));
			$pipe->process( $context );
		} catch( KoreException $e ){
			return self::statuses( 'CMD_ERROR' );
		}
		return self::statuses( 'CMD_OK' );
	}
	
}

?>