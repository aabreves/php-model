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
 * /var/www/html/maktub/modules/Home/classHomeController.php
 */
require_once("modules/Basic/classBasicController.php");
require_once("classHomeModel.php");
require_once("classHomeView.php");

/**
 * <h4>Definition of class HomeController</h4>
 * <p></p>
 *
 * @author aabreves
 */
class HomeController extends BasicController{

   /**
    *
    */
   public function __construct(){
      parent::__construct();
      $this->className( get_class() );
      
      $this->sModule   = "HOME";
      $this->asActionsMap = [ 
         "home_action_0" => "runHomeAction_0"
      ]; // $this->asActionsMap = [ 
   } // public function __construct()

   /**
    *
    * @param array $asArgv
    * @return type
    */
   protected function runHomeAction_0( array $asArgv ){
      $bReturn = $this->oModel->runDataAction( "home_data_action_0", $asArgv );
      // TODO:
      
      return $bReturn;
   } // private function runHomeAction( array $asArgv ){

} // class HomeController extends BasicController
