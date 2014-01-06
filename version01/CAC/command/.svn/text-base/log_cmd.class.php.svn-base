
<?php

class log_cmd extends Kore_Command {
	
	public function doExecute( Kore_Context $context ){
		
		$pipe = new Pipe_Simple_Log( 
				new Pipe_Other_Log(
				new Pipe_Simple_log()
			));
		
		$pipe->process( $context );
		return self::statuses( 'CMD_INSUFFICIENT_DATA' );
	}
	
	
}

?>