<?php

/**
 * @author Revan
 */
class WorkerURLBuilder extends Worker {
    
    protected static $exchg = 'processors';
    
    public static function URLBuilder( $urlString ){
        
        static::errorLog('Initializing URL Builder: '.$urlString);
        
        // Setup the environment
        $url        = new Pipe_URL( $urlString );
        $crawler    = new Pipe_Crawler($url);
        $finUrl     = $crawler->getFinalURL();
        $urlKey     = new GraphKeySHA256( $finUrl->getString() );
        $parser     = new Pipe_Parser( $crawler );
        $ogparser   = new Pipe_Parser_OG( $crawler );
        $reparser   = new Pipe_Parser_Readability( $crawler );
        $imgs       = $ogparser->getImages();
        $vids       = $parser->getVideos();
        $title      = strlen( $ogparser->getTitle() ) > 0 ? $ogparser->getTitle() : $reparser->getTitle();
        $outlinks   = $reparser->getOutURLs();
        
        // Attempt upload
        try {
        $urlNode = URLNodeBuilder::create(
                $finUrl->getString(), 
                $finUrl->getHost()->getDomainNoWWW(), 
                $finUrl->getOrigURL(), 
                $ogparser->getTitle(),
                $reparser->getTitle(),
                $ogparser->getDescription(),
                $reparser->getDescription(),
                URLNode::stripDescription( $reparser->getDescription() ),
                ''
                );
        } catch( KoreException $e ){
            static::errorLog('URL already exists: '.$e->getMessage().' -- '.$finUrl->getString().' '.$urlKey->getRowKey() );
            // URL existed, so exit
            return;
        }
        
        /// GENERATE GRAPH DEPENDENCIES ///
        
        // Setup the exchange to use
        $procExch   = ExchangePool::acq(static::$exchg);
        
        // Start sub-system processes
        //static::sendTokenizer($procExch, $urlKey->getRowKey(), $title );
        //static::sendDomainTag($procExch, $urlKey->getRowKey(), $url->getHost()->getAllDomainSubstructure() );
        static::URLShortenerUpdate( $urlKey->getRowKey() );
        //static::sendToURLURLCreator( $procExch, $urlKey->getRowKey(), $outlinks );
        
        if( is_array( $imgs ) ){
            foreach( $imgs as $i ){
                static::sendImage( $procExch, $urlKey->getRowKey(), $i->getString() );
            }
        }
        
        if( is_array( $vids ) ){
            foreach( $vids as $v ){
                static::sendVideo( $procExch, 
                        $urlKey->getRowKey(), 
                        get_class($v), 
                        $v->getURL()->getString() );
            }
        }
        
        static::sendToTagger($procExch, $urlKey->getRowKey(), $title, $url->getHost()->getAllDomainSubstructure() );
        
    }
    protected static function sendTokenizer(Exchange $xcg, $urlKey, $title ){
        Pub::sendMsg($xcg, Message::create(array( 'WorkerURLBuilder', 'URLTokenizer' ), array( $urlKey, $title) ) );
    }
    protected static function sendImage( Exchange $xcg, $urlKey, $imgpath ){
        $msg = Message::create(array( 'WorkerMediaBuilder', 'MediaImageBuild' ), array( $urlKey, $imgpath ) );
        Pub::sendMsg($xcg, $msg );
    }
    protected static function sendVideo( Exchange $xcg, $urlKey, $vidType, $origLink ){
        $msg = Message::create(array( 'WorkerMediaBuilder', 'MediaVideoBuilder' ), array( $urlKey, $vidType, $origLink ));
        Pub::sendMsg($xcg, $msg );
    }
    protected static function sendDomainTag( Exchange $xcg, $urlKey, $domains ){
        foreach( $domains as $domain ){
            $msg = Message::create(array( 'WorkerTag', 'addTagToURL' ), array( $domain, $urlKey, true ));
            Pub::sendMsg($xcg, $msg );
        }
    }
    protected static function sendTagToURL( Exchange $xcg, $urlKey, $tag ){
        $msg = Message::create(array( 'WorkerTag', 'addTagToURL' ), array( $tag, $urlKey ));
        Pub::sendMsg($xcg, $msg );
    }
    protected static function sendToURLURLCreator( Exchange $xcg, $urlKeyFrom, $urlKeyTo ){
        $msg = Message::create(array( 'WorkerURLBuilder', 'URLGenerateRelation' ), array( $urlKeyFrom, $urlKeyTo ));
        Pub::sendMsg($xcg, $msg );
    }
    protected static function sendToTagger( Exchange $xcg, $urlKeyFrom, $title, $domains ){
        $msg = Message::create(array( 'WorkerTag', 'tagger' ), array( $urlKeyFrom, $title, $domains ));
        Pub::sendMsg($xcg, $msg );
    }
    
    
    public static function URLTokenizer( $urlKey, $title = '' ){
        static::errorLog('Tokenizing: '.$urlKey.' TITLE: '.$title);
        $ngram = new NGram($title);
        $xcg   = ExchangePool::acq(static::$exchg);
        foreach( $ngram->getArray() as $tok ){
            static::errorLog('Sending token: '.$tok);
            static::sendTagToURL($xcg, $urlKey, $tok);
        }
    }
    public static function URLShortenerUpdate( $urlKey ){
        static::errorLog('URL Shortening Service: '.$urlKey);
        
        $url = new URLNode( new GraphKeySHA256( $urlKey, true ) );
        $idx = $url->getShortIdx();
        try {
            ShortenerNodeBuilder::create($idx, $urlKey);
        } catch( KoreException $e ){
            static::errorLog('Shortener failed to update record:'.$urlKey.' with message:'. $e->getMessage() );
        }
        
    }
    public static function URLGenerateRelation( $urlKeyFrom, $urlKeysTo ){
        
        
        if( is_array( $urlKeysTo ) ){
            foreach( $urlKeysTo as $key ){
                static::errorLog('Build URL-URL relation: '.$urlKeyFrom. 'to: '. $key->getString() );
            }
            
            
        }
        
    }
    
}

?>
