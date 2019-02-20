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
( defined( "INDEX" ) or defined( "LOADER" ) ) AND defined( "INIT" ) or 
exit( "ERROR: forbidden direct access.".( ( isset($_env[ "debug_mode"] ) && $_env[ "debug_mode"] ) ? ": ".__FILE__ : "!" ) );

define( "NL", "\n" );
define( "T1", "\t" );
define( "T2", "\t\t" );
define( "T3", "\t\t\t" );

define( "DSEP", "/" );

define( "DOC_ROOT", filter_input( INPUT_SERVER, "DOCUMENT_ROOT", FILTER_SANITIZE_FULL_SPECIAL_CHARS ) );

define( "SCRIPT_NM", filter_input( INPUT_SERVER, "SCRIPT_NAME", FILTER_SANITIZE_FULL_SPECIAL_CHARS ) );

define( "ACCP_DB", "accpDatabase" );
define( "ACCP_DB_CONN_DATA", "accpdb_conn_data" );

define( "MAIN_DB", "mainDatabase" );
define( "MAIN_DB_CONN_DATA", "maindb_conn_data" );

define( "INVALID_MODULE",      9001 );
define( "INVALID_ACTION",      9002 );
define( "INVALID_DATA_ACTION", 9003 );
define( "INVALID_VIEW",        9004 );

define( "INVALID_PROPERTY",    9101 );