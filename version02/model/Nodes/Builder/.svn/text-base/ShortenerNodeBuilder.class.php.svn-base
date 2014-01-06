<?php

/**
 * @author Revan
 */
class ShortenerNodeBuilder extends ShortenerNode {
    
    public static function create(  $shortIdx,
                                    $urlKey){
        
        try {
            
            // Check for valid values
            $shortIdx   = GraphConsistency::cleanShortIdx($shortIdx);
            $urlKey     = GraphConsistency::cleanURLKey($urlKey);
            
            // Generate an appropriate key
            $key = new GraphKey( $shortIdx, true );
            
            // Try to obtain a unique updater (no overwriting)
            $updater = static::gStorage(get_parent_class())->create()->createRow($key);
            
            // Add fields into the new record
            $updater->add( Node::NODE, 'url', $urlKey );
            
            // Perform insertion
            $updater->update($key);
            
            // Now re-fetch the created object and return it
            return new ShortenerNode( $key );
            
        } catch( GRAPH_COMPLIANCE_EXCEPTION $e ){
            throw $e;
        } catch( RECORD_EXISTS $e ){
            throw new GRAPH_STORAGE_EXCEPTION('Cannot Overwrite '.get_parent_class().' Record',0,$e);
        } catch( KoreException $e ){
            throw new GRAPH_STORAGE_EXCEPTION('Create Failure',0,$e);
        }
    }
    
}

?>
