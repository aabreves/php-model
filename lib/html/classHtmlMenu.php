<?php
require_once "classHtmlObject.php";

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
<ul class="nav navbar-nav">
   <li class="active">
      <a href="http://localhost/portal_ci3/index.php">
         <span>Home</span>
      </a>
   </li>
   <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
         <span>Page 1 </span>
         <span class="caret"></span>
      </a>
      <ul class="dropdown-menu">
         <li>
            <a href="#">
               <span>Page 1-1</span>
            </a>
         </li>
         <li>
            <a href="#">
               <span>Page 1-2</span>
            </a>
         </li>
      </ul>
   </li>
   <li>
      <a href="#">
         <span>Page 2</span>
      </a>
   </li>
</ul>
*/

/**
 * Description of HtmlMenu
 *
 * @author aabreves
 */
class HtmlMenu extends HtmlObject{
//   private $sId;
//   private $sLabel;
//   private $asItens = [];

   /**
    * 
    * @param type $sId
    * @param type $sLabel
    */
   function __construct( $sId, $sLabel = "" ){
      parent::__construct( "ul", $sId );
      //$this->sLabel = $sLabel;
   } // function __construct( $sId, $sLabel = "" )
   
   /**
    * 
    */
   static function buildDropdownMenu( $jsOptions ){
      
      $sModule = "Module";
      $jaModMenus = json_decode( $jsOptions );
      
      $hmnModuleMenu = new HtmlMenu( "hmn".$sModule."Menu" );
      $hmnModuleMenu->setAttributes( [ "class" => "nav navbar-nav navbar-left" ] );
   
      $ahmiMenus = [];
      foreach ( $jaModMenus as $joModMenu ){
         $hmiModuleMenu = new HtmlMenuItem( $joModMenu->id,
                                            $joModMenu->caption,
                                            false,
                                            "#" );
         
         $hmiModuleMenu->setIcon( $joModMenu->icon[0],
                                  "left" );

         $hmiModuleMenu->getAnchor()->setAttributes( [ 
            "class" => "dropdown-toggle",
            "data-toggle" => "dropdown" 
         ] );

               $sDropdownId = $joModMenu->id . "_dropdown";
               $hmnDropdownModuleMenu = new HtmlMenu( $sDropdownId );
               $hmnDropdownModuleMenu->setAttributes( [ "class" => "dropdown-menu" ] );

               $ahmiItems = [];
               foreach ( $joModMenu->items as $joMenuItem ){
                     $hmiModuleItem = new HtmlMenuItem( $joMenuItem->id,
                                                        $joMenuItem->caption,
                                                        $joMenuItem->setOnclick,
                                                        $joMenuItem->href,
                                                        $joMenuItem->target );
                     $hmiModuleItem->setIcon( $joMenuItem->icon[0],
                                                "left" );
                     
                     $ahmiItems[] = $hmiModuleItem;
               } // foreach ( $joModMenu->items as $joMenuItem ){

               $hmnDropdownModuleMenu->addObjects( $ahmiItems );

         $hmiModuleMenu->addObjects( [$hmnDropdownModuleMenu ] );
         
         $ahmiMenus[] = $hmiModuleMenu;
      } // foreach ( $jaModMenus as $joModMenu ){

      $hmnModuleMenu->addObjects( $ahmiMenus );
      
      return $hmnModuleMenu;
      
   } // static function buildDropdownMenu( $jsOptions ){

} // class HtmlMenu

/**
 * 
 */
class HtmlMenuItem extends HtmlObject{

   private $sCaption = "";
//   private $sHref    = "#";
//   private $sOnclick = "";

   private $sIconClass = "";
   private $sIconPosition = "left";

   private $aAnchor = null;

   /**
    *
    * @param type $sId
    * @param type $sCaption
    * @param type $bOnclick
    * @param type $sHref
    */
   function __construct( $sId, $sCaption, $bOnclick = true, $sHref = "", $sTarget="_self" ){
      parent::__construct( "li", $sId );

      $this->aAnchor = new HtmlObject( "a", "a_$sId" );

      $this->sCaption = $sCaption;
      if ( $bOnclick ){
         $this->aAnchor->setAttributes( [ "href"    => "javascript:void(0)",
                                          "onclick" => $sId."_onclick()" ] );
      }
      else{
         $this->aAnchor->setAttributes( [ "href"    => $sHref,
                                          "target" => "$sTarget" ] );
      }

      $this->addObject( $this->aAnchor );

   } // function __construct( $sId, $sCaption, $sHref, $bOnclick )

   /**
    *
    * @param type $sIconClass
    * @param type $sIconPosition
    */
   function setIcon( $sIconClass, $sIconPosition = "left" ){
      $this->sIconClass    = $sIconClass;
      $this->sIconPosition = $sIconPosition;
   } // function setIcon( $sIconClass, $sIconPosition = "left" )

   /**
    *
    * @return type
    */
   function getAnchor(){
      return $this->aAnchor;
   } // function getAnchor()

   /**
    *
    */
   private function buildMenuItem(){

      $spnCaption = new HtmlObject( "span" );
      $spnCaption->setText( $this->sCaption );

      $spnIcon = null;
      if ( $this->sIconClass !== "" ){
         $spnIcon = new HtmlObject( "span" );
         $spnIcon->setAttributes( [ "class" => $this->sIconClass] );
      } // if ( $this->sIconClass !== "" )

      if ( $spnIcon !== null ){
         if ( $this->sIconPosition === "left"){
            $this->aAnchor->addObjects( [$spnIcon, $spnCaption] );
         }
         else{
            $this->aAnchor->addObjects( [$spnCaption, $spnIcon] );
         }
      } // if ( $spnIcon !== null )
      else{
         $this->aAnchor->addObject( $spnCaption );
      } // if ( $spnIcon !== null ) .. else

   } // private function buildMenuItem()

   /**
    *
    */
   function getHtmlCode(){

      $this->buildMenuItem();

      return parent::getHtmlCode();
   } // function getHtmlCode()

} // class HtmlMenuItem extends HtmlObject