<?php

/**
 * @author Revan
 */
class TagNodeBuilder extends TagNode {
    
    public static function create( $newTagString ){
        
        try {
            
            // Check for valid values
            //$urlKey     = GraphConsistency::cleanURLKey($urlKey);
            //$imgPath    = GraphConsistency::cleanURL($imgPath);
            
            
            $key = new GraphKey( $newTagString );
            
            // Try to obtain a unique updater (no overwriting)
            $updater = static::gStorage(get_parent_class())->create()->createRow($key);
            
            // Now begin upload sequence to storage
            // Add fields into the new record
            $updater->add( Node::NODE, 'tag', $newTagString );
            
            // Perform insertion
            $updater->update($key);
            
            // Now re-fetch the created object and return it
            return new TagNode( $key );
            
        } catch( GRAPH_COMPLIANCE_EXCEPTION $e ){
            throw $e;
        } catch( RECORD_EXISTS $e ){
            throw new GRAPH_STORAGE_EXCEPTION('Cannot Overwrite '.get_parent_class().' Record',0,$e);
        } catch( KoreException $e ){
            throw new GRAPH_STORAGE_EXCEPTION('Create Failure: '.$e->getMessage(),0,$e);
        }
    }
    
}

?>
