<?php

abstract class Kore_Pipe_Process extends Kore_Pipe {
	
	protected $pipeDownstream;
	protected $requiredFields;
	
	public function __construct( Kore_Pipe $pipeDownstream = NULL ){
		if( $pipeDownstream ){
			$this->pipeDownstream = $pipeDownstream;
		}
	}
	
	/**
	 * @li Check for required fields in Kore_Pipe_Process::$requiredFields
	 * @li Do sub-class processing in Kore_Pipe_Process::doProcess()
	 * @li Execute any attached additional Kore_Pipe_Process Objects
	 */
	public function process( Kore_Context $context ){
		$valid = $this->checkRequires( $context );
		if( $valid ){
			$context->setMessage("Executing Pipe: " . get_called_class() );
			$this->doProcess( $context ); 
		}
		$this->processDecendant( $context );
	}
	
	
	protected function checkRequires( Kore_Context $context ){
		$output = true;
		if( is_array( $this->requiredFields ) ){
			foreach( $this->requiredFields as $key => $field ){
				if( ! $context->getProperty( $field ) ){
					$context->setMessage( 'PIPE: ' . get_called_class() . '::Missing Required Field: ' . $field );
					$output = false;
				}
			}
		}
		return $output;	
	}
	
	
	protected function processDecendant( Kore_Context $context ){
		if( isset( $this->pipeDownstream ) ){
			$this->pipeDownstream->process( $context );
		}
	}
	
	abstract protected function doProcess( Kore_Context $context );
	
}

?>