<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

      <!-- Modal -->
      <div id="divStatusDimmer"
           class="modal"
           role="dialog" >
         <div class="modal-dialog modal-sm"
              style="top:100px;">

            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
               </div>
               <div class="modal-body">
                  <div class="ui segment" 
                       style="height:80px;">
                     <div class="ui active dimmer">
                        <div class="ui text loader">Loading</div>                  
                     </div>
                     <p></p>
                  </div>
               </div>
               <div class="modal-footer">
               </div>
            </div>

         </div>
      </div> <!-- <div id="divStatusDimmer" -->

      <script id="scrDimmer"
              type="text/javascript">

         function showDimmer(){
            console.log( 'showDimmer' );
            $( '#divStatusDimmer' ).modal( "show" );
         } /* function showModal(){ */

         function hideDimmer(){
            console.log( 'hideDimmer' );
            $( '#divStatusDimmer' ).modal( "hide" );
         } /* function showModal(){ */
      </script>