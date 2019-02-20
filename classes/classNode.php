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
require_once "classes/classObjectModel.php";

/**
 * <h4>Definition of class Node</h4>
 * /var/www/html/maktub/classes/classNode.php
 *
 * <p>Node types</p>
 * <ul>
 *    <li>0 - ROOT Node</li>
 *    <li>1 - System Node</li>
 *    <li>2 - Companies Node</li>
 *    <li>3 - Company Node</li>
 *    <li>4 - Users Node</li>
 *    <li>5 - User Node</li>
 *    <li>6 - ??? Node</li>
 * </ul>
 *
 * @author aabreves
 */
class Node extends ObjectModel{

   private $anNodes = [];

   static $iNodeIdCtl = 0;

   /**
    *
    * creates a Database object and a connection with the server
    *
    * @param string $sDriver
    * @param array  $asConnInfo - assoc array ([ "host"], [ "user"], [ "pass"])
    */
   function __construct(){
      parent::__construct();

      $this->defineProperties( [ "nod_i4_uid"             => "",
                                 "nod_fk_usr_i4_uid"      => "1",
                                 "nod_i4_parent_node_uid" => "0",
                                 "nod_s32_name"           => "root",
                                 "nod_s256_description"   => "",
                                 "nod_i1_type"            => "",
                                 "nod_i2_action_type"     => "",
                                 "nod_i2_action_code"     => "",
                                 "nod_s256_action_data"   => "",
                                 "nod_s256_state1_style"  => "",
                                 "nod_s256_state2_style"  => "",
                                 "nod_s32_icon1"          => "",
                                 "nod_s32_icon2"          => "",
                                 "nod_s256_icon1_style"   => "",
                                 "nod_s256_icon2_style"   => "",
                                 "nod_i1_active"          => "",
                                 "nod_i1_visible"         => "" ] );
   } // function __construct()

   /**
    *
    * @param type $nod_fk_usr_i4_uid
    * @param type $nod_i4_parent_node_uid
    * @param type $nod_s32_name
    * @param type $nod_s256_description
    * @param type $nod_i1_type
    * @param type $nod_i2_action_type
    * @param type $nod_i2_action_code
    * @param type $nod_s256_action_data
    * @param type $nod_s256_state1_style
    * @param type $nod_s256_state2_style
    * @param type $nod_s32_icon1
    * @param type $nod_s32_icon2
    * @param type $nod_s256_icon1_style
    * @param type $nod_s256_icon2_style
    * @param type $nod_i1_active
    * @param type $nod_i1_visible
    * @return $this
    */
   public static function _createNode( $nod_fk_usr_i4_uid,
                                       $nod_s32_name,
                                       $nod_s256_description,
                                       $nod_i1_type,
                                       $nod_i2_action_type,
                                       $nod_i2_action_code,
                                       $nod_s256_action_data,
                                       $nod_s256_state1_style,
                                       $nod_s256_state2_style,
                                       $nod_s32_icon1,
                                       $nod_s32_icon2,
                                       $nod_s256_icon1_style,
                                       $nod_s256_icon2_style,
                                       $nod_i1_active,
                                       $nod_i1_visible ){

      $nodNew = new Node();

      $nodNew->nod_i4_uid             = Node::$iNodeIdCtl++;
      $nodNew->nod_fk_usr_i4_uid      = $nod_fk_usr_i4_uid;
      $nodNew->nod_i4_parent_node_uid = 0;
      $nodNew->nod_s32_name           = $nod_s32_name;
      $nodNew->nod_s256_description   = $nod_s256_description;
      $nodNew->nod_i1_type            = $nod_i1_type;
      $nodNew->nod_i2_action_type     = $nod_i2_action_type;
      $nodNew->nod_i2_action_code     = $nod_i2_action_code;
      $nodNew->nod_s256_action_data   = $nod_s256_action_data;
      $nodNew->nod_s256_state1_style  = $nod_s256_state1_style;
      $nodNew->nod_s256_state2_style  = $nod_s256_state2_style;
      $nodNew->nod_s32_icon1          = $nod_s32_icon1;
      $nodNew->nod_s32_icon2          = $nod_s32_icon2;
      $nodNew->nod_s256_icon1_style   = $nod_s256_icon1_style;
      $nodNew->nod_s256_icon2_style   = $nod_s256_icon2_style;
      $nodNew->nod_i1_active          = $nod_i1_active;
      $nodNew->nod_i1_visible         = $nod_i1_visible;

      return $nodNew;
   } // public function _createNode( $nod_fk_usr_i4_uid, ...

