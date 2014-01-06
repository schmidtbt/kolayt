<?php

/**
 * @author Revan
 */
class RabbitNetworkConfig {
    
    
    //////////////////////////////////////
    //
    //  Bind exchanges and Queues
    //
    //////////////////////////////////////
    /**
     * 
     * 
     * Nesting Levels
     * <ul>
     *  <li> Exchange </li>
     *  <ul>
     *      <li> type: String, Type of exchange, use Exchange::CONST </li>
     *      <li> properties: Array, <li>
     *              <ul>
     *                  <li> autodelete: boolean </li>
     *                  <li> durable: boolean </li>
     *              </ul>
     *      <li> queues: Array, list of queues to bind this exchange. Entries may be arrays or strings </li>
     *              <ul>
     *                  <li> String: name of queue </li>
     *                  <li> Array, key: name of queue, value is single or array or routing keys</li>
     *              </ul>
     *  
     *  </ul>
     * </ul>
     * 
     * 
     */
    public static $network = array(
        'xChng' => array(   'type' => 'direct',
                            'properties' => array(
                                                'autodelete' => false,
                                                'durable'    => false
                                            ),
                            'queues' => array(  
                                                array( 'test' => '' ),
                                                array( 'test2' => array( 'banana', 'kore' ) ),
                                                array( 'test4' => 'kore' )
                                              )
                        ),
        'xChng2' => array(  'type' => 'fanout', 
                            'queues' => array(  'test1',
                                                'test3',
                                                'test5')
                        ),
        'koreLog' => array( 'type' => 'topic',
                            'properties' => array(
                                                'autodelete' => false,
                                                'durable'    => true
                                            ),
                            'queues' => array(  
                                                array( 'log' => '*' ),
                                                array( 'critical' => '*.critical' ),
                                                array( 'alert' => 'alert.*' )
                                              )
                        ),
        'processors' => array( 'type' => 'direct',
                            'properties' => array(
                                                'autodelete' => false,
                                                'durable'    => false
                                            ),
                            'queues' => array(  
                                                'processors'
                                              ),
                        )
    );
    
    
}

?>
