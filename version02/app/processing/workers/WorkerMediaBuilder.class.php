<?php

/**
 * @author Revan
 */
class WorkerMediaBuilder extends Worker{
    
    public static function MediaImageBuild( $urlKey, $imgPath ){
        static::errorLog('Image Building: '.$imgPath);
        
        try {
            $media      = MediaImageNodeBuilder::create($urlKey, $imgPath);
            $urlNode    = new URLNode( new GraphKeySHA256( $urlKey, true ) );
            URLMediaEdge::create( $urlNode, $media );
            MediaURLEdge::create( $media, $urlNode );
        } catch( KoreException $e ){
            static::errorLog('MediaImageBuild failed to update record:'.$urlKey.' with message:'. $e->getMessage().$e->getTraceAsString() );
        }
        
    }
    
    /**
     * @bug vimeo links to /video/... and /... are showing up as separate. Some normalization is required.
     * @param string $urlKey
     * @param string $vidType class of the Pipe_Video variety
     * @param string $origLink embed link for the content
     */
    public static function MediaVideoBuilder( $urlKey, $vidType, $origLink ){
        try {
            static::errorLog('Video Building: '.$vidType. ' '.$origLink );

            $vid = new $vidType( new Pipe_URL_Video( $origLink ) );
            //$vid = new Pipe_Video_Youtube( new Pipe_URL_Video( $origLink ) );

            $media = MediaVideoNodeBuilder::create( $vid->getEmbedLink(), get_class( $vid ), $vid->getKey(), $vid->getRemoteImageLink() );
            $urlNode = new URLNode( new GraphKeySHA256( $urlKey, true ) );
            URLMediaEdge::create( $urlNode, $media );
            MediaURLEdge::create( $media, $urlNode );
        } catch( KoreException $e ){
            static::errorLog($e->getMessage());
        }
    }
    
}

?>
