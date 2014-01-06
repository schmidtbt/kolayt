<?php


class CAC_Response {
    
    protected $_header;
    /**
     *
     * @var Smarty
     */
    protected $_smarty;
    protected $_template;
    
    function __construct(){
        $this->defaults();
    }
    
    protected function defaults(){
        $this->_smarty = ViewSwitch::smartyWWW();
        $this->_header = new CAC_Output_Headers();
        $this->_template = 'default.tpl';
    }
    
    /**
     * Called in controller to invoke the output display 
     */
    function invoke(){
        $this->_smarty->display( $this->_template );
    }
    
    /**
     * @return CAC_Output_Headers
     */
    function headers(){ 
        return $this->_header;
    }
    
    function smarty(){
        return $this->_smarty;
    }
    
    function setSmarty( Smarty $smarty ){
        $this->_smarty = $smarty;
    }
    
    function assign( $name, $value ){
        $this->_smarty->assign($name, $value);
    }
    
    function setTemplate( $template ){
        $this->_template = $template;
    }
    
    function setHeader( CAC_Output_Headers $header ){
        $this->_header = $header;
    }
    
    
    
}

?>
