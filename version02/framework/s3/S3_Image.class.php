<?php

/**
 * @author Revan
 */
class S3_Image {
    
    const URLTHUMB      = 'kol8.thumb';
    const URLFULL       = 'kol8.full';
    const VIDEOTHUMB    = 'kol8.vidimg';
    const AVATAR        = 'kol8.avatar';
    
    protected static $_basePath = 'https://s3.amazonaws.com/';
    
    protected $_amazonS3;
    protected $_lastPath;
    
    public function __construct(){
        $this->_amazonS3 = new AmazonS3();
    }
    
    public function upload( $key, $filePath, $bucket ){
        $key = static::fixKey($key);
        
		$response = $this->_amazonS3->create_object(
			$bucket,
			$key,
			array(
                'fileUpload' => $filePath,
                'contentType' => 'image/jpeg',
                'acl' => AmazonS3::ACL_PUBLIC,
                'headers' => array( // raw headers
                    'Cache-Control' => 'max-age=86400',
                )
			)
		);
        
		if( $response->isOk() ){
            $this->_lastPath = static::$_basePath . $bucket . '/' . $key;
            return $this->_lastPath;
        } else {
            throw new AMAZON_S3_EXCEPTION( 'Failure uploading Img: '. $response->body->Message );
        }
    }
    
    public function getLastPath(){
        return $this->_lastPath;
    }
    
    /**
     * Add .jpeg if not present
     * @param string $key
     * @return string 
     */
    protected static function fixKey( $key ){
        if( strpos( '.jpeg', $key ) === false ){
            $key .= '.jpeg';
        }
        return $key;
    }
    
}

?>
