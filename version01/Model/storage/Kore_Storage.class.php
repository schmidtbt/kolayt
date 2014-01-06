<?php
/**
 * @ingroup Model
 */
abstract class Kore_Storage {
	
	/**
	 * @brief Fetch a value from storage via a key value
	 */
	abstract public function fetchRecordValueOnKey( $key );
	/**
	 * @brief Set a value in the system via a provided key and value pair
	 */
	abstract public function insertRecordKeyValuePair( $key, $value );
	
	
}

?>