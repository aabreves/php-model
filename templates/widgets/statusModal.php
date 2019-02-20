<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

      <!-- Modal -->
      <div id="divStatusModal"
           class="modal"
           role="dialog" >
         <div class="modal-dialog"
              style="top:100px;">

            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button"
                          class="close"
                          data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Status</h4>
               </div>
               <div id="divStatusText"
                    class="modal-body">
                  <p>Some text in the modal.</p>
               </div>
               <div class="modal-footer">
                  <button type="button"
                          class="btn btn-default"
                          data-dismiss="modal">Close</button>
               </div>
            </div>

         </div>
      </div> <!-- <div id="divStatusModal" -->

      <script id="scrModal"
              type="text/javascript">

         function showModal(){
            console.log( 'showModal' );
            $( '#divStatusModal' ).modal( "show" );
         } /* function showModal(){ */
      </script>