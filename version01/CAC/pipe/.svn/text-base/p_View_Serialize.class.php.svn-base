<?php

class p_View_Serialize extends Kore_Pipe_Process {
	
	protected function doProcess( Kore_Context $context ){
		$cmdArr = $context->getCommandStack();
		$data = $context->getViewData();
		file_put_contents( '/var/www/html/kore/trunk/server/backend/library/kore/View/Serialized_Data_'.get_class( $cmdArr[0][0] ), serialize( $data ));
	}
	
}

?>