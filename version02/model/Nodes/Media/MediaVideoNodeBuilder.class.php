<?php

/**
 * @author Revan
 */
class MediaVideoNodeBuilder extends MediaVideoNode {
    
    
    public static function create( $embedLink, $vidType, $vidKey, $vidImgLink ){
        
        try {
            
            // Check for valid values
            //$urlKey     = GraphConsistency::cleanURLKey($urlKey);
            //$imgPath    = GraphConsistency::cleanURL($imgPath);
            
            
            $key = new GraphKeySHA256( $embedLink );
            
            $img = new Pipe_Image( new Pipe_URL_Image( $vidImgLink) );
            $fullPath = $img->getFullPath();
            
            // Try to obtain a unique updater (no overwriting)
            $updater = static::gStorage(get_parent_class())->create()->createRow($key);
            
            
            // Key obtained, this is unique, upload pictures to S3
            $s3 = new S3_Image();
            $s3->upload( $key->getRowKey(), $fullPath, S3_Image::VIDEOTHUMB );
            $vidS3Path = $s3->getLastPath();
            
            
            // Now begin upload sequence to storage
            // Add fields into the new record
            $updater->add( Node::NODE, 'embed', $embedLink );
            $updater->add( Node::NODE, 'vidimg', $vidS3Path );
            $updater->add( Node::NODE, 'vidtype', $vidType );
            $updater->add( Node::NODE, 'vidkey', $vidKey );
            $updater->add( Node::NODE, 'type', 'MediaVideoNode' );
            
            // Perform insertion
            $updater->update($key);
            
            // Now re-fetch the created object and return it
            return new MediaNode( $key );
            
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
