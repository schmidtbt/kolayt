<?php

/**
 * @author Revan
 */
class NGram {
    
    protected $_string;
    protected $_tokens;
    protected $_trimChars = " \t\r\n.,!?)(:\x0B\0";
    protected $_ngram;
    
    public function __construct( $string, $size = 1 ){
        $this->_string = $string;
        $this->ngram($size);
    }
    
    public function getArray(){
        return $this->_ngram;
    }
    
    public function ngram( $Nsize ){
        $this->_tokens = $this->tokenize();
        $this->_ngram = $this->genNGrams( $this->_tokens, $Nsize);
        return $this->_ngram;
    }
    
    protected function genNGrams( $tokens, $Nsize ){
        
        $output = array();
        //var_dump( $tokens );
        foreach( $tokens as $key => $tok ){
            //echo $tok . "\n";
            $output[]   = $tok;
            
            /// ADD possesives as tokens
            $possesive  = static::duplicatePossessives( $tok );
            if( $possesive ){ $output[] = $possesive; }
            
            
            $lags       = array();
            $lags[]     = $tok;
            $maxidx     = $key + 1 + $Nsize < sizeof( $tokens ) ? $Nsize+$key+1 : sizeof( $tokens );
            //echo $maxidx . "\n";
            
            for( $i = $key+1; $i < $maxidx; $i++ ){
                
                $lags[] = $tokens[$i];
                $newTok = '';
                //var_dump( $lags );
                foreach( $lags as $l ){
                    $newTok .= ' '.$l;
                }
                //echo $newTok . "\n";
                //var_dump( static::duplicatePossessives(trim($newTok)) );
                $output[] = trim($newTok);
            }
            
        }
        return $output;
    }
    
    protected static function duplicatePossessives( $string ){
        if( strpos( $string, "'s") !== false ){
            return str_replace( "'s", '' , $string );
        }
        
        //var_dump( preg_replace( '/\'s/', '', $string ) );
        
    }
    
    protected function tokenize(){
        $string = $this->_string;
        $string = strip_tags( $string );
        $string = strtolower($string);
        
        $tokens = explode( ' ', $string );
        
        foreach( $tokens as &$token ){
            $token = trim( $token, $this->_trimChars );
        }
        
        return $tokens;
    }
    
}

?>
