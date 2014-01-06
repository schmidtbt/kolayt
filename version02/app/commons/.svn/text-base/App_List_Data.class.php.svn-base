<?php

/**
 * @author Revan
 */
class App_List_Data {
    
    /**
     * Parses Edge entries (arrays of them) that were generated with App_List_Data::generateTagListEntry
     * Further, it should implement iURLEntityEdge
     * @param array $urlNodes 
     * @return array For adding into smarty
     */
    public static function processList( array $urlNodes ){
        
        $output = array();
        foreach( $urlNodes as $url ){
            if( $url instanceof iURLEntityEdge ) {
                $entry = array();
                $entry['short']     = $url->getShortIdx();
                $entry['media']     = $url->getMediaData();
                $entry['title']     = $url->getTitle();
                $entry['describe']  = $url->getOGDescribe();
                $entry['host']      = $url->getDomain();
                $output[] = $entry;
            }
            
        }
        return $output;
        
    }
    
    public static function fullMediaImages( array $allurls ){
        $maxIdxs = 5;
        $fullurls = array();
        foreach( $allurls as $key => $u ){
            if( $key > $maxIdxs ){ continue; }
            if( isset( $u['media']['full'] ) ){
                $fullurls[] = array( 'img' => $u['media']['full'], 'describe'=> $u['describe'], 'title' => $u['title'] );
            }
        }
        return $fullurls;
    }
    
    public static function acquireTrendingTags( $max = 10 ){
        
        $tags = VicinityScanner::tablescan( 'TagNode' , 100 );
        $tagArr = array();
        
        // Generate a pretty array of tag info
        foreach( $tags as $t ){
            if( $t instanceof TagNode ){
                $tagArr[$t->getKeyString()] = array( 'number'=>$t->getNumPages(), 'disp' => $t->getDispName(), 'key'=>$t->getKeyString() );
            }
        }
        
        // Create a sort-by array
        $sortArr = array();
        foreach( $tagArr as $key=> $ta ){
            $sortArr[$key] = $ta['number'];
        }
        
        array_multisort( $tagArr, SORT_DESC, $sortArr );
        $tagArr = array_slice( $tagArr, 0, $max );
        return $tagArr;
        
    }
    
    /**
     * What to store at an edge location
     * @param Smarty $smarty
     * @param URLNode $url 
     */
    public static function generateTagListEntry( HBase_Update $updater, URLNode $url ){
        
        $updater->add( Edge::TONODE, 'urlkey',   $url->getKeyString() );
        $updater->add( Edge::TONODE, 'urlkey', $url->getKeyString() );
        $updater->add( Edge::TONODE, 'shortidx', $url->getShortIdx() );
        
        $media = VicinityScanner::vicinity( $url, 'URLMediaEdge' );
        if( is_array( $media) && sizeof( $media) > 0 ) {
            $m = $media[0];
            $m = $m->to();
            if( $m instanceof MediaNode ){
                $subType = $m->getSubType();
                if( $subType instanceof MediaImageNode ){
                    $updater->add( Edge::TONODE, 'media_type', 'img' );
                    $updater->add( Edge::TONODE, 'media_img', $subType->getThumbPath() );
                    $updater->add( Edge::TONODE, 'media_img_full', $subType->getFullPath() );
                } elseif( $subType instanceof MediaVideoNode ) {
                    $updater->add( Edge::TONODE, 'media_type', 'vid' );
                    $updater->add( Edge::TONODE, 'media_img', $subType->getImgURL() );
                    $updater->add( Edge::TONODE, 'media_embed', $subType->getEmbedURL() );
                    $updater->add( Edge::TONODE, 'media_provider', $subType->getProvider() );
                    $updater->add( Edge::TONODE, 'media_key', $subType->getVidKey() );
                } else {
                    $updater->add( Edge::TONODE, 'media_type', 'none' );
                }
            } else {
                $updater->add( Edge::TONODE, 'media_type', 'none' );
            }
        } else {
            $updater->add( Edge::TONODE, 'media_type', 'none' );
        }
        $updater->add( Edge::TONODE, 'ogdescribe', $url->getOGDescribe() );
        $updater->add( Edge::TONODE, 'shortidx', $url->getShortIdx() );
        $updater->add( Edge::TONODE, 'title', $url->getTitle() );
        $updater->add( Edge::TONODE, 'host', $url->getDomain() );
        return $updater;
    }
    
    public static function userTagsList( array $userTagNodes ){
        $output = array();
        foreach( $userTagNodes as $userTag ){
            if( $userTag instanceof UserTagEdge ) {
                $entry = array();
                $entry['tagkey']     = $userTag->getTagKey();
                $entry['tagdisp']    = $userTag->to()->getDispName();
                $output[] = $entry;
            }
        }
        return $output;
    }
    
}

?>
