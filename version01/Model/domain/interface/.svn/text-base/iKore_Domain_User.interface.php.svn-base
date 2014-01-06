<?php
/**
 * @ingroup ModelIf
 */
interface iKore_Domain_User {
	/**
	 * @name Interact With Hbase
	 */
	//@{
	public function loginByHandlePassword( $handle, $password );
	public function loginByToken( $token );
	public function removeSectionFromList( $section_name );
	public function addSectionToList( $section_name );
	public function newUser( $email, $first, $last, $handle );
	//@}
	
	//public function getUserPreferenceData();
	/**
	 * @name Return Information
	 */
	//@{
	public function getSectionList();
	public function getEmailAddress();
	public function getHandle();
	public function getToken();
	public function setToken();
	public function getLast();
	public function getFirst();
	//@}
	// public function getUserLikeHistory();
	
	public function newUserCreatedElement( Kore_Domain_Element $element );
	public function voteForElement( Kore_Domain_Element $element, $vote );
	
	
}

?>