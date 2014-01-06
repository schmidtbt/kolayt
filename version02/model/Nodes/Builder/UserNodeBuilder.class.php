<?php

/**
 * @author Revan
 */
class UserNodeBuilder extends UserNode {
    
    /**
     * 
     * @param type $handle
     * @param type $first
     * @param type $last
     * @param type $email
     * @param type $password
     * @return UserNode
     * @throws GRAPH_EXCEPTION
     * @throws GRAPH_LOGIC_EXCEPTION 
     */
    protected static function doCreate( $handle, $first, $last, $email, $password ){
        
        $dispayHandle   = GraphConsistency::cleanUserDisplayHandle($handle);
        $keyHandle      = GraphConsistency::cleanUserKeyHandle($handle);
        $first          = GraphConsistency::cleanUserName( $first );
        $last           = GraphConsistency::cleanUserName( $last );
        $email          = GraphConsistency::cleanUserEmailAddr($email);
        
        $key = new GraphKey( $handle );
        
        $updater = static::gStorage(get_parent_class())->create()->createRow($key);
        
        // Ensure email does not already exist
        try {
            $emailNode = new EmailNode( new GraphKey( $email ) );
            throw new GRAPH_EXCEPTION('Email Already Exists');
        } catch( GRAPH_ENTITY_DOES_NOT_EXIST $e ){}
        
        $updater->add( Node::NODE, 'handle', $handle );
        $updater->add( Node::NODE, 'first', $first );
        $updater->add( Node::NODE, 'last', $last );
        $updater->add( Node::NODE, 'email', $email );
        $updater->add( UserNode::AUTH, 'password', $password );
        $updater->update($key);
        
        // Generate a UserNode object from the new data
        $obj = new UserNode( $key );
        
        // Update the user email entry
        try {
            EmailNodeBuilder::create( $key->getRowKey(), $email );
        } catch( GRAPH_EXCEPTION $e ){
            throw new GRAPH_LOGIC_EXCEPTION('Unable to update user\'s email');
        }
        
        return $obj;
        
    }
    
}

?>
