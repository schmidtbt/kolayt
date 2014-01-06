<?php

/**
 * @author Revan
 */
class WorkerActionUpdater extends Worker {
    
    public static function newAction( $serializedAction ){
        static::errorLog('New Action');
        
        $obj = unserialize( $serializedAction );
        if( ! $obj instanceof Action ){
            static::errorLog('Action Serialization Failure');    
            return;
        }
        
        if( $obj instanceof URLStreamAction ){
            static::errorLog('Cannot process URLStreamAction via WorkerActionUpdater::newAction');    
            return;
        }
        
        if( $obj instanceof URLAction ){
            // This is referring to an action by a user on a URL
            $user   = new UserNode( new GraphKey( $obj->subject(), true ) );
            $url    = new URLNode( new GraphKeySHA256( $obj->target(), true ) );
            static::errorLog('Parsing URLAction, user:'.$user->getKeyString().', url:'.$url->getKeyString() );
            
            $followers = array();
            
            $userFollowers = VicinityScanner::vicinityLabel( $user, UserUserEdge::FOLLOWING, 'UserFollowingEdge' );
            //var_dump( sizeof( $userFollowers ) );
            
            foreach( $userFollowers as $uf ){
                $followers[$uf->to()->getKeyString()] = $uf->to();
            }
            
            $tagsOnURL = VicinityScanner::vicinity( $url, 'URLTagEdge' );
            //var_dump( sizeof( $tagsOnURL ) );
            
            $allTagFollowers = array();
            
            foreach( $tagsOnURL as $tu ){
                $tagFollowers = VicinityScanner::vicinity( $tu->to(), 'TagUserEdge' );
                foreach( $tagFollowers as $tf ){
                    $allTagFollowers[$tf->to()->getKeyString()] = $tf->to();
                }
            }
            
            // Update with basic actions
            foreach( $followers as $f ){
                UserStreamEdge::create($f, $obj);
            }
            
            
            $streamAction = URLStreamAction::create($url);
            foreach( $allTagFollowers as $atf ){
                UserStreamEdge::create($atf, $streamAction);
            }
            
            
            UserActionEdge::create($user, $obj);
            URLActionEdge::create( $url, $obj );
            
            
        }
        
        
    }
    
    
    public static function streamUpdate( $urlKey, array $tags ){
        
        $url  = new URLNode( new GraphKeySHA256( $urlKey, true ) );
        
        /*
        $followers = array();
        
        $userFollowers = VicinityScanner::vicinityLabel( $user, UserUserEdge::FOLLOWING, 'UserFollowingEdge' );
        //var_dump( sizeof( $userFollowers ) );

        foreach( $userFollowers as $uf ){
            $followers[$uf->to()->getKeyString()] = $uf->to();
        }
        */
        
        $allTagFollowers = array();
        
        foreach( $tags as $tu ){
            try{
                $tagNode = new TagNode( new GraphKey( $tu ) );
                $tagFollowers = VicinityScanner::vicinity( $tagNode, 'TagUserEdge' );
                foreach( $tagFollowers as $tf ){
                    $allTagFollowers[$tf->to()->getKeyString()] = $tf->to();
                }
            } catch( KoreException $e ){}
        }

        /*
        // Update with basic actions
        foreach( $followers as $f ){
            UserStreamEdge::create($f, $url);
        }
        */
        
        foreach( $allTagFollowers as $atf ){
            try {
                UserStreamRankedEdge::create($atf, $url);
            } catch( KoreException $e ){}
        }
        
        
        //UserActionEdge::create($user, $url);
        //URLActionEdge::create( $url, $url );
        
    }
    
    /**
     * Execute when someone modifies a URL entry
     * 
     * @param type $userKey
     * @param type $urlKey
     * @param type $action 
     */
    public static function NewActionOnURL( $userKey, $urlKey, $action ){
        
    }
    
    /**
     * Execute when a user performs an action. Recorded on their personal page. 
     */
    public static function NewActionOnUser(){}
    
    /**
     * Execute when action is called and want all registered parties' stream's notified. 
     */
    public static function NewStreamAction(){}
    
}

?>
