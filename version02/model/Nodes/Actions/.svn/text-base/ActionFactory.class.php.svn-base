<?php

/**
 * @author Revan
 */
class ActionFactory {
    
    protected $_actionColFam;
    public function __construct( HbaseColFam $actionColFam ){
        $this->_actionColFam = $actionColFam;
    }
    
    /**
     *
     * @param HbaseColFam $actionColFam
     * @return \Action
     * @throws GRAPH_ACTION_EXCEPTION 
     */
    public static function factory( HbaseColFam $actionColFam ){
        
        $values = $actionColFam->cellValueAsStringArray();
        
        if( !isset( $values['type'] ) ){
            throw new GRAPH_ACTION_EXCEPTION('Type was not suppplied');
        }
        
        if( $values['type'] === 'URLStreamAction' ){
            return static::URLStreamFactory($values);
        }
        
        if( !isset( $values['subj'] ) ||
            !isset( $values['verb'] ) ||
            !isset( $values['tar'] ) ){
            throw new GRAPH_ACTION_EXCEPTION('Invalid Action Definition in Storage System. Missing Required Params');
        }
        
        $actionClass    = $values['type'];
        $subject        = $values['subj'];
        $verb           = $values['verb'];
        $target         = $values['tar'];
        
        return new Action($subject, $verb, $target, $values);
        
    }
    
    protected static function URLStreamFactory( array $values ){
        $v = $values;
        return new URLStreamAction( $v['key'], $v['title'], $v['short'] );
    }
    
}

?>
