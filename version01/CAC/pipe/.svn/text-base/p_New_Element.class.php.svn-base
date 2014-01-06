<?php

/**
 * @brief Create a new element
 */
class p_New_Element extends Kore_Pipe_Process {
	
	/**
	 * @pre 'user' Kore_Domain_User object
	 * @pre 'url' Kore_Domain_URL object
	 * @pre 'section' Kore_Domain_Section object
	 */
	protected function doProcess( Kore_Context $context ){
		
		$user 		= $context->getObject('user');
		$url 		= $context->getObject('url');
		$section 	= $context->getObject('section');
		
		
		try{
			$e = new Kore_Domain_Element();
			$e->newElement($user, $url, $section);
			$context->setMessage( __CLASS__ . ": Created new element" );
		} catch( KoreException $e ){
			$context->setMessage( __CLASS__ . ": Error Attempting to Create New Element -> " .$e->getMessage() );
			throw new Kore_Pipe_Exception("Failed To Create Element", 0, $e);
		}
	}
	
}

?>