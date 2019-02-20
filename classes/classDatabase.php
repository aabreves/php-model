<?php
/*
 * project: projectMVC
 * Copyright (C) 2017 Alessandro Amaral Breves (aa.breves@outlook.com)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Copyright (C) 2017 Alessandro Amaral Breves (aa.breves@outlook.com)
 */
/**
 * /var/www/html/maktub/classes/classDatabase.php
 */
require_once "classes/classObjectModel.php";

/**
 * <h4>Definition of class Database</h4>
 * 
 * <p></p>
 *
 * @author aabreves
 */
class Database extends ObjectModel{
   
//   private $sDrvr = "";
//   private $sHost = "";
//   private $sUser = "";
//   private $sPass = "";
//   private $sDbNm = "";
//   
//   private $bConn = false;
//   
//   private $dbConn = null;
//   private $rsData = null;
   
   /**
    * 
    * retrieves all available database drivers
    * 
    * @return array
    */
   static public function _getDrivers(){
      return PDO::getAvailableDrivers();
   } // static public function _getDrivers()

   /**
    * 
    * creates a Database object and a connection with the server
    * 
    * @param string $sDriver
    * @param array  $asConnInfo - assoc array ([ "host"], [ "user"], [ "pass"])
    */
   function __construct( array $asConnInfo = [] ){
      parent::__construct();
      
      $this->defineProperties( [ "sDrvr"  => "",
                                 "sHost"  => "localhost",
                                 "sUser"  => "root",
                                 "sPass"  => "",
                                 "sDbNm"  => "",
                                 "bConn"  => "",
                                 "dbConn" => "",
                                 "rsData" => "" ] );
      
      $this->sDrvr = isset( $asConnInfo[ "drvr"] ) ? $asConnInfo[ "drvr"] : "mysql";
      $this->sHost = isset( $asConnInfo[ "host"] ) ? $asConnInfo[ "host"] : "";
      $this->sUser = isset( $asConnInfo[ "user"] ) ? $asConnInfo[ "user"] : "";
      $this->sPass = isset( $asConnInfo[ "pass"] ) ? $asConnInfo[ "pass"] : "";
      $this->sDbNm = isset( $asConnInfo[ "dbnm"] ) ? $asConnInfo[ "dbnm"] : "";
      
      $this->connect();
   } // function __construct()
   
   /**
    * tries to stablish a connection with de db server
    * 
    */
   private function connect(){
      try{         
         $sHost = ( $this->sHost ) ? "host=$this->sHost"   : "";
         $sDbNm = ( $this->sDbNm ) ? "dbname=$this->sDbNm" : "";
         
         $DSN = "";
         switch ( $this->sDrvr ){            
            case "pgsql":
               $DSN = "pgsql:";
               break;
            
            case "mysql":
            default:
               $DSN = "mysql:";
               break;
         } // switch ( $this->sDrvr )
         
         if ( $sHost !== "" ){
            $DSN .= $sHost;
            
            $DSN .= ( $sDbNm !== "" ) ? ";$sDbNm" : "";

            if ( $this->sPass !== "" ){
               $this->dbConn = new PDO( $DSN, $this->sUser, $this->sPass );
            } // if ( $this->sPass !== "" ){
            else{
               $this->dbConn = new PDO( $DSN, $this->sUser );
            } // if ( $this->sPass !== "" ){ .. else

            $this->dbConn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            $this->bConn = true;
         } // if ( $sHost !== "" ){
      }
      catch ( PDOException $ex ){
         $this->addErrorIncident( $ex->getCode(), $ex->getMessage() );
         $this->bConn = false;
      }
      
      return $this->bConn;
   } // private function connect()
   
   /**
    * 
    * @return type
    */
   public function isConnected(){
      return $this->bConn;
   } // public function isConnected()
   
