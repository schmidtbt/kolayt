<?php

class Kore_View_Table_Generator {
	
	protected $sectionList;
	
	protected $maxWidthBox;
	protected $maxHeightBox;
	protected $totalWidth;
	
	protected $weightedElements;
	
	public function __construct( Kore_Domain_Section_List $list ){
		$this->setSectionList($list);
	}
	
	
	public function setTableProperties( $totalWidth = 3, $maxWidthBox = 3, $maxHeightBox = 4 ){
		$this->maxWidthBox = $maxWidthBox;
		$this->maxHeightBox = $maxHeightBox;
		$this->totalWidth = $totalWidth;
	}
	
	
	public function setSectionList( Kore_Domain_Section_List $list ){}
	
	public function generateTable(){}
	
	
	
	
	public function displayTable(){}
	public function debugDisplay(){}
	
	
	
	
	/**
	 * @name Generate Weighted Lists
	 */
	//@{
	public function setElementWeights( Kore_Domain_Section_List $list ){
		
		$elist = $list->elementList();
		
		$this->weightedElements = array();
		
		if( $list->isOrganizedByTime() ){
			// Time List
			$this->setTimeWeights($elist);
		} else {
			// Score List
			$this->setScoreWeights($elist);
		}
		
		// Sort by highest -> lowest
		arsort( $this->weightedElements );
		echo "<br /><br />";
		//var_dump( $this->weightedElements );
		
		$this->dispBinScores($this->weightedElements);
	}
	
	
	/**
	 * @brief Generates a reverse key so that the most recent item is key value sorted first
	 */
	protected function setTimeWeights( array $elist ){
		foreach( $elist as $key => $e ){
			$this->weightedElements[ $key ] = 999999 - $key;
		}
	}
	
	
	/**
	 * @brief Generates the scored weights
	 * 
	 * This method will create an array which is [list key] => score With duplicate integer scores
	 * being replaced by consecutive 0.001 additions. So two items with scores of 10 will be included as
	 * 10 and 10.001 so that similarly scored items will still be sorted together
	 */
	protected function setScoreWeights( array $elist ){
		foreach( $elist as $key => $e ){
			
			$score = $e->getScore();
			
			if( array_search( $score, $this->weightedElements ) ){
				while( true ){
					$score = $score + .001;
					if( ! array_search( $score, $this->weightedElements ) ){
						break;
					}
				}
			}
			
			$this->weightedElements[ $key ] = $score;
			
		}
		
	}
	//@}
	
	protected function getBox( $maxWidth, $maxHeight ){}
	protected function getMaxFitBox( $idxRow, $idxCol ){}
	
	
	protected function generateBoxContent( Kore_Domain_Element $element ){}
	
	
	/**
	 * @brief Generate bins
	 * 
	 * @param $weightMatrix is matrix of weights with [list key] => score
	 * @param $numBins how many bins you'd like to group these into
	 * @param $binWeights how much each bin should hold
	 */
	public function binScores( $weightMatrix, $numBins, $binWeights ){
		
		
		
		
	}
	
	
	public function dispBinScores( $weightMatrix ){
		
		$max = ceil( max( $weightMatrix ) );
		$min = floor( min( $weightMatrix ) );
		
		for( $i = $min; $i <= $max; $i++ ){
			$count = $this->countOff($weightMatrix , $i );
			if( is_array( $count ) ){
				echo $i . ':';
				foreach( $count as $c ){ echo "*"; }
				echo "<br />";
			} else {
				echo $i . ':';
			}
		}
		
		
		
	}
	
	protected function countOff( $array, $value ){
		return array_keys( $array, $value );
	}
	
}

?>
