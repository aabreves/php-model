/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
'use strict';

/**
 *
 * @param {type} formId
 * @returns {Array}
 */
function getJsonFromForm( formId ){
   formId = "#" + formId;

   var sendInfo = {};
   $( formId ).serializeArray( ).map( function( item ){
      if ( sendInfo[item.name] ){
         if ( typeof ( sendInfo[item.name] ) === "string" ){
            sendInfo[item.name] = [sendInfo[item.name]];
         } /* if ( typeof ( sendInfo[item.name] ) === "string" ) { */
         sendInfo[item.name].push( item.value );
      } /* if ( sendInfo[item.name] ) { */
      else{
         sendInfo[item.name] = item.value;
      } /* if ( sendInfo[item.name] ) { .. else */
   } ); /* $( "#formContainer" ).serializeArray( ).map( function( item ) { */

   return sendInfo;
} /* function getJsonFromForm( formId ){ */

/**
 * 
 * @param {type} url
 * @param {type} param
 * @param {type} value
 * @returns {.document@call;createElement.href|parser.href|urlAddParameter.parser.href}
 */
function urlAddParameter( url, param, value ){
   var hash = {};
   var parser = document.createElement( 'a' );

   parser.href = url;

   var parameters = parser.search.split( /\?|&/ );

   for ( var i = 0; i < parameters.length; i++ ){
      if ( !parameters[i] )
         continue;

      var ary = parameters[i].split( '=' );
      hash[ary[0]] = ary[1];
   } /* for ( var i = 0; i < parameters.length; i++ ){ */

   hash[param] = value;

   var list = [];
   Object.keys( hash ).forEach( function( key ){
      list.push( key + '=' + hash[key] );
   } ); /* Object.keys( hash ).forEach( function( key ){ */

   parser.search = '?' + list.join( '&' );
   return parser.href;
} /* function urlAddParameter( url, param, value ){ */