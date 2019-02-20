<?php 
//      Message Box 
//         ATENÇÃO: utiliza bootstrap e semantic-ui juntos
//         modal   bootstrap
//         message semantic-ui
?>

      <div id="divMessageBoxWrapper" 
           class="modal fade" 
           role="dialog">
         <input id="hidShowMessageBox" 
                type="hidden" 
                data-toggle="modal" 
                data-target="#divMessageBoxWrapper" />
         <div id="divMessageBoxDialog"
              class="modal-dialog">

            <div id="divMessage"
                 class="ui message">
               <div id="divMessageHeader"
                    class="modal-header"
                    style="background-color: #eee">
                  <button type="button"
                          class="close" 
                          data-dismiss="modal">&times;</button>
                  <h4 id="h4HeaderTitle"
                      class="modal-title">Modal Header</h4>
                  <p id="pHeaderInfo"></p>
               </div> <!-- <div id="divMessageHeader" -->
               <div id="divMessageBody"
                    class="modal-body">
                     <p id="pMessage"></p>
               </div> <!-- <div id="divMessageBody" -->
               <div  id="divMessageFooter"
                     class="modal-footer">
                  <button id="cmdCloseMB"
                          type="button" 
                          class="btn btn-default ui basic button" 
                          data-dismiss="modal">Fechar</button>
               </div> <!-- <div  id="divMessageFooter" -->
            </div> <!-- <div id="divMessage" -->

         </div> <!-- <div id="divMessageBoxDialog" -->
      </div> <!-- <div id="divMessageBoxWrapper"  -->

      <script type="text/javascript">
         'use strict';

         /**
          * 
          * @param {type} oMessage - object - { text: '',
          *                                     type: '',
          *                                     title: '' }
          * 
          * types: error, warning, info or success (default)
          * 
          * @returns {undefined}
          */
         function showMessageBox( oMessage ){

            console.log( "showMessageBox: " + oMessage.text );
            var divMessage    = $( "#divMessage" );
            var h4HeaderTitle = $( '#h4HeaderTitle' );
            var pHeaderInfo   = $( '#pHeaderInfo' );
            var pMessage = $( '#pMessage' );
            var cmdCloseMB    = $( '#cmdCloseMB' );

            divMessage.removeClass( 'error warning info success' );
            cmdCloseMB.removeClass( 'error warning info success' );

            var sClass = '';
            var sHeader = '';
            var sMsgType = oMessage.type.toLowerCase();
            switch ( sMsgType ){
               case 'error':
                  sClass  = 'error';
                  sHeader = 'ERRO';
                  break;
               case 'warning':
                  sClass  = 'warning';
                  sHeader = 'ATENÇÃO';
                  break;
               case 'info':
                  sClass  = 'info';
                  sHeader = 'AVISO';
                  break;
               case 'success':
               default:
                  sClass  = 'success';
                  sHeader = 'SUCESSO';
                  break;

            } /* switch ( sMsgType ){ */
            
            divMessage.addClass( sClass );
            cmdCloseMB.addClass( sClass );            
         
            if ( oMessage.text !== "" ){
               pMessage.html( oMessage.text );
            } /* if ( oMessage.text !== "" ){ */
            
            h4HeaderTitle.html( sHeader );
            if ( oMessage.title !== "" ){
               pHeaderInfo.html( oMessage.title );
            } /* if ( oMessage.title !== "" ){ */
            
            var hidShowMessageBox = document.getElementById( 'hidShowMessageBox' );
            hidShowMessageBox.click();

         } /* function showMessageBox( sMessage ){ */

      </script>