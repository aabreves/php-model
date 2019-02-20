<?php

function testJsonSyntax(){   
   $jsOptions = '[ {' 
      . '"id" : "hmnHomeMenu_options",'
      . '"type" : "dropdown",'
      . '"caption" : "home",'
      . '"setOnclick" : "false",'
      . '"href" : "#",'
      . '"items" : [ {'
               . '"id" : "hmiHomeMenu_option1",'
               . '"type" : "final",'
               . '"caption" : "home 1",'
               . '"setOnclick" : "true",'
               . '"href" : "",'
               . '"items" : []'
            . '},{'
               . '"id" : "hmiHomeMenu_option2",'
               . '"type" : "final",'
               . '"caption" : "home 2",'
               . '"setOnclick" : "true",'
               . '"href" : "",'
               . '"items" : []'
            . '}'
      . ']'
   . '} ]';

   echo "json string<br />";
   print_r( $jsOptions );


   echo "<br /><br />";

   $joObject = json_decode( $jsOptions );

   echo "json object<br />";
   echo "<pre>";
   if ( $joObject ){
      print_r( $joObject );
   }
   else{
      echo json_last_error_msg();
   }
   echo "</pre>";
} // function testJsonSyntax(){

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

testJsonSyntax();