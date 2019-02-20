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
 * /var/www/html/maktub/classes/classResponse.php
 */
require_once "classes/classObjectModel.php";

/**
 * <h4>Definition of class Response</h4>
 * 
 * <p>This class represent responses to be sent to the client interface.
 * It is formed by two arrays, one of data (html, css, json, xml, ... ) 
 * and another of actions (javascript) to be executed at the client side</p>
 *
 * RESPONSE OBJECT
 * 
 * oResponse
 *    |----> Data[]
 *    |       |--[0]---->(DataItem)
 *    |       |           |---->TargetId  :  html element id
 *    |       |           |---->Content   :  response content (html | json)
 *    |       |           |---->Replace   :  1-yes; 0:no
 *    |       |           |---->Type      :  html | json
 *    |       |
 *    |       |--[1]---->(DataItem)
 *    |       |           |---->TargetId  :  html element id
 *    |       |           |---->Content   :  response content
 *    |       |           |---->Replace   :  1-yes; 0:no
 *    |       |           |---->Type      :  html | json
 *    |       |
 *    |       |--[n] ...
 *    |
 *    |----> Action[]
 *            |--[0]---->(ActionItem)
 *            |           |---->Command   :  js command
 *            |
 *            |--[1]---->(ActionItem)
 *            |           |---->Command   :  js command
 *            |
 *            |--[n] ...
 * 
 *
 * 
 * @author aabreves
 */
class Response{

   public $Data = [];
   public $Action = [];

   protected $sType = "";
   
   /**
    * 
    * @param type $sType
    */
   public function __construct( $sType = "html" ){
      $this->sType = $sType;
   } // public function __construct( $sType = "html" ){

   /**
    *
    */
   final public function _render(){
      $vResponse = null;
      switch ( $this->sType ){
         case "data":
            $vResponse = $this->Data;
            break;
         case "json":
            $vResponse = $this->json_encode();
            break;
         case "html":
         default:
            $vResponse = $this->html_encode();
      } // switch ( $this->sType ){      

      $this->Data   = [];
      $this->Action = [];
      
      return $vResponse;
   } // final public function _render()
   
   /**
    * 
    * @param type $sType
    */
   public function setType( $sType ){
      $this->sType = $sType;
   } // public function setType( $sType ){
   
   /**
    *
    * @return type
    */
   private function json_encode(){
      return json_encode( $this );
   } // public function json_encode()
   
   /**
    * 
    * @return type
    */
   private function html_encode(){
      $sHtml = "";
      
      foreach ( $this->Data as $data ){
         $sHtml .= $data->Content;
      } // foreach ( $this->Data as $data )
      
      return $sHtml;
   } // public function html_encode()
} // class Response

/**
 * <h4>Definition of class DataItem</h4>
 * 
 * <p></p>
 *
 * @author aabreves
 */
class DataItem{

   public $TargetId = "";
   public $Content  = "";
   public $Replace  = "1";
   public $Type     = "html";

   /**
    *
    * ( needed if we are responding an ajax request )
    * @param type $sTargetId
    * @param type $bReplace
    * @param type $sType
    */
   function __construct( $sTargetId = "no_target", $bReplace = false, $sType = "html" ){
      $this->TargetId = $sTargetId;
      $this->Replace  = $bReplace ? "1" : "0";
      $this->Type     = $sType;
   } // function __construct( $sTargetId, $bReplace, $sType = "html" ){
} // class DataItem

/**
 * <h4>Definition of class ActionItem</h4>
 * 
 * <p></p>
 *
 * @author aabreves
 */
class ActionItem{

   public $Command = "";

} // class ActionItem
