<?php
/*
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
 * /var/www/html/maktub/modules/classMasterController.php
 */

/**
 * <h4>Definition of class MasterController</h4>
 * <p></p>
 *
 * @author aabreves
 */
class MasterController{
   static private $_sModule = "";
   static private $_sAction = "";
   static private $_sView = "";

   /**
    *
    * @param array of strings - $asMAV  - [ "module"], [ "action"], [ "view"]
    * @param array of strings - $asArgv - named arguments
    *
    * loader.php?m=Main&a=default&v=default:json
    */
   //static public function _run( array &$asMAV, array &$asArgv )
   static public function _run( array $asMAV, array $asArgv ){         
       
      //Debug::_varDump( $asMAV, true );
      self::_extractMAVData( $asMAV );
      return self::_runModule( $asArgv );
   } // static public function _run( $asMAV, $asArgv )

   /**
    * Extracts the Module [m], Action [a] and View [v] info from  $asMAV array
    * @param string_array $asMAV
    *
    * loader.php?m=Main&a=default&v=default:json
    *
    */
   static private function _extractMAVData( array &$asMAV ){
      if ( isset($asMAV[ "m"]) ){
         self::$_sModule = ucfirst( $asMAV[ "m"] ); // Module
         unset( $asMAV[ "m"] );
      } // if ( isset($asMAV[ "m"]) )
      else{
         self::$_sModule = "Starter";
      }
      
      if ( isset($asMAV[ "a"]) ){
         self::$_sAction = $asMAV[ "a"]; // Action
         unset( $asMAV[ "a"] );
      } // if ( isset($asMAV[ "m"]) )
      else{
         self::$_sAction = "default";
      }
      
      if ( isset($asMAV[ "v"]) ){
         self::$_sView = $asMAV[ "v"]; // View
         unset( $asMAV[ "v"] );
      } // if ( isset($asMAV[ "m"]) )
      else{
         self::$_sView = "starter";
      }

   } /* private function _extractMAVData( $asMAV ) */

   /**
    * Creates the proper module controller and run it.
    * If the class module does not exist throws an exception
    * @param string_array $asArgv
    * @throws type
    */
   static private function _runModule( array &$asArgv ){
      $_sModuleController = self::$_sModule."Controller";
      
      try{
         $oModuleController = App::_loadObject( $_sModuleController, $_sModuleController );
         $oModuleController->setModule( self::$_sModule );
         
         $vResult = $oModuleController->run( self::$_sAction, $asArgv, self::$_sView );
         
         if ( !is_string( $vResult ) && !$vResult ){
            throw( new Exception( $oModuleController->Error() ) );
         } // if ( !$vResult ){
         
         return $vResult;
         
      } /* if ( class_exists( $_sModuleController ) ) */
      catch ( Exception $ex ){
         throw( new Exception( $ex->getMessage() ) );
      } /* if ( class_exists( $_sModuleController ) ) .. else */

   } /* private function _runModule( $asArgv ) */
   
} // class MasterController