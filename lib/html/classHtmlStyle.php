<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class HtmlStyle extends HtmlObject{
   
   private $bProcessed = false;

   /**
    * 
    * custom parameters...
    * @param type $sId
    * @param type $sURI
    */
   function __construct( $sId, $sURI = "" ){
      parent::__construct( "link", $sId, true );
      
      // TO DO: custom object properties...
      $this->setAttributes([ "rel" => "stylesheet"]);
      if ( $sURI !== "" ){
         $this->setAttributes([ "href" => $sURI]);
         $this->bProcessed = false;         
      } // if ( $sURI !== "" ){
      else{
         $this->bProcessed = true;
      } // if ( $sURI !== "" ){ .. else

   } // function __construct( $sId, $sURI = "" ){
   
   /**
    * 
    * @param type $bProcessed
    */
   public function setProcessed( $bProcessed = true ){
      $this->bProcessed = $bProcessed;
   } // public function setProcessed( $bProcessed = true ){
   
   /**
    * 
    * @return type
    */
   public function getProcessed(){
      return $this->bProcessed;
   } // public function getProcessed(){

   /**
    *
    */
   public function getHtmlCode(){      // TO DO:

      return parent::getHtmlCode();
   } // public function getHtmlCode()

} // class HtmlStyle extends HtmlObject