<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("modules/Basic/classBasicView.php");

/**
 * Definition of classHomeView
 *
 * @author aabreves
 */
class HomeView extends BasicView{

   /**
    *
    */
   public function __construct(){
      parent::__construct();
      $this->sModuleWrapperId = "divHomeWrap";
      $this->className( get_class() );
      
      $this->sModule   = "HOME";
      
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
               . '"id" : "hmiHomeMenu_options",'
               . '"type" : "dropdown",'
               . '"caption" : "' . App::_getText( "home_options" ) . '",'
               . '"icon" : [ "glyphicon glyphicon-option-vertical" ],'
               . '"setOnclick" : false,'
               . '"href" : "#",'
               . '"target" : "_self",'
               . '"items" : [ {'
                        . '"id" : "hmiHomeMenu_option1",'
                        . '"type" : "final",'
                        . '"caption" : "' . App::_getText( "home_item_1" ) . '",'
                        . '"icon" : [ "glyphicon glyphicon-tasks" ],'
                        . '"setOnclick" : "true",'
                        . '"href" : "",'
                        . '"target" : "",'
                        . '"items" : []'
                     . '},{'
                        . '"id" : "hmiHomeMenu_option2",'
                        . '"type" : "final",'
                        . '"caption" : "' . App::_getText( "home_item_2" ) . '",'
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
      /*       * *********************************************************** */
      if ( !AssetsMng::checkScript( "jsHome" ) ){
         AssetsMng::addScript( "jsHome",
                               "modules/Home/home.js" );
      } // if ( !AssetsMng::checkScript( "jsHome" ) ){

      /*       * *********************************************************** */
      if ( !AssetsMng::checkStyle( "cssHome" ) ){
         AssetsMng::addStyle( "cssHome",
                              "modules/Home/home.css" );
      } // if ( !AssetsMng::checkStyle( "cssHome" ) ){      
   } // protected function loadAssets(){
   
   /**
    * 
    * @return type
    */
   public function getOptions(){
      if ( !$this->modOptions ){
         $this->loadOptions( 0 );
      } // if ( !self::$modOptions ){      
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
         case "home_view_0":
            $this->renderHomeView_0( $oModel );
            break;

         default:
            if ( !$this->renderBasicView( $sView ) ){
               throw new Exception( App::_getText( "invalid_view" ) . " - $sView - " . $this->className(),
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
      /*       * *********************************************************** */
   } // public function render( $sView, HomeModel $oModel )
   
   /**
    *
    */
   private function renderHomeView_0(){
      
      $this->loadOptions( 0 );

      ob_start();      
      require_once "templates/$this->sTemplate/header.php";
      require_once 'views/homeView_0.php';
      require_once "templates/$this->sTemplate/footer.php";
      $sHtml = ob_get_contents();
      ob_clean();

      $oData1 = new DataItem( "divContainer",
                              true,
                              "html" );
      $oData1->Content = (string)$sHtml;
      $this->oResponse->Data[] = $oData1;
   } // private function renderHomeView()
   
} // class HomeView extends BasicView
