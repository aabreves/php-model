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
 * /var/www/html/maktub/modules/Home/classHomeModel.php
 */
require_once("modules/Basic/classBasicModel.php");

/**
 * <h4>Definition of class HomeModel</h4>
 * <p></p>
 *
 * @author aabreves
 */
class HomeModel extends BasicModel{

   /**
    *
    * 
    */
   public function __construct(){
      parent::__construct();
      $this->className( get_class() );
      
      $this->sModule   = "HOME";
      $this->asActionsMap = [
          "home_data_action_0" => "runHomeDataAction_0"
      ]; // $this->asActionsMap = [
   } // public function __construct()

   /**
    *
    * @param array $asArgv
    * @return boolean
    */
   protected function runHomeDataAction_0( array $asArgv ){
      $bReturn = true;
      // TODO: Performs some database operation...   
      
      $this->asData = [
         "action"  => "$this->sModule::Model::data_action_0",
         "status"  => "done",
         "message" => App::_getText( "successful_operation" )
      ]; // $this->asData = [
      
      return $bReturn;
   } // private function runHomeDataAction_0( array $asArgv ){

} // class HomeModel extends BasicModel
