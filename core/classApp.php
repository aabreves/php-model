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
 * /var/www/html/maktub/core/classApp.php
 */
(defined( "INDEX" ) || defined( "LOADER" )) && defined( "INIT" ) ||
exit( "ERROR: forbidden direct access.".( ( isset($_env[ "debug_mode"] ) && $_env[ "debug_mode"] ) ? ": ".__FILE__ : "!" ) );

/**
 * <h4>Definition of class App</h4>
 * <p></p>
 *
 * @author aabreves
 */
class App{

   static private $_asData    = [];
   static private $_aoObjects = [];
   static private $_asErrors  = [];

   static private $_sLang  = "pt-br";
   static private $_asLang = [];
   /**
    *
    * Start session.
    *
    */
   public static function _startApp( array $aaArgs ){

      foreach ( $aaArgs as $asArgv ){
         self::_setData( $asArgv );
      } // foreach ( $aaArgs as $asArgv ){

      Session::_startSession();

      Debug::_startDebug( self::_getData( "debug_mode" ) );
      Utils::_startUtils();

      // ********** ********** ********** ********** ********** ********** **********
      if ( !Session::_get( "cia_code" ) ){
         $codCia  = Utils::_filterInput( INPUT_GET, "co", "1" );
         $pathCia = sprintf( "cos/co%03d/", $codCia );

         Session::_setData( [ "cia_code" => $codCia,
                              "cia_path" => $pathCia ] );
      } // if ( !Session::_get( "cia_code" ) ){
      else{
         $codCia  = Session::_get( "cia_code" );
         $pathCia = Session::_get( "cia_path" );
      } // if ( !Session::_get( "cia_code" ) ){ .. else

      // ********** ********** ********** ********** ********** ********** **********
      if ( file_exists( $pathCia."init.php" ) ){
         $_env = [];
         $_dba = [];
         require_once( __DIR__."/../".$pathCia."init.php" ); // => load $_accp_dba_conn
         self::_setData( $_env );
         self::_setData( $_dba );

         unset( $_env );
         unset( $_dba );
      } // if ( file_exists( "config/database/database_info.php" ) ){

      // ********** ********** ********** ********** ********** ********** **********
      $sLang = Utils::_filterInput( INPUT_GET, "lang" );
      if ( $sLang ){
         Session::_setData( [ "lang" => $sLang ] );
      } // if ( $sLang )

      if ( !Session::_get( "lang" ) ){
         // starts default language
         Session::_setData( [ "lang" => "pt-br" ] );
      } // if ( !Session::_getData( "lang" ) ){

      self::$_sLang = Session::_get( "lang" );

      $_asLang = null;
      require_once( __DIR__."/lang/lang.php" );
      self::$_asLang = $_asLang;
      unset( $_asLang );

      // ********** ********** ********** ********** ********** ********** **********
      // LOADS DATABASE CONNECTION DATA
      if ( self::_getData( "dbase_mode" ) === "1" ){
         $_accp_dba_conn = Session::_get( ACCP_DB_CONN_DATA );
         require_once( __DIR__."/../config/database/database.php" );
         
         if ( self::_getData( "db_ready" ) ){
            Session::_setData( [ ACCP_DB_CONN_DATA => $_accp_dba_conn ] );
            
            if ( Session::_get( "logged" ) !== null ){
               $asDbaApArgv = [ "dap_i2_uid"        => Session::_get("cfg_main_dba_ap"),
                                "dap_fk_cia_i2_uid" => Session::_get("cia_code") ];
               $asMainDbaApData = MasterController::_run( [ "m" => "database",
                                                            "a" => "load_maindba_access_point",
                                                            "v" => "maindba_ap_data" ], $asDbaApArgv );
               
               Session::_setData( [ MAIN_DB_CONN_DATA => $asMainDbaApData["maindba_ap_data"] ] );
            }
            
         } // if ( self::_getData( "db_ready" ) ){
         
         unset( $_accp_dba_conn );
      } // if ( file_exists( $pathCia."config/database/database_info.php" ) ){

      // ********** ********** ********** ********** ********** ********** **********
      //Debug::_varDump( self::$_asData, true );

   } // public static function _startApp(){

   /**
    *
    * @param type $vTextId
    */
   public static function _getText( $vTextId ){
      $sText = "";
      
      if ( is_array( $vTextId ) ){
         $i = 0;
         foreach ( $vTextId as $sTextId ){
            if ( $i > 0 ){
               $sText .= " - ";
            } // if ( $i > 0 ){
            
            if ( isset( self::$_asLang[ $sTextId ] ) ){
               $sText .= self::$_asLang[ $sTextId ][ self::$_sLang ];
            } // if ( isset( self::$_asLang[ $sTextId ] ) ){
            else{
               $sText .= $sTextId;
            } // if ( isset( self::$_asLang[ $sTextId ] ) ){ .. else
            $i++;
         } // foreach ( $vTextId as $sTextId ){
      } // if ( is_array( $vTextId ) ){
      else{
         $sTextId = $vTextId;
         if ( isset( self::$_asLang[ $sTextId ] ) ){
            $sText = self::$_asLang[ $sTextId ][ self::$_sLang ];
         } // if ( isset( self::$_asLang[ $sTextId ] ) ){
         else{
            $sText = $sTextId;
         } // if ( isset( self::$_asLang[ $sTextId ] ) ){ .. else
      } // if ( is_array( $vTextId ) ){ .. else
      
      return $sText;
   } // public static function _getText( $sTextId ){

   /**
    *
    * @param type  $sClassName
    * @param array $asArgv
    * @param type  $bForceCreateNew
    *
    * @return type
    */
   public static function _loadObject( $sOID, $sClassName, array $asArgv = null, $bForceCreateNew = false ){

      if ( !$sOID || $sOID === "" ){
         $sOID = $sClassName;
      } // if ( !$sOID || $sOID === null ){
      
      if ( class_exists( $sClassName ) ){
         if ( !isset( self::$_aoObjects[$sOID] ) || $bForceCreateNew ){
            if ( isset( $asArgv ) ){
               self::$_aoObjects[$sOID] = new $sClassName( $asArgv );
            } // if ( isset( $asArgv ) )
            else{
               self::$_aoObjects[$sOID] = new $sClassName();
            } // if ( isset( $asArgv ) ) .. else
         } // if ( !isset( self::$_aoObjects[$sClassName] ) )
         
         return self::$_aoObjects[$sOID];
      } // if ( class_exists( $sClassName ) ){
      else{
         throw new Exception( App::_getText( "invalid_class" )." - $sClassName" );
      } // if ( class_exists( $sClassName ) ){ .. else

      return null;
   } // public function _loadObject( $sClassName, array $asArgv = null )

   /**
    *
    * @param array $asData
    */
   public static function _setData( array $asData ){
      foreach ( $asData as $sKey => $sValue ){
         self::$_asData[$sKey] = $sValue;
      } // foreach ( $asData as $sKey => $sValue )
   } // public static function _setData()

   /**
    *
    * @param type $sKey
    * @return type
    */
   public static function _getData( $sKey ){
      if ( isset( self::$_asData[$sKey] ) ){
         return self::$_asData[$sKey];
      } // if ( isset( self::$_asData[$sKey] ) )
      return null;
   } // public static function _getData( $sKey )

} // class App