   /**
    * 
    * @param string $sTable
    * @param array  $asFieldValuePairs
    * @return boolean
    */
   public function insert( $sTable, array $asFieldValuePairs ){
      $iReturn = 0;
      
      try{
         $sFields = "";
         $sValues = "";
         $asValues = [];
         foreach ( $asFieldValuePairs as $sField => $sValue ){
            $sFields .= " $sField,";
            $sValues .= " ?,";

            $asValues[] = $sValue;
         } // foreach ( $asFieldValuePairs as $sField => $sValue )

         $sFields = substr( $sFields, 0, -1 );
         $sValues = substr( $sValues, 0, -1 );

         $sSQL = "INSERT INTO $sTable ($sFields) VALUES ($sValues)";
         $this->rsData = $this->dbConn->prepare( $sSQL );
         
         if ( $this->rsData->execute( $asValues ) ){         
            $iReturn = $this->dbConn->lastInsertId();
         } // if ( $this->rsData->execute( $asValues ) ){
      }
      catch ( PDOException $ex ){
         $this->addErrorIncident( $ex->getCode(), $ex->getMessage() );
      }
      
      return $iReturn;
   } // public function insert( $sTable, array $asFields, array $asValues )
   
   /**
    * 
    * @param string $sTable
    * @param array  $asFieldValuePairs
    * @return boolean
    */
   public function update( $sTable, array $asFieldValuePairs, $asWhere_and ){
      $iReturn = 0;
      
      try{
         $sFields = "";
         $asValues = [];
         foreach ( $asFieldValuePairs as $sField => $sValue ){
            $sFields .= " $sField = :bp_$sField,";
            $asValues[":bp_$sField"] = $sValue;
         } // foreach ( $asFieldValuePairs as $sField => $sValue )
         
         $sWhere = "";
         foreach ( $asWhere_and as $sField => $sValue ){
            if ( $sWhere === ""){
               $sWhere = "WHERE ";
            } // if ( $sWhere === ""){
            else{
               $sWhere .= " AND ";
            }
            $sWhere .= "$sField='$sValue'";
         } // foreach ( $asWhere_and as $sField => $sValue ){

         $sFields = substr( $sFields, 0, -1 ); // remove last comma
         //$sValues = substr( $sValues, 0, -1 );

         $sSQL = "UPDATE $sTable SET $sFields $sWhere";
         $rsData = $this->dbConn->prepare( $sSQL );
//         foreach ( $asFieldValuePairs as $sField => $sValue ){
//            $rsData->bindParam( ":bp_$sField", $sValue );
//         } // foreach ( $asFieldValuePairs as $sField => $sValue )
         
         // $sql->execute(array(':dbname' => $dbname));
         
         if ( $rsData->execute( $asValues ) ){         
            //$iReturn = $this->dbConn->lastInsertId();
         } // if ( $this->rsData->execute( $asValues ) ){
      }
      catch ( PDOException $ex ){
         $this->addErrorIncident( $ex->getCode(), $ex->getMessage() );
      }
/*      
      
UPDATE `tbl_sys_nodes` SET `nod_fk_usr_i4_uid` = '0', `nod_i4_parent_node_uid` = '0', `nod_s32_name` = 'Teste', `nod_s256_description` = 'Teste teste', `nod_s256_url` = '', `nod_s32_icon1` = 'fa fa-folder', `nod_s32_icon2` = 'fa fa-folder-open', `nod_s256_state1_style` = 'color:red;', `nod_s256_state2_style` = 'color:red;', `nod_s256_icon1_style` = 'color:red;', `nod_s256_icon2_style` = 'color:red;' WHERE `tbl_sys_nodes`.`nod_i4_uid` = 1;
      
*/      
      return $iReturn;
   } // public function update( $sTable, array $asFields, array $asValues )
   
   /**
    * 
    * @param type $sSQL
    */
   public function select( $sSQL ){
      $bReturn = FALSE;
      
      try{
         $this->rsData = $this->dbConn->query( $sSQL );
         $this->rsData->setFetchMode( PDO::FETCH_ASSOC );
         $bReturn = true;
      }
      catch ( PDOException $ex ){
         $this->addErrorIncident( $ex->getCode(), $ex->getMessage() );
      }
      
      return $bReturn;
   } // public function select( $sSQL )

   /**
    * 
    * @return type
    */
   public function getRecord(){
      try{
         return $this->rsData->fetch();
      }
      catch ( Exception $ex ){
         $this->addErrorIncident( $ex->getCode(), $ex->getMessage() );
      }
      return false;
   } // public function getRecord()

