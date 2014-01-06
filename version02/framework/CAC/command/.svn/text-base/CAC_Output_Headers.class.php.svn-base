<?php


class CAC_Output_Headers {
    
    /* HTTP STATUS CODES */
    const STATUS_200 = 200, STATUS_OK                 = 200; //The request has succeeded
    const STATUS_201 = 201, STATUS_CREATED            = 201; //The request has been fulfilled and resulted in a new resource being created
    const STATUS_202 = 202, STATUS_ACCEPTED           = 202; //The request has been accepted for processing, but the processing has not been completed
    const STATUS_204 = 204, STATUS_NO_CONTENT         = 204; //The server has fulfilled the request but does not need to return an entity-body
    
    const STATUS_301 = 301, STATUS_MOVE_PERM          = 301; //The requested resource has been assigned a new permanent URI
    const STATUS_302 = 302, STATUS_MOVE_TEMP          = 302; //The requested resource resides temporarily under a different URI
    const STATUS_304 = 304, STATUS_NOT_MODIFIED       = 304; 
    
    
    const STATUS_400 = 400, STATUS_BAD_REQUEST        = 400; //The request could not be understood by the server due to malformed syntax
    const STATUS_401 = 401, STATUS_UNAUTHORIZED       = 401; //The request requires user authentication
    const STATUS_403 = 403, STATUS_FORBIDDEN          = 403; //The server understood the request, but is refusing to fulfill it
    const STATUS_404 = 404, STATUS_NOT_FOUND          = 404; //The server has not found anything matching the Request-URI
    const STATUS_405 = 405, STATUS_METHOD_NOT_ALLOWED = 405; //The method specified in the Request-Line is not allowed for the resource identified by the Request-URI
    const STATUS_408 = 408, STATUS_TIMEOUT            = 408; //The client did not produce a request within the time that the server was prepared to wait
    const STATUS_410 = 410, STATUS_GONE               = 410; //The requested resource is no longer available at the server and no forwarding address is known
    
    const STATUS_500 = 500, STATUS_SERVER_ERROR       = 500;
    const STATUS_501 = 501, STATUS_NOT_IMPLEMENTED    = 501; //The server does not support the functionality required to fulfill the request
    const STATUS_503 = 503, STATUS_SERVICE_UNAVAILABLE= 503; //The server is currently unable to handle the request due to a temporary overloading or maintenance of the server
    
    /* CONTENT TYPE */
	const XML   = 1001;
	const JSON  = 1002;
    const HTML  = 1000;
    
    const HOUR      = 3600;
    const MINUTE    = 60;
    const DAY       = 86400;
    const WEEK      = 604800;
    
    protected static $internal = '/site';
    
    protected $headerArray;
	protected $location;
    protected $status;
    protected $cacheControl;
    
    public function __construct(){
        $this->headerArray = array();
    }
    
    /**
     * Add a name/value pair
     * @param {String} $name
     * @param {String} $value 
     */
    public function addHeader( $name, $value ){
        $this->headerArray[] = $name . ': ' . $value;
    }
    
    /**
     * Add a full header lines
     * @param {String} $line 
     */
    public function addHeaderLine( $line ){
        $this->headerArray[] = $line;
    }
    
    /**
     * Set the headers or echo them
     * @param {BOOL} $echoOnly If true, will echo to output rather than set headers
     * @param {String} $delimit If $echoOnly is true, is used to delimit between header lines
     */
    public function executeHeaders( $echoOnly = false, $delimit = '\n' ){
		// prepend the location header if it has been set
		if( isset( $this->location ) ){
			$this->headerArray = array_merge( array( 'Location: ' . $this->location ), $this->headerArray  );
		}
        if( isset( $this->cacheControl ) ){
            $this->headerArray = array_merge( array( 'Cache-Control: ' . $this->cacheControl ), $this->headerArray );
        }
        foreach( $this->headerArray as $line ){
            if( $echoOnly ){
                echo $line . $delimit;
            } else {
                header( $line );
            }
        }
        
    }
    
	/**
	 * Set the location header type
	 * @param type $location
	 * @return TRUE if location created. 
	 * @return {STRING} If Location was over-written with name of old location being returned
	 * @bug It is possible to set the location header for addHeader method. Checks should be made against this.
	 */
    public function setLocation( $location ){
		if( isset( $this->location ) ){
			$prevLocation = $this->location;
			$this->location = $location;
			return $prevLocation;
		} else {
			$this->location = $location;
			return true;
		}
    }
    
    public function setInternalLocation( $location ){
        $internal = static::$internal . self::modrewrite( $location );
        return $this->setLocation( $internal );
    }
    
