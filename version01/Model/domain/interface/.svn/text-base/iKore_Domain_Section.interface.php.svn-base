<?php
/**
 * @ingroup ModelIf
 */
interface iKore_Domain_Section {
	public function __construct();
	public function setSection( $section_name );
	public function getSectionName();
	public function getCreator();
	public function getCreatedAt();
	/** @brief Get number of subscribers on the feed currently */
	public function getNumberOfSubscribers();
	/** @brief Increment Subscriber Count */
	public function addSubscriber();
	/** @brief Decrement Subscriber Count */
	public function removeSubscriber();
	/** @brief Get main section information */
	public function getSectionMain( $section_name );
	/** @brief Insert a new section */
	public function newSection( $sectionName, Kore_Domain_User $creator );
}

?>