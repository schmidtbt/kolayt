<?php

class Kore_Domain_User extends Kore_Domain implements iKore_Domain_User {
	
	protected $handle;
	protected $userData; // Store a HBase user data row
	
	public function __construct(){}
	
	/**
	 * @name Fetch User
	 */
	//@{
	
	/**
	 * @return True on success
	 * @return False on Failure (wrong password)
	 * @return Null if handle does not exist
	 */
	public function loginByHandlePassword( $handle, $password ){
		if ($this->getUserByHandle( $handle ) ){
			if( $password === $this->getPassword() ){
				$this->handle = $handle;
				if( !is_null( $this->getUserByHandle( $this->handle ) ) ){
					$this->setToken();
					return true;
				} else {
					$this->userData = NULL;
					$this->handle = NULL;
					return false;
				}
			} else {
				$this->userData = NULL;
				$this->handle = NULL;
				return null;
			}
		}
		//var_dump( $this->userData );
		//var_dump( $this->getPassword() );
	}
	
	/**
	 * @return True on success
	 * @return False on Failure (wrong password)
	 * @return Null if handle does not exist
	 */
	public function loginByToken( $token ){
		$handle = Kore_Domain_Token::convertTokenToHandle( $token );
		if( $handle ){
			$this->handle = $handle;
			if( !is_null( $this->getUserByHandle( $this->handle ) ) ){
				return true;
			} else {
				$this->userData = NULL;
				$this->handle = NULL;
				return false;
			}
		} else {
			$this->userData = NULL;
			$this->handle = NULL;
			return null;
		}
	}
	//@}
	
	/**
	 * @return Array of Section Names (as recorded in Hbase)
	 */
	public function getSectionList(){
		$family = static::getColFamily( $this->userData, "section_list");
		return static::getColNamesWithinFamily( $family );
	}
	
	/**
	 * @TODO change param to section objects
	 */
	public function removeSectionFromList( $section_name ){
		if( isset( $this->handle ) ){
			$hbase = new Kore_Storage_Hbase_Users();
			return $hbase->removeSectionList( $this->handle, $section_name );
		}
	}
	
	/**
	 * @TODO change param to section objects
	 */
	public function addSectionToList( $section_name ){
		if( isset( $this->handle ) ){
			$hbase = new Kore_Storage_Hbase_Users();
			return $hbase->appendSectionList( $this->handle, $section_name );
		}
	}
	
	//public function getUserPreferenceData(){}
	public function getEmailAddress(){
		if( $this->isPopulated() ){
			return static::getColValue( $this->userData, "meta:email");
		}
	}
	
	
	public function getHandle(){
		if( isset( $this->handle ) ){
			return $this->handle;
		}
	}
	
	public function getToken(){
		if( $this->isPopulated() ){
			return static::getColValue( $this->userData, "meta:token");
		}
	}
	
	public function getLast(){
		if( $this->isPopulated() ){
			return static::getColValue( $this->userData, "meta:last");
		}
	}
	
	public function getFirst(){
		if( $this->isPopulated() ){
			return static::getColValue( $this->userData, "meta:first");
		}
	}
	
	public function setToken(){
		if( isset( $this->handle ) ){
			$hbase = new Kore_Storage_Hbase_Users();
			return $hbase->changeToken( $this->handle, Kore_Domain_Token::genTokenFromHandle( $this->handle ) );
		}
	}
	
	// public function getUserLikeHistory(){}
	public function newUser( $email, $first, $last, $handle ){
		$hbase = new Kore_Storage_Hbase_Users();
		return $hbase->insertNewUser( $email, $first, $last, $handle );
	}
	
	
	
	/**
	 * @brief Add a record into users_history with a new element creation
	 * @note Updates user's history
	 */
	public function newUserCreatedElement( Kore_Domain_Element $element ){
		if( $element->isPopulated() & $this->isPopulated() ){
			$hbase_u_history = new Kore_Storage_Hbase_Users_History();
			$hbase_u_history->newUserCreation($this->getHandle(), $element->getURL(), $element->getTitle(), $element->getCaption(), $element->getSectionName(), $element->getThumbEmbed());
			$this->voteForElement($element, true ); // Automatically vote for new elements
		}
	}
	
	
	/**
	 * @brief User votes for element
	 * @note Updates elements' history and user's history
	 * @todo should also update the user's personal record for easier checking for duplicates
	 */
	public function voteForElement( Kore_Domain_Element $element, $vote ){
		if( $element->isPopulated() & $this->isPopulated() ){
			$vote = $vote ? true : false;
			$hbase_e_history = new Kore_Storage_Hbase_Element_History();
			$hbase_e_history->newVote( $element->getSectionName(), $element->getURL(), $this->getHandle(), $vote );
			
			$hbase_u_history = new Kore_Storage_Hbase_Users_History();
			$hbase_u_history->newUserVote($this->getHandle(), $element->getURL(), $element->getTitle(), $element->getCaption(), $element->getSectionName(), $element->getThumbEmbed(), $vote );
		}
	}
	
	
	protected function getPassword(){
		if( $this->isPopulated() ){
			return static::getColValue( $this->userData, "meta:pass");
		}
	}
	
	
	
	/**
	 * @name User Utilities
	 */
	//@{
	
	/**
	 * @brief Lookup in Storage By Handle
	 * 
	 * @return NULL if not found
	 * @return True if found
	 */
	private function getUserByHandle( $handle ){
		$hbase = new Kore_Storage_Hbase_Users();
		$raw = $hbase->fetchRecordValueOnKey( $handle );
		if( isset( $raw[0] ) ){
			$this->userData = $raw[0];
			if( $this->isPopulated() ){ return true; }
		}
		// return NULL;
	}
	
	public function isPopulated(){
		if( $this->userData instanceof TRowResult ){
			return true;
		} else {
			return false;
		}
	}
	
	
	
	//@}
}

?>
