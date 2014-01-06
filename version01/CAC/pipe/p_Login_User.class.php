<?php

class p_Login_User extends Kore_Pipe_Process {
	
	/**
	 * @precondition Handle and Password URL params
	 * @postcondition handle/password/loggedin properties set
	 */
	protected function doProcess( Kore_Context $context ){
		
		// GET PARAMS
		
		$params = $context->httpRequest()->getUrlParams();
		
		$handle = null;
		$password = null;
		
		if( isset( $params['handle'] ) ){
			$handle = $params['handle'];
		} else {
			throw new Kore_Pipe_Exception( "Required Param Not Set: handle" );
		}
		
		
		if( isset( $params['password'] ) ){
			$password = $params['password'];
		} else {
			throw new Kore_Pipe_Exception( "Required Param Not Set: password" );
		}
		
		$context->setProperty('handle', $handle );
		$context->setProperty('password', $password );
		
		
		// LOGIN
		$user = new Kore_Domain_User();
		$loggedin = $user->loginByHandlePassword($handle, $password);
		
		if( ! $loggedin ){
			$context->setProperty('loggedin', false );
			throw new Kore_Pipe_Exception( "Authentication Failed" );
		}
		
		$context->setObject( 'user' , $user );
		$context->setProperty( "loggedin",  $loggedin === true ? true : false );
		
		
	}
	
}

?>