<?php

class Pipe_Other_Log extends Kore_Pipe_Process {
	
	protected function doProcess( Kore_Context $context ){
		$context->setMessage('Other-Pipe-Feedback');
	}
	
}

?>