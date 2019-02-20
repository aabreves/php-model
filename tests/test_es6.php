<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<script>


class BaseClass{
   
   constructor(){
      console.log( "BaseClass::constructor" );
   }
   
   render(){
      console.log( "BaseClass::render" );
   }
   
}

class DerivedClass extends BaseClass{
   
   constructor(){
      super();
      this.iTest = 10;
      console.log( "DerivedClass::constructor" );
   }
   
   render(){
      super.render();
      console.log( "DerivedClass::render" );
      console.log( this.iTest );
   }
}


var dcObject = new DerivedClass();
dcObject.render();



</script>