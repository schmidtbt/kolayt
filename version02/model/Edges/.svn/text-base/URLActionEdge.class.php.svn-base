<?php

/**
 * @author Revan
 */
class URLActionEdge extends URLEdge {
    
    /*
    public function delete(){
        $this->removeRow();
    }
    */
    
    /**
     *
     * @return Action
     */
    public function action(){
        return ActionFactory::factory( $this->getColFamily(GraphEntity::ACTION) );
    }
    
    
    public static function assembleKey(Node $from, Node $to =null, $label = '') {
        $fromKeyString = $from->getKeyString();
        $toKeyString    = 'action';
        if( $label == '' ){
            $key = GraphKey::assemble( array( $fromKeyString, GraphKey::invertTime(time()), $toKeyString ) );
        } else {
            $key = GraphKey::assemble( array( $fromKeyString, $label, $toKeyString ) );
        }
        return $key;
    }
    protected function setTo( ActionNode $to) {
        parent::setTo($to);
    }
    public static function generate($fromKey, $toKey, $label ) {
        $from    = new URLNode( new GraphKeySHA256( $fromKey, true ) );
        $to      = new ActionNode( new GraphKey( $toKey, true ) );
        return new URLActionEdge( $from, $to, $label );
    }
    
    public static function create( Node $from, Action $to ) {
        try {
            static::executeCreate($from, $to );
        } catch( GRAPH_COMPLIANCE_EXCEPTION $e ){
            throw $e;
        } catch( RECORD_EXISTS $e ){
            throw new GRAPH_ENTITY_EXISTS('Cannot Overwrite '.get_parent_class().' Record',0,$e);
        } catch( KoreException $e ){
            var_dump( $e );
            throw new GRAPH_STORAGE_EXCEPTION('Edge Create Failure: '.$e->getMessage(),0,$e);
        }
    }
    
    protected static function executeCreate( URLNode $from, Action $to ) {
        
        $key = static::assembleKey( $from );
        
        $updater = static::gStorage(__CLASS__)->create()->createRow($key);
        
        $updater->add( Edge::FROMNODE,          'url',   $from->getKeyString() );
        
        $updater = $to->update($updater);
        
        $updater->update($key);
        
        return true;
    }
    
    
    
}

?>
