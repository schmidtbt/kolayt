<?php

class p_Set_Section extends Kore_Pipe_Process {
	
	/**
	 * @pre 'section' property
	 * 
	 * @post 'section' Kore_Domain_Section object
	 */
	protected function doProcess( Kore_Context $context ){
		$section_name = $context->getProperty('section');
		
		$section = new Kore_Domain_Section();
		$section->getSectionMain($section_name);
		
		echo $section->isPopulated();
		
		$context->setObject("section", $section );
		
	}
	
}

?>