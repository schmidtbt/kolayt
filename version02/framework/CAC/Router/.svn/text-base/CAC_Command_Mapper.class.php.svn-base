<?php

/**
 * @brief Maps Kore_Request URL-Params to Internal Command Paths
 * 
 */
class CAC_Command_Mapper {
	
    protected static $maxNestLevel      = 5;
    
    protected $_http;
    protected $_map;
    
    protected $_params;
    
    private function __construct( CAC_Client_Request $httpObj, CAC_App_Map $map  ) {
        $this->_http    = $httpObj;
        $this->_map     = $map;
        $this->_params  = static::getParamKeys( $this->_http );
    }
    
    
    /**
     * 
     * @param CAC_Client_Request $httpObj
     * @return CAC_Command
     */
    public static function getCommand( CAC_Client_Request $httpObj, CAC_App_Map $map ){
        
        $mapper     = new CAC_Command_Mapper( $httpObj, $map );
        $cmdString  = $mapper->generateCommand();
        return new $cmdString();
    }
    
    /**
     * @param CAC_Client_Request $httpObj 
     * @return Array of Param keys in all lower case
     */
    protected static function getParamKeys( CAC_Client_Request $httpObj ){
        $pvalues = $httpObj->getUrlParams();
        $output = array();
        foreach( $pvalues as $key=>$val ){
            if( strpos( $key, 'p') !== 0 ){ continue; }
            // Begins with 'p'
            if( strlen($key) === 1 ){
                $output[] = strtolower( $val );
                continue;
            }
            if( !is_numeric($key[1]) ){ continue; }
            // Second index is number
            $output[] = strtolower( $val );
            
        }
        return $output;
    }
	
    /**
     * 
     * @see Kore_Command_Mapper::getParamKeys()
     * @return {String} Of Command
     */
    protected function generateCommand(){
        
        $cmdString  = $this->_map->getDefaultCommand();
        $methods    = $this->_map->getMethods();
        
        $params     = $this->_params;
        $maxParam = sizeof($params);
        
        // This loop is not entered when there are no params passed
        foreach( $params as $key => $p ){
            
            if( $key > static::$maxNestLevel ){ throw new CAC_ROUTE_FAILURE('Too Many Param Nestings'); }
            
            // Does this param exist at this level?
            $search = array_key_exists( $p, $methods );
            
            if( $search ){
                // Exists
                $methods = $methods[$p];
                
                
                if( $key+1 == $maxParam ){
                    // Reached bottom of param stack, check if this level has something of note
                    
                    // See if a cmd exists at this level with a 0 indexed array key
                    if( isset($methods[0]) ){
                        if( is_array($methods) ){
                            $cmdString = $methods[0];
                        } else {
                            $cmdString = $methods;
                        }
                        break;
                    } else {
                        throw new CAC_ROUTE_FAILURE('Reached Search End, No Command at this Level');
                    }

                } else {
                    // Not at bottom yet
                    
                    // Not at bottom of param stack, continue recursion
                    if( is_array($methods) ){
                        continue;
                    }

                    // Not really sure this ever gets called
                    if( isset($methods[0]) ){
                        $cmdString = $methods[0];
                        break;
                    } else {
                        throw new CAC_ROUTE_FAILURE('No Default Command At this Level');
                    }
                
                    
                    
                }
                
                
                
                
            } else {
                // Does not exist
                throw new CAC_ROUTE_FAILURE('Method Path Not Found');
            }
            
        }
        
        
        if( !class_exists($cmdString) ){ 
            throw new CAC_ROUTE_FAILURE('Command class does not exist: ' . $cmdString ); 
        }
        
        return $cmdString;
    }
    
    
    protected static function recurse( $param, array $nestedMap ){
        
        $search = array_key_exists( $param, $nestedMap );
        if( $search ){
             return $search;
        }
        
        return false;

    }

    




    protected static function isApiCommand( array $param ){
		if( isset( $param[0] ) && $param[0] === 'api' ){
			return true;
		} else {
			return false;
		}
	}
    
	protected static function mapApiCommandParam( array $params ){
		
        $cmds = array();
        if( sizeof( $params ) > 2 ){
            $cmds = static::commandExists( $params[1], $params[2], true );
        } else if( sizeof( $params ) > 1 ){
            $cmds = static::commandExists( $params[1], null,	   true );
        }
        
        return $cmds;
	}
	
    /**
     * @note Should be all lower case input params
     * 
     * @param array $params
     * @return Array Of Valid Commands
     * @return false if no valid commands were found
     */
    protected static function mapCommandParam( array $params ){
        
        $cmdParams = array();
        
        if( sizeof( $params ) == 1 ){
            $cmds = static::commandExists( $params[0] );
        } else {
            $cmds = static::commandExists( $params[0], $params[1] );
        }
        
        return $cmds;
    }
    
    
    protected static function commandExists( $cmd, $subCmd = NULL, $isApi = false ){
        
		if( $isApi ){
            $cmdSearch = static::$APImethods;
			$topCmds = array_keys( static::$APImethods );
		} else {
            $cmdSearch = static::$methods;
			$topCmds = array_keys( static::$methods );
		}
        
        $validCmds = array();
        // Validate Top Level Command Exists
        if( array_search( $cmd , $topCmds ) !== false ){
            $validCmds[] = $cmd;
        } else {
            return false;
        }
        
        // If choosen, validate next level
        if( ! is_null( $subCmd ) ){
            if(array_search( $subCmd, $cmdSearch[ $cmd ] ) !== false ){
                $validCmds[] = $subCmd;
            }
        }
        
        return $validCmds;
    }
    
    /**
     * 
     * @param array $validCmdArray Array of Strings of valid commands (command + sub-command)
     * @return {String} Of Valid Class command path
     */
    protected static function genCommandString( array $validCmdArray, $isApi = false ){
        
		if( $isApi ){
			$output = 'Cmd_Root_Api_';
		} else {
			$output = 'Cmd_Root_';
		}
		
        foreach( $validCmdArray as $cmd ){
            $output .= ucfirst( strtolower( $cmd ) ) . '_';
        }
        
        // Prune trailing _ character
        $len = strlen( $output );
        $output = substr( $output, 0, $len -1 );
        
        return $output;
    }
    
    
    
    
	
}

?>