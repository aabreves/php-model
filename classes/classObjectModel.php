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
 * /var/www/html/maktub/classes/classObjectModel.php
 */
(defined( "INDEX" ) || defined( "LOADER" )) && defined( "INIT" ) ||
exit( "ERROR: forbidden direct access.".( ( isset($_env[ "debug_mode"] ) && $_env[ "debug_mode"] ) ? ": ".__FILE__ : "!" ) );

/**
 * <h4>Definition of class Object</h4>
 *
 * <p>This class acts as a base class for most of the other classes (except for
 * static classes (mostly core classes))</p>
 *
 * @author aabreves
 */
class ObjectModel{

   private $sUID       = "";
   private $sClassName = "";
   private $asErrors   = []; // error array
   private $asStatus   = []; // status array

   protected $asProperties = [];

   /**
    *
    * @param type $sUID
    */
   function __construct( $sUID = "" ){
      if ( $sUID === "" ){
         $sUID = "Object_".get_class()."_".time();
      } // function __construct( $sUID = "" )
      $this->UID( $sUID );
      $this->className( get_class() );
   } // function __construct( $sUID = "" )

   /**
    * 
    * Define the object properties
    * 
    * @param array $asProperties
    */
   protected function defineProperties( array $asProperties ){
      foreach ( $asProperties as $sProperty => $vValue ){
         $this->asProperties[$sProperty] = $vValue;
      } // foreach ( $asProperties as $sProperty => $vValue ){
   } // protected function defineProperties( array $asProperties ){
   
   /**
    * 
    * Set new values to the specified properties.
    * This method does not create new properties.
    * 
    * @param array $asProperties
    */
   protected function setValuesFromArray( array $asProperties ){      
      foreach ( $this->asProperties as $sField => $sCurrValue ){
         if ( isset( $asProperties[$sField] ) && $asProperties[$sField] !== $sCurrValue ){
            $this->asProperties[$sField] = $asProperties[$sField];
         } // if ( isset( $asProperties[$sField] ) && $asProperties[$sField] !== $sCurrValue ){
      } // foreach ( $this->asProperties as $sField => $sValue ){      
   } // protected function setValuesFromArray( array $asProperties ){
   
   /**
    *
    * Set a new value to a specific property.
    * This method does not create new properties.
    * 
    * @param type $sProperty
    * @param type $vValue
    * @throws Exception
    */
   protected function setProperty( $sProperty, $vValue ){
      if ( array_key_exists($sProperty, $this->asProperties ) ){
         $this->asProperties[$sProperty] = $vValue;
      } // if (array_key_exists($sProperty, $this->asProperties ) )
      else{
         $sError = "$this->sModule::$this->sClassName::setProperty: $sProperty - ".App::_getText( "invalid_property" );
         throw new Exception( $sError, INVALID_PROPERTY );
      } // if ( array_key_exists($sProperty, $this->asProperties ) ){ .. else
   } // protected function setProperty( $sProperty, $vValue )

   /**
    * 
    * @param type $sProperty
    * @param type $vValue
    */
   public function __set( $sProperty, $vValue ) {
      $this->setProperty( $sProperty, $vValue );
   } // public function __set( $sProperty, $vValue ) {
   
   /**
    *
    * @param  type $sProperty
    * @return type
    * @throws Exception
    */
   public function __get( $sProperty ){
      if ( array_key_exists( $sProperty, $this->asProperties ) ){
         return $this->asProperties[$sProperty];
      } // if ( array_key_exists( $sProperty, $this->asProperties ) )
      $sError = "$this->sModule::$this->sClassName::__get: $sProperty - ".App::_getText( "invalid_property" );
      throw new Exception( $sError, INVALID_PROPERTY );
   } // public function __get( $sProperty ){

   /**
    * <h4>Set or Get the object UID:</h4>
    * <p>If $sUID is given then it is used to set a new value to the object UID;
    * else just returns the current value assigned to the object UID.</p>
    *
    * @param  string $sUID [optional]
    * @return string or $this (if $sUID is given)
    */
   public final function UID(){
      return $this->sUID;
   } // public final function UID( $sUID = "" )

   /**
    * <h4>Set or Get the object ClassName:</h4>
    * <p>If $sClassName is given then it is used to set a new value to the object ClassName;
    * else just returns the current value assigned to the object ClassName.</p>
    *
    * @param  string $sClassName [optional]
    * @return string or $this (if $sClassName is given)
    */
   public final function className( $sClassName = "" ){
      if ( $sClassName and $sClassName !== "" ){
         $this->sClassName = $sClassName;
         return $this;
      } // if ( $sClassName and $sClassName !== "" )
      else{
         return $this->sClassName;
      } // if ( $sClassName and $sClassName !== "" ) .. else
   } // public final function className( $sClassName = "" )

   /**
    * <h4>Set or Get the object ErrorCode:</h4>
    * <p>If $vErrorCode is given then it is used to set a new value to the object ErrorCode array;
    * else just returns the current value assigned to the object ErrorCode and reset the array.</p>
    *
    * @param  string or array: $vError [optional]
    * @return string or $this (if $vErrorCode is given)
    */
   public final function Error( $vError = "" ){
      if ( $vError && $vError !== "" ){
         if ( is_array( $vError ) ){
            foreach ( $vError as $sError ){
               $this->asErrors[] = $sError;
            } // foreach ( $vError as $sError ){
         } // if ( is_array( $vError ) ){
         else{
            $this->asErrors[] = $vError;
         } // if ( is_array( $vError ) ){ .. else         
         return $this;
      } // if ( $vError && $vError !== "" )
      
      return $this->getErrors();
   } // public final function errorCode( $vErrorCode = "" )
   
   /**
    * 
    * @return type
    */
   private final function getErrors(){
      $sReturn = "";
      foreach ( $this->asErrors as $errorCode => $errorMessage ){
         if ( $errorCode !== "0" && $errorMessage !== "" ){
            $sReturn .= "<p>$errorCode: $errorMessage</p>";
         } // if ( $errorCode !== "0" && $errorMessage !== "" ){
      } // foreach ( $this->asErrors as $errorCode => $errorMessage ){
      $this->asErrors = [];
      return $sReturn;
   } // public final function getErrors(){

   /**
    * <h4>Set or Get the status array:</h4>
    * <p>If $vStatus is given then it is used to set a new value to the object's status array;
    * else just returns the current object's status and reset status array.</p>
    *
    * @param  variant $vStatus [optional] - string or string array or none
    * @return string or $this (if $vStatus is given)
    */
   public final function Status( $vStatus = "" ){
      if ( $vStatus && $vStatus !== "" ){
         if ( is_array( $vStatus ) ){
            foreach ( $vStatus as $sStatus ){
               $this->asStatus[] = $sStatus;
            } // foreach ( $vStatus as $sStatus ){
         } // if ( is_array( $vStatus ) ){
         else{
            $this->asStatus[] = $vStatus;
         } // if ( is_array( $vStatus ) ){ .. else
         return $this;
      } // if ( $vStatus and $vStatus !== "" )
      
      return $this->getStatus();
   } // public final function Status( $vStatus = "" )
   
   /**
    * 
    * <p>Get all the status messages; reset the status array</p>
    * 
    * @return string
    */
   private final function getStatus(){
      $sReturn = "";
      foreach ( $this->asStatus as $vStatus ){
         if ( $vStatus !== "" ){
            $sReturn .= "<p>$vStatus</p>";
         } // if ( $vStatus !== "" ){
      } // foreach ( $this->asErrors as $vErrorCode ){
      $this->asStatus = [];
      return $sReturn;
   } // public final function getStatus(){

} // class Object
