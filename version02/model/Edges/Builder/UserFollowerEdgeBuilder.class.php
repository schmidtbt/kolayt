<?php

/**
 * @author Revan
 */
class UserFollowerEdgeBuilder extends UserFollowerEdge {
    
    public static function create( UserNode $from, UserNode $to ){
        
        if( $from->getKey()->getRowKey() === $to->getKey()->getRowKey() ){
            throw new GRAPH_LOGIC_EXCEPTION('User Cannot follow themself');
        }
        
        static::oneDirectionCreate($from, $to);
        static::oneDirectionCreate($to, $from);
        
    }
    
    protected static function oneDirectionCreate( UserNode $from, UserNode $to ){
        
        $key = static::assembleKey($from, $to);
        $updater = static::gStorage(get_parent_class())->create()->createRow($key);
        $updater->add( 'userfollowers', 'friendsince' , '' );
        $updater->update($key);
    }
    
}

?>