   /**
    * <p>Usage:</p>
    * ::createNodeFromArray( [<br />
    * &nbsp;&nbsp;"nod_fk_usr_i4_uid"      => fk_usr_i4_uid,<br />
    * &nbsp;&nbsp;"nod_s32_name"           => s32_name,<br />
    * &nbsp;&nbsp;"nod_s256_description"   => s256_description,<br />
    * &nbsp;&nbsp;"nod_i1_type"            => i1_type,<br />
    * &nbsp;&nbsp;"nod_i2_action_type"     => i2_action_type,<br />
    * &nbsp;&nbsp;"nod_i2_action_code"     => i2_action_code,<br />
    * &nbsp;&nbsp;"nod_s256_action_data"   => s256_action_data,<br />
    * &nbsp;&nbsp;"nod_s256_state1_style"  => s256_state1_style,<br />
    * &nbsp;&nbsp;"nod_s256_state2_style"  => s256_state2_style,<br />
    * &nbsp;&nbsp;"nod_s32_icon1"          => s32_icon1,<br />
    * &nbsp;&nbsp;"nod_s32_icon2"          => s32_icon2,<br />
    * &nbsp;&nbsp;"nod_s256_icon1_style"   => s256_icon1_style,<br />
    * &nbsp;&nbsp;"nod_s256_icon2_style"   => s256_icon2_style,<br />
    * &nbsp;&nbsp;"nod_i1_active"          => i1_active,<br />
    * &nbsp;&nbsp;"nod_i1_visible"         => i1_visible<br />
    * ] );
    *
    * <p>Node types (nod_i1_type)</p>
    * <ul>
    *    <li>0 - ROOT Node</li>
    *    <li>1 - System Node</li>
    *    <li>2 - Companies Node</li>
    *    <li>3 - Company Node</li>
    *    <li>4 - Users Node</li>
    *    <li>5 - User Node</li>
    *    <li>6 - ??? Node</li>
    * </ul>
    *
    * @param array $asNode
    * @return \Node
    */
   public static function _createNodeFromArray( array $asNode ){

      $nodNew = new Node();

      $nodNew->nod_i4_uid             = Node::$iNodeIdCtl++;
      $nodNew->nod_fk_usr_i4_uid      = isset( $asNode["nod_fk_usr_i4_uid"] )       ? trim( $asNode["nod_fk_usr_i4_uid"] )      :  1;
      $nodNew->nod_i4_parent_node_uid = -1;
      $nodNew->nod_s32_name           = isset( $asNode["nod_s32_name"] )            ? trim( $asNode["nod_s32_name"] )           : "";
      $nodNew->nod_s256_description   = isset( $asNode["nod_s256_description"] )    ? trim( $asNode["nod_s256_description"] )   : "";
      $nodNew->nod_i1_type            = isset( $asNode["nod_i1_type"] )             ? trim( $asNode["nod_i1_type"] )            :  1;
      $nodNew->nod_i2_action_type     = isset( $asNode["nod_i2_action_type"] )      ? trim( $asNode["nod_i2_action_type"] )     :  1;
      $nodNew->nod_i2_action_code     = isset( $asNode["nod_i2_action_code"] )      ? trim( $asNode["nod_i2_action_code"] )     :  1;
      $nodNew->nod_s256_action_data   = isset( $asNode["nod_s256_action_data"] )    ? trim( $asNode["nod_s256_action_data"] )   : "";
      $nodNew->nod_s256_state1_style  = isset( $asNode["nod_s256_state1_style"] )   ? trim( $asNode["nod_s256_state1_style"] )  : "color:red;";
      $nodNew->nod_s256_state2_style  = isset( $asNode["nod_s256_state2_style"] )   ? trim( $asNode["nod_s256_state2_style"] )  : "color:red;background-color:rgb(170, 255, 170);";
      $nodNew->nod_s32_icon1          = isset( $asNode["nod_s32_icon1"] )           ? trim( $asNode["nod_s32_icon1"] )          : "fa fa-folder";
      $nodNew->nod_s32_icon2          = isset( $asNode["nod_s32_icon2"] )           ? trim( $asNode["nod_s32_icon2"] )          : "fa fa-folder-open";
      $nodNew->nod_s256_icon1_style   = isset( $asNode["nod_s256_icon1_style"] )    ? trim( $asNode["nod_s256_icon1_style"] )   : "color:red";
      $nodNew->nod_s256_icon2_style   = isset( $asNode["nod_s256_icon2_style"] )    ? trim( $asNode["nod_s256_icon2_style"] )   : "color:green";
      $nodNew->nod_i1_active          = isset( $asNode["nod_i1_active"] )           ? trim( $asNode["nod_i1_active"] )          :  1;
      $nodNew->nod_i1_visible         = isset( $asNode["nod_i1_visible"] )          ? trim( $asNode["nod_i1_visible"] )         :  1;

      return $nodNew;
   } // public static function _createNodeFromArray( array $asNode ){

