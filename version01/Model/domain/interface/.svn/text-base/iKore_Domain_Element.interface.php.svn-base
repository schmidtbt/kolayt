<?php
/**
 * @ingroup ModelIf
 */
interface iKore_Domain_Element {
	
	
	public function __construct();
	public function newElement( Kore_Domain_User $user, Kore_Domain_URL $url, Kore_Domain_Section $section );
	
	public function populate( TRowResult $HbaseRow );
	public function fetchElement( $section, $url );
	/**
	 * @name Static Accessors
	 * @brief All Elements should contain these data. They don't change over-time
	 */
	//@{
	public function hasTitle();
	public function hasCaption();
	public function hasMovie();
	public function hasThumb();
	public function getTitle();
	public function getCaption();
	public function hasCreator();
	public function getURL();
	public function getSectionName();
	public function getCreator();
	public function getThumbEmbed();
	public function getMovieEmbed();
	//@}
	
	/**
	 * @name Dynamic Elements
	 * @brief These elements are subject to change and may not be available in all views
	 */
	//@{
	public function hasVoteCount();
	public function hasScore();
	public function getVoteCount();
	public function getScore();
	//@}
	
	/**
	 * @name Detailed Records
	 * @brief Records which exist on more complex element storages
	 */
	//@{
	public function getHistory1Day();
	public function getHistory7Days();
	public function getHistory30Days();
	//@}
	
	
	
}

?>
