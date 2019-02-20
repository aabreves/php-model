<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$format = "dd/mm/yyyy";
$sDate = "01/01/2019";

$oTest = (object)[ "message" => "isto &eacute; um teste"
];

$sJson = '{ "msg":"isto &#xE9; um teste" }';

print_r( $oTest );
echo "<br />";
print_r( $sJson );
echo "<br />";

echo "json_encode<br />";
$oJson = json_encode( $sJson, JSON_UNESCAPED_UNICODE );
print_r( $oJson );
echo "<br />";

echo "json_decode<br />";
$sJson = json_decode( $oJson );
print_r( $sJson );
echo "<br />";

