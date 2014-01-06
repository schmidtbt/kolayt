<?php

/**
 * @author Revan
 */
class UserUserEdge extends UserEdge {
    
    const FOLLOWERS = 'my';
    const FOLLOWING = 'me';
    
    public static function assembleKey(Node $from, Node $to, $label = '') {
        if( $label === '' ){
            return parent::assembleKey( $from, $to, GraphKey::invertTime(time()) );
        } else {
            return parent::assembleKey( $from, $to, $label);
        }
    }
    
    protected function setTo( UserNode $to ) {
        parent::setTo($to);
    }
    
    public static function generate($fromKey, $toKey, $label ) {
        $tagNode    = new UserNode( new GraphKey( $fromKey, true ) );
        $urlNode    = new UserNode( new GraphKeySHA256( $toKey, true) );
        $class = get_called_class();
        return new $class( $tagNode, $urlNode, $label );
    }
    
    protected static function executeCreate(UserNode $from, UserNode $to, $label = '') {
        
        // Add Follower Relation
        try {
            $followKey = static::assembleKey( $from, $to, UserUserEdge::FOLLOWERS );
            $updater = static::gStorage(__CLASS__)->create()->createRow($followKey);
            $updater->add( Edge::FROMNODE,  'user', $from->getKeyString() );
            $updater->add( Edge::TONODE,    'user', $to->getKeyString() );
            $updater->update($followKey);
        } catch( KoreException $e ){
            throw new GRAPH_TRANSACTION_FAILURE('Transaction failed while updating followers:'.$e->getMessage(), 0, $e );
            return;
        }
        
        // Add Following Relation
        try {
            $followingKey = static::assembleKey( $from, $to, UserUserEdge::FOLLOWING );
            $updater = static::gStorage(__CLASS__)->create()->createRow($followingKey);
            $updater->add( Edge::FROMNODE,  'user', $to->getKeyString() );
            $updater->add( Edge::TONODE,    'user', $from->getKeyString() );
            $updater->update($followingKey);
        } catch( KoreException $e ){
            throw new GRAPH_TRANSACTION_FAILURE('Transaction failed while updating followings:'.$e->getMessage(), 0, $e );
            return;
        }
        
        
        // Now update the following stats on both systems
        try {
            $from->incrementNumFollowings();
            $to->incrementNumFollowers();
        } catch( KoreException $e ){
            throw new GRAPH_TRANSACTION_FAILURE('Transaction failed While Updating Stats:'.$e->getMessage(), 0, $e );
        }
        
        $class = __CLASS__;
        return new $class( $from, $to, UserUserEdge::FOLLOWERS );
        
    }
    
}

?>
