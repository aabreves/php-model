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
defined( "INDEX" ) AND defined( "INIT" ) or exit( "ERROR: forbidden direct access.".( ( isset($_env[ "debug_mode"] ) && $_env[ "debug_mode"] ) ? ": ".__FILE__ : "!" ) );

$_asDbDriver[ "sqlite"] = [ "drvr" => "sqlite",
                           "host" => "localhost",
                           "port" => "",
                           "user" => "sqlite",
                           "pass" => "",
                           "dbnm" => "projectMVC" ];

$_asDbDriver[ "mysql"] = [ "drvr" => "mysql",
                          "host" => "localhost",
                          "port" => "3306",
                          "user" => "root",
                          "pass" => "",
                          "dbnm" => "projectMVC" ];

$_asDbDriver[ "postgresql"] = [ "drvr" => "postgre",
                               "host" => "localhost",
                               "port" => "5432",
                               "user" => "postgre",
                               "pass" => "",
                               "dbnm" => "projectMVC" ];
