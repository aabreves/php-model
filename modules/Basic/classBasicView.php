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
 * /var/www/html/maktub/modules/Basic/classBasicView.php
 */
require_once "classModule.php";
require_once "classes/classResponse.php";
require_once "lib/html/classHtmlObject.php";

/**
 * <h4>Definition of class BasicView</h4>
 * <p></p>
 *
 * @author aabreves
 */
abstract class BasicView extends Module{
   
//   protected $modOptions = null;
//   
//   protected $sView     = "";
//   protected $oModel    = null;
//   protected $oResponse = null;
//   protected $sType     = "html";
//   
//   protected $sModuleWrapperId = "";   
//   protected $sTemplate = "";
//
//   private   $aoScripts = null;
//   private   $aoStyles = null;
//
//   protected $bRenderScripts   = false;
//   protected $bRenderStyles    = false;
//
//   protected $bRenderErrorView = false;

   /**
    *
    */
   public function __construct(){
      parent::__construct();
      
      $this->defineProperties( [ 
         "modOptions"       => null,
         "sView"            => "",
         "oModel"           => null,
         "oResponse"        => [],
         "sType"            => "html",
         "sModuleWrapperId" => "",
         "sTemplate"        => null,
         "aoScripts"        => [],
         "aoStyles"         => [],
         "bRenderScripts"   => false,
         "bRenderStyles"    => false,
         "bRenderErrorView" => false
      ] ); // $this->defineProperties( [ 

      if ( Session::_get("ajax") ){
         $this->sType = "json";
      } // if ( Session::_get("ajax") )

      $this->bRenderErrorView = false;
      $this->oResponse = new Response( $this->sType );
   } // public function __construct()

   abstract public function render( $sView, $oModel );
   
   abstract protected function loadOptions( $iOptionsView );
   abstract protected function loadAssets();
   abstract public function getOptions();

   /**
    *
    * @param  string  $sView
    * @return boolean
    */
   final protected function renderBasicView( $sView ){
      $bReturn = false;
      switch( $sView ){
         case "default":
            $bReturn = $this->renderDefaultView();
            break;

         case "blank":
            $bReturn = $this->renderBlankView();
            break;

         case "error_view":
            $bReturn = $this->renderErrorView();
            break;

         case "none":
            $bReturn = true;
            break;
      } // switch( $sView )

      return $bReturn;
   } // final protected function renderBasicView( $sView )

   /**
    *
    */
   protected function renderDefaultView(){
      /* ************************************************************ */
      $divModuleWrap = $this->getModuleWrapper();

         $pModuleDefault = new HtmlObject( "p" );
         $pModuleDefault->setText( print_r( $this->oModel->getAsData(), true ) );

      $divModuleWrap->addObjects( [$pModuleDefault] );

      $oData1 = new DataItem( "divContainer", true, "html" );
      $oData1->Content  = (string)$divModuleWrap;
      $this->oResponse->Data[ "default_view"] = $oData1;

      return true;
   } // protected function renderDefaultView()

   /**
    *
    */
   final protected function renderBlankView(){
      /* ************************************************************ */
      $oData1 = new DataItem( "divContainer", true, "html" );
      $oData1->Content  = "";
      $this->oResponse->Data[ "blank_view"] = $oData1;

      return true;
   } // final protected function renderBlankView()

   /**
    *
    */
   protected function renderErrorView(){
      /* ************************************************************ */
      $asResultData = $this->oModel->getAsData();

      $sHtml = "<div class='alert alert-danger'>".$asResultData[ "message"]."</div>";

         $oData1 = new DataItem( "divStatusText", true, "html" );
         $oData1->Content  = (string)$sHtml;
         $this->oResponse->Data[ "error_view"] = $oData1;

         $oAction = new ActionItem();
         $oAction->Command  = (string)"showModal()";
         $this->oResponse->Action[] = $oAction;

      $this->bRenderErrorView = false;
      return true;
   } // protected function renderErrorView()

