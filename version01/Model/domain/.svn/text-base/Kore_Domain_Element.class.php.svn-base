<?php
/**
 * 
 * 
 * @ingroup ModelIf
 */
class Kore_Domain_Element extends Kore_Domain implements iKore_Domain_Element {
	
	protected $data;
	
	public function __construct(){}
	
	/**
	 * @brief "Create" a element object by passing a result from Hbase to use as the element info
	 * 
	 * This is normally done from a List of elements to use the api to access element properties.
	 */
	public function populate( TRowResult $HbaseRow ){
		$this->data = $HbaseRow;
	}
	
	
	/**
	 * @name Standard Element Properties. Non-dynamic
	 */
	//@{
	public function hasTitle(){
		if( $this->isPopulated() ){
			return is_null( static::getColValue( $this->data, "element:title") ) ? false : true;
		}
	}
	public function hasCaption(){
		if( $this->isPopulated() ){
			return is_null( static::getColValue( $this->data, "element:caption") ) ? false : true;
		}
	}
	public function hasMovie(){
		if( $this->isPopulated() ){
			return is_null( static::getColValue( $this->data, "element:movie") ) ? false : true;
		}
	}
	public function hasThumb(){
		if( $this->isPopulated() ){
			$thumbArr = static::getColFamily( $this->data, "thumb");
			return ! empty( $thumbArr );
		}
	}
	public function hasCreator(){
		if( $this->isPopulated() ){
			return is_null( static::getColValue( $this->data, "element:creator") ) ? false : true;
		}
	}
	public function hasCreated(){
		if( $this->isPopulated() ){
			return is_null( static::getColValue( $this->data, "element:created") ) ? false : true;
		}
	}
	public function getTitle(){
		if( $this->isPopulated() ){
			return static::getColValue( $this->data, "element:title");
		}
	}
	public function getCaption(){
		if( $this->isPopulated() ){
			return static::getColValue( $this->data, "element:caption");
		}
	}
	public function getURL(){
		if( $this->isPopulated() ){
			return static::getColValue( $this->data, "element:url");
		}
	}
	public function getMovieEmbed(){
		if( $this->isPopulated() ){
			return static::getColValue( $this->data, "element:movie");
		}
	}
	
	/**
	 * @todo Different thumb storages seem to access this property differently
	 */
	public function getThumbEmbed(){
		if( $this->isPopulated() ){
			//return static::getColValue( $this->data, "element:thumb");
			$family = static::getColFamily( $this->data, "thumb");
			var_dump( $family );
			return static::getColNamesWithinFamily( $family );
		}
	}
	public function getCreator(){
		if( $this->isPopulated() ){
			return static::getColValue( $this->data, "element:creator");
		}
	}
	public function getSectionName(){
		if( $this->isPopulated() ){
			return static::getColValue( $this->data, "element:section");
		}
	}
	public function getCreated(){
		if( $this->isPopulated() ){
			return static::getColValueTs( $this->data, "element:created");
		}
	}
	//@}
	
	/**
	 * @name Element Records updated via MapReduce
	 */
	//@{
	public function hasVoteCount(){
		if( $this->isPopulated() ){
			return is_null( static::getColValue( $this->data, "element:votecount") ) ? false : true;
		}
	}
	public function hasScore(){
		if( $this->isPopulated() ){
			return is_null( static::getColValue( $this->data, "element:score") ) ? false : true;
		}
	}
	public function getVoteCount(){
		if( $this->isPopulated() ){
			return static::getColValue( $this->data, "element:votecount");
		}
	}
	public function getScore(){
		
		return rand(1,10) + rand( 3,10);	// debugging display system
		
		if( $this->isPopulated() ){
			return static::getColValue( $this->data, "element:score");
		}
	}
	//@}
	
	
	
	/**
	 * @name Dynamic Properties
	 */
	//@{
	public function getHistory1Day(){}
	public function getHistory7Days(){}
	public function getHistory30Days(){}
	//@}
	
	
	/**
	 * @throws Kore_Domain_Exception if params isPopulated() status is false
	 */
	public function newElement( Kore_Domain_User $user, Kore_Domain_URL $url, Kore_Domain_Section $section ){
		
		// Check params for populated status
		if( !( $section->isPopulated() & $url->isPopulated() & $user->isPopulated() ) ){
			throw new Kore_Domain_Exception("Kore_Domain_Element::newElement Unpopulated Paramters were found" );
		}
		
		// Insert into elements section
		$hbase = new Kore_Storage_Hbase_Element();
		try{
			$hbase->newElement($section->getSectionName(), $url->getURL(), $url->getTitle(), $user->getHandle(), $url->getParsedSnippet(), $url->getImages() );
		} catch ( KoreException $e ){
			// Nothing... this is fine, a re-upload occured
		}
		
		// Now populate this instance with the content just uploaded
		$this->fetchElement($section->getSectionName(), $url->getURL() );
		
		
		// Update time history
		$this->updateTimeHistory($user, $url, $section);
		
		// Update the user's history (also updates a vote for them)
		$user->newUserCreatedElement( $this );
		
	}
	
	/**
	 * @brief Populate this object using a section/url identifier for an element
	 */
	public function fetchElement( $section, $url ){
		$hbase = new Kore_Storage_Hbase_Element();
		$raw = $hbase->fetchRecordValueOnKey( $this->compoundKey( $section , $url ) );
		if( isset( $raw[0] ) ){
			$this->data = $raw[0];
			if( $this->isPopulated() ){ return true; }
		}
	}
	
	public function isPopulated(){
		if( $this->data instanceof TRowResult ){
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * @todo This method should use the Kore_Domain_Element url's to populate content (to avoid consistency errors)
	 */
	protected function updateTimeHistory( Kore_Domain_User $user, Kore_Domain_URL $url, Kore_Domain_Section $section ){
		// Update the history segements for this element (for time-reading of elements in a section)
		$hbase_list_history = new Kore_Storage_Hbase_List_Time();
		$hbase_list_history->setSection($section->getSectionName());
		$hbase_list_history->newHistoryRecord($url->getURL(), $url->getTitle(), $section->getSectionName(), $url->getParsedSnippet(), $user->getHandle(), $url->getImages());
	}
	
	
	protected function compoundKey( $section_name, $url ){
		return $section_name . '+' . $url;
	}
}

?>
