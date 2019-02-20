<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$bShowFormWrapper = false;
if ( isset( $this->form_view ) && $this->form_view !== "" ){
   $bShowFormWrapper = true;
}
?>
      <style>
         .slide-container{
            width:90%;
            min-height:90%;
            margin:auto;
         }

         .slide:target{
            display:block;
         }
      </style>

      <nav id="navDefaultNavBar"
           class="navbar navbar-inverse navbar-fixed-top"
           style="margin:0">
         <div id="divNavBarWrapper"
              class="container-fluid">
            <div id="divNavBarHeader"
                 class="navbar-header">
               <button type="button"
                       class="navbar-toggle"
                       data-toggle="collapse"
                       data-target="#divNavBarOptions">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
               </button>

               <a id="aBrand"
                  class="navbar-brand"
                  href="javascript:void(0)"
                  onclick='aBrand_onclick()'>
                  <i id="iBrFlag"
                     class="br flag" 
                     onclick="flag_onclick('pt-br')"></i>
                  <i id="iUsFlag"
                     class="us flag" 
                     onclick="flag_onclick('en')"></i>
                  <span>PHP MODEL 1.0 - template starter</span>
               </a> <!-- <a id="aBrand" -->
            </div> <!-- <div id="divNavBarHeader" -->
            <div id="divNavBarOptions"
                 class="collapse navbar-collapse">
               <?php
                  $jsOptions = self::$modOptions;   
                  $modOptions = HtmlMenu::buildDropdownMenu( $jsOptions );
                  echo $modOptions;
               ?>               
            </div> <!-- <div id="divNavBarOptions" -->
         </div> <!-- <div id="divNavBarWrapper" -->
      </nav> <!-- <nav id="navDefaultNavBar" -->
      <!-- ********** ********** ********** ********** ********** ********** ********** -->
      <script id="scrLanguage"
              src="js/language.js"
              type="text/javascript"></script>
      <!-- ********** ********** ********** ********** ********** ********** ********** -->
      <script>
         /**
          * 
          * @returns {undefined}
          */
         function aBrand_onclick(){
            window.location.assign( "index.php" );
         } /* function aBrand_onclick(){ */
      </script>
      <!-- ********** ********** ********** ********** ********** ********** ********** -->
      <div id="divContainer"
           class="container-fluid"
           style="padding:0;margin-top:50px;height:100%">