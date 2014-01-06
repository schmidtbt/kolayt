<?php


/**
 * @brief Get a section view for a user
 */
class p_User_Via_Token extends Kore_Pipe_Process {
	
	
	/**
	 * @pre 'ak' cookie set
	 * 
	 * @post 'loggedin' set as true/false
	 * @post 'user' Kore_Domain_User
	 */
	protected function doProcess( Kore_Context $context ){
		
		$cookies = $context->httpRequest()->getCookies();
		
		if( isset( $cookies[ 'ak' ] ) ){
			$token = $cookies[ 'ak' ];
			
			$user = new Kore_Domain_User();
			$loggedin = $user->loginByToken($token);
			
			if( $loggedin ){
				$context->setProperty("loggedin", true );
				$context->setObject('user', $user );
			} else {
				$context->setProperty('loggedin', false );
			}
			
		} else{
			$context->setProperty('loggedin', false );
		}
		
		
	}
	
}

?>