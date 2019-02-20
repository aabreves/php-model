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
class HtmlModel extends HtmlObject{

   /**
    * 
    * custom parameters...
    * @param type $sId
    */
   function __construct( $sId ){
      parent::__construct( "tag", $sId );
      // TO DO: custom object properties...

   } // function __construct()

   /**
    *
    */
   public function getHtmlCode(){
      // TO DO:

      return parent::getHtmlCode();
   } // public function getHtmlCode()

} // class HtmlModel extends HtmlObject