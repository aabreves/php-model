<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$sJson = '{ name:"isto é um teste"}';

?>
<h4 id="h4Test"></h4>
<script>
    var oJson = JSON.parse( '<? echo utf8_decode( $sJson );?>' );
    //alert( decodeURIComponent( escape( oJson.msg ) ) );
    //alert( unescape( encodeURIComponent( oJson.msg ) ) );
    alert( oJson.msg );

    console.log( decodeURIComponent( escape( oJson.msg ) ) );
    console.log( decodeURIComponent( oJson.msg ) );
    console.log( unescape( encodeURIComponent( oJson.msg ) ) );
    console.log( oJson.msg );

    function test(){
      document.getElementById( "h4Test" ).innerHTML = oJson.msg;
    }

</script>
<h4>'<? echo $sJson;?>'</h4>

