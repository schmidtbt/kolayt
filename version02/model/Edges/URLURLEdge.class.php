<?php

/**
 * @author Revan
 */
class URLURLEdge extends URLEdge {
    
    public static function assembleKey(Node $from, Node $to, $label = '') {
        if( $label === '' ){
            return parent::assembleKey( $from, $to, GraphKey::invertTime(time()) );
        } else {
            return parent::assembleKey( $from, $to, $label);
        }   
    }
    protected function setTo(URLNode $to) {
        parent::setTo($to);
    }
    public static function generate($fromKey, $toKey, $label ) {
        $fromNode   = new URLNode( new GraphKeySHA256( $fromKey, true ) );
        $toNode     = new URLNode( new GraphKeySHA256( $toKey, true) );
        $class      = __CLASS__;
        return new $class( $fromNode, $toNode, $label );
    }
    protected static function executeCreate( URLNode $urlFrom, URLNode $urlTo, $label = '') {

        $key = static::assembleKey( $urlFrom, $urlTo );
        $updater = static::gStorage(__CLASS__)->create()->createRow($key);

        $updater->add( Edge::FROMNODE,  'urlkey', $urlFrom->getKeyString() );
        $updater->add( Edge::TONODE,    'urlkey', $urlTo->getKeyString() );
        
        $updater->update($key);

        $label = $key->getLabel();
        
        $class = __CLASS__;
        return new $class( $urlFrom, $urlTo, $label );
        
    }
}

?>
