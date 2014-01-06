<?php


/**
 * @brief Get a section view for a user
 */
class p_Fetch_User_View extends Kore_Pipe_Process {
	
	protected function doProcess( Kore_Context $context ){
		
		$user = $context->getObject('user');
		$section_list = $user->getSectionList();
		
		if( !isset( $section_list[0] ) ){ $section_list[0] = 'Default'; }
		
		$context->setProperty('section', 'Default' );
		
	}
	
}

?>