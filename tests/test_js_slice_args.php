<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
   <head>
      <meta charset="UTF-8">
      <title></title>
      <script type="text/javascript">

         function createFlattenedFunc(createVerticesFunc, vertsPerColor) {
           return function(gl) {
             //const arrays = createVerticesFunc.apply(null,  Array.prototype.slice.call(arguments, 1));
             var arrays = Array.prototype.slice.call(arguments, 1);
             //return createFlattenedVertices(gl, arrays, vertsPerColor);
             for( var i in arrays ){
                console.log( arrays[i] );
             }
           };
         }

         // These functions make primitives with semi-random vertex colors.
         // This means the primitives can be displayed without needing lighting
         // which is important to keep the samples simple.

         window.flattenedPrimitives = {
           "create3DFBufferInfo": createFlattenedFunc([1.0, 0.0, 0.0], 1)
         };
         
         var test = flattenedPrimitives.create3DFBufferInfo( 777, 555, 444, 333  );

      </script>
   </head>
   <body>
      <?php
      // put your code here
      ?>
   </body>
</html>
