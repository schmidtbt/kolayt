<?php

/**
 * @author Revan
 */
class UserNode extends Node {
    
    const GAMER = 'gamer';
    const AUTH  = 'auth';
    
    // Get/Set all fields at this node location
    // Other classes can use this node and make modifications
    // i.e. Pass to 'gamer', and 'auth'
    
    // Nodes/Edges shouldn't care what is done with them, they should
    // simply provide the guidance on what is allowed
    // Business Logic actually does interesting manipulations
    // This is an abstraction of a storage model
    
    public function getFirstName(){
        return $this->getAttributeValue( 'user', 'first' );
    }
    public function getDispHandle(){
        return $this->getAttributeValue( Node::NODE, 'handle' );
    }
    
    public function incrementNumFollowers(){
        $this->incrementAttribute( UserNode::NODE, 'followers' );
    }
    public function incrementNumFollowings(){
        $this->incrementAttribute( UserNode::NODE, 'followings' );
    }
    
    public function getNumFollowers(){
        return $this->getAttribute(UserNode::NODE, 'followers')->asCounter();
    }
    public function getNumFollowings(){
        return $this->getAttribute(UserNode::NODE, 'followings')->asCounter();
    }
    
    public function modBio( $newBio ){
        $bio = GraphConsistency::cleanUserBio( $newBio );
        return $this->modAttribute( 'user' , 'bio' , $bio );
    }
    public function validatePassword( Auth_Password $password ){
        $savedPassword = new Auth_Password( $this->getPassword() );
        return $savedPassword->isValid( $password );
    }
    protected function getPassword(){
        return $this->getAttributeValue( static::AUTH, 'password' );
    }
    public function insertToken( Auth_Token $token ){
        $time = time();
        $col  = 'token'.$time;
        $this->modAttribute( UserNode::AUTH, $col, $token->string() );
    }
    
    public function validateToken( Auth_Token $token ){
        if( $this->acquireTokenKey($token) ){
            return true;
        } else {
            return false;
        }
    }
    
    public function invalidateToken( Auth_Token $token ){
        $tokenKey = $this->acquireTokenKey($token);
        if( $tokenKey ){
            return $this->removeAttribute( UserNode::AUTH, $tokenKey );
        } else {
            throw new GRAPH_LOGIC_EXCEPTION('Cannot remove a non-existent token');
        }
    }
    
    protected function acquireTokenKey( Auth_Token $token ){
        $values = $this->getAttributeColFamilyValues( UserNode::AUTH, 'token' );
        $tokenKey = array_search( $token->string() , $values );
        if( $tokenKey === false ){
            return false;
        } else {
            return $tokenKey;
        }
    }
    
    
}

?>