   /**
    * CSV DATA
    * fk_usr_i4_uid;s32_name;s256_description;i1_type;i2_action_type;i2_action_code
    * s256_action_data;[s256_state1_style;s256_state2_style;s32_icon1;s32_icon2;
    * s256_icon1_style;s256_icon2_style;i1_active;i1_visible]
    *
    * @param type $csvNode
    * @return $this
    */
   public static function _createNodeFromCSV( $csvNode ){
      $asNode = explode( ";", $csvNode );

      $nodNew = new Node();

      $nodNew->nod_i4_uid             = Node::$iNodeIdCtl++;
      $nodNew->nod_fk_usr_i4_uid      = isset( $asNode[0] )   ? trim( $asNode[0] )  :  1;
      $nodNew->nod_i4_parent_node_uid = 0;
      $nodNew->nod_s32_name           = isset( $asNode[1] )   ? trim( $asNode[1] )  : "";
      $nodNew->nod_s256_description   = isset( $asNode[2] )   ? trim( $asNode[2] )  : "";
      $nodNew->nod_i1_type            = isset( $asNode[3] )   ? trim( $asNode[3] )  :  1;
      $nodNew->nod_i2_action_type     = isset( $asNode[4] )   ? trim( $asNode[4] )  :  1;
      $nodNew->nod_i2_action_code     = isset( $asNode[5] )   ? trim( $asNode[5] )  :  1;
      $nodNew->nod_s256_action_data   = isset( $asNode[6] )   ? trim( $asNode[6] )  : "";
      $nodNew->nod_s256_state1_style  = isset( $asNode[7] )   ? trim( $asNode[7] )  : "color:red;";
      $nodNew->nod_s256_state2_style  = isset( $asNode[8] )   ? trim( $asNode[8] )  : "color:red;background-color:rgb(170, 255, 170);";
      $nodNew->nod_s32_icon1          = isset( $asNode[9] )   ? trim( $asNode[9] )  : "fa fa-folder";
      $nodNew->nod_s32_icon2          = isset( $asNode[10] )  ? trim( $asNode[10] ) : "fa fa-folder-open";
      $nodNew->nod_s256_icon1_style   = isset( $asNode[11] )  ? trim( $asNode[11] ) : "color:red";
      $nodNew->nod_s256_icon2_style   = isset( $asNode[12] )  ? trim( $asNode[12] ) : "color:green";
      $nodNew->nod_i1_active          = isset( $asNode[13] )  ? trim( $asNode[13] ) :  1;
      $nodNew->nod_i1_visible         = isset( $asNode[14] )  ? trim( $asNode[14] ) :  1;

      return $nodNew;
   } // public static function _createNodeFromCSV( $csvNode ){

   /**
    *
    * @param Node $nodNode
    * @return \Node - the added node
    */
   public function addNode( Node $nodNode ){
      $nodNode->nod_i4_parent_node_uid = $this->nod_i4_uid;
      $this->anNodes[] = $nodNode;

      return $nodNode;
   } // public function addNode( Node $nodNode ){

