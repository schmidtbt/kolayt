<?php

/**
 * @author Revan
 */
class GraphConsistency {
    
    public static function LOWERSTRING( &$input ){
        if( static::STRING($input) ){
            $input = strtolower($input);
            return true;
        }
        return false;
    }
    public static function ALPHANOSPACE( &$input ){
        if( is_int( $input ) ){ return false; }
        if( ctype_alpha( $input ) ){
            return true;
        }
        return false;
    }
    public static function PROPERNAME( &$input ){
        return static::ALPHANOSPACE($input);
    }
    public static function ROWSAFE( &$input ){
        if( static::LOWERSTRING($input) ){
            $input = str_replace( ' ', '-', $input );
        } else {
            return false;
        }
    }
    public static function STRING( &$input ){
        return is_string( $input ) ? true : false;
    }
    public static function ALPHANUM( &$input ){
        return ctype_alnum( $input ) ? true : false;
    }
    
    
    /// URLNode
    static function cleanURLKey( $urlKey ){
        return $urlKey;
    }
    static function cleanURL( $url ){
        return $url;
    }
    static function cleanURLDescription( $description ){
        return $description;
    }
    static function cleanHTMLForStorage($html){
        return $html;
    }
    static function cleanShortIdx( $shortidx ){
        return $shortidx;
    }
    
    
    /// UserNode
    static function cleanUserDisplayHandle( $input ){
        if( is_string( $input ) &&
            ctype_alnum( $input ) ){
            return $input;
        }
        throw new GRAPH_COMPLIANCE_EXCEPTION('Invalid Display Handle');
    }
    static function cleanUserKeyHandle( $input ){
        if( static::cleanUserDisplayHandle($input) &&
            static::LOWERSTRING($input) ){
            return $input;
        }
        throw new GRAPH_COMPLIANCE_EXCEPTION('Invalid Key Handle');
    }
    static function cleanUserBio( $bio ){
        if( is_string( $bio ) ){
            return htmlentities($bio);
        }
        throw new GRAPH_COMPLIANCE_EXCEPTION('Invalid Bio');
    }
    static function cleanUserName( $name ){
        if( static::PROPERNAME( $name ) ){
            return $name;
        }
        throw new GRAPH_COMPLIANCE_EXCEPTION('Invalid Name');
    }
    static function cleanUserEmailAddr( $email ){
        return $email;
    }
    static function cleanUserToken( $token ){
        return $token;
    }
}

?>
