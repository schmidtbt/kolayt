<?php

/**
 * @author Revan
 */
class URLTagEdgeBuilder extends URLTagEdge {
    
    public static function create( URLNode $url, TagNode $tag ){
        
        try {
            
            $key = static::assembleKey( $url, $tag );
            $updater = static::gStorage(get_parent_class())->create()->createRow($key);
            
            $updater->add( Edge::FROMNODE, 'urlkey', $url->getKeyString() );
            $updater->add( Edge::TONODE, 'disptag', $tag->getDispName() );
            
            $updater->update($key);
            
            return new URLTagEdge( $url, $tag );
            
            
        } catch( RECORD_EXISTS $e ){
            throw new GRAPH_STORAGE_EXCEPTION('Cannot Overwrite '.get_parent_class().' Record',0,$e);
        } catch( KoreException $e ){
            throw new GRAPH_STORAGE_EXCEPTION('Create Failure '.$e->getMessage(),0,$e);
        }
        
    }
    
}

?>
