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
 * /var/www/html/maktub/core/classUtils.php
 */
(defined( "INDEX" ) || defined( "LOADER" )) && defined( "INIT" ) ||
exit( "ERROR: forbidden direct access.".( ( isset($_env[ "debug_mode"] ) && $_env[ "debug_mode"] ) ? ": ".__FILE__ : "!" ) );

/**
 * <h4>Definition of class Utils</h4>
 * <p></p>
 *
 * @author aabreves
 */
class Utils{

   /**
    *
    */
   static function _startUtils(){
   } // static function _startUtils()

   /**
    *
    * @return boolean
    */
   static public function _isAjaxRequest(){
      $bReturn = false;
      if ( in_array( "loader.php", explode( DSEP, SCRIPT_NM ) ) ){
         $bReturn = true;
      } // if( !empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ...
      return $bReturn;
   } // function _isAjaxRequest()

   /**
    *
    * Applies php filter_input
    *
    * @param type $iType <p>One of <b>INPUT_GET</b>, <b>INPUT_POST</b>,
    * <b>INPUT_COOKIE</b>, <b>INPUT_SERVER</b>, or
    * <b>INPUT_ENV</b>.</p>
    * @param type $sVarName <p>Name of a variable to get.</p>
    * @param type $sDefault [optional]
    * @param type $iFilter  [optional]
    * @param type $options  [optional] <p>Associative array of options or bitwise disjunction of flags. If filter
    *                         accepts options, flags can be provided in "flags" field of array.</p>
    * @return type
    */
   static public function _filterInput( $iType, 
                                        $sVarName,
                                        $sDefault = "",
                                        $iFilter = FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                                        $options = null ){

         $sReturn = filter_input( $iType, $sVarName, $iFilter, $options );

         if ( $sReturn === null ){
            $sReturn = $sDefault;
         } // if ( $sReturn === null )

         return $sReturn;
   } // static public function _filterInput( $iType, $sVarName, ...

   /**
    *
    * @param type $sURI
    */
   static public function _redirect( $sURI ){

      $sMethod = "auto";
		switch ( $sMethod ){
			case "refresh":
				header( "Refresh:0;url=$sURI" );
				break;

			default:
				header( "Location: $sURI", FALSE );
				break;
		} // switch ( $sMethod )

		exit();
   } // static public function _redirect( $sURI )
   
   /**
    * 
    * @param type $sOutput
    * @return type
    */
   static public function _prepareOutput( $sOutput ){
      
      if ( App::_getData( "debug_mode" ) === "1" ){
         return $sOutput;
      } // if ( App::_getData( "debug_mode" ) === "1" ){
      
      $asData = explode( "\n", $sOutput );
      
      foreach ( $asData as $sKey => $sData ){
         $asData[$sKey] = trim( $sData );
      } // foreach ( $asData as $sKey => $sData ){
      
      //return str_replace( "\n", " ", implode( "\n", $asData ) );
      return implode( " ", $asData );
   } // static public function _prepareOutput( $sOutput ){
   
   /**
    * 
    * @param type $sJsScript
    * @return type
    */
   static public function _prepareScript( $sJsScript, $bRemovScriptTags = true ){
      
      $asData = explode( "\n", $sJsScript );
      
      if ( $bRemovScriptTags ){
         array_pop( $asData );
         array_shift( $asData );
      } // if ( $bRemovScriptTags ){
      
      foreach ( $asData as $sKey => $sData ){
         $asData[$sKey] = trim( $sData );
      } // foreach ( $asData as $sKey => $sData ){
      
      $sJsScript = implode( " ", $asData );
      
      return $sJsScript;
   } // static public function _prepareScript( $sJsScript ){

} // class Utils

