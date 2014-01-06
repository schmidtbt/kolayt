<?php

class p_Token_Cookie extends Kore_Pipe_Process {
	
	protected function doProcess( Kore_Context $context ){
		
		$user = $context->getObject('user');
		
		$token = $user->getToken();
		$context->setCookie('ak', $token);
		
		$context->setProperty( "token" , $token );
		
	}
	
}

?>