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
 * /var/www/html/maktub/core/classDebug.php
 */
(defined( "INDEX" ) || defined( "LOADER" )) && defined( "INIT" ) ||
exit( "ERROR: forbidden direct access.".( ( isset($_env[ "debug_mode"] ) && $_env[ "debug_mode"] ) ? ": ".__FILE__ : "!" ) );

/**
 * <h4>Definition of class Debug</h4>
 * <p></p>
 *
 * @author aabreves
 */
class Debug{

   private static $_iMode;

   /**
    *
    */
   static function _startDebug( $iMode ){
      self::$_iMode = $iMode;
      switch ( $iMode ){
         case '0':
            ini_set( "display_errors", "0" );
            break;

         case '1':
         default:
            ini_set( "display_errors", "1" );
            break;
      } // switch ( $iMode ){

   } // static function startDebug()

   /**
    *
    * @param type $vVar
    * @param type $bDie
    */
   static function _varDump( $vVar, $bDie = false, $sOutput = "" ){
      ob_start();

      echo "<pre>";
      var_dump( $vVar );
      echo "</pre>";
      echo "<br /><hr />";

      $sData = ob_get_contents();

      ob_clean();

      if ( $sOutput !== "" ){
         $sFile = "/var/www/html/maktub/logs/$sOutput";
         file_put_contents($sFile, $sData);
      } // if ( $sOutput !== "" ){
      else{
         echo $sData;
      } // if ( $sOutput !== "" ){ .. else

      if ( $bDie ){
         die;
      }
   } // static function varDump( $vVar, $bDie = false ){

   /**
    *
    * @param type $vVar
    * @param type $sOutput
    */
   static function _varDump_toFile( $vVar, $sOutput ){

      $sData = print_r( $vVar, true );

      if ( $sOutput !== "" ){
         $sFile = "/var/www/html/maktub/logs/$sOutput";
         file_put_contents($sFile, $sData);
      } // if ( $sOutput !== "" ){
   } // static function varDump( $vVar, $bDie = false ){

} // class Debug{