   /**
    *
    * Properties:
    * "nod_i4_uid"             => "",
      "nod_fk_usr_i4_uid"      => "1",
      "nod_i4_parent_node_uid" => "0",
      "nod_s32_name"           => "root",
      "nod_s256_description"   => "",
      "nod_i1_type"            => "",
      "nod_i2_action_type"     => "",
      "nod_i2_action_code"     => "",
      "nod_s256_action_data"   => "",
      "nod_s256_state1_style"  => "",
      "nod_s256_state2_style"  => "",
      "nod_s32_icon1"          => "",
      "nod_s32_icon2"          => "",
      "nod_s256_icon1_style"   => "",
      "nod_s256_icon2_style"   => "",
      "nod_i1_active"          => "",
      "nod_i1_visible"         => ""
    *
    * @param type $asInputData
    */
   public function insertNode( $asInputData ){
      // Performs some database action...
      $mainDB = APP::_loadObject( MAIN_DB, "database", Session::_get( MAIN_DB_CONN_DATA ) );

      if ( !( $mainDB && $mainDB->isConnected() ) ){
         $this->asData["action_status"]  = "error";
         $this->asData["status_message"] = App::_getText( [ "no_database_access", "main_database" ] );
         return false;
      } // if ( !( $mainDB && $mainDB->isConnected() )

      $asFieldsAndValues = [ "nod_fk_usr_i4_uid"      => isset( $asInputData["nod_fk_usr_i4_uid"] )      ? $asInputData["nod_fk_usr_i4_uid"]      : null,
                             "nod_i4_parent_node_uid" => isset( $asInputData["nod_i4_parent_node_uid"] ) ? $asInputData["nod_i4_parent_node_uid"] : null,
                             "nod_s32_name"           => isset( $asInputData["node_s32_name"] )          ? $asInputData["node_s32_name"]          : null,
                             "nod_s256_description"   => isset( $asInputData["nod_s256_description"] )   ? $asInputData["nod_s256_description"]   : null,
                             "nod_i1_type"            => isset( $asInputData["nod_i1_type"] )            ? $asInputData["nod_i1_type"]            : "1",
                             "nod_i2_action_type"     => isset( $asInputData["nod_i2_action_type"] )     ? $asInputData["nod_i2_action_type"]     : null,
                             "nod_i2_action_code"     => isset( $asInputData["nod_i2_action_code"] )     ? $asInputData["nod_i2_action_code"]     : null,
                             "nod_s256_action_data"   => isset( $asInputData["nod_s256_action_data"] )   ? $asInputData["nod_s256_action_data"]   : null,
                             "nod_s256_state1_style"  => isset( $asInputData["nod_s256_state1_style"] )  ? $asInputData["nod_s256_state1_style"]  : null,
                             "nod_s256_state2_style"  => isset( $asInputData["nod_s256_state2_style"] )  ? $asInputData["nod_s256_state2_style"]  : null,
                             "nod_s32_icon1"          => isset( $asInputData["nod_s32_icon1"] )          ? $asInputData["nod_s32_icon1"]          : null,
                             "nod_s32_icon2"          => isset( $asInputData["nod_s32_icon2"] )          ? $asInputData["nod_s32_icon2"]          : null,
                             "nod_s256_icon1_style"   => isset( $asInputData["nod_s256_icon1_style"] )   ? $asInputData["nod_s256_icon1_style"]   : null,
                             "nod_s256_icon2_style"   => isset( $asInputData["nod_s256_icon2_style"] )   ? $asInputData["nod_s256_icon2_style"]   : null,
                             "nod_i1_active"          => "1",
                             "nod_i1_visible"         => "1" ];

      $iNewNodeUId = $mainDB->insert( "tbl_sys_nodes", $asFieldsAndValues );

      if ( !$iNewNodeUId ){
         $this->asData["action_status"]  = "error";
         $this->asData["status_message"] = App::_getText( "failed_operation" );
         return false;
      } // if ( !$iNewUserId ){

      $this->loadNode( $iNewNodeUId, false );

      $this->asData["action_status"]  = "done";
      $this->asData["status_message"] = App::_getText( "successful_operation" );

      return $this;
   } // public function insertNode( $asProperties ){

