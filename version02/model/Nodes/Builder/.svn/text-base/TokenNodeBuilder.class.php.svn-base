<?php

/**
 * @author Revan
 */
class TokenNodeBuilder extends TokenNode {
    
    protected static function doCreate( $token, $userKey ) {
        
        
        $token          = GraphConsistency::cleanUserToken($token);
        $userKey        = GraphConsistency::cleanUserKeyHandle($userKey);
        
        $key = new GraphKey( $token );
        
        $updater = static::gStorage(get_parent_class())->create()->createRow($key);
        
        $updater->add( Node::NODE, 'token',     $token );
        $updater->add( Node::NODE, 'userkey',   $userKey );
        $updater->update($key);
        
        // Generate a UserNode object from the new data
        $class = get_parent_class();
        $obj = new $class( $key );
        return $obj;
    }
    
}

?>
