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
 * /var/www/html/maktub/loader.php
 */
define( "LOADER", 1 );

require_once "core/init.php";

$sResult = "";

/**
 * if is not AJAX then $_asMAV[] and $_asArgv[] are defined in caller file
 */

$bIsAjax = Utils::_isAjaxRequest();
try{
   if ( $bIsAjax ){

      //sleep( 1 );
      // an ajax request is send directly to this file
      Session::_set( "ajax",   "1" );
      Session::_set( "reload", "0" );
      
      $_asMAV[ "m"] = Utils::_filterInput( INPUT_GET, "m" );
      $_asMAV[ "a"] = Utils::_filterInput( INPUT_GET, "a" );
      $_asMAV[ "v"] = Utils::_filterInput( INPUT_GET, "v" );
      
      $_asArgv = [];
      
   } // if ( _isAjaxRequest() )
   else{
      Session::_set( "ajax",   "0" );
      Session::_set( "reload", "1" );
   } // if ( _isAjaxRequest() ) .. else   
   
   $asPostKeys = array_keys( $_POST );
   foreach ( $asPostKeys as $sKey ){
      if (is_array( $_POST["$sKey"] ) ){
         $_asArgv[$sKey] = $_POST["$sKey"];
         continue;
      }
      $_asArgv[$sKey] = Utils::_filterInput( INPUT_POST, $sKey );
   } // foreach ( $asPostKeys as $sKey )
      
   // loader.php?m=Main&a=default&v=default:json
   $vResult = MasterController::_run( $_asMAV, $_asArgv );
   
   if ( is_array( $vResult ) ){
      $vResult = json_encode( $vResult );
   } // if ( is_array( $vResult ) ){
   
   echo $vResult;
} // try
catch ( Exception $e ){
   echo getErrorView( $e->getMessage(), $bIsAjax);
} // catch ( Exception $e )

/**
 * 
 * @param type $sError
 * @param type $bIsAjax
 */
function getErrorView( $sError, $bIsAjax ){
   $sResult = "";
   if ( $bIsAjax ){
      $sResult .= "{\"Data\":[ ";

      $sResult .= "{";
      $sResult .= "\"TargetId\":\"bdyBody\",";
      $sResult .= "\"Content\":\"$sError\"";
      $sResult .= "}";

      $sResult .= "]}";
   }
   else{
      $sResult = "<div class='alert alert-danger'>$sError</div>";
   }
   
   echo $sResult;
} // function getErrorView( $sError, $bIsAjax ){

?>

