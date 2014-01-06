<?php

/**
 * @brief Get the URL param 'section'
 */
class p_Get_Section extends Kore_Pipe_Process {
	
	/**
	 * @post 'section' property, set to which section to view
	 * @post 'section_view' property, set to which section to view
	 */
	protected function doProcess( Kore_Context $context ){
		
		$params = $context->httpRequest()->getUrlParams();
		
		$section = 'Default';
		
		if( isset( $params['section'] ) ){
			$section = $params['section'];
		}
		
		$context->setProperty('section' , $section );
		$context->setProperty('section_view', $section );
		
	}
	
}

?>