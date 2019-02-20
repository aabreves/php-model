<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<!-- FROM header.php
<div id="divContainer"
     class="container-fluid"
     style="margin-top:50px">
-->
<!-- CUSTOM CONTENT -->


</div> <!-- <div id="divContainer" ... -->

<div id="divFooter" class="container-fluid">
</div>

<?php
require_once( __DIR__."/../widgets/statusModal.php" );
?>

<?php
require_once( __DIR__."/../widgets/statusDimmer.php" );
?>
      
<script id="scrClock"
        type="text/javascript">
   /* ********** ********** ********** */
   function startTime(){
      var today = new Date();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);
      var spnClockVal = document.getElementById('spnClockVal');
      if ( spnClockVal ){
         spnClockVal.innerHTML = today.toLocaleString(); // + " - " + h + ":" + m + ":" + s;
      } /* if ( spnClockVal ) */
       
       var t = setTimeout(startTime, 500);
   } /* function startTime() */
   
   function checkTime(i){
      if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
         return i;
   } /* function checkTime(i) */
   
   startTime();
</script> <!-- <script id="scrClock" type="text/javascript"> -->