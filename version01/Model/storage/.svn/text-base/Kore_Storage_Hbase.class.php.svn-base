<?php

/**
 * @ingroup Model
 */
class Kore_Storage_Hbase extends Kore_Storage {
	
	protected $socket;
	protected $transport;
	protected $protocol;
	protected $client;
	protected $table;
	
	public function __construct(){
		$this->init();
		$this->connect();
	}
	
	/**
	 * @brief Key-based lookup in Hbase
	 * 
	 * @return Empty Array if key does not exist
	 * @return Array with a single TRowResult Object
	 * 
	 * @note The TRowResult has two public properties, $row and $columns
	 * 
	 */
	public function fetchRecordValueOnKey( $key ){
		return $this->client->getRow( $this->table, $key );
	}
	
	/**
	 * @return Value on true
	 * @see Kore_Storage_Hbase::fetchRecordValueOnKey()
	 * @return False if key does not exist
	 */
	public function checkKeyValueExists( $key ){
		$value = $this->fetchRecordValueOnKey($key);
		if( isset( $value[0] ) ){
			return $value[0];
		} else {
			return false;
		}
	}
	
	/**
	 * @return Array of table names
	 */
	public function getTableNames(){
		return $this->client->getTableNames();
	}
	
	/**
	 * @brief << unused >>
	 */
	public function insertRecordKeyValuePair( $key, $value ){
		throw new Kore_Storage_Hbase_Exception("Kore_Storage_Hbase::insertRecordKeyValuePair is not defined. See API for details on inserting records");
	}
	
	// OVERRIDE and make protected later
	public function setTable( $table ){
		$this->table = $table;
		return $this;
	}
	
	/**
	 * @brief Set a value at a Row, Colfamily, Column coordinates
	 */
	public function insertColumnRecord( $row, $colfamily, $col, $value ){
		$mutations = array(
		    new Mutation( array(
		      'column' => $colfamily . ':' . $col,
		      'value' => $value
		    ) ),
		);
		return $this->client->mutateRow( $this->table, $row, $mutations );
	}
	
	/**
	 * @param $changeRows is an array with each entry containing a 'colfamily', 'col', and 'value'
	 */
	public function insertMultiColumns( $row, $changeRows ){
		
		$mutations = array();
		
		foreach( $changeRows as $mutrow ){
			$mut = new Mutation( array(
		      'column' => $mutrow['colfamily'] . ':' . $mutrow['col'],
		      'value' => $mutrow['value']
		    ) );
			$mutations[] = $mut;
		}
		
		return $this->client->mutateRow( $this->table, $row, $mutations );
	}
	
	/**
	 * @brief Put a delete marker at the Row, Colfamily, Column coordiantes
	 */
	public function removeColumnRecord( $row, $colfamily, $col ){
		$mutations = array(
		    new Mutation( array(
		      'column' => $colfamily . ':' . $col,
			  'isDelete' => 'true'
		    ) ),
		);
		return $this->client->mutateRow( $this->table, $row, $mutations );
	}
	
	/**
	 * @brief Increment a column
	 * 
	 * @warning This requires that a specific Increment column be designated. Do not set a value
	 * explicitly at these coordiantes. Use only increment. Values are stored as byte arrays which
	 * do not behave well when set to values other than by increment operator.
	 */
	public function incrementColumn( $row, $colfamily, $col, $amt = 1 ){
		return $this->client->atomicIncrement ($this->table, $row, $colfamily . ':' . $col, $amt);
	}
	
	/**
	 * @name Hbase Connection
	 */
	//@{
	public function init(){
		$this->socket = new TSocket( '10.10.0.14', 9090 );
		$this->socket->setSendTimeout( 10000 ); // Ten seconds (too long for production, but this is just a demo ;)
		$this->socket->setRecvTimeout( 20000 ); // Twenty seconds
		$this->transport = new TBufferedTransport( $this->socket );
		$this->protocol = new TBinaryProtocol( $this->transport );
		$this->client = new HbaseClient( $this->protocol );
	}
	
	/**
	 * @TODO use as a on-demand connection (remove from Kore_Storage_Hbase::__construct() )
	 */
	public function connect(){
		$this->transport->open();
	}
	//@}
	
	
	
	/**
	 * @brief Scan from start row for $numRows
	 */
	public function scanRows( $rowStart, array $colFamilyArray, $numRows ){
		$scanner = $this->client->scannerOpen( $this->table, $rowStart, $colFamilyArray );
		$this->client->scannerGet( $scanner );
		$values = $this->client->scannerGetList( $scanner, $numRows );
		$this->client->scannerClose( $scanner );
		return $values;
	}
	
	/**
	 * @brief Scan rows using a Prefix
	 * 
	 * @note an Empty array for $colFamilyArray will get all column families
	 */
	public function scanRowsPrefix( $prefix, array $colFamilyArray, $numRows ){
		$scanner = $this->client->scannerOpenWithPrefix( $this->table, $prefix, $colFamilyArray );
		$this->client->scannerGet( $scanner );
		$values = $this->client->scannerGetList( $scanner, $numRows );
		$this->client->scannerClose( $scanner );
		return $values;
	}
	
	
	/**
	 * @brief Given a unix timestamp, invert it so it is decending order
	 * 
	 * @param $time INT A unix time stamp
	 */
	public static function invertTime( $time ){
		$entry = 9999999999;
		return $entry - $time;
	}
	
	
}




?>