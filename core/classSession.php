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
 * /var/www/html/maktub/core/classSession.php
 */
(defined( "INDEX" ) || defined( "LOADER" )) && defined( "INIT" ) ||
exit( "ERROR: forbidden direct access.".( ( isset($_env[ "debug_mode"] ) && $_env[ "debug_mode"] ) ? ": ".__FILE__ : "!" ) );

/**
 * <p>Definition of class Session:</p>
 * <p>Available keys:</p>
 * <ul>
 * <li>"logged"</li>
 * <li>"usr_uid"</li>
 * <li>"usr_group_uid"</li>
 * <li>"usr_group"</li>
 * <li>"usr_name"</li>
 * <li>"usr_email"</li>
 * <li>"usr_social"</li>
 * <li>"usr_mobile"</li>
 * <li></li>
 * <li>"cia_code"</li>
 * <li>"lang"</li>
 * <li>"ajax"</li>
 * <li>"reload</li>
 * <li></li>
 * <li>ACCP_DB_CONN_DATA</li>
 * <li>MAIN_DB_CONN_DATA</li>
 * </ul>
 *
 * @author aabreves
 */
class Session{

   /**
    *
    * Start session.
    *
    */
   public static function _startSession(){
      session_start();
      if ( !isset( $_SESSION[ "session_started"] ) ){
         $_SESSION[ "session_started"] = "1";
      } // if ( !isset( $_SESSION[ "session_started"] ) ){
   } // public static function _startSession(){

   /**
    * Destroy session.
    */
   public static function _resetSession(){
      foreach ( $_SESSION as $sDataKey => $vValue ){
         $_SESSION[$sDataKey] = null;
         unset( $_SESSION[$sDataKey] );
      }
      session_destroy();
   } // public function _resetSession()

   /**
    *
    * @param array $aaData
    */
   public static function _setData( array $aaData ){
      if ( self::_isset( "session_started" ) ){
         foreach ( $aaData as $key => $value ){
            self::_set( $key, $value );
         } // foreach ( $_env as $key => $value )
         return true;
      } // if ( self::_isset( "session_started" ) ){
      return false;
   } // public static function _setData( array $aaData ){

   /**
    *
    * Creates a session variable or set a new value to an existing one.
    *
    * @param string  $sDataKey
    * @param variant $varValue
    */
   public static function _set( $sDataKey, $varValue ){
      if ( self::_isset( "session_started" ) ){
         $_SESSION[$sDataKey] = $varValue;
         return true;
      } // if ( self::_isset( "session_started" ) ){
      return false;
   } // public static function _set( $sDataKey, $varValue ){

   /**
    *
    * Check if a session variable was defined.
    *
    * @param  type $sDataKey
    * @return type
    */
   public static function _isset( $sDataKey ){
      return ( isset( $_SESSION[$sDataKey] ) ) ? true : false;
   } // public static function _isset( $sDataKey )

   /**
    *
    * Unset a session variable.
    *
    * @param string $sDataKey
    */
   public static function _unset( $sDataKey ){
      unset( $_SESSION[$sDataKey] );
   } // public static function _unset( $sDataKey ){

   /**
    *
    * Get a session variable.
    *
    * @param  string $sName
    * @return variant
    */
   public static function _get( $sDataKey ){
      return ( isset( $_SESSION[$sDataKey] ) ) ? $_SESSION[$sDataKey] : null;
   } // public static function _get( $sDataKey ){

} // class Session