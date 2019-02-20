/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
'use strict';
         
/**
 * 
 * @param {type} sLang
 * @returns {undefined}
 */
function flag_onclick( sLang ){
//   var href = urlAddParameter( location.href, "lang", sLang );
//   alert( href );
//   //window.location.href='index.php?lang='+sLang;
//   window.location.reload(true);
//   window.location = href + "?lang=" + sLang;
   document.getElementById( "hidLang" ).value = sLang;
   document.getElementById( "frmLang" ).submit();
} /* function flag_onclick( sLang ){ */

