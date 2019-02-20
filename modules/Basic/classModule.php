<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "classes/classObjectModel.php";

/**
 * Definition of classModule
 *
 * @author breves
 */
class Module extends ObjectModel{

   /**
    * 
    */
   public function __construct(){
      parent::__construct();
      
      $this->defineProperties( [ "sModule" => "" ] );
   } // function __construct()
   
   /**
    * 
    * @param type $sModule
    */
   public function setModule( $sModule ){
       $this->sModule = $sModule;
   } // public function setModule( $sModule ){
} // class Module extends ObjectModel{    
