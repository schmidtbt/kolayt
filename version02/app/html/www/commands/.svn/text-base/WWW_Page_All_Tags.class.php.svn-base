<?php

/**
 * @author Revan
 */
class WWW_Page_All_Tags extends CAC_Command {
    
    public function doExecute(CAC_Client_Request $http) {
        
        $tagScanner = VicinityScanner::tablescan('TagNode', 100);
        
        AllTags_Assignment::assignAllTags($this->getResponse()->smarty(), $tagScanner );
        $this->getResponse()->setTemplate( 'all_tags.tpl' );
    }
    
}

?>
