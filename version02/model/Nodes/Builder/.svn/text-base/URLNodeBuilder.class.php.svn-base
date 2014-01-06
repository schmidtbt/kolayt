<?php

/**
 * @author Revan
 */
class URLNodeBuilder extends URLNode {
    
    public static function create(  $urlString,
                                    $domain,
                                    $origSource, 
                                    $ogtitle,
                                    $retitle,
                                    $ogdescription ='', 
                                    $readabilitydescription='',
                                    $shortdescription = '',
                                    $fullHTML =''){
        
        try {
            
            // Check for valid values
            $urlString              = GraphConsistency::cleanURL($urlString);
            $origSource             = GraphConsistency::cleanURL($origSource);
            $domain                 = GraphConsistency::cleanURL($domain);
            $ogdescription          = GraphConsistency::cleanURLDescription( $ogdescription );
            $readabilitydescription = GraphConsistency::cleanURLDescription( $readabilitydescription );
            $fullHTML               = GraphConsistency::cleanHTMLForStorage( $fullHTML );
            
            // Generate an appropriate key
            $key = new GraphKeySHA256( $urlString );
            
            // Try to obtain a unique updater (no overwriting)
            $updater = static::gStorage(get_parent_class())->create()->createRow($key);
            
            
            $autoIdx = new AutoIndexNode( new GraphKeyAutoindex(AutoIndexNode::TypeURL) );
            $nextIdx = $autoIdx->getNextBase26Index();
            
            // Add fields into the new record
            $updater->add( Node::NODE, 'url', $urlString );
            $updater->add( Node::NODE, 'orig', $origSource );
            $updater->add( Node::NODE, 'domain', $domain );
            $updater->add( Node::NODE, 'shortidx', $nextIdx );
            $updater->add( Node::NODE, 'ogtitle', $ogtitle );
            $updater->add( Node::NODE, 'retitle', $retitle );
            $updater->add( Node::NODE, 'ogdescribe', $ogdescription );
            $updater->add( Node::NODE, 'short', $shortdescription );
            
            $updater->add( URLNode::HTML, 'readparsed', $readabilitydescription );
            $updater->add( URLNode::HTML, 'full', $fullHTML );
            
            // Perform insertion
            $updater->update($key);
            
            // Now re-fetch the created object and return it
            return new URLNode( $key );
            
        } catch( GRAPH_COMPLIANCE_EXCEPTION $e ){
            throw $e;
        } catch( RECORD_EXISTS $e ){
            throw new GRAPH_STORAGE_EXCEPTION('Cannot Overwrite '.get_parent_class().' Record',0,$e);
        } catch( KoreException $e ){
            throw new GRAPH_STORAGE_EXCEPTION('Create Failure '.$e->getMessage(),0,$e);
        }
    }
    
}

?>