   /**
    *
    * Properties:
    *
    * @param type $asProperties
    */
   public function updateNode( $asInputData ){
      // Performs some database action...
      $mainDB = APP::_loadObject( MAIN_DB, "database", Session::_get( MAIN_DB_CONN_DATA ) );

      if ( !( $mainDB && $mainDB->isConnected() ) ){
         $this->asData["action_status"]  = "error";
         $this->asData["status_message"] = App::_getText( [ "no_database_access", "main_database" ] );
         return false;
      } // if ( !( $mainDB && $mainDB->isConnected() ) ){

      $asFieldsAndValues = [ "nod_fk_usr_i4_uid"      => isset( $asInputData["nod_fk_usr_i4_uid"] )      ? $asInputData["nod_fk_usr_i4_uid"]      : 0,
                             "nod_i4_parent_node_uid" => isset( $asInputData["nod_i4_parent_node_uid"] ) ? $asInputData["nod_i4_parent_node_uid"] : null,
                             "nod_s32_name"           => isset( $asInputData["nod_s32_name"] )           ? $asInputData["nod_s32_name"]           : null,
                             "nod_s256_description"   => isset( $asInputData["nod_s256_description"] )   ? $asInputData["nod_s256_description"]   : null,
                             "nod_i1_type"            => isset( $asInputData["nod_i1_type"] )            ? $asInputData["nod_i1_type"]            : "1",
                             "nod_i2_action_type"     => isset( $asInputData["nod_i2_action_type"] )     ? $asInputData["nod_i2_action_type"]     : null,
                             "nod_i2_action_code"     => isset( $asInputData["nod_i2_action_code"] )     ? $asInputData["nod_i2_action_code"]     : null,
                             "nod_s256_action_data"   => isset( $asInputData["nod_s256_action_data"] )   ? $asInputData["nod_s256_action_data"]   : null,
                             "nod_s256_state1_style"  => isset( $asInputData["nod_s256_state1_style"] )  ? $asInputData["nod_s256_state1_style"]  : null,
                             "nod_s256_state2_style"  => isset( $asInputData["nod_s256_state2_style"] )  ? $asInputData["nod_s256_state2_style"]  : null,
                             "nod_s32_icon1"          => isset( $asInputData["nod_s32_icon1"] )          ? $asInputData["nod_s32_icon1"]          : null,
                             "nod_s32_icon2"          => isset( $asInputData["nod_s32_icon2"] )          ? $asInputData["nod_s32_icon2"]          : null,
                             "nod_s256_icon1_style"   => isset( $asInputData["nod_s256_icon1_style"] )   ? $asInputData["nod_s256_icon1_style"]   : null,
                             "nod_s256_icon2_style"   => isset( $asInputData["nod_s256_icon2_style"] )   ? $asInputData["nod_s256_icon2_style"]   : null,
                             "nod_i1_active"          => isset( $asInputData["nod_i1_active"] )          ? $asInputData["nod_i1_active"]          : "1",
                             "nod_i1_visible"         => isset( $asInputData["nod_i1_visible"] )         ? $asInputData["nod_i1_visible"]         : "1" ];

      $asWhere = [ "nod_i4_uid" => $asInputData["nod_i4_uid"] ];
      $mainDB->update( "tbl_sys_nodes", $asFieldsAndValues, $asWhere );

      return $this;

   } // public function updateNode( $asProperties ){

   /**
    *
    * @param type $iNodeUID
    * @param type $bLoadChildren
    */
   public function loadNode( $iNodeUID, $bLoadChildren = true ){
      // Performs some database action...
      $mainDB = APP::_loadObject( MAIN_DB, "database", Session::_get( MAIN_DB_CONN_DATA ) );

      if ( !( $mainDB && $mainDB->isConnected() ) ){
         $this->asData["action_status"]  = "error";
         $this->asData["status_message"] = App::_getText( [ "no_database_access", "main_database" ] );
         return false;
      } // if ( !( $mainDB && $mainDB->isConnected() ) ){

      $sSQL = "SELECT * FROM tbl_sys_nodes WHERE (nod_i4_uid='$iNodeUID') ORDER BY nod_i4_parent_node_uid;";

      if ( !$mainDB->select( $sSQL ) ){
         $this->asData["action_status"]  = "error";
         $this->asData["status_message"] = $mainDB->getErrors();
         return false;
      } // if ( !$mainDB->select( $sSQL) ){

      $workspaceNode = $mainDB->getDataset();

      if ( $workspaceNode ){
         if ( count( $workspaceNode ) === 1 ){
            $this->loadFromArray( $workspaceNode[0] );
            if ( $bLoadChildren ){
               $this->loadNodes( $this->nod_i4_uid, $bLoadChildren );
            } // if ( $bLoadChildren ){
         } // if ( count( $aNode ) === 1 ){
      } // if ( $qryNode ){

      return $this;
   } // public function loadNode( $iNodeUID      = null, ... ){

   /**
    *
    * @param type $iParentNodeUID
    * @param type $bLoadChildren
    */
   private function loadNodes( $iParentNodeUID, $bLoadChildren = true ){
      // Performs some database action...
      $mainDB = APP::_loadObject( MAIN_DB, "database", Session::_get( MAIN_DB_CONN_DATA ) );

      if ( !( $mainDB && $mainDB->isConnected() ) ){
         $this->asData["action_status"]  = "error";
         $this->asData["status_message"] = App::_getText( [ "no_database_access", "main_database" ] );
         return false;
      } // if ( !( $mainDB && $mainDB->isConnected() ) ){

      $sSQL = "SELECT nod_i4_uid FROM tbl_sys_nodes WHERE (nod_i4_parent_node_uid='$iParentNodeUID') ORDER BY nod_i4_uid;";
      if ( !$mainDB->select( $sSQL ) ){
         $this->asData["action_status"]  = "error";
         $this->asData["status_message"] = $mainDB->getErrors();
         return false;
      } // if ( !$mainDB->select( $sSQL) ){

      $nodesChildren = $mainDB->getDataset();

      if ( count( $nodesChildren ) > 0 ){
         foreach ( $nodesChildren as $asNode ){
            $nodChild        = new Node();
            $this->anNodes[] = $nodChild->loadNode( $asNode["nod_i4_uid"], $bLoadChildren );
         } // foreach ( $asNodes as $asNode ){
      } // if ( count( $aResult ) > 0 ){
   } // public function loadNodes( $iParentNodeUID, ... ){

