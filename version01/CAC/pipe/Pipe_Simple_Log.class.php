<?php

class Pipe_Simple_Log extends Kore_Pipe_Process {
	
	protected $requiredFields = array(
		'username'
	);
	
	protected function doProcess( Kore_Context $context ){
		$context->setMessage('Pipe-Feedback');
	}
	
}

?>