   /**
    * 
    * @return type
    */
   public function getDataset(){
      try{
         return $this->rsData->fetchAll();
      }
      catch ( Exception $ex ){
         $this->addErrorIncident( $ex->getCode(), $ex->getMessage() );
      }
      return false;
   } // public function getDataset()
   
   /**
    * 
    * @return type
    */
   public function errorInfo(){
      $asErrorInfo = ""; //print_r( $this->dbConn->errorInfo(), true );
      return $asErrorInfo;
   } // public function errorInfo(){

   /**
    * 
    * @param type $sDbNm
    */
   public function getDatabases(){
      try{
         
         if ( !$this->dbConn ){
            $this->connect();
         } // if ( !$this->dbConn )
         
         switch ( $this->sDrvr ){
            case "mysql":
               $sSQL = "SHOW DATABASES;";
               break;
            
            case "pgsql":
               $sSQL = "SELECT datname FROM pg_database WHERE datistemplate = false;";
               break;
            
            default:
               break;
         } // switch ( $this->sDrvr )
         
         $pdoResult = $this->dbConn->query( $sSQL, PDO::FETCH_ASSOC );
         
         if ( $pdoResult ){
            return $pdoResult->fetchAll();
         }
         
         return false;
         
      }
      catch ( PDOException $ex ){
         $this->addErrorIncident( $ex->getCode(), $ex->getMessage() );
      }
   } // public function getDatabases(){
   
   /**
    * 
    * @param type $sqlFile
    */
   public function createDatabaseFromScript( $sqlFile, $sDbName ){
      try{
         
         if ( !$this->dbConn ){
            $this->connect();
         } // if ( !$this->dbConn )
         
         $sqlFullPathFile = "";
         
         $this->sDbNm = $sDbName;
         switch ( $this->sDrvr ){
            case "mysql":
               $sqlFullPathFile = "sql/mysql/mys_$sqlFile";
               break;
            
            case "pgsql":
               $sqlFullPathFile = "sql/postgres/pgs_$sqlFile";
               break;
            
            default:
               break;
         } // switch ( $this->sDrvr )
      
         if ( file_exists( $sqlFullPathFile ) ){
            $sql = file_get_contents( $sqlFullPathFile );

            $sql = str_replace( "DATABASE_NAME", $sDbName, $sql );

            Debug::_varDump_toFile( $sql, "sql_script.log" );
            
            $result = $this->dbConn->exec( $sql );
            
            return true;
         } // if ( file_exists( $sqlFullPathFile ) ){
         
      }
      catch ( PDOException $ex ){
         $this->addErrorIncident( $ex->getCode(), $ex->getMessage() );
      }
      
      return false;
      
   } // public function createDatabaseFromScript( $sqlFile 
   
   /**
    * 
    * @param type $sDbName
    * @return type
    */
   public function createDatabase( $sDbName ){
      $bReturn = true;
      
      switch ( $this->sDrvr ){
         case "mysql":
            $sSQL = "CREATE DATABASE $sDbName DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;";
            break;

         case "pgsql":
            $sSQL = "CREATE DATABASE $sDbName WITH OWNER = postgres 
ENCODING = 'UTF8' TABLESPACE = pg_default LC_COLLATE = 'pt_BR.UTF-8' 
LC_CTYPE = 'pt_BR.UTF-8' CONNECTION LIMIT = -1;";
            break;

         default:
            break;
      } // switch ( $this->sDrvr )
      
      try{
         $this->sDbNm = $sDbName;
         $pdoStatement = $this->dbConn->prepare( $sSQL );
         $bReturn = $pdoStatement->execute();
         
      }
      catch ( PDOException $ex ){
         $this->addErrorIncident( $ex->getCode(), $ex->getMessage() );
         $bReturn = false;
      }
      return $bReturn;
      
   } // public function createDatabase( $sDbName )

//         switch ( $this->sDrvr ){
//            case "mysql":
//               break;
//            
//            case "pgsql":
//               break;
//            
//            default:
//               break;
//         } // switch ( $this->sDrvr )
   
} // class Database