   public function getNodes(){
      return $this->anNodes;
   }

   //function getTreeView_html( $node, $bRoot = false ){
   function getTreeView_html( $bRoot = false ){
      $sHtml = "";

      $iNodeId = $this->nod_i4_uid;
      $sNodeNm = $this->nod_s32_name;
      $iNodeTy = $this->nod_i1_type;

      $sNodeIc1 = $this->nod_s32_icon1;
      $sNodeIc2 = $this->nod_s32_icon2;

      $sNodeState1Style = $this->nod_s256_state1_style;
      $sNodeState2Style = $this->nod_s256_state2_style;
      $sIcon1Style      = $this->nod_s256_icon1_style;
      $sIcon2Style      = $this->nod_s256_icon2_style;

      $iParentNodeId    = $this->nod_i4_parent_node_uid;
      $sNodeDescription = $this->nod_s256_description;

      if ( $bRoot ){
         $sHtml       .= "<ul id='ulRoot' class='list-group'>";
         $sDataParent = "ulRoot";
      } // if ( $bRoot ){
      else{
         $sDataParent = "ulTree_$iParentNodeId";
      } // if ( $bRoot ){ .. else

      $sDataTarget = "";
      $sDataHtml   = "";
      $asNodes     = $this->getNodes();
      $sDataTarget = "ulTree_$iNodeId";
      if ( count( $asNodes ) > 0 ){
         $sDataHtml = "data-tog-gle='coll_apse' data-target='#$sDataTarget' data-parent='#$sDataParent'";
      } // if ( count( $asNodes ) > 0 ){

      $sHtml .= "<li id='liNode_$iNodeId'>";
      $sHtml .= "<a id='aNodeIcon_$iNodeId'"
              ."href='#' $sDataHtml "
              ."class='node-icon' "
              ."data-node-uid='$iNodeId' >";
              //."onclick='aNodeIcon_onclick($iNodeId)' >";
      $sHtml .= "<span id='spnNodeIcon_$iNodeId' "
              ."class='$sNodeIc1' "
              ."data-icon1='$sNodeIc1' "
              ."data-icon2='$sNodeIc2' "
              ."data-icon1-style='$sIcon1Style' "
              ."data-icon2-style='$sIcon2Style' "
              ."data-icon-state='1' "
              ."style='$sIcon1Style'></span></a>";
      $sHtml .= "<a id='aNode_$iNodeId' "
              ."href='#' "
              ."class='node' "
              ."data-target='#$sDataTarget' "
              //."onclick='aNode_onclick($iNodeId)' "
              ."data-node-uid='$iNodeId' "
              ."data-node-type='$iNodeTy' "
              ."data-node-parent-uid='$iParentNodeId' "
              ."data-state='1' "
              ."data-state1-style='$sNodeState1Style' "
              ."data-state2-style='$sNodeState2Style' "
              ."style='$sNodeState1Style' >";
      $sHtml .= "<textarea id='txaNodeDescr_$iNodeId' "
              ."style='display:none;'>$sNodeDescription</textarea><span id='spnNodeName_$iNodeId'> $sNodeNm</span>";
      $sHtml .= "</a>";

      $sHtml .= "<ul id='$sDataTarget' "
              ."class='sublinks collapse'>";
      if ( count( $asNodes ) > 0 ){
         foreach ( $asNodes as $nodNode ){
            $sHtml .= $nodNode->getTreeView_html();
         } // foreach ( $asNodes as $asNode ){
      } // if ( count( $asNodes ) > 0 ){
      $sHtml .= "</ul>";

      $sHtml .= "</li>";

      if ( $bRoot ){
         $sHtml .= "</ul>";
      } // if ( $bRoot ){

      return $sHtml;
   } // function getTreeView_html( $bRoot = false ){
} // class Node