    public function getLocation(){
        return $this->location;
    }
    
	public function setCookie( $name, $value, $expireIn = null ){
        if( is_null( $expireIn ) ){
            $expireIn = 60*60; // One Hour
        }
		setcookie( $name, $value, time()+$expireIn, "/");
    }
	
    
    public function expireCookie( $name ){
        setcookie( $name, '', time()-10000, '/' );
    }
    
    
    public static function modrewrite( $location ){
        $param = explode( '?', $location );
        $arr = explode( '/', $param[0] );
        $out = '/?';
        //var_dump( $arr );
        if( !is_array( $arr ) ){
            return $location;
        }
        foreach( $arr as $key => $a ){
            if( strlen( $a ) == 0 ){ continue; }
            $out .= 'p'.$key . '=' . $a . '&';
        }
        
        if( isset( $param[1] ) ){
            $out .= $param[1];
        }
        
        return $out;
    }
    
	/**
	 * 
	 * @param type $contentType Should be one of the Content Type Consts of Kore_Headers
	 */
	public function setContentType( $contentType ){
		
		$type = '';
		
		switch( $contentType ){
			case CAC_Output_Headers::XML:
				$type .= 'text/xml'; break;
			case CAC_Output_Headers::JSON:
				$type .= 'application/json'; break;
            case CAC_Output_Headers::HTML:
				$type .= 'text/html'; break;
			default:
				throw new KoreException('Kore_Headers::setContentType Invalid Content-Type code: ' . $contentType );
		}
		
		if( strlen( $type ) > 0 ){
			$this->addHeaderLine( 'Content-Type: ' . $type );
			return true;
		} else {
			return false;
		}
		
	}
	
	/**
	 * @param type $statusCode
	 * @return boolean 
	 */
	public function setStatusCode( $statusCode ){
		
		$status = '';
		
		switch( $statusCode ){
			case CAC_Output_Headers::STATUS_200:
				$status .= '200 OK'; break;
			case CAC_Output_Headers::STATUS_201:
				$status .= '201 Created'; break;
			case CAC_Output_Headers::STATUS_202:
				$status .= '202 Accepted'; break;
			case CAC_Output_Headers::STATUS_204:
				$status .= '204 No Content'; break;
			case CAC_Output_Headers::STATUS_301:
				$status .= '301 Moved Permanently'; break;
			case CAC_Output_Headers::STATUS_302:
				$status .= '302 Found'; break;
			case CAC_Output_Headers::STATUS_304:
				$status .= '304 Not Modified'; break;
            case CAC_Output_Headers::STATUS_400:
				$status .= '400 Bad Request'; break;
			case CAC_Output_Headers::STATUS_401:
				$status .= '401 Unauthorized'; break;
			case CAC_Output_Headers::STATUS_403:
				$status .= '403 Forbidden'; break;
			case CAC_Output_Headers::STATUS_404:
				$status .= '404 Not Found'; break;
			case CAC_Output_Headers::STATUS_405:
				$status .= '405 Method Not Allowed'; break;
			case CAC_Output_Headers::STATUS_408:
				$status .= '408 Request Timeout'; break;
			case CAC_Output_Headers::STATUS_410:
				$status .= '410 Gone'; break;
			case CAC_Output_Headers::STATUS_500:
				$status .= '500 Internal Server Error'; break;
			case CAC_Output_Headers::STATUS_501:
				$status .= '501 Not Implemented'; break;
			case CAC_Output_Headers::STATUS_503:
				$status .= '503 Service Unavailable'; break;
			default:
				throw new KoreException('Kore_Headers::setStatusCode Invalid status code: ' . $statusCode );
		}
		
		if( strlen( $status ) > 0 ){
			$this->addHeaderLine( 'HTTP/1.1 ' . $status );
            $this->status = $statusCode;
			return true;
		} else {
			return false;
		}
		
	}
    
    public function getStatus(){
        return $this->status;
    }
    
    
    public function setMaxAge( $maxAge ){
        $ageString = 'max-age='.$maxAge . ', must-revalidate';
        $this->setCacheControl( $ageString );
    }
    
    public function ccNoCache(){
        $this->setCacheControl( 'no-cache, must-revalidate' );
    }
    
    public function ccPrivate(){
        $this->setCacheControl( 'private, must-revalidate' );
    }
    
    /**
     * @return BOOL whether succeeded. False indicates an existing cache control
     */
    public function setDoNotCache(){
        $nocache = 'no-cache, must-revalidate';
        $this->setCacheControl( $nocache );
    }
    
    protected function setCacheControl( $msg ){
        $this->cacheControl = $msg;
    }
    
    
}


?>