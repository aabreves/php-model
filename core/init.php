<?php
/*
 * project: projectMVC
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
/**
 * /var/www/html/maktub/core/init.php
 */

if ( !defined( "INIT" ) ){

   define( "INIT", 1 );

   /*
    * setup initialization flags; these flags can be overwritten by custom company
    * flags (ie. cos/co001/init.php)
    */
   $_env = [ "debug_mode" => "1",   // 1: enable debug mode
             "devel_mode" => "1",   // 1: enable development mode
             "dbase_mode" => "0",   // 1: enable database usage mode
             "elink_mode" => "0" ]; // 1: enable external link mode

   /* ********************************************************************** */
   defined( "INDEX" ) or defined( "LOADER" ) or 
   exit( "ERROR: forbidden direct access.".( ( isset($_env[ "debug_mode"] ) && $_env[ "debug_mode"] ) ? ": ".__FILE__ : "!" ) );
   
   require_once( "defines.php" );
   require_once( "classAutoLoader.php" );
   
   $base_path = ".";   
   $_env[ "base_path"] = realpath($base_path)."/";
   
   $main_uri = filter_input( INPUT_SERVER, "REQUEST_SCHEME", FILTER_SANITIZE_FULL_SPECIAL_CHARS );
   $main_uri .= "://".filter_input( INPUT_SERVER, "SERVER_NAME", FILTER_SANITIZE_FULL_SPECIAL_CHARS );
   $main_uri .= filter_input( INPUT_SERVER, "REQUEST_URI", FILTER_SANITIZE_FULL_SPECIAL_CHARS );
   
   if ( strstr( $main_uri, "?" ) ){
      $main_uri = explode( "?", $main_uri )[0];
   } // if ( strstr( $main_uri, "?" ) ){
   $_env[ "main_uri"]  = $main_uri;
   
   App::_startApp( [ $_env ] );
   
} // if ( !defined( "INIT" ) ){
?>