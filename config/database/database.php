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
 * /var/www/html/maktub/config/database/database.php
 */
(defined( "INDEX" ) || defined( "LOADER" )) && defined( "INIT" ) ||
exit( "ERROR: forbidden direct access.".( ( isset($_env[ "debug_mode"] ) && $_env[ "debug_mode"] ) ? ": ".__FILE__ : "!" ) );

define( "ADMIN_PWD", "123" );

// LOADS DATABASE CONNECTION DATA
if ( !isset( $_accp_dba_conn ) && file_exists( "config/database/database_info.php" ) ){
   require_once( "database_info.php" ); // => load $_accp_dba_conn
} // if ( file_exists( "config/database/database_info.php" ) ){

$_bDbSetup = false;
$_bDbReady = false;

$_asDbAccess = [];
if ( !isset( $_accp_dba_conn[ "db_drvr"] ) ){
   // NO DATABASE CONNECTION DATA FOUND
   $_bDbSetup = true;
} // if ( !isset( $_accp_dba_conn[ "drvr"] ) ){
else{
   // DATABASE CONNECTION DATA FOUND - TRY TO CONNECT
   $_asDbAccess = [ "drvr" => $_accp_dba_conn[ "db_drvr"],
                    "host" => isset( $_accp_dba_conn[ "db_host"] ) ? $_accp_dba_conn[ "db_host"]: "",
                    "port" => isset( $_accp_dba_conn[ "db_port"] ) ? $_accp_dba_conn[ "db_port"]: "",
                    "user" => isset( $_accp_dba_conn[ "db_user"] ) ? $_accp_dba_conn[ "db_user"]: "",
                    "pass" => isset( $_accp_dba_conn[ "db_pass"] ) ? $_accp_dba_conn[ "db_pass"]: "",
                    "dbnm" => isset( $_accp_dba_conn[ "db_dbnm"] ) ? $_accp_dba_conn[ "db_dbnm"]: "" ];

   $db = App::_loadObject( ACCP_DB, "Database", $_asDbAccess );
   if ( $db->isConnected() ){
      $_bDbSetup = false;
      $_bDbReady = true;
   } // if ( $db->isConnected() ){
   else{
      $_bDbSetup = true;
      $_bDbReady = false;
   } // if ( $db->isConnected() ){ .. else
} // if ( !isset( $_accp_dba_conn[ "drvr"] ) ){ .. else

App::_setData( [ "db_setup"  => $_bDbSetup,
                 "db_ready"  => $_bDbReady ] );

unset( $_asDbAccess );

