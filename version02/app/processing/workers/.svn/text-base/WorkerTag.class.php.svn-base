<?php

/**
 * @author Revan
 */
class WorkerTag extends Worker{
    
    public static function addTagToMedia( $tag, $mediaKey ){}
    
    public static function addTagToURL( $tag, $urlKey, $createIfMissing = false ){
        
        $tagObj = static::getTag( $tag, $createIfMissing );
        
        /*
        if( !$tagObj ){
            // Create it
            $tagObj = TagNodeBuilder::create( $tag );
        }
        */
        
        if( $tagObj ){
            static::errorLog('Adding Tag: '. $tag . ' to URL: ' . $urlKey );
            $tagObj->addTagUsage();
            // Create the edge between these two
            $urlNode = new URLNode( new GraphKeySHA256( $urlKey, true ) );
            
            try {
                static::errorLog( 'Building edges' );
                URLTagEdge::create($urlNode, $tagObj);
                TagURLEdge::create($tagObj, $urlNode);
                static::errorLog( 'Done');
                return true;
            } catch( RECORD_EXISTS $e ){
                static::errorLog( 'Record existed');
            } catch( KoreException $e ){
                static::errorLog( $e->getMessage() );
            }
            
        }
    }
    
    public static function tagger( $urlKey, $title, $domains ){
        
        static::errorLog('Tag Tokenizing: '.$urlKey.' TITLE: '.$title);
        $tagsAdded = array();
        
        // Tokenize Title
        $ngram = new NGram($title);
        foreach( $ngram->getArray() as $tok ){
            static::errorLog('Sending token: '.$tok);
            $result = static::addTagToURL( $tok, $urlKey );
            if( $result ){
                $tagsAdded[] = $tok;
            }
        }
        
        
        // Add domain structures as tags
        foreach( $domains as $domain ){
            $result = static::addTagToURL( $domain, $urlKey, true );
            if( $result ){
                $tagsAdded[] = $domain;
            }
        }
        
        // Add to POPULAR to some items
        if( rand(0,10 ) <= 3 ){
            $result = static::addTagToURL( 'popular', $urlKey, true );
        }
        
        
        
        $xcg = ExchangePool::acq('processors');
        $msg = Message::create(array( 'WorkerActionUpdater', 'streamUpdate' ), array( $urlKey, $tagsAdded ));
        Pub::sendMsg($xcg, $msg );
        
        
        static::addTagTagRelations($tagsAdded);
        
    }
    
    
    public static function addTagTagRelations( array $tagArray ){
        
        if( sizeof( $tagArray ) <= 1 ){
            return;
        }
        
        foreach( $tagArray as $key1 => $tag1 ){
            foreach( $tagArray as $key2 => $tag2 ){
                
                if( $key2 > $key1 ){
                    
                    static::errorLog('TagTagRelation: '.$tag1.', '.$tag2);
                    
                    try {
                        $t1 = new TagNode( new GraphKey( $tag1 ) );
                        $t2 = new TagNode( new GraphKey( $tag2 ) );
                    } catch( KoreException $e ){
                        static::errorLog('Err in Tag-Tag Node Creation: '.$e->getMessage() );
                    }
                    
                    try {
                        $t2t1 = TagTagEdge::create( $t2, $t1 );
                    } catch( KoreException $e ){
                        static::errorLog('Err in Tag-Tag Edges: '.$e->getMessage() );
                    }
                    
                    try {
                        $t1t2 = TagTagEdge::create( $t1, $t2 );
                    } catch( KoreException $e ){
                        static::errorLog('Err in Tag-Tag Edges: '.$e->getMessage() );
                    }
                    
                    try {
                        $t1t2 = new TagTagEdge( $t1, $t2 );
                        $t1t2->incrementStrength();
                        $t2t1 = new TagTagEdge( $t2, $t1 );
                        $t2t1->incrementStrength();
                    } catch( KoreException $e ){
                        static::errorLog('Err in Tag-Tag Edges: '.$e->getMessage() );
                    }
                    
                    
                }
                
                
            }
        }
        
    }
    
    /**
     *
     * @param type $tag
     * @param type $createIfMissing
     * @return \TagNode|boolean 
     */
    protected static function getTag( $tag, $createIfMissing = false ){
        try {
            $storage = TagNode::gStorage('TagNode')->create()->createRow( new GraphKey( $tag ) );
            if( $createIfMissing ){
                return TagNodeBuilder::create( $tag );
            } else {
                return false;
            }
        } catch( RECORD_EXISTS $e ){
            $tagObj = new TagNode( new GraphKey( $tag ) );
            return $tagObj;
        } catch( KoreException $e ){
            static::errorLog('Something bad happened while attempting to get tag: '. $tag . ' '.$e->getMessage() );
            return false;
        }
        
        
    }
    
}

?>
