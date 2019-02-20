<?php
/*
 * Copyright (C) 2017 Alessandro Amaral Breves (aa.breves@outlook.com)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Copyright (C) 2017 Alessandro Amaral Breves (aa.breves@outlook.com)
 */
define( "INDEX", 1 );
define( "APP_URI", $_SERVER["HTTP_REFERER"] );

$iReload = filter_input( INPUT_GET, "reload", FILTER_SANITIZE_FULL_SPECIAL_CHARS );
if ( $iReload ){
   session_start();
   unset( $_SESSION );
   session_destroy();
   header( 'Location: '.APP_URI );
   die();
} // if ( $iReload ){

require_once "core/init.php";

?>
<!DOCTYPE html>
<html lang=<?php echo("\"".Session::_get( "lang" )."\""); ?> >
   <head id="hdHeader">
      <meta charset="UTF-8" />
      <meta name="description"
            content="MVC Project Model" />
      <meta name="keywords"
            content="HTML,CSS,XML,JavaScript, AJAX" />
      <meta name="author"
            content="Alessandro Breves" />
      <meta name="viewport"
            content="width=device-width, initial-scale=1.0" />

      <title>Portal</title>

<?php if ( $_env[ "elink_mode"] === "1" ): ?>
<!--      <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />-->

<!-- JQUERY -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- BOOTSTRAP -->
      <link rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- SEMANTIC -->
      <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/semantic-ui/2.2.13/semantic.min.css">
      <script src="https://cdn.jsdelivr.net/semantic-ui/2.2.13/semantic.min.js"></script>;
<?php else: ?>

<!-- JQUERY -->
<!--      <script src="js/lib/jquery/3.2.1/jquery.min.js"></script>-->
      <script src="assets/jquery/dist/jquery.min.js"></script>

<!-- BOOTSTRAP -->
<!--      <link rel="stylesheet"
            href="js/lib/bootstrap/3.3.7/css/bootstrap.min.css" />
      <script src="js/lib/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
      <link rel="stylesheet"
            href="assets/bootstrap/dist/css/bootstrap.min.css" />
      <script src="assets/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- FONT-AWESOME -->

<!--      <link rel="stylesheet"
            href="js/lib/font-awesome/4.7.0/css/font-awesome.min.css" />    -->
      <link rel="stylesheet"
            href="assets/font-awesome/css/font-awesome.min.css" />

<!-- SEMANTIC -->
      <link rel="stylesheet"
            href="js/lib/semantic-ui/2.2.13/semantic.min.css">
      <script src="js/lib/semantic-ui/2.2.13/semantic.min.js"></script>
<?php endif ?>

      <script id="scrDebug"
              src="js/debug.js"
              type="text/javascript" ></script>
      <script id="scrHttpRequest"
              src="js/http_request.js"
              type="text/javascript" ></script>
      <script id="scrTools"
              src="js/tools.js"
              type="text/javascript" ></script>

      <!-- ********** ********** ********** ********** ********** ********** ********** -->
      <script id="scrIndex"
              src="js/index.js"
              type="text/javascript"></script>

   </head> <!-- <head id="hdHeader"> -->
   <body id="bdyBody">
      <?php
         $_asMAV[ "m"] = Utils::_filterInput( INPUT_GET, "m", "model_" );
         $_asMAV[ "a"] = Utils::_filterInput( INPUT_GET, "a", "model__action_0" );
         $_asMAV[ "v"] = Utils::_filterInput( INPUT_GET, "v", "model__view_0" );

//         $_asMAV[ "m"] = Utils::_filterInput( INPUT_GET, "m", "home" );
//         $_asMAV[ "a"] = Utils::_filterInput( INPUT_GET, "a", "home_action_0" );
//         $_asMAV[ "v"] = Utils::_filterInput( INPUT_GET, "v", "home_view_0" );

         $_asArgv = [];

         require_once 'loader.php';
      ?>
   </body> <!-- <body id="bdyBody"> -->
</html>
