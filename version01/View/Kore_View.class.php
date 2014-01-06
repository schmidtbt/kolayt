<?php

class Kore_View {
	
	private $_data;
	
	public function __construct( $data = null ){
		if( ! is_null($data) ){
			$this->_data = $data;
		}
	}
	
	/**
	 * @brief Execute the view script using the $data variable and return the string
	 * 
	 * @note By including the file in this manner, the .view.php files will have a scope with the
	 * $data object and the $this-> will refer to the instance of Kore_View from which they were invoked.
	 */
	public function render( $view_file ){
		
		$data = isset( $this->_data ) ? $this->_data : array();
		ob_start();
		include( self::setPath($view_file) );
		$contents = ob_get_contents();
		ob_end_clean();
		
		return $contents;
	}
	
	
	private static function setPath( $file ){
		$defpath = "";	// Setup to use config system
		return $defpath . '/' . $file . '.view.php';
	}
	
}

?>
