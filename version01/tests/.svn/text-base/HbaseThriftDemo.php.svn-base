<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<?php

$GLOBALS['THRIFT_ROOT'] = '/var/www/html/kore/trunk/server/backend/library/thrift';

require_once( $GLOBALS['THRIFT_ROOT'].'/Thrift.php' );

require_once( $GLOBALS['THRIFT_ROOT'].'/transport/TSocket.php' );
require_once( $GLOBALS['THRIFT_ROOT'].'/transport/TBufferedTransport.php' );
require_once( $GLOBALS['THRIFT_ROOT'].'/protocol/TBinaryProtocol.php' );

# According to the thrift documentation, compiled PHP thrift libraries should
# reside under the THRIFT_ROOT/packages directory.  If these compiled libraries 
# are not present in this directory, move them there from gen-php/.  
require_once( $GLOBALS['THRIFT_ROOT'].'/packages/Hbase/Hbase.php' );

function printRow( $rowresult ) {
  echo( "row: {$rowresult->row}, cols: \n" );
  $values = $rowresult->columns;
  asort( $values );
  foreach ( $values as $k=>$v ) {
    echo( "  {$k} => {$v->value}\n" );
  }
}

$socket = new TSocket( '10.10.0.14', 9090 );
$socket->setSendTimeout( 10000 ); // Ten seconds (too long for production, but this is just a demo ;)
$socket->setRecvTimeout( 20000 ); // Twenty seconds
$transport = new TBufferedTransport( $socket );
$protocol = new TBinaryProtocol( $transport );
$client = new HbaseClient( $protocol );

$transport->open();

$t = 'testtable';

var_dump( $client->getTableNames() );
echo "\n<br />";
var_dump( $client->isTableEnabled( 'testtable' ) );
echo "\n<br />";
$scanner = $client->scannerOpen( $t, "", array( "colfam1" ) );
var_dump( $client->scannerGet( $scanner ) );
var_dump( $client->scannerGet( $scanner ) );
echo "\n<br />";
var_dump( $client->scannerGetList( $scanner, 3 ) );
echo "\n<br />";
$mutations = array(
    new Mutation( array(
      'column' => 'colfam1:unused',
      'value' => "DELETE_ME"
    ) ),
  );
var_dump( $client->mutateRow( $t, 'row-aa', $mutations ) );
echo "\n<br />";
var_dump( $client->getRow( $t, 'row-aa' ) );
echo "\n<br />";
var_dump( $client->atomicIncrement( 'temp_table', '201101', 'incr:value', 1 ) );
$v = ( $client->getRow( 'temp_table', '201101' ) );
echo "\n<br />";echo "\n<br />";
var_dump( $v[0]->columns );
//var_dump( $v[0]->read('row-1') );
//echo $v[0]['columns']['incr:value']['value'];
var_dump( $client->getRow( 'temp_table', '201101' ) );
echo "\n<br />";
$c = ( $client->getRow( 'temp_table', '201101' ) );
$d = ( $c[0]->columns );
$e = $d['incr:value']->value;
echo btyeArrayToInt( $e );
echo "\n<br />";

$mutations = array(
    new Mutation( array(
      'column' => 'incr:delete',
      'value' => "DELETE_ME"
    ) ),
  );
var_dump( $client->mutateRow( 'temp_table', 'row-delete', $mutations ) );



$mutations = array(
    new Mutation( array(
      'column' => 'incr:delete',
//      'value' => "DELETE_ME"
		'isDelete' => 'true'
    ) ),
  );
var_dump( $client->mutateRow( 'temp_table', 'row-delete', $mutations ) );

$mutations = array(
    new Mutation( array(
      'column' => 'incr:ver',
      'value' => rand(0,1000)
    ) ),
  );
var_dump( $client->mutateRow( 'temp_table', 'row-ver', $mutations ) );
$mutations = array(
    new Mutation( array(
      'column' => 'incr:ver',
      'value' => rand(0,1000)
    ) ),
  );
var_dump( $client->mutateRow( 'temp_table', 'row-ver', $mutations ) );
var_dump( $client->getVer( 'temp_table', 'row-ver', 'incr:ver', 2 ) );

echo "\n<br />";

$scanner = $client->scannerOpenWithStop( 'temp_table', "row", "row-ver", array( "incr" ) );
var_dump( $client->scannerGetList( $scanner, 15 ) );

/*
$content = file_get_contents('http://www.google.com');

$mutations = array(
    new Mutation( array(
      'column' => 'incr:raw',
      'value' => $content
    ) ),
  );
( $client->mutateRow( 'temp_table', 'row-google', $mutations ) );

$return = $client->getRow('temp_table', 'row-google' );
echo "\n<br />";echo "\n<br />";
$v = $return[0]->columns;
echo ( $v['incr:raw']->value );
*/

echo "\n<br />";
echo "\n<br />";
echo "Finito";

function btyeArrayToInt( $byteArray ){
	$temp = unpack( 'N*', $byteArray );
	return $temp[2];
}


?>