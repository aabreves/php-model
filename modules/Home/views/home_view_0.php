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
    <script src="js/utils/gl-matrix.js"></script>
    <script src="js/utils/utils.js"></script>
    
    <script type="x-shader/vs" id="vertex-draw">
        #version 300 es
        layout(std140, column_major) uniform;
        
        layout(location=0) in vec4 position;
        layout(location=1) in vec2 uv;
        layout(location=2) in vec4 normal;
        
        uniform SceneUniforms {
            mat4 viewProj;
            vec4 eyePosition;
            vec4 lightPosition;
        } uScene;       
        
        uniform mat4 uModel;
        out  vec3 vPosition;
        out  vec2 vUV;
        out  vec3 vNormal;
        void main() {
            vec4 worldPosition = uModel * position;
            vPosition = worldPosition.xyz;
            vUV = uv;
            vNormal = (uModel * normal).xyz;
            gl_Position = uScene.viewProj * worldPosition;
        }
    </script>
    <script type="x-shader/vf" id="fragment-draw">
        #version 300 es
        precision highp float;
        layout(std140, column_major) uniform;
        uniform SceneUniforms {
            mat4 viewProj;
            vec4 eyePosition;
            vec4 lightPosition;
        } uScene;
        uniform sampler2D tex;
        
        in vec3 vPosition;
        in vec2 vUV;
        in vec3 vNormal;
        out vec4 fragColor;
        void main() {
            vec3 color = texture(tex, vUV).rgb;
            vec3 normal = normalize(vNormal);
            vec3 eyeVec = normalize(uScene.eyePosition.xyz - vPosition);
            vec3 incidentVec = normalize(vPosition - uScene.lightPosition.xyz);
            vec3 lightVec = -incidentVec;
            float diffuse = max(dot(lightVec, normal), 0.0);
            float highlight = pow(max(dot(eyeVec, reflect(incidentVec, normal)), 0.0), 100.0);
            float ambient = 0.1;
            fragColor = vec4(color * (diffuse + highlight + ambient), 1.0);
        }
    </script>
  
    <div id="divHomeView_0"
         style="width:100%; height:90%;">
        <div id="divWebGlOut" 
             style="padding:10px ;width:100%; height:100%; float: left;">
            <canvas id="canWebGlOut"
                    style="width:100%;height:100%"
                    <!--width="800" 
                    height="600"-->>
            </canvas>
        </div> <!-- <div id="divWebGlOut" -->
    </div> <!-- <div id="divHomeView_2" -->
    <script type="text/javascript">
        var canvas = document.getElementById("canWebGlOut");
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        
        var gl = canvas.getContext("webgl2");
        if (!gl) {
            console.error("WebGL 2 not available");
            document.body.innerHTML = "This example requires WebGL 2 which is unavailable on this system."
        }
        gl.viewport(0, 0, gl.drawingBufferWidth, gl.drawingBufferHeight);
        gl.clearColor(0.0, 0.0, 0.0, 1.0)
        gl.enable(gl.DEPTH_TEST);
        
        /////////////////////
        // SET UP PROGRAM
        /////////////////////
        var vsSource =  document.getElementById("vertex-draw").text.trim();
        var fsSource =  document.getElementById("fragment-draw").text.trim();
        
        var vertexShader = gl.createShader(gl.VERTEX_SHADER);
        gl.shaderSource(vertexShader, vsSource);
        gl.compileShader(vertexShader);
        if (!gl.getShaderParameter(vertexShader, gl.COMPILE_STATUS)) {
            console.error(gl.getShaderInfoLog(vertexShader));
        }
        
        var fragmentShader = gl.createShader(gl.FRAGMENT_SHADER);
        gl.shaderSource(fragmentShader, fsSource);
        gl.compileShader(fragmentShader);
        if (!gl.getShaderParameter(fragmentShader, gl.COMPILE_STATUS)) {
            console.error(gl.getShaderInfoLog(fragmentShader));
        }
        
        var program = gl.createProgram();
        gl.attachShader(program, vertexShader);
        gl.attachShader(program, fragmentShader);
        gl.linkProgram(program);
        if (!gl.getProgramParameter(program, gl.LINK_STATUS)) {
            console.error(gl.getProgramInfoLog(program));
        }
        
        /////////////////////////
        // GET UNIFORM LOCATIONS
        /////////////////////////
        var sceneUniformsLocation = gl.getUniformBlockIndex(program, "SceneUniforms");
        gl.uniformBlockBinding(program, sceneUniformsLocation, 0);
        
        var modelMatrixLocation = gl.getUniformLocation(program, "uModel");
        var texLocation = gl.getUniformLocation(program, "tex");
        gl.useProgram(program);
        
        /////////////////////
        // SET UP GEOMETRY
        /////////////////////
        var box = utils.createBox({dimensions: [2.0, 1.0, 1.0]});
        var numVertices = box.positions.length / 3;
        var cubeArray = gl.createVertexArray();
        gl.bindVertexArray(cubeArray);
        
        var positionBuffer = gl.createBuffer();
        gl.bindBuffer(gl.ARRAY_BUFFER, positionBuffer);
        gl.bufferData(gl.ARRAY_BUFFER, box.positions, gl.STATIC_DRAW);
        gl.vertexAttribPointer(0, 3, gl.FLOAT, false, 0, 0);
        gl.enableVertexAttribArray(0);
        
        var uvBuffer = gl.createBuffer();
        gl.bindBuffer(gl.ARRAY_BUFFER, uvBuffer);
        gl.bufferData(gl.ARRAY_BUFFER, box.uvs, gl.STATIC_DRAW);
        gl.vertexAttribPointer(1, 2, gl.FLOAT, false, 0, 0);
        gl.enableVertexAttribArray(1);
        
        var normalBuffer = gl.createBuffer();
        gl.bindBuffer(gl.ARRAY_BUFFER, normalBuffer);
        gl.bufferData(gl.ARRAY_BUFFER, box.normals, gl.STATIC_DRAW);
        gl.vertexAttribPointer(2, 3, gl.FLOAT, false, 0, 0);
        gl.enableVertexAttribArray(2);      
        
        //////////////////////////
        // UNIFORM DATA
        //////////////////////////
        var projMatrix = mat4.create();
        mat4.perspective(projMatrix, Math.PI / 2, gl.drawingBufferWidth / gl.drawingBufferHeight, 0.1, 10.0);
        
        var viewMatrix = mat4.create();
        var eyePosition = vec3.fromValues(1, 1, 2);
        mat4.lookAt(viewMatrix, eyePosition, vec3.fromValues(0, 0, 0), vec3.fromValues(0, 1, 0));
        
        var viewProjMatrix = mat4.create();
        mat4.multiply(viewProjMatrix, projMatrix, viewMatrix);
        
        var lightPosition = vec3.fromValues(1, 1, 0.5);
        var modelMatrix = mat4.create();
        var rotateXMatrix = mat4.create();
        var rotateYMatrix = mat4.create();
        var sceneUniformData = new Float32Array(24);
        sceneUniformData.set(viewProjMatrix);
        sceneUniformData.set(eyePosition, 16);
        sceneUniformData.set(lightPosition, 20);
        
        var sceneUniformBuffer = gl.createBuffer();
        gl.bindBufferBase(gl.UNIFORM_BUFFER, 0, sceneUniformBuffer);
        gl.bufferData(gl.UNIFORM_BUFFER, sceneUniformData, gl.STATIC_DRAW);
        
        var angleX = 0;
        var angleY = 0;
        var image = new Image();
        image.onload = function() {
            var texture = gl.createTexture();
            gl.activeTexture(gl.TEXTURE0);
            gl.bindTexture(gl.TEXTURE_2D, texture);
            gl.pixelStorei(gl.UNPACK_FLIP_Y_WEBGL, true);
            gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.LINEAR);
            gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.LINEAR_MIPMAP_LINEAR);
            gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, gl.REPEAT);
            gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, gl.REPEAT);
            
            var levels = levels = Math.floor(Math.log2(Math.max(this.width, this.height))) + 1;
            gl.texStorage2D(gl.TEXTURE_2D, levels, gl.RGBA8, image.width, image.height);
            gl.texSubImage2D(gl.TEXTURE_2D, 0, 0, 0, image.width, image.height, gl.RGBA, gl.UNSIGNED_BYTE, image);
            gl.generateMipmap(gl.TEXTURE_2D);
            gl.uniform1i(texLocation, 0);
            
            function draw() {
                angleX += 0.01;
                //angleY += 0.02;
                
                mat4.fromXRotation(rotateXMatrix, angleX);
                mat4.fromYRotation(rotateYMatrix, angleY);
                mat4.multiply(modelMatrix, rotateXMatrix, rotateYMatrix);
                
                gl.uniformMatrix4fv(modelMatrixLocation, false, modelMatrix);
                gl.clear(gl.COLOR_BUFFER_BIT);
                gl.drawArrays(gl.TRIANGLES, 0, numVertices);
                requestAnimationFrame(draw);
            }
            
            requestAnimationFrame(draw);
            
        }
        image.src = "media/images/logo_sascar_nova.jpg";
        
        function senData(){
            var sendInfo = $( "#formContainer" ).serializeArray();
            
            var sendInfo = {};
            $( "#formContainer" ).serializeArray().map(function(item) {
                if ( sendInfo[item.name] ) {
                    if ( typeof(sendInfo[item.name]) === "string" ) {
                        sendInfo[item.name] = [sendInfo[item.name]];
                    }
                    sendInfo[item.name].push(item.value);
                } else {
                    sendInfo[item.name] = item.value;
                }
            });

            //alert( JSON.stringify(sendInfo) );
            $.ajax({
                type: "POST",
                url: "http://localhost/cgi-bin/qt-cgi.cgi",
                contentType: 'application/json',
                dataType: "json",
                success: function (data) {
                    alert( "Done: " + JSON.stringify(data) );
                },
                error: function(data){
                    alert( "Error: " + JSON.stringify(data) );
                },
                data: JSON.stringify(sendInfo)
            });
        }
    </script>
  
<!--
</div> --> <!-- <div id="divContainer" ... -->

