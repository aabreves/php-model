<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("modules/Basic/classBasicView.php");

/**
 * Definition of classModel_View
 * 
 * Usage: 
 * 
 *       1 - How to create a new module:
 * 
 *          Ex. to create a new module called Pathfinder
 * 
 *          in modules directory, create a new directory to the new module:
 *             mkdir Pathfinder
 * 
 *             copy the entire content of Model_ directory to the new directory
 *             and rename the files replacing Model_ by Pathfinder:
 * 
 *                classModel_Controller.php => classPathfinderController.php
 *                classModel_Model.php      => classPathfinderModel.php
 *                classModel_View.php       => classPathfinderView.php
 *                model_.js                 => pathfinder.js
 *                model_.css                => pathfinder.css
 * 
 *                views/model_View_0.php    => views/pathfinderView_0.php
 *                views/model_View_1.php    => views/pathfinderView_1.php
 *                views/model_View_2.php    => views/pathfinderView_2.php
 * 
 *          for each file replace the word model_ by the new word, pathfinder:
 *                replace model_ by pathfinder
 *                replace Model_ by Pathfinder
 * 
 *       2 - setup the loadOptions function - this will define the options menu 
 *           for this module:
 *             - on loadOptions method
 * 
 *       3 - setup the core/lang/lang.php file:
 * 
 *       4 - setup the view template to be used:
 *             - on render method:
 *                $this->sTemplate = "sample"; // this can be changed for each 
 *                different view
 *
 * @author aabreves
 */
class Model_View extends BasicView {
   
   /**
    *
    */
   public function __construct(){
      parent::__construct();
      $this->sModuleWrapperId = "divModel_Wrap";
      $this->className( get_class() );
      
      $this->sModule   = "MODEL_";
      
      $this->loadOptions( 0 );
      $this->loadAssets();
   } // public function __construct()
   
   /**
    * 
    */
   protected function loadOptions( $iOptionsView ){      
      switch ( $iOptionsView ){
         case 0:
         default:
            $this->modOptions = '[ {' 
               . '"id" : "hmiModel_Menu_options",'
               . '"type" : "dropdown",'
               . '"caption" : "' . App::_getText( "model__options" ) . '",'
               . '"icon" : [ "glyphicon glyphicon-option-vertical" ],'
               . '"setOnclick" : false,'
               . '"href" : "#",'
               . '"target" : "_self",'
               . '"items" : [ {'
                        . '"id" : "hmiModel_Menu_option1",'
                        . '"type" : "final",'
                        . '"caption" : "' . App::_getText( "model__item_1" ) . '",'
                        . '"icon" : [ "glyphicon glyphicon-tasks" ],'
                        . '"setOnclick" : "true",'
                        . '"href" : "",'
                        . '"target" : "",'
                        . '"items" : []'
                     . '},{'
                        . '"id" : "hmiModel_Menu_option2",'
                        . '"type" : "final",'
                        . '"caption" : "' . App::_getText( "model__item_2" ) . '",'
                        . '"icon" : [ "glyphicon glyphicon-tasks" ],'
                        . '"setOnclick" : "true",'
                        . '"href" : "",'
                        . '"target" : "",'
                        . '"items" : []'
                     . '}'
               . ']'
            . '} ] ';
      } // switch ( $iOptionsView ){      
   } // protected function loadOptions( $iOptionsView ){
   
   /**
    * 
    */
   protected function loadAssets(){
      /* ************************************************************ */
      if ( !AssetsMng::checkScript( "jsModel_" ) ){
         AssetsMng::addScript( "jsModel_", 
                               "modules/Model_/model_.js" );
      } // if ( !AssetsMng::checkScript( "jsModel_" ) ){

      /* ************************************************************ */
      if ( !AssetsMng::checkStyle( "cssModel_" ) ){
         AssetsMng::addStyle( "cssModel_", 
                              "modules/Model_/model_.css" );
      } // if ( !AssetsMng::checkStyle( "cssModel_" ) ){      
   } // protected function loadAssets(){
   
   /**
    * 
    * @return type
    */
   public function getOptions(){
      if ( !$this->modOptions ){
         $this->loadOptions( 0 );
      } // if ( !$this->modOptions ){      
      return $this->modOptions;
   } // public function getOptions(){

   /**
    * 
    * @param type $sView
    * @param type $oModel
    * @param type $bRenderScripts
    * @param type $bRenderStyles
    * @return type
    * @throws Exception
    */
   public function render( $sView, 
                           $oModel, 
                           $bRenderScripts = true, 
                           $bRenderStyles = true ){
      $this->oModel = $oModel;

      $this->sTemplate = "sample";
      switch ( $sView ){
         case "model__view_0":            
            $this->renderModel_View_0( $oModel );
            break;

         case "model__view_1":
            $this->renderModel_View_1( $oModel );
            break;

         case "model__view_2":
            $this->renderModel_View_2( $oModel );
            break;

         default:
            if ( !$this->renderBasicView( $sView ) ){
               throw new Exception( App::_getText( "invalid_view" )." - $sView - ".$this->className(), 
                                    INVALID_VIEW );
            } // if ( !$this->renderBasicView( $sView ) )
      } // switch ( $sView )

      $this->oResponse->Data = array_merge(
         $this->oResponse->Data, 
         AssetsMng::renderAssets(
            $this->sType, 
            $this->bRenderScripts || $bRenderScripts,
            $this->bRenderStyles || $bRenderStyles
         ) // AssetsMng::renderAssets(
      ); // $this->oResponse->Data = array_merge(

      if ( $this->bRenderErrorView ){
         return $this->render( "error_view", 
                               $oModel );
      } // if ( $this->bRenderErrorView ){
      else{
         return $this->oResponse->_render();
      } // if ( $this->bRenderErrorView ){ .. else
      /* ************************************************************ */
   } // public function render( $sView, Model_Model $oModel )

   /**
    *
    */
   private function renderModel_View_0(){
      
      // each view can have a different set of options
      $this->loadOptions( 0 );

      ob_start();
      require_once "templates/$this->sTemplate/header.php";
      require_once 'views/model_View_0.php';
      require_once "templates/$this->sTemplate/footer.php";
      $sHtml = ob_get_contents();
      ob_clean();

      $oData1 = new DataItem( "divContainer", true, "html" );
      $oData1->Content  = (string)$sHtml;
      $this->oResponse->Data[] = $oData1;
   } // private function renderModel_View_0()

   /**
    *
    */
   private function renderModel_View_1(){
      
      // each view can have a different set of options
      $this->loadOptions( 0 );

      ob_start();
      require_once "templates/$this->sTemplate/header.php";
      require_once 'views/model_View_1.php';
      require_once "templates/$this->sTemplate/footer.php";
      $sHtml = ob_get_contents();
      ob_clean();

      $oData1 = new DataItem( "divContainer", true, "html" );
      $oData1->Content  = (string)$sHtml;
      $this->oResponse->Data[] = $oData1;
   } // private function renderModel_View_1()

   /**
    *
    */
   private function renderModel_View_2(){
      
      // each view can have a different set of options
      $this->loadOptions( 0 );

      ob_start();
      require_once "templates/$this->sTemplate/header.php";
      require_once 'views/model_View_2.php';
      require_once "templates/$this->sTemplate/footer.php";
      $sHtml = ob_get_contents();
      ob_clean();

      $oData1 = new DataItem( "divContainer", true, "html" );
      $oData1->Content  = (string)$sHtml;
      $this->oResponse->Data[] = $oData1;
   } // private function renderModel_View_2()

} // class Model_View extends BasicView
