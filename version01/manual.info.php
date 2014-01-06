<?php
/**
 * 
 * @mainpage
 * 
 * @see Data
 * 
 * 
 * - @subpage Flow
 * - @subpage Data
 * - @subpage Model
 * - @subpage CAC
 * - @subpage View
 * 
 * @page Data Data Storage -- Hbase & Hadoop
 * 
 * @section Hbase Hbase Info
 * Uses Hbase thrift. @see HbaseIf
 * 
 * 
 * @page Flow Data Flow
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * @defgroup View View
 * @defgroup Model Model
 * @defgroup ModelIf ModelIf
 * @defgroup CAC CAC
 * 
 * @defgroup Hbase Hbase
 * 
 * 
 */

 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 /**
  * @brief Interface Copied from the HBase Thrift Interface. Used for documentation only.
  * 
  * @ingroup HBase
  */
interface HbaseIf {
  public function enableTable($tableName);
  public function disableTable($tableName);
  public function isTableEnabled($tableName);
  public function compact($tableNameOrRegionName);
  public function majorCompact($tableNameOrRegionName);
  public function getTableNames();
  public function getColumnDescriptors($tableName);
  public function getTableRegions($tableName);
  public function createTable($tableName, $columnFamilies);
  public function deleteTable($tableName);
  public function get($tableName, $row, $column);
  public function getVer($tableName, $row, $column, $numVersions);
  public function getVerTs($tableName, $row, $column, $timestamp, $numVersions);
  public function getRow($tableName, $row);
  public function getRowWithColumns($tableName, $row, $columns);
  public function getRowTs($tableName, $row, $timestamp);
  public function getRowWithColumnsTs($tableName, $row, $columns, $timestamp);
  public function getRows($tableName, $rows);
  public function getRowsWithColumns($tableName, $rows, $columns);
  public function getRowsTs($tableName, $rows, $timestamp);
  public function getRowsWithColumnsTs($tableName, $rows, $columns, $timestamp);
  public function mutateRow($tableName, $row, $mutations);
  public function mutateRowTs($tableName, $row, $mutations, $timestamp);
  public function mutateRows($tableName, $rowBatches);
  public function mutateRowsTs($tableName, $rowBatches, $timestamp);
  public function atomicIncrement($tableName, $row, $column, $value);
  public function deleteAll($tableName, $row, $column);
  public function deleteAllTs($tableName, $row, $column, $timestamp);
  public function deleteAllRow($tableName, $row);
  public function deleteAllRowTs($tableName, $row, $timestamp);
  public function scannerOpen($tableName, $startRow, $columns);
  public function scannerOpenWithStop($tableName, $startRow, $stopRow, $columns);
  public function scannerOpenWithPrefix($tableName, $startAndPrefix, $columns);
  public function scannerOpenTs($tableName, $startRow, $columns, $timestamp);
  public function scannerOpenWithStopTs($tableName, $startRow, $stopRow, $columns, $timestamp);
  public function scannerGet($id);
  public function scannerGetList($id, $nbRows);
  public function scannerClose($id);
}
 
 
 ?>
