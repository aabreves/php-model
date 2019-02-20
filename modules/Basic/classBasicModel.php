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
 * /var/www/html/maktub/modules/Basic/classBasicModel.php
 */
require_once "classModule.php";
require_once "classes/classDatabase.php";
require_once("lib/html/classHtmlMenu.php");

/**
 * <h4>Definition of class BasicModel</h4>
 * <p></p>
 *
 * @author aabreves
 */
abstract class BasicModel extends Module{

//   protected $sAction = "";
//   protected $asActionsMap = [];
//   
//   protected $dbData = null;
//   protected $asData = [
//      "action" => "",
//      "status" => "",
//      "message" => "" ];

   /**
    *
    */
   public function __construct(){
      parent::__construct();
      
      $this->defineProperties( [ 
         "sAction"      => "",
         "asActionsMap" => [],
         "dbData"       => null,
         "asData"       => [],
         "db"           => null
      ] ); // $this->defineProperties( [ 

      $this->asData = [
         "action"  => "data_action",
         "status"  => 0,
         "message" => "message" ];
   } // function __construct( $sModuleName )
   
   /**
    *
    * This method should returns a boolean
    *
    * @param string $sAction
    * @param array  $asArgv
    * @return boolean
    * @throws Exception
    */
   public function runDataAction( $sAction,
                                  array $asArgv ){
      $bReturn = false;
      if ( Session::_get( "$this->sModule" ) === null ){
         Session::_set( "$this->sModule",
                        0 );
      } // if ( Session::_get( "MODEL_" ) === null )

      if ( array_key_exists( $sAction,
                             $this->asActionsMap ) &&
         method_exists( $this,
                        $this->asActionsMap[$sAction] ) ){
         $this->sAction = $sAction;
         $sMtdName = $this->asActionsMap[$sAction];
         $bReturn = $this->$sMtdName( $asArgv );
      } // if ( array_key_exists( $sAction , $this->asActionsMap ) &&
      else{
         $bReturn = $this->runBasicDataAction( $sAction,
                                               $asArgv );
         if ( !$bReturn ){
            throw new Exception( App::_getText( "invalid_action" ) . " - $sAction - " . $this->className(),
                                                INVALID_ACTION );
         } // if ( !$this->runBasicAction( $sAction, $asArgv ) )
      } // if ( array_key_exists( $sAction , $this->asActionsMap ) &&  .. else

      return $bReturn;
   } // public function runDataAction( $sAction )
   
   /**
    *
    * @param type $sAction
    * @return boolean
    */
   protected final function runBasicDataAction( $sAction,
                                                array $asArgv = [] ){
      $bReturn = false;
      switch ( $sAction ){
         case "default":
            $bReturn = true;
            $this->asData["action"] = "default";
            $this->asData["status"] = 1;
            $this->asData["message"] = "done";
            break;

         case "none":
            $bReturn = true;
            $this->asData["action"] = "none";
            $this->asData["status"] = 1;
            $this->asData["message"] = "done";
            break;
      } // switch ( $sAction ){

      return $bReturn;
   } // protected function runBasicDataAction( $sAction, array $asArgv ){
   
   /**
    *
    * @return object
    */
   public function getDbData( $sDataIndex = "" ){
      if ( isset( $this->dbData["$sDataIndex"] ) ){
         return $this->dbData["$sDataIndex"];
      } // if ( isset( $this->dbData["$sDataIndex"] ) ){
      return $this->dbData;
   } // public function getDbData()
   
   /**
    *
    * @return array
    */
   public function getAsData( $sDataIndex = "" ){
      if ( isset( $this->asData["$sDataIndex"] ) ){
         return $this->asData["$sDataIndex"];
      } // if ( isset( $this->asData["$sDataIndex"] ) ){
      return $this->asData;
   } // public function getAsData()
   
} // class BasicModel

