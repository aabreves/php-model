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

//require_once "lib/html/classHtmlObject.php";

/**
 * <h4>Definition of class AssetsMng</h4>
 * <p></p>
 *
 * @author aabreves
 */
class AssetsMng{
   
   private static $aoScripts_      = [];
   private static $aoStyles_       = [];
   private static $bRenderScripts_ = true;
   private static $bRenderStyles_  = true;

   /**
    *
    * @return type
    */
   final static public function addScript( $sId, $sFile ){
      $sFile .= "?".time();
      //$objScript = (object)[ "id" => $sId, "file" => $sFile];
      if ( !isset( self::$aoScripts_[$sId] ) ){
         $scrScript = new HtmlScript( $sId, $sFile );
         self::$aoScripts_ = array_merge( self::$aoScripts_, [ $sId => $scrScript ] );
      } // if ( !isset( self::$aoScripts_[$sId] ) ){
   } // final static public function getScripts()

   /**
    * 
    * @param type $sRequestType
    * @return type
    */
   static private function getScripts( $sRequestType ){
      $sReturn = "";
      if ( $sRequestType === "json" ){
         $aoScripts = null;
         foreach( self::$aoScripts_ as $scrScript ){
            if ( $scrScript->getProcessed() ){
               continue;
            } // if ( $scrScript->getProcessed() ){
            
            $oScript = (object)[ 
               "id"   => $scrScript->id, 
               "file" => $scrScript->src
            ]; // $oScript = (object)[ 
            
            $aoScripts[] = $oScript;
            $scrScript->setProcessed();
         } // foreach( self::$aoScripts_ as $scrScript )
         $sReturn = json_encode( $aoScripts );
      } // if ( $sRequestType === "json" ){
      else{
         foreach( self::$aoScripts_ as $scrScript ){
            if ( $scrScript->getProcessed() ){
               continue;
            } // if ( $scrScript->getProcessed() ){
            $sReturn .= (string)$scrScript;
            $scrScript->setProcessed();
         } // foreach( self::$aoScripts_ as $scrScript )
      } // if ( $sRequestType === "json" ){ .. else
      return $sReturn;
   } // static private function getScripts( $sRequestType ){

   /**
    * 
    * @param type $sId
    * @return type
    */
   final static public function checkScript( $sId ){
      return isset( self::$aoScripts_[$sId] );
   } // final static public function checkScript( $sId ){

   /**
    *
    * @param type $sId
    * @param string $sFile
    */
   final static public function addStyle( $sId, $sFile ){
      $sFile .= "?".time();
      if ( !isset( self::$aoStyles_[$sId] ) ){
         $cssStyle = new HtmlStyle( $sId, $sFile );
         self::$aoStyles_ = array_merge( self::$aoStyles_, [ $sId => $cssStyle ] );
      } // if ( !isset( self::$aoStyles_[$sId] ) ){
   } // final static public function getStyles()

   /**
    * 
    * @param type $sRequestType
    * @return type
    */
   static private function getStyles( $sRequestType ){
      $sReturn = "";
      if ( $sRequestType === "json" ){
         $aoStyles = null;
         foreach( self::$aoStyles_ as $cssStyle ){
            if ( $cssStyle->getProcessed() ){
               continue;
            } // if ( $cssStyle->getProcessed() ){
            
            $oStyle = (object)[
               "id" => $cssStyle->id, 
               "file" => $cssStyle->href
            ]; // $oStyle = (object)[
            
            $aoStyles[] = $oStyle;
            $cssStyle->setProcessed();
         } // foreach( self::$aoScripts_ as $scrScript )
         $sReturn = json_encode( $aoStyles );
      } // if ( $sRequestType === "json" ){
      else{
         foreach( self::$aoStyles_ as $cssStyle ){
            if ( $cssStyle->getProcessed() ){
               continue;
            } // if ( $cssStyle->getProcessed() ){
            $sReturn .= (string)$cssStyle;
            $cssStyle->setProcessed();
         } // foreach( self::$aoScripts_ as $scrScript )
      } // if ( $sRequestType === "json" ){ .. else
      return $sReturn;
   } // static private function getStyles( $sRequestType ){

   /**
    * 
    * @param type $sId
    * @return type
    */
   final static public function checkStyle( $sId ){
      return isset( self::$aoStyles_[$sId] );
   } // final static public function checkScript( $sId ){
   
   /**
    * 
    * @param type $sRequestType
    * @param type $bRenderScripts
    * @param type $bRenderStyles
    * @return \DataItem
    */
   final static public function renderAssets( $sRequestType   = "html",
                                              $bRenderScripts = true, 
                                              $bRenderStyles  = true ){

      $adiAssets = [];
      /* ************************************************************ */
      if ( self::$bRenderScripts_ && $bRenderScripts ){
         $oDataJS = new DataItem( "hdHeader", 
                                  false, 
                                  "script" );
         $oDataJS->Content        = self::getScripts( $sRequestType );
         $adiAssets[] = $oDataJS;
         self::$bRenderScripts_    = false;
      } // if ( self::$bRenderScripts_ && $bRenderScripts ){

      /* ************************************************************ */
      if ( self::$bRenderStyles_ && $bRenderStyles ){
         $oDataCss = new DataItem( "hdHeader", 
                                   false, 
                                   "stylesheet" );
         $oDataCss->Content       = self::getStyles( $sRequestType );
         $adiAssets[] = $oDataCss;
         self::$bRenderStyles_     = false;
      } // if ( self::$bRenderStyles_ && $bRenderStyles ){
      
      return $adiAssets;
                                     
   } // final static public function renderAssets( $sRequestType   = "html", ...

} // class AssetsMng{

