<?php

class CAC_Api_Response extends CAC_Response {
    
    protected static $_version = 'kore_v0';
    
    protected $output = array();
    
    public function __construct(){
        parent::__construct(); // run defaults()
    }
    
    public function defaults(){
        $this->_smarty = ViewSwitch::smartyAPI();
        $this->_header = new CAC_Output_Headers();
        $this->_template = 'api.tpl';
        // Add version info
        $this->initDefaultParams();
        
    }
    
    protected function initDefaultParams(){
        $this->add( 'version', static::$_version );
        $this->add( 'timestamp', time() );
    }
    
    
    /**
     * New entry to the key/value system of the JSON output
     * @param type $key
     * @param type $value 
     */
    public function add( $key, $value ){
        $this->output[ $key ] = $value;
    } 
    
    public function invoke(){
        //var_dump( $this );
        $this->_smarty->assign( 'api_output', $this->getAsJson() );
        $this->_smarty->display( $this->_template );
    }
    
    
    
    
    public function setTemplate($template) {
        throw new CAC_EXCEPTION('Cannot set template in Api response');
    }
    
    
    
	/**
	 * Format Reponse in JSON format
	 * @return {String} of JSON content
	 * @note You must set the content-type for this to display properly
	 */
    protected function getAsJson(){
        $encode = json_encode( $this->output );
		if( $encode ){
			return $encode;
		}
    }
    
	/**
	 * Format Response as XML 1.0
	 * @return {String} of XML content 
	 * @note You must set the content-type for this to display properly
	 */
    protected function getAsXML(){
        $xml = $this->stemXML( 'kolayt_api'  );
	$outXML = $this->array_to_xml( $this->output,  $xml );
	return $outXML;
    }
    
	/**
	 *
	 * @param {String} $rootNodeName
	 * @return \SimpleXMLElement 
	 */
	protected function stemXML( $rootNodeName ){
		$xml = new SimpleXMLElement("<?xml version=\"1.0\"?><" . $rootNodeName . "></" . $rootNodeName . ">");
		return $xml;
	}
	
	/**
	 *
	 * @param array $inputArray Input Associative array of field => values
	 * @param SimpleXMLElement $outputXML
	 * @return {String} Of XML 1.0 formatted content
	 */
	private function array_to_xml( array $inputArray, SimpleXMLElement &$outputXML ) {
		foreach ($inputArray as $key => $value) {
			if (is_array($value)) {
				if (!is_numeric($key)) {
					$subnode = $outputXML->addChild("$key");
					$this->array_to_xml($value, $subnode);
				} else {
					$this->array_to_xml($value, $outputXML);
				}
			} else {
				$outputXML->addChild("$key", "$value");
			}
		}
		
		return $outputXML->asXML();
		
	}
	
}

?>