<?php

class Kore_Table_Display {
	
	protected $DEBUG = false;
	protected $dblog = "";
	
	/**
	 * @brief The HTML content that is generated
	 */
	protected $html = "";
	
	/**
	 * @brief Boolean array of whether a box currently resides at that location
	 */
	protected $filled = array();
	
	/**
	 * @brief Hex values are contiguous for connected regions. Visualize array purposes.
	 */
	protected $disp = array();
	
	
	protected $weightedElements;
	protected $sectionElements;
	
	protected $maxWidthBox;
	protected $maxHeightBox;
	protected $totalWidth;
	protected $numBoxes;
	
	/**
	 * @param $totalWidth Width of section in box units (number of 1x unit boxes to fit across row)
	 * @param $maxWidthBox Maximum width of a single unit
	 * @param $maxHeightBox Maximum height of  a single unit
	 */
	public function __construct( $totalWidth = 3, $maxWidthBox = 3, $maxHeightBox = 4, $numToGen = 40 ){
		$this->maxWidthBox = $maxWidthBox;
		$this->maxHeightBox = $maxHeightBox;
		$this->totalWidth = $totalWidth;
		$this->numBoxes = $numToGen;
		
		$this->init();
	}
	
	/**
	 * @brief Populates the arrays for use in searches
	 */
	protected function init(){
		
		// INIT the $filled and $disp arrays with zeros
		$rowArray = array();
		for( $i = 0; $i< $this->totalWidth; $i++ ){
			$rowArray[] = 0;
		}
		
		for( $i = 0; $i< 1000; $i++ ){
			$this->filled[$i] = $rowArray;
			$this->disp[$i] = $rowArray;
		}
		
	}
	
	/**
	 * @brief Create the layout
	 */
	public function generate(){
		
		$thtml = "";
		$thtml .= "<table>";
		$cont = true;
		
		$row = 0;
		$count = 0;
		
		while( $cont ){
			
			$thtml .= "<tr>";
			/// MOVE ACROSS THE COLUMNs IN A ROW
			for( $i = 0; $i < $this->totalWidth; $i++ ){
				$this->rlog .= $i;
				if( $this->filled[ $row ][ $i ] == 1 ){
					// NOTHING
				} else {
					// This box is not filled, now check for largest square we can put a new box into
					$availableSize = $this->getMaxBoxFit($row, $i);
					$box = $this->getBox( $availableSize[0],  $availableSize[1] ); 
					// Obtain random number for visualization
					$rand = rand(1, 255 );
					// Move over columns
					for( $k = 0; $k < $box[0]; $k++ ){
						for( $j = 0; $j < $box[1]; $j++ ){
							$this->filled[ $row + $j ][ $i + $k ] = 1;
							$this->disp[ $row + $j ][ $i + $k ] = dechex($rand);
						}
					}
					$count++;
					$thtml = $this->genTD($thtml, $box[0], $box[1], $count);
					//$thtml .= "<td colspan='" . $box[0] . "' rowspan='". $box[1] ."'><div>".dechex($rand)."</div></td>";
				}
			}
			
			$row++;
			$thtml .= "</tr>";
			
			
			// Break out of loop upon 50 iterations
			
			if( $count > $this->numBoxes ){ break; }
			
		}
		
		$thtml .= "</table>";
		//$html = preg_replace("(<tr><\/tr>)", "", $thtml ); // Used to remove empty <td> elements
		$this->html = $thtml;
	}
	
