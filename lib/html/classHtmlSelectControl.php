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
 * 
 * A LABELED INPUT CONTROL
 *  
 * div id='$sId_group' 
 *     class='$cssGroup'
 * 
 *    label class='$cssLabel'
 *       $sCaption
 *    /label
 * 
 *    select id='$sId' 
 *           name='$sId'  
 *           class='$cssControl' /
 * 
 * /div
 * 
 * 
 * 
 */
class HtmlSelectControl extends HtmlObject{
   
   private $lblCaption = null;
   private $selControl = null;
   
   /**
    * 
    * div id='$sId_group' 
    *     class='$cssGroup'
    * 
    *    label class='$cssLabel'
    *       $sCaption
    *    /label
    * 
    *    select id='$sId' 
    *           name='$sId' 
    *           class='$cssControl' /
    * 
    * /div
    * 
    * 
    * @param type $sType
    * @param type $sId
    * @param type $sCaption
    * @param type $sValue
    */
   public function __construct( $sId, $sCaption = "", $sSelected = "" ){
      parent::__construct( "div", $sId."_group" );
      
      if ( $sCaption !== "" ){
         $this->lblCaption = new HtmlObject( "label" );
         $this->lblCaption->setAttributes( [ "for" => "$sId"] );
         $this->lblCaption->setText( $sCaption );
      } // if ( $sCaption !== "" )
      
      $this->selControl = new HtmlObject( "select", $sId );
      $this->selControl->setAttributes( [ "name" => "$sId",
         "onchange" => $sId."_onchange()"] );
      
   } // public function __construct( $sType, $sId, $sCaption, $sValue )
   
   /**
    * 
    * @param array $aOptions
    */
   public function setOptions( array $aOptions ){
      $htmOption = new HtmlObject( "option" );
      $htmOption->setText( "none" );
      $this->selControl->addObject( $htmOption );
         
      foreach( $aOptions as $sKey => $sOption ){
         $htmOption = new HtmlObject( "option" );
         $htmOption->setText( $sOption );
         $this->selControl->addObject( $htmOption );
      } // foreach( $aOptions as $sKey => $sOption )
   } // public function setOptions( array $aOptions )
   
   /**
    * 
    * @param string $cssGroup   - css class for group
    * @param string $cssLabel   - css class for label
    * @param string $cssControl - css class for control
    */
   public function setStyles( $cssGroup, $cssLabel, $cssControl ){
      
      if ( $cssGroup !== "" ){
         $this->setAttribute( "class", $cssGroup );
      } // if ( $cssGroup !== "" )
      
      if ( $cssLabel !== "" ){
         $this->lblCaption->setAttribute( "class", $cssLabel );
      } // if ( $cssLabel !== "" )
      
      if ( $cssControl !== "" ){
         $this->selControl->setAttribute( "class", $cssControl );
      } // if ( $cssControl !== "" )
      
   } // public function setStyles( $cssGroup, $cssLabel, $cssControl )
   
   /**
    * 
    * @param array $asAttributes
    */
   public function setControlAttributes( array $asAttributes ){
      $this->selControl->setAttributes( $asAttributes );
   } // public function setControlAttributes( array $asAttributes )
   
   /**
    * 
    */
   public function getHtmlCode(){
      $this->addObjects( [$this->lblCaption, $this->selControl] );
      return parent::getHtmlCode();
   } // public function getHtmlCode()   
   
} // class HtmlInputControl extends HtmlObject