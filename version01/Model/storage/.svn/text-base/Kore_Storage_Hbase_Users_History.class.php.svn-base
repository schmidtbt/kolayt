<?php

class Kore_Storage_Hbase_Users_History extends Kore_Storage_Hbase {
	
	protected $table = "users_history";
	
	protected function newUserHistoryRecord( $handle, $url, $title, $snippet, $section_name, $imgArray, $type ){
		
		
		
		$changeRows = array(
			array( 'colfamily' => 'element', 'col' => 'url', 'value'	 	=> $url ),
			array( 'colfamily' => 'element', 'col' => 'title', 'value' 		=> $title ),
			array( 'colfamily' => 'element', 'col' => 'created', 'value' 	=> "" ),
			array( 'colfamily' => 'element', 'col' => 'creator', 'value' 	=> $handle ),
			array( 'colfamily' => 'element', 'col' => 'caption', 'value' 	=> $snippet ),
			array( 'colfamily' => 'element', 'col' => 'section', 'value' 	=> $section_name ),
		);
		
		if( is_bool( $type ) ){
			// This is a vote
			$vote = $type ? 1 : 0;
			$type = 'v';
			$changeRows[] = array( 'colfamily' => 'meta', 'col' => 'vote', 'value' => $vote );
		}
		
		// Populate First Image Only
		if( is_array( $imgArray ) & sizeof( $imgArray ) > 0 ){
			$changeRows[] = array( 'colfamily' => 'element', 'col' => 'thumb', 'value' => $imgArray[0] );
		}
		
		return $this->insertMultiColumns( self::compoundKey( $section_name , $type, time()), $changeRows );
		
	}
	
	public function newUserCreation( $handle, $url, $title, $snippet, $section_name, $imgArray ){
		$this->newUserHistoryRecord($handle, $url, $title, $snippet, $section_name, $imgArray, 'c' );
	}
	
	public function newUserVote( $handle, $url, $title, $snippet, $section_name, $imgArray, $vote ){
		$vote = $vote ? true : false;
		$this->newUserHistoryRecord($handle, $url, $title, $snippet, $section_name, $imgArray, $vote );
	}
	
	public function newUserFavorite(){}
	
	
	public static function compoundKey( $handle, $type, $time ){
		$key = $handle . '+' . $type . '+' . self::invertTime($time);
		return $key;
	}
	
}

?>
