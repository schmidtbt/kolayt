<?php

/**
 * @author Revan
 */
class Action {
    
    protected $_entity;
    protected $_user;
    protected $_verb;
    protected $_target;
    protected $_meta;
    
    public function __construct( $subject =null, $verb=null, $target=null, $meta = NULL ){
        $this->setSubject($subject);
        $this->setVerb($verb);
        $this->setTarget($target);
        $this->setMeta($meta);
    }
    
    public static function create( UserNode $user ){
        $subject = $user->getKeyString();
        
    }
    
    
    protected function parseRecords( HBase_Record $record ){
        var_dump( $record );
    }
    
    public function setSubject( $subject ){
        $this->_user = $subject;
    }
    public function setVerb( $verb ){
        $this->_verb = $verb;
    }
    public function setTarget( $target ){
        $this->_target = $target;
    }
    public function setMeta( $meta ){
        $this->_meta = $meta;
    }
    
    public function subject(){
        return $this->_user;
    }
    public function verb(){
        return $this->_verb;
    }
    public function target(){
        return $this->_target;
    }
    public function update( HBase_Update $updater ){
        $updater->add( GraphEntity::ACTION,     'subj',  $this->subject() );
        $updater->add( GraphEntity::ACTION,     'verb',  $this->verb() );
        $updater->add( GraphEntity::ACTION,     'tar',   $this->target() );
        $updater->add( GraphEntity::ACTION,     'type',  get_class() );
        return $updater;
    }
}

?>
