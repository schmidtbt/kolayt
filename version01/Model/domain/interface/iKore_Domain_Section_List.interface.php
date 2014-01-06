<?php

interface iKore_Domain_Section_List {
	
	const TIMEORDER 	= 	0;
	const SCOREORDER 	= 	1;
	
	public function __construct( Kore_Domain_Section $section );
	public function setOrder( $orderType );
	public function getElements( $numRows, $startIdx = 0);
	public function getNumberElements();
	
	public function elementList();
	public function isOrganizedByTime();
	public function isOrganizedByScore();
	
}

?>
