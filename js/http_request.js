/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
'use strict';

/**
 * 
 * @param {type} sModule      module name
 * @param {type} sAction      action to be executed
 * @param {type} sView        result view
 * @param {type} sArgs        args to be used on action
 * @param {type} fnCallBack   callback function to process the reseponse
 * @returns {undefined}
 */
function requestMVC(sModule, sAction, sView, sArgs, fnCallBack) {

   var sURL = "loader.php";
   var sMAV = ""; /* Module, Action, View */
   sMAV += "m=" + sModule;
   sMAV += "&a=" + sAction;
   sMAV += "&v=" + sView;

   sMAV !== "" ? debugMsg("requestMVC::MAV?" + sMAV) : "";
   sArgs !== "" ? debugMsg("requestMVC::Args?" + sArgs) : "";

   processRequest(sURL, sMAV, sArgs, fnCallBack);
} /* function requestMVC( sModule, sAction, sView, sArgs ) */

/**
 *
 * @param {type} sURL
 * @param {type} sMAV
 * @param {type} sActionArgs
 * @param {type} fnCallBack
 * @returns {undefined}
 */
function processRequest(sURL, sMAV, sActionArgs, fnCallBack) {
   debugMsg("processRequest - init");
   var xhttp = new XMLHttpRequest();

   showDimmer();
   xhttp.onreadystatechange = function () {
      if (xhttp.readyState === 4 && xhttp.status === 200) {
         hideDimmer();
         if (fnCallBack === undefined)
            processResponse(xhttp.responseText);
         else {
            try {
               fnCallBack(xhttp.responseText);
            } catch (err) {
               //alert( err );
               sctWorkspace.innerHTML = err;
            }
         } /* if ( fnCallBack === undefined ) .. else */
      } /* if ( xhttp.readyState == 4 && xhttp.status == 200 ) */
   }; /* xhttp.onreadystatechange = function() */

   debugMsg("processRequest: " + sMAV + " - args: " + sActionArgs);

   xhttp.open("POST", sURL + "?" + sMAV, true);
   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhttp.send(sActionArgs);
} /* function processRequest( sLoad, sAction, sView, sArgs ) */

/**
 * 
 * @param {type} sResponse
 * @returns {undefined}
 */
function processResponse(sResponse)
{
   debugMsg("processResponse: " + sResponse);

   var sTargetId = "";
   try {
      /*
       * RESPONSE OBJECT
       * 
       * oResponse
       *    |----> Data[]
       *    |       |--[0]---->(DataItem)
       *    |       |           |---->TargetId  :  html element id
       *    |       |           |---->Content   :  response content (html | json)
       *    |       |           |---->Replace   :  1-yes; 0:no
       *    |       |           |---->Type      :  html | json
       *    |       |
       *    |       |--[1]---->(DataItem)
       *    |       |           |---->TargetId  :  html element id
       *    |       |           |---->Content   :  response content
       *    |       |           |---->Replace   :  1-yes; 0:no
       *    |       |           |---->Type      :  html | json
       *    |       |
       *    |       |--[n] ...
       *    |
       *    |----> Action[]
       *            |--[0]---->(ActionItem)
       *            |           |---->Command   :  js command
       *            |
       *            |--[1]---->(ActionItem)
       *            |           |---->Command   :  js command
       *            |
       *            |--[n] ...
       * 
       */
      var oResponse = JSON.parse(sResponse);

      //debugMsg( oResponse.Data.length );
      var i = -1;
      for (i in oResponse.Data) {

         sTargetId = oResponse.Data[i].TargetId;
         var domTarget = null;
         switch (oResponse.Data[i].Type) {
            case 'html':
               domTarget = document.getElementById(sTargetId);

               if (oResponse.Data[i].Replace === "1") {
                  domTarget.innerHTML = oResponse.Data[i].Content;
               } else {
                  domTarget.innerHTML += oResponse.Data[i].Content;
               }
               break;

            case "script":
               domTarget = document.getElementById(sTargetId);
               if (domTarget === null) {
                  domTarget = document.getElementsByTagName("head");
               }
               var aoScripts = JSON.parse(oResponse.Data[i].Content);

               for (var i in aoScripts) {
                  var domScript = document.getElementById(aoScripts[i].id);

                  if (domScript === null) {
                     domScript = document.createElement("script");
                     domScript.id = aoScripts[i].id;
                     domScript.type = "text/javascript";
                     domScript.src = aoScripts[i].file;
                     domTarget.appendChild(domScript);
                  } // if ( domScript === null )
               } // for ( var i in aoScripts )
               break;

            case "stylesheet":
               domTarget = document.getElementById(sTargetId);
               if (domTarget === null) {
                  domTarget = document.getElementsByTagName("head");
               }
               var aoStyles = JSON.parse(oResponse.Data[i].Content);

               for (var i in aoStyles) {
                  var domStyle = document.getElementById(aoStyles[i].id);

                  if (domStyle === null) {
                     domStyle = document.createElement("link");
                     domStyle.id = aoStyles[i].id;
                     domStyle.type = "text/css";
                     domStyle.rel = "stylesheet";
                     domStyle.href = aoStyles[i].file;

                     domTarget.appendChild(domStyle);
                  } // if ( domScript === null )
               } // for ( var i in aoScripts )
               break;
         } // switch ( oResponse.Data[i].Type )

      } /* for ( i in oResponse.Data ) */
      for (i in oResponse.Action) {
         //debugMsg( oResponse.Action[i].Command );
         try {
            eval(oResponse.Action[i].Command);
         } catch (err) {
            alert(err.message);
         }
      } // for ( i in oResponse.Action )
   } catch (err) {
      var sError = err.message;
      sError += "\nResponse: " + sResponse;
      document.body.innerHTML = sResponse;
      alert(sTargetId + " : " + err.message);
   }

} /* function processResponse( sResponse ) */


