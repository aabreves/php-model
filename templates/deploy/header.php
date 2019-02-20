<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<nav id="navDefaultNavBar"
     class="navbar navbar-inverse navbar-fixed-top"
     style="margin:0">
   <div id="divNavBarWrapper"
        class="container-fluid">
      <div class="navbar-header">
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
            <i class="br flag"></i>
            <span>Breves</span>
         </a>
      </div>
      <div id="divNavBarOptions"
           class="collapse navbar-collapse">
         <ul id='hmnLeftMenu'
             class='nav navbar-nav' >
            <li id='hmiDeploy'
                class='' >
               <a id='a_hmiDeploySidebar'
                  href='javascript:void(0)'
                  onclick='a_hmiDeploySidebar_onclick()' >
                  <i class="sidebar red icon"></i>
                  <span>Deploy</span>
               </a>
            </li>
         </ul> <!-- <ul id='hmnLeftMenu'  -->

         <?php
         echo $this->options;
         ?>
      </div> <!-- <div id="divNavBarOptions" -->
   </div> <!-- <div id="divNavBarWrapper" -->
</nav> <!-- <nav id="navDefaultNavBar" -->

<script>
   $( function(){
      $( '.context.deploy-side-bar .ui.sidebar' )
              .sidebar( {
                 context: $( '.context.deploy-side-bar .bottom.segment' )
              } ).sidebar( 'attach events', '.context.deploy-side-bar .menu .item' );

      $( '.menu .item' ).tab();
   } ); /* $( function(){ */

   function aBrand_onclick(){
      window.location.href = 'index.php?reload=1';
   } /* function aBrand_onclick(){ */

   function a_hmiDeploySidebar_onclick(){
      $( '#divDeploySideBarOptions' ).sidebar( 'toggle' );
   } /* function a_hmiSidebar_onclick(){ */
</script>

<div id="divContainer"
     class="container-fluid"
     style="padding:0;margin-top:50px;height:100%">

   <!--  ON footer.php
   </div>
   -->