<?php

/**
 * @author Revan
 */
class WWW_Page_URL extends CAC_Command {
    
    public function doExecute(CAC_Client_Request $http) {
        
        $params = $http->getUrlParams();
        
        if( isset( $params['key'] ) ){
            
            $urlNode    = new URLNode( new GraphKeySHA256( $params['key'], true ) );
            
        } elseif ( isset( $params['short'] ) ){
            
            $shortIdx   = new ShortenerNode( new GraphKey( $params['short'] ) );
            $key        = $shortIdx->getURLKey();
            $urlNode    = new URLNode( new GraphKeySHA256( $key, true ) );
            
        } else {
            
            $this->setResponse( new BADREQUEST() );
            return;
            
        }
        
        $medias = VicinityScanner::vicinity( $urlNode , 'URLMediaEdge' );
        $tags   = VicinityScanner::vicinity( $urlNode,  'URLTagEdge' );
        
        URL_Page_Assignment::assignURLNode( $this->getResponse()->smarty(), $urlNode );
        URL_Page_Assignment::assignURLMedia($this->getResponse()->smarty(), $medias);
        URL_Page_Assignment::assignURLTags( $this->getResponse()->smarty(), $tags);
        $short = is_null( $urlNode->getShortDescription() ) ? $urlNode->getOGDescribe() : $urlNode->getShortDescription();
        $this->getResponse()->assign( 'description', $short );
        $this->getResponse()->assign( 'numviews', $urlNode->getNumberViews() );
        $this->getResponse()->setTemplate( 'www_page_url.tpl' );
        
    }
    
}

?>
