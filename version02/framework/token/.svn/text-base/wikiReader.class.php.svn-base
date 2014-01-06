<?php

/**
 * @author Revan
 */
class wikiReader {
    
    public function __construct( $path ){
        
        $handle = @fopen($path, "r");
        if ($handle) {
            $count = 0;
            while (($buffer = fgets($handle, 4096)) !== false && $count < 100 ) {
                
                $buffer = str_replace('!','', $buffer);
                
                $count++;
                echo $buffer;
            }
            if (!feof($handle)) {
                echo "Error: unexpected fgets() fail\n";
            }
            fclose($handle);
}
        
        
    }
    
    
}

?>
