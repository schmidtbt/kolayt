<?php

/**
 * @author Revan
 */
class URL_Page_Assignment extends SmartyAssigner {
    
    public static function assignURLNode( Smarty $smarty, URLNode $url ){
        
        //$this->setTemplate( 'www_page_url.tpl' );
        
        $smarty->assign( 'title', $url->getTitle() );
        $smarty->assign( 'link', $url->getURLLink() );
        $smarty->assign( 'url_description', $url->getOGDescribe() );
        $smarty->assign( 'short', $url->getShortIdx() );
        
    }
    
    public static function assignURLMedia( Smarty $smarty, array $medias ){
        
        $media = array();
        $count = 0;
        foreach( $medias as $u ){
            if( $u instanceof URLMediaEdge ){
                if( $u->to()->getSubType() instanceof MediaImageNode ){
                    $media[$count] = array();
                    $media[$count]['type'] = 'image';
                    $media[$count]['link'] = $u->to()->getSubType()->getFullPath();
                }
                if( $u->to()->getSubType() instanceof MediaVideoNode ){
                    $media[$count] = array();
                    $media[$count]['type'] = 'video';
                    $media[$count]['link'] = $u->to()->getSubType()->getImgURL();
                    $media[$count]['vid'] = $u->to()->getSubType()->getEmbedURL();
                }
            }
            $count++;
        }
        $smarty->assign('media', $media );
        
    }
    
    public static function assignURLTags( Smarty $smarty, array $tags ){
        
        $allTags = array();
        foreach( $tags as $t ){
            if( $t instanceof URLTagEdge ){
                $allTags[] = array( 'key' => $t->getTagKey(), 'display'=>$t->to()->getDispName() );
            }
        }
        
        $smarty->assign( 'tags', $allTags );
        
        
    }
    
}

?>
