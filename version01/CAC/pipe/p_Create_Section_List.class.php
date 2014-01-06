<?php


/**
 * @brief Get a section view for a user
 */
class p_Create_Section_List extends Kore_Pipe_Process {
	
	/**
	 * @pre Expects object 'section_view' to be set
	 * @pre 'orderby' property of time or score
	 * 
	 * @post 'section_list' Kore_Domain_Section_List object
	 */
	protected function doProcess( Kore_Context $context ){
		
		$section = $context->getObject("section");
		$orderby = $context->getProperty("orderby");
		
		$sl = new Kore_Domain_Section_List( $section );
		
		if( $orderby === 'score' ){
			$sl->setOrder( Kore_Domain_Section_List::SCOREORDER );
		} else {
			$sl->setOrder( Kore_Domain_Section_List::TIMEORDER );
		}
		$sl->getElements( 50 );
		$context->setObject( "section_list", $sl );
	}
	
}

?>