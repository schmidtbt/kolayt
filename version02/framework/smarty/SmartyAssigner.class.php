<?php

/**
 * @author Revan
 */
class SmartyAssigner {
    
    /**
     * 
     * @var \Smarty
     */
    protected $_smarty;
    protected $_template;
    
    public function __construct( Smarty $smarty ){
        $this->_smarty = $smarty;
        $this->_template = 'default.tpl';
    }
    
    public function getSmarty(){
        return $this->_smarty;
    }
    
    public function getTemplate(){
        return $this->_template;
    }
    
    protected function setTemplate( $template ){
        $this->_template = $template;
    }
    
}

?>
