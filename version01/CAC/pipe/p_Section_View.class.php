<?php


/**
 * @brief Get a section view for a user
 */
class p_Section_View extends Kore_Pipe_Process {
	
	/**
	 * @pre Expects object 'section_view' to be set
	 * 
	 * @post 'section_html' The html to display the table
	 */
	protected function doProcess( Kore_Context $context ){
		
		
		$section 	= $context->getObject( 'section' );
		$sl 		= $context->getObject( 'section_list' );
		
		// Determine View Properties Based on Section List
		$numToGen = $sl->getNumberElements();
		
		if( $sl->isOrganizedByTime() ){
			$totalWidth = 1;
			$maxWidthBox = 1;
			$maxHeightBox = 1;
		} else {
			$totalWidth = 3;
			$maxWidthBox = 3;
			$maxHeightBox = 4;
		}
		
		// Generate the display
		$t = new Kore_Table_Display( $totalWidth, $maxWidthBox, $maxHeightBox, $numToGen - 1);
		$t->generate();
		$t->setElementWeights( $sl );
		$t->overlayContent();
		$html = $t->testStyle()->disp();
		
		$context->setProperty( 'section_html',  $html );
		
	}
	
}

?>