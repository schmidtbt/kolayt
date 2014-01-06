<?php

/**
 * @brief An abstraction of the S3 storage mechanism
 * 
 * S3store is the base class for accessing the amazon S3 systems. At it's core it uses
 * the provided amazon S3 PHP SDK. 
 * 
 * @see http://docs.amazonwebservices.com/AWSSDKforPHP/latest/#i=AmazonS3
 * 
 * It it's simplest form, it is resonsible for maintaining key/value pairs where the values
 * are strings stored in text format on S3. Base-classes specify the specific settings for accessing
 * the data by specifying a few parameters:
 * 
 * @li The bucketname used by the sub-class
 * @li The key parameter to S3 key conversion
 * 
 * The key conversion is done via the static (using late static binding) method S3store::modifyKey().
 * This allows the passed key via the other programs to be evaluated as a string specific to the mechanisms
 * for storage of the specific sub-class. This need arises because of the inability to create "sub-buckets"
 * and so building hierarchies within a bucket requires explicitly setting the structure via the name. For
 * instance, to store log data by user then by date, you could provide an array as the $key parameter and
 * then specify that it uses <userindex>_<date> as a storage mechanism. That would allow storing of every user
 * in the same bucket but organized by user then by date.
 * 
 * @ingroup Model
 */
abstract class Kore_Storage_S3 extends Kore_Storage {
	
	/**
	 * @brief A amazonS3 object
	 */
	protected $amazonS3Object;
	
	
	/**
	 * @brief Stores the bucket name used for this S3 interaction
	 */
	protected static $bucketName;
	
	/**
	 * @brief Private Constructor since using singleton pattern
	 * 
	 * @see http://php.net/manual/en/language.oop5.patterns.php
	 */
	public function __construct(){
		// Inititalizes the s3 object reference
		$this->amazonS3Object = new AmazonS3();
	}
	
	
	/**
	 * @brief Fetches a record given a Key
	 * 
	 * @param $key The key value to fetch from the S3 system (this can be modified
	 * by the method S3store:;modifyKey() to make it more friendly on S3)
	 * 
	 * @retval String_JSON of the stored value at the $key location if it is stored as JSON
	 * @retval String of the stored value at the $key location if it is stored as a string
	 * @retval FALSE if a failure occured
	 */
	public function fetchRecordValueOnKey( $key ){
		
		// late static binding to acces sub-class specific key modification
		$modifiedKey = static::modifyKey( $key );
		
		$response = $this->amazonS3Object->get_object(
			static::$bucketName,
			$modifiedKey
		);
		
		if( $response->isOk() ){
			if( is_string($response->body) ){
				// String
				return $response->body;
			} else {
				// CFSimpleXML object
				return $response->body->to_json();
			}
		} else {
			return false;
		}
		
	}
	
	
	
	/**
	 * @brief Insert a Key/Value pair to the specified bucket
	 * 
	 * @param $key A key value to store this record by (this can be modified
	 * by the method S3store::modifyKey() to make it more friendly on S3)
	 * @param $value A string to store as text at the specified Key
	 * 
	 * @retval BOOL whether the upload succeeded or failed
	 */
	public function insertRecordKeyValuePair( $key, $value ){
		
		$modifiedKey = static::modifyKey( $key );
		
		$response = $this->amazonS3Object->create_object(
			static::$bucketName, 
			$modifiedKey, 
			array(
				'body' => $value,
				'contentType' => 'text/plain',
			)
		);
		return $response->isOk();
	}
	
	
	/**
	 * @brief Allows the modification of a key to establish a new pattern for fetching
	 * 
	 * This method is used to be over-ridden in base classes wishing to support
	 * a different input method for key. This method will be accessed within the
	 * S3store::fetchRecordValueOnKey() to allow this modification seamlessly without
	 * the caller needs to know the specifics of the storage mechanisms.
	 * 
	 * In S3store, it simply returns the original key
	 */
	protected static function modifyKey( $key ){
		return $key;
	}
	
	
	
}

?>