	/**
	 * @brief Generate a specific box content
	 */
	protected function genTD( $html, $colSpan, $rowSpan, $elem ){
		$volume = $colSpan * $rowSpan;
		$html .= "<td colspan='" . $colSpan . "' rowspan='". $rowSpan ."'><div>!--#".$volume."--</div></td>";
		return $html;
	}
	
	
	/**
	 * @brief 1-indexed, max width/height box to return
	 * 
	 * @return array( WIDTH , HEIGHT ) 
	 */
	protected function getBox( $maxWidth, $maxHeight ){ // typically, ( 3, 8 )
		
		$width = rand( 1, $maxWidth  );
		$height = rand( 1, $maxHeight );
		
		$this->deblog( "$maxWidth $maxHeight | " . $width . " " . $height . " <br />" );
		return array( $width, $height );
		
	}
	
	
	/**
	 * @brief For a given Row,Col coordinate, how large of a box can fit
	 * 
	 * @return array( WIDTH, HEIGHT )
	 */
	protected function getMaxBoxFit( $idxRow, $idxCol ){
		
		$width = 0;
		$height = 0;
		
		for( $s = $idxCol; $s< $this->maxWidthBox; $s++ ){
			if( $this->filled[ $idxRow ][ $s ] == 0 ){
				$width++;
			} else {
				break;
			}
		}
		
		// check downwards from this row
		for( $s = $idxRow; $s< $idxRow + $this->maxHeightBox; $s++ ){
			if( $this->filled[ $s ][ $idxCol ] == 0 ){
				$height++;
			} else {
				break;
			}
		}
		
		return array( $width, $height );
		
	}
	
	/**
	 * @brief << UNINIT >> Should return the CSS % to use for this size
	 */
	public function getCSSBoxWidth(){
		
	}
	
	
	public function testStyle(){
		echo '<style>
					table{
						
						width: 900px;
					}
					
					tr{
						height:55px;
					}
					
					td{
						border:1px solid grey;
						width:33%;
						border-radius:5px;
						margin:4px;
					}
			</style>';
			
		return $this;
	}
	
	public function disp(){
		//echo $this->html;
		return $this->html;
	}
	
	
	public function overlayContent(){
		
		//var_dump( $this->sectionElements[0] );
		$count = 1;
		
		$minVolume = 1;
		$maxVolume = $this->maxWidthBox * $this->maxHeightBox;
		
		$volume = $maxVolume;
		
		
		foreach( $this->weightedElements as $key => $we ){
			$volume = $this->nextLowestVolume( $volume, $minVolume );
			
			$this->html = preg_replace( '<!--#'.$volume.'-->', $this->formatElement( $this->sectionElements[$key], $we ), $this->html, 1);
			//echo $this->html;
		}
		
	}
	
	
	public function nextLowestVolume( $currVolume, $minVolume ){
		
		if( preg_match( '<!--#'.$currVolume.'-->', $this->html ) === 0 ){
			// No more volumes of this size
			
			if( $currVolume <= $minVolume ){
				return null;
			}
			
			return $this->nextLowestVolume($currVolume - 1, $minVolume );
		} else {
			// More of these exist
			return $currVolume;
		}
	}
	
	
	
	public function formatElement( Kore_Domain_Element $element, $score = 0 ){
		
		$html = '
		<div id="title">'. $element->getTitle() . $score . '</div>
		<div id="link"><a href="'.$element->getURL().'" target="_blank">Go</a></div>
		';
		/*
		if( $element->hasThumb() ){
			$thumbs = $element->getThumbEmbed();
			$html .= '<div id="thumb"><img src="'.$thumbs.'" /></div>"';
		}
		*/
		return $html;
		
	}
	
	
	
	/**
	 * @name Generate Weighted Lists
	 */
	//@{
	public function setElementWeights( Kore_Domain_Section_List $list ){
		
		$elist = $list->elementList();
		
		$this->sectionElements = $elist;
		
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
		//echo "<br /><br />";
		//var_dump( $this->weightedElements );
		
		//$this->dispBinScores($this->weightedElements);
	}
	
	
	/**
	 * @brief Generates a reverse key so that the most recent item is key value sorted first
	 */
	protected function setTimeWeights( $elist ){
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
	protected function setScoreWeights( $elist ){
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
	
	protected function deblog( $msg ){
		if( $this->DEBUG ){
			$this->dblog .= $msg;
		}
	}
	
	protected function printDebLog(){
		echo $this->dblog;
	}
	
}

?>