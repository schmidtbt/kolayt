<?php
/**
 * @brief Generate the View Data object for Sections
 */
class p_View_Section extends Kore_Pipe_Process {
	
	protected function doProcess( Kore_Context $context ){
		
		$data = array();
		
		$data['section_html'] 	= $context->getProperty( 'section_html' );
		
		$user = $context->getObject( 'user' );
		
		$data[ 'handle' ] 		= $user->getHandle();
		
		$context->setViewData($data);
	}
	
}

?>