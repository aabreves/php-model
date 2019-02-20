/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
'use strict';

/**
 *
 * @returns {undefined}
 */
function hmiHomeMenu_option1_onclick(){
   debugMsg( 'hmiHomeMenu_option1_onclick' );
} /* function hmiHomeMenu_option1_onclick(){ */

/**
 *
 * @returns {undefined}
 */
function hmiHomeMenu_option2_onclick(){
   debugMsg( 'hmiHomeMenu_option2_onclick' );
} /* function hmiHomeMenu_option2_onclick(){ */

/**
 *
 * @returns {undefined}
 */
var requestAppHome = function(){
   debugMsg( 'function requestAppHome: ' );
   /* requestMVC( module, action, view, argv ) */
   requestMVC( "Home", "none", "default", "" );
}; /* function requestAppHome() */

/* requestAppHome(); */