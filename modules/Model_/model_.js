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
function hmiModel_Menu_option1_onclick(){
   debugMsg( 'hmiModel_Menu_option1_onclick' );
} /* function hmiModel__Menu_option1_onclick() */

/**
 *
 * @returns {undefined}
 */
function hmiModel_Menu_option2_onclick(){
   debugMsg( 'hmiModel_Menu_option2_onclick' );
} /* function hmiModel__Menu_option2_onclick() */

/**
 *
 * @returns {undefined}
 */
var requestAppModel_ = function(){
   debugMsg( 'function requestAppModel_: ' );
   /* requestMVC( module, action, view, argv ) */
   requestMVC( "Model_", "none", "default", "" );
}; /* function requestAppModel_() */

/* requestAppModel_(); */