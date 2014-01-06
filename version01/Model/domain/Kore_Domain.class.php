<?php

/**
 * @brief Super-class container for Domain objects
 * 
 * Domain objects are used to access contents of the system. It provides
 * an abstraction for the lower-level storage systems.
 * 
 */
class Kore_Domain {
	
	
	/**
	 * @name Domain Utilities For Parsing TRowResult
	 */
	//@{
	/**
	 * @brief Convert Counter Columns to (LONG)INT values
	 * 
	 * Hbase stores incremented values as 8x Hex values with 0 indexing. This function
	 * converts those 8 Hex values into a single LONG value.
	 * 
	 * Use to convert increment columns to INT
	 * 
	 */
	public static function btyeArrayToInt( $byteArray ){
		$temp = unpack( 'N*', $byteArray );
		return $temp[2];
	}
	
	/**
	 * @brief Get value at specific column coordinates
	 * 
	 * @return Value on success
	 * @return NULL on failure
	 */
	public static function getColValue( $data, $col ){
		try{
			$cols = $data->columns;
			if( isset( $cols[ $col ] ) ){
				return $cols[$col]->value;
			}
		}catch( Exception $e ){
			// Exit will null
		}
	}
	
	/**
	 * @brief Get Timestamp at coordinates
	 * 
	 * @return Timestamp on success
	 * @return NULL on failure
	 */
	public static function getColValueTs( $data, $col ){
		try{
			$cols = $data->columns;
			if( isset( $cols[ $col ] ) ){
				return $cols[$col]->timestamp;
			}
		}catch( Exception $e ){
			// Exit will null
		}
	}
	
	/**
	 * @return Array of TCell Objects Belonging to a Column Family
	 */
	public static function getColFamily( $data, $colFamily ){
	
		$sections = static::array_keys_contain($data->columns, $colFamily );
		
		$out = array();
		foreach( $sections as $sec ){
			$out[ $sec ] = $data->columns[ $sec ];
		}
		
		return $out;
	}
	
	
	
	/**
	 * @brief Strips the column family (before the ":") and returns the column names
	 * @param $TCellArray an Array of TCells
	 * @return The Column Name For Each Element
	 */
	public static function getColNamesWithinFamily( $TCellArray ){
		
		$outSections = array();
		foreach( $TCellArray as $key => $sec ){
			//var_dump( $this->stripColFamilyName( $sec ) );
			$sec = static::stripColFamilyName( $key );
			if( $sec ){
				$outSections[] = $sec;
			}
		}
		return $outSections;
	}
	
	
	/**
	 * @brief Remove the column family delimeter and return a new string
	 * 
	 * @return String of column name without Column Family
	 * @return NULL if failure
	 */
	public static function stripColFamilyName( $fullyQualifiedName ){
		$colonPosition = strpos( $fullyQualifiedName, ":" );
		if( $colonPosition ){
			return substr( $fullyQualifiedName, $colonPosition+1 );
		} else {
			return NULL;
		}
	}
	
	
	/**
	 * @brief Partial search of array keys
	 * 
	 * Use for finding column-families
	 * 
	 * @return Array of key values that match
	 */
	public static function array_keys_contain($input, $search_value, $strict = false)
    {
        $tmpkeys = array();

        $keys = array_keys($input);

        foreach ($keys as $k)
        {
            if ($strict && strpos($k, $search_value) !== FALSE)
                $tmpkeys[] = $k;
            elseif (!$strict && strpos($k, $search_value) !== FALSE)
                $tmpkeys[] = $k;
        }

        return $tmpkeys;
    }
	//@}
	
}

?>
