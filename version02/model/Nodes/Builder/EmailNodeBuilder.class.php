<?php

/**
 * @author Revan
 */
class EmailNodeBuilder extends EmailNode {
    
    protected static function doCreate( $userKey, $emailaddr ) {
        
        $userKey    = GraphConsistency::cleanUserKeyHandle($userKey);
        $emailaddr  = GraphConsistency::cleanUserEmailAddr($emailaddr);
        
        $key        = new GraphKey( $emailaddr );
        
        $updater    = static::gStorage(get_parent_class())->create()->createRow($key);
        
        $updater->add( Node::NODE, 'email', $emailaddr );
        $updater->add( Node::NODE, 'user', $userKey );
        
        $updater->update($key);
        
    }
    
}

?>
