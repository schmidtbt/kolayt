<?php

/**
 * @author Revan
 */
class AllTags_Assignment extends SmartyAssigner {
    
    public static function assignAllTags( Smarty $smarty, array $allTags ){
        
        $tags = array();
        foreach( $allTags as $tag ){
            if( $tag instanceof TagNode ){
                $tags[] = array('key'=>$tag->getKeyString(), 'display'=>$tag->getDispName(), 'num' => $tag->getNumPages() );
            }
        }
        
        $smarty->assign( 'tags', $tags );
        
    }
    
}

?>
