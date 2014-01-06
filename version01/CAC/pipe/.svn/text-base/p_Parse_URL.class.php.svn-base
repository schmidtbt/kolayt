<?php


/**
 * @brief Get a section view for a user
 */
class p_Parse_URL extends Kore_Pipe_Process {
	
	/**
	 * @pre 'url' URL paramter
	 * 
	 * @post 'url' Kore_Domain_URL object
	 * @post 'url' property
	 */
	protected function doProcess( Kore_Context $context ){
		
		$params = $context->httpRequest()->getUrlParams();
		
		if( isset( $params['url'] ) ){
			$url = $params['url'];
		} else {
			throw new Kore_Pipe_Exception("Missing required URL param: url" );
		}
		
		$context->setProperty('url', $url);
		
		$urlObj = new Kore_Domain_URL();
		try{
			$urlObj->insertNewURL( $url );
		} catch( KoreException $e ){
			//
		}
		
		$urlObj->fetchURL($url);
		
		$context->setObject("url", $urlObj );
	}
	
}

?>