/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
'use strict';

var RESP_MAX_WIDTH = 600;
var g_sResponsive = "";

function requestAppStarter(){
    debugMsg( 'function requestAppStarter: ' );

    bdyBody_onresize();

    var sArgs = "";
    sArgs += "innerHeight=" + window.innerHeight;
    sArgs += "&innerWidth=" + window.innerWidth;
    sArgs += "&height=" + screen.height;
    sArgs += "&width=" + screen.width;
    sArgs += "&availHeight=" + screen.availHeight;
    sArgs += "&availWidth=" + screen.availWidth;

    requestMVC( "Starter", "none", "starter", sArgs );
} /* function requestAppStarter() */

function bdyBody_onresize(){
    debugMsg( 'function bdyBody_onresize: ' + window.innerWidth );
    if ( window.innerWidth < RESP_MAX_WIDTH ){
        g_sResponsive = "responsive";
    }
    else{
        g_sResponsive = "";
    }
} /* function bdyBody_onresize() */

function gotoSlide(sOrigin,sTarget){
    debugMsg( "function gotoSlide" );
    document.getElementById(sOrigin).style.display = "none";
    document.getElementById(sTarget).style.display = "block";
} /* function  gotoWall(origin,target) */

/*
 *  1500 / 1200 --- 300
 *  1737 / 1600 --- 137
 *
 *  300 - 140 == 160
 *  137 - 81  == 56
 */
