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
 * /var/www/html/maktub/core/classAutoLoader.php
 */
(defined( "INDEX" ) || defined( "LOADER" )) && defined( "INIT" ) || 
exit( "ERROR: forbidden direct access.".( ( isset($_env[ "debug_mode"] ) && $_env[ "debug_mode"] ) ? ": ".__FILE__ : "!" ) );

/**
 * <h4>Definition of class AutoLoader</h4>
 * <p></p>
 *
 * @author aabreves
 */
class AutoLoader
{
   private $asDirs = [];

   /**
    * 
    */
   public function __construct()
   {
      $this->loadDirs();
      spl_autoload_register( array( $this, "loader" ) );
   } // public function __construct()

   /**
    *
    */
   private function loadDirs(){

      $this->asDirs = [ "classes"   => "classes/",    // Misc classes
                        "core"      => "core/",       // Core classes
                        "lib"       => "lib/",
                        "lib/html/" => "lib/html/",
                        "modules"   => "modules/" ];

      $asDirModules = scandir( $this->asDirs[ "modules"] );

      unset( $asDirModules[0] ); /* unset '.' */
      unset( $asDirModules[1] ); /* unset '..' */

      foreach ( $asDirModules as $sDirModule )
      {
         //$sPath = "./modules/$sDirModule/";
         $sPath = $this->asDirs[ "modules"]."$sDirModule/";
         if ( @is_dir( $sPath ) )
         {
            $this->asDirs[ "modules/$sDirModule"] = $sPath;
         } // foreach ( $asDirModules as $sDirModule )
      } // foreach ( $asDirModules as $sDirModule )
   } // private function loadDirs()

   /**
    *
    * @param type $sClassName
    */
   private function loader( $sClassName )
   {
      /*
       * Looping through each directory to load all the class files.
       * It will only require a file once.
       */
      foreach( $this->asDirs as $sDir )
      {
         $sFile = $sDir."class$sClassName.php";
         if ( file_exists( $sFile ) )
         {
            require_once( $sFile );
            break;
         } // if ( file_exists( $sDir."class$sClassName.php" ) )
      } // foreach( $asDirs as $sDir )
   } // private function loader( $sClassName )
} // class AutoLoader

$AL = new AutoLoader();