<?php

/**
 * @author Revan
 */
class MediaImageNodeBuilder extends MediaImageNode {
    
    /**
     *
     * @param String $urlKey url key hash
     * @param String $imgPath url to image location
     * @return \ShortenerNode
     * @throws GRAPH_COMPLIANCE_EXCEPTION
     * @throws GRAPH_STORAGE_EXCEPTION 
     */
    public static function create( $urlKey, $imgPath ){
        
        try {
            
            // Check for valid values
            $urlKey     = GraphConsistency::cleanURLKey($urlKey);
            $imgPath    = GraphConsistency::cleanURL($imgPath);
            
            $imgURL     = new Pipe_URL_Image( $imgPath );
            $img        = new Pipe_Image( $imgURL );
            
            $thumbPath  = $img->getThumbPath();
            $fullPath   = $img->getFullPath();
            
            $thumbKey   = new GraphKeyFileHash($thumbPath);
            $fullKey    = new GraphKeyFileHash($fullPath);
            
            // Try to obtain a unique updater (no overwriting)
            $updater = static::gStorage(get_parent_class())->create()->createRow($fullKey);
            
            
            // Key obtained, this is unique, upload pictures to S3
            $s3 = new S3_Image();
            $s3->upload( $fullKey->getRowKey(), $fullPath, S3_Image::URLFULL );
            $s3Full = $s3->getLastPath();
            $s3->upload( $fullKey->getRowKey(), $thumbPath, S3_Image::URLTHUMB );
            $s3Thumb = $s3->getLastPath();
            
            // Now begin upload sequence to storage
            // Add fields into the new record
            $updater->add( Node::NODE, 'origsource', $imgPath );
            $updater->add( Node::NODE, 'full', $s3Full );
            $updater->add( Node::NODE, 'thumb', $s3Thumb );
            $updater->add( Node::NODE, 'type', 'MediaImageNode' );
            
            // Perform insertion
            $updater->update($fullKey);
            
            // Now re-fetch the created object and return it
            return new MediaNode( $fullKey );
            
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
