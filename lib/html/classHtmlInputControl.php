<?php
require_once "classHtmlObject.php";
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
 *    input id='$sId'
 *          name='$sId'
 *          type='$sType'
 *          value='$sValue'
 *          class='$cssControl' /
 *
 * /div
 *
 *
 *
 */
class HtmlInputControl extends HtmlObject{

   private $lblCaption = null;
   private $inpControl = null;

   /**
    *
    * div id='$sId_group'
    *     class='$cssGroup'
    *
    *    label class='$cssLabel'
    *       $sCaption
    *    /label
    *
    *    input id='$sId'
    *          name='$sId'
    *          type='$sType'
    *          value='$sValue'
    *          class='$cssControl' /
    *
    * /div
    *
    *
    * @param type $sType
    * @param type $sId
    * @param type $sCaption
    * @param type $sValue
    */
   public function __construct( $sType, $sId, $sCaption = "", $sValue = "" ){
      parent::__construct( "div", $sId."_group" );

      if ( $sCaption !== "" ){
         $this->lblCaption = new HtmlObject( "label" );
         $this->lblCaption->setAttributes( [ "for" => "$sId"] );
         $this->lblCaption->setText( $sCaption );
      } // if ( $sCaption !== "" )

      $this->inpControl = new HtmlObject( "input", $sId, true );
      $this->inpControl->setAttributes( [ "name" => "$sId",
                                          "type"  => "$sType" ] );

      if ( $sValue !== "" ){
         $this->inpControl->setAttributes( [ "value" => "$sValue" ] );
      } // if ( $sValue !== "" )
   } // public function __construct( $sType, $sId, $sCaption, $sValue )

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
         $this->inpControl->setAttribute( "class", $cssControl );
      } // if ( $cssControl !== "" )

   } // public function setStyles( $cssGroup, $cssLabel, $cssControl )

   /**
    *
    * @param array $asAttributes
    */
   public function setControlAttributes( array $asAttributes ){
      $this->inpControl->setAttributes( $asAttributes );
   } // public function setControlAttributes( array $asAttributes )

   /**
    *
    */
   public function getHtmlCode(){
      if ( $this->inpControl->getAttribute( "type" ) === "checkbox" ){
         $this->lblCaption->addObjects( [ $this->inpControl] );
         $this->addObjects( [$this->lblCaption ] );
      }
      else{
         $this->addObjects( [$this->lblCaption, $this->inpControl] );
      }
      return parent::getHtmlCode();
   } // public function getHtmlCode()

} // class HtmlInputControl extends HtmlObject
