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
 *
 */

/*
 * setup initialization flags
 */
$_env = [ "debug_mode" => "1",   // 1: enable debug mode
          "devel_mode" => "0",   // 1: enable development mode
          "dbase_mode" => "0",   // 1: enable database usage mode
          "elink_mode" => "0" ]; // 1: enable external link mode

$_dba = [ "db_setup"  => false, 
          "db_ready"  => false, 
          /*"db_access" => false, 
          "db_maindb" => false*/ ];
   
?>