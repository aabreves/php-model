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
 * /var/www/html/maktub/modules/Basic/classBasicController.php
 */
require_once "classModule.php";

/**
 * <h4>Definition of class BasicController</h4>
 * <p></p>
 *
 * @author aabreves
 */
abstract class BasicController extends Module{

//   protected $sAction = "";
//   protected $asActionsMap = [];
//   protected $oModel = null;
//   protected $oView = null;

   /**
    *
    */
   public function __construct(){
      parent::__construct();
      
      $this->defineProperties( [ 
         "sAction"      => "",
         "asActionsMap" => [],
         "oModel"       => null,
         "oView"        => null
      ] ); // $this->defineProperties( [ 
   } // function __construct()
   
   /**
    *
    * @param type $sAction
    * @param array $asArgv
    * @param type $sView
    *
    * @return variant
    */
   final public function run( $sAction,
                              array $asArgv,
                              $sView ){
      $vReturn = true;
      try{
         // Load the proper Model
         $this->oModel = App::_loadObject( $this->sModule . "Model",
                                           $this->sModule . "Model",
                                           [ "module" => "$this->sModule" ] );
         // Run the requested constroller action
         $this->runAction( $sAction,
                           $asArgv );

         // Load the proper View
         $this->oView = App::_loadObject( $this->sModule . "View",
                                          $this->sModule . "View" );
         // Render the requested view
         $vReturn = $this->oView->render( $sView,
                                          $this->oModel );
      } // try{
      catch ( Exception $ex ){
         $this->Error( $ex->getCode().": ".$ex->getMessage() );
         $vReturn = false;
      } // catch ( Exception $ex ){

      return $vReturn;
   } // public function run( $sAction, array $asArgv, $sView )
   
   /**
    *
    * @param string $sAction
    * @param array  $asArgv
    * @throws Exception
    */
   public function runAction( $sAction,
                              array $asArgv ){
      $bReturn = false;
      // Register the module
      if ( Session::_get( "$this->sModule" ) === null ){
         Session::_set( "$this->sModule",
                        0 );
      } // if ( Session::_get( "$this->sModule" ) === null ){

      // Check if the action is mapped and its method is defined
      if ( array_key_exists( $sAction,
                             $this->asActionsMap ) && method_exists( $this,
                                                                     $this->asActionsMap[$sAction] ) ){
         $this->sAction = $sAction;
         $sMtdName = $this->asActionsMap[$sAction];
         $bReturn = $this->$sMtdName( $asArgv );
      }
      else{
         $bReturn = $this->runBasicAction( $sAction,
                                           $asArgv );
         if ( !$bReturn ){
            throw new Exception( App::_getText( "invalid_action" ) . " - $sAction - " . $this->className(),
                                                INVALID_ACTION );
         } // if ( !$this->runBasicAction( $sAction, $asArgv ) )
      }

      return $bReturn;
   } // public function runAction( $sAction )
   
   /**
    *
    * @param type $sAction
    * @param type $asArgv
    * @return boolean
    */
   final protected function runBasicAction( $sAction,
                                            array $asArgv = [] ){
      $bReturn = false;
      switch ( $sAction ){
         case "default":
            $bReturn = $this->oModel->runBasicDataAction( $sAction,
                                                          $asArgv );
            break;

         case "none":
            $bReturn = true;
            break;
      } // switch ( $sAction )

      return $bReturn;
   } // final protected function runBasicAction( $sAction, $asArgv = "" )
   
   /**
    *
    * @return type
    */
   public function getAction(){
      return $this->sAction;
   } // public function getAction()
   
} // abstract class BasicController extends ObjectModel

