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
 * /var/www/html/maktub/lib/html/classHtmlObject.php
 */
require_once "classes/classObjectModel.php";

/**
 * Definition of classHtmlObject
 *
 * @author aabreves
 */
class HtmlObject extends ObjectModel{ 
   
   private static $iHtmlLevel = 1;
   
   private $asAttributes    = [];
   private $aheInnerObjects = [];

   /**
    *
    * @param type $sId
    * @param type $sTag
    * @param type $bIsEmpty
    */
   public function __construct( $sTag, $sId = "", $bIsEmpty = false ){
      parent::__construct( $sId );
      
      $this->defineProperties( [ "sTag"            => "",
                                 "bIsEmpty"        => false,
                                 "sText"           => "" ] );
      
      if ( $sId !== "" ){
         $this->setAttribute( "id", $sId );
      } // if ( $sId !== "" )
      $this->sTag     = $sTag;
      $this->bIsEmpty = $bIsEmpty;
   } // public function __construct( $sTag, $bIsEmpty )

   /**
    *
    * @param  string $sAttr - the attribute name
    * @return string or null - the attribute value
    */
   public function __get( $sAttr ){
      if ( array_key_exists( $sAttr, $this->asAttributes ) ) {
          return $this->asAttributes[$sAttr];
      }
      else{
         return parent::__get( $sAttr );
      }
      return null;
   } // public function _get( $sAttr )

   /**
    *
    * @param type $sAttr
    * @param type $sValue
    */
   public function setAttribute( $sAttr, $sValue ){
      $this->asAttributes[ "$sAttr"] = $sValue;
   } // public function setAttribute( $sAttribute, $sValue )

   /**
    *
    * @param type $sAttr
    * @param type $sValue
    */
   public function getAttribute( $sAttr ){
      return ( isset( $this->asAttributes[ "$sAttr"] ) ) ? $this->asAttributes[ "$sAttr"] : "";
   } // public function setAttribute( $sAttribute, $sValue )

   /**
    *
    * @param array $asAttributes [ "attribute" => "value"]
    */
   public function setAttributes( array $asAttributes ){
      foreach ( $asAttributes as $sAttribute => $sValue ){
         $this->setAttribute( $sAttribute, $sValue );
      } // foreach ( $asAttributess as $sAttribute => $sValue )
   } // public function setAttribute( $sAttribute, $sValue )

   /**
    *
    * @param type $sText
    */
   public function setText( $sText ){
      $this->sText = $sText;
   } // public function setText( $sText )

   /**
    *
    * @param HtmlObject $htmObject
    */
   public function addObject( HtmlObject $htmObject ){
      if ( $this->bIsEmpty ){
         return false;
      } // if ( $this->bIsEmpty )

      $this->aheInnerObjects[] = $htmObject;
      return true;
   } // public function addObject( HtmlObject $htmObject )

   /**
    * 
    * @param array $ahtmObjects
    * @return int  - the number of added objects
    */
   public function addObjects( array $ahtmObjects ){
      $iCountAdded = 0;
      foreach ( $ahtmObjects as $htmObject ){
         if ( $htmObject !== null ){
            $this->addObject( $htmObject );
            $iCountAdded++;
         } // if ( $htmObject !== null )
      } // foreach ( $ahtmObjects as $htmObject )
      return $iCountAdded;
   } // public function addObjects( array $ahtmObjects )

   /**
    * returns the htmlcode
    */
   public function getHtmlCode(){
      
      $htmlCode = "";
      $iHtmlLevel = ++self::$iHtmlLevel;
      
      $cNL     = "";
      $varTabs = "";
      if ( !Utils::_isAjaxRequest() ){
         $iTabSize = 3;
         $varTabs = array_fill( 0, $iHtmlLevel * $iTabSize, " " );
         $varTabs = implode( "", $varTabs );
         $cNL     = "\n";
      } // if ( !Utils::_isAjaxRequest() )
      
      $htmlCode = "$cNL$varTabs<".($this->sTag);

      foreach( $this->asAttributes as $sAttribute => $sValue){
         if ( $sValue === "true" ){
            $htmlCode .= " $sAttribute";
         } // if ( $sValue === "" )
         elseif ( $sValue !== "false" ){
            $htmlCode .= " $sAttribute='$sValue'";
         } // if ( $sValue === "" ) .. else
      } // foreach( $this->asAttributes as $sAttribute => $sValue)

      if ( $this->bIsEmpty ){
         $htmlCode .= " />";
      } // if ( $this->bIsEmpty )
      else{
         $htmlCode .= " >";
         if ( strlen( $this->sText ) > 0 ){
            $htmlCode .= $this->sText;
         } // if ( strlen( $this->sText ) > 0 )

         foreach( $this->aheInnerObjects as $heObject ){
            $htmlCode .= (string)$heObject.$cNL.$varTabs;
         } // foreach( $this->aheInnerObjects as $heObject )
         $htmlCode .= "</$this->sTag>";
      } // if ( $this->bIsEmpty ) .. else

      self::$iHtmlLevel--;
      return $htmlCode;
   } // public function getHtmlCode()

   /**
    * stringfy the object
    */
   public function __toString(){
      return $this->getHtmlCode();
   } // public function __toString()

} // class HtmlObject