   /**
    *
    * @return \HtmlObject
    */
   protected function getModuleWrapper(){
      $divModuleWrap = new HtmlObject( "div", $this->sModuleWrapperId );
      return $divModuleWrap;
   } // protected function getModuleWrapper()

//   /**
//    *
//    * @return type
//    */
//   final public function addScript( $sId, $sFile ){
//      $sFile .= "?".time();
//      //$objScript = (object)[ "id" => $sId, "file" => $sFile];
//      if ( !isset( $this->aoScripts[$sId] ) ){
//         $scrScript = new HtmlScript( $sId, $sFile );
//         $this->aoScripts = array_merge( $this->aoScripts, [ $sId => $scrScript ] );
//      } // if ( !isset( $this->aoScripts[$sId] ) ){
//   } // final public function getScripts()
//
//   /**
//    * Returns a json encoded script objects
//    * @return type
//    */
//   final public function getScripts(){
//      $sReturn = "";
//      if ( $this->sType === "json" ){
//         $aoScripts = null;
//         foreach( $this->aoScripts as $scrScript ){
//            if ( $scrScript->getProcessed() ){
//               continue;
//            } // if ( $scrScript->getProcessed() ){
//            $oScript = (object)[ "id" => $scrScript->id, "file" => $scrScript->src];
//            $aoScripts[] = $oScript;
//            $scrScript->setProcessed();
//         } // foreach( $this->aoScripts as $scrScript )
//         $sReturn = json_encode( $aoScripts );
//      } // if ( $this->sType === "json" )
//      else{
//         foreach( $this->aoScripts as $scrScript ){
//            if ( $scrScript->getProcessed() ){
//               continue;
//            } // if ( $scrScript->getProcessed() ){
//            $sReturn .= (string)$scrScript;
//            $scrScript->setProcessed();
//         } // foreach( $this->aoScripts as $scrScript )
//      } // if ( $this->sType === "json" ) .. else
//      return $sReturn;
//   } // final public function getScripts()
//
//   /**
//    * 
//    * @param type $sId
//    * @return type
//    */
//   final public function checkScript( $sId ){
//      return isset( $this->aoScripts[$sId] );
//   } // final public function checkScript( $sId ){
//
//   /**
//    *
//    * @param type $sId
//    * @param string $sFile
//    */
//   final public function addStyle( $sId, $sFile ){
//      $sFile .= "?".time();
//      if ( !isset( $this->aoStyles[$sId] ) ){
//         $cssStyle = new HtmlStyle( $sId, $sFile );
//         $this->aoStyles = array_merge( $this->aoStyles, [ $sId => $cssStyle ] );
//      } // if ( !isset( $this->aoStyles[$sId] ) ){
//   } // final public function getStyles()
//
//   /**
//    *
//    * @return type
//    */
//   final public function getStyles(){
//      $sReturn = "";
//      if ( $this->sType === "json" ){
//         $aoStyles = null;
//         foreach( $this->aoStyles as $cssStyle ){
//            if ( $cssStyle->getProcessed() ){
//               continue;
//            } // if ( $cssStyle->getProcessed() ){
//            $oStyle = (object)[ "id" => $cssStyle->id, "file" => $cssStyle->href];
//            $aoStyles[] = $oStyle;
//            $cssStyle->setProcessed();
//         } // foreach( $this->aoScripts as $scrScript )
//         $sReturn = json_encode( $aoStyles );
//      } // if ( $this->sType === "json" )
//      else{
//         foreach( $this->aoStyles as $cssStyle ){
//            if ( $cssStyle->getProcessed() ){
//               continue;
//            } // if ( $cssStyle->getProcessed() ){
//            $sReturn .= (string)$cssStyle;
//            $cssStyle->setProcessed();
//         } // foreach( $this->aoScripts as $scrScript )
//      } // if ( $this->sType === "json" ) .. else
//      return $sReturn;
//   } // final public function getStyles()
//
//   final public function checkStyle( $sId ){
//      return isset( $this->aoStyles[$sId] );
//   } // final public function checkScript( $sId ){

} // class BasicView
