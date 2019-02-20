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
 * /var/www/html/maktub/lib/html/classHtmlObject.php
 */

class WidgetsLibrary{

   public static function _loadWidget( $sWidgetName ){

      $htmWidget = null;
      switch ( $sWidgetName ){
         case "bsform_model":
            $htmWidget = self::_loadBsForm_Model();
            break;

         case "bsform_login":
            $htmWidget = self::_loadBsForm_Login();
            break;

         case "bsform_signup":
            $htmWidget = self::_loadBsForm_Signup();
            break;

         case "bsform_test_database_conndata":
            $htmWidget = self::_loadBsForm_TestDatabaseConnData();
            break;

         case "bsform_setup_ap_database_conndata":
            $htmWidget = self::_loadBsForm_SetupApDatabaseConnData();
            break;

         case "bsform_setup_main_database_conndata":
            $htmWidget = self::_loadBsForm_SetupMainDatabaseConnData();
            break;

         case "bswidget_clock":
            $htmWidget = self::_loadBsWidget_Clock();
            break;

         case "bswidget_db_ready":
            $htmWidget = self::_loadBsWidget_DbReady();
            break;

         case "bsform_navbar_search":
            $htmWidget = self::_loadBsForm_NavBarSearch();
            break;

         case "bsform_custom_categories":
            $htmWidget = self::_loadBsForm_CustomCategories();
            break;

         case "bsform_custom_themes":
            $htmWidget = self::_loadBsForm_CustomThemes();
            break;

         case "bsform_custom_subjects":
            $htmWidget = self::_loadBsForm_CustomSubjects();
            break;

         case "bsform_custom_topics":
            $htmWidget = self::_loadBsForm_CustomTopics();
            break;
      } // switch ( $sWidgetName ){

      return $htmWidget;
   } // public static function loadWiget( $sWidgetName

   /**
    *
    * @return \HtmlObject
    */
   private static function _loadBsForm_Model(){

      $formWidget = new HtmlObject( "form", "formModel" );
      $formWidget->setAttributes( [ "name"     => "formModel",
                                    "action"   => "",
                                    "method"   => "",
                                    "onsubmit" => "return false;" ] );


         $emlUsrMail = new HtmlInputControl( "email", "emlUsrMail", "e-mail:" );
         $emlUsrMail->setStyles( "form-group", "", "form-control input-sm" );
         $emlUsrMail->setControlAttributes( [ "required" => "",
                                              "placeholder" => "digite o email" ] );

         $pwdUsrPass = new HtmlInputControl( "password", "pwdUsrPass", "password" );
         $pwdUsrPass->setStyles( "form-group", "", "form-control input-sm" );
         $pwdUsrPass->setControlAttributes( [ "required" => "",
                                              "placeholder" => "digite a senha" ] );

         /* ********** */
         $submitModel = new HtmlObject( "input", "submitModel", true );
         $submitModel->setAttributes( [ "value"    => "Model",
                                        "type"     => "submit",
                                        "class"    => "btn btn-primary",
                                        "required" => "required",
                                        "onclick"  => "alert('submitModel')" ] );

         $spnNBSP = new HtmlObject( "span" );
         $spnNBSP->setText( "&nbsp;&nbsp;&nbsp;&nbsp;" );

         $aCancelModel = new HtmlObject( "a", "aCancelModel" );
         $aCancelModel->setAttributes( [ "href"    => "#",
                                         "class"   => "btn btn-warning",
                                         "onclick" => "alert('aCancelModel')" ] );
         $aCancelModel->setText( App::_getText( "cancel_option" ) );

         $aReload = new HtmlObject( "a", "aReloadModel" );
         $aReload->setAttributes( [ "href"  => "#",
                                    "class" => "btn btn-danger" ] );
         $aReload->setText( "Reload" );

         $formWidget->addObjects( [ $emlUsrMail, $pwdUsrPass, $submitModel, $spnNBSP, $aReload, $spnNBSP, $aCancelModel ] );

      return $formWidget;

   } // private static function _loadBsForm_Model(){

   /**
    *
    * @return \HtmlObject
    */
   private static function _loadBsForm_NavBarSearch(){

      $formSearch = new HtmlObject( "form", "formSearch" );
      $formSearch->setAttributes( [ "class" => "navbar-form navbar-left"] );
         $sHtml = "";
         $sHtml .= "<div class=\"input-group\">
               <input type=\"text\"
                      class=\"form-control\"
                      placeholder=\"Search\" />
               <div class=\"input-group-btn\">
                  <button class=\"btn btn-default\" type=\"submit\">
                     <i class=\"glyphicon glyphicon-search\"></i>
                  </button>
               </div>
            </div>";
      $formSearch->setText( $sHtml );

      return $formSearch;

   } // private static function _loadBsForm_NavBarSearch(){

   /**
    *
    * @return \HtmlObject
    */
   private static function _loadBsWidget_Clock(){

      $aClock = new HtmlObject( "a", "aClock" );
      $aClock->setAttributes( [ "href" => "#" ] );

         $spnClockVal = new HtmlObject( "span", "spnClockVal" );

         $spnClockIco = new HtmlObject( "span", "spnClockIco" );
         $spnClockIco->setAttributes( [ "class" => "glyphicon glyphicon-time" ] );

      $aClock->addObjects( [ $spnClockIco, $spnClockVal ] );

      return $aClock;
   } // private static function _loadBsWidget_Clock(){

   /**
    *
    * @return \HtmlObject
    */
   private static function _loadBsWidget_DbReady(){

      $aStatus = new HtmlObject( "a", "aStatus" );
      $aStatus->setAttributes( [ "href" => "#" ] );

         $spnStatusVal = new HtmlObject( "span", "spnStatusVal" );

         $spnStatusIco = new HtmlObject( "span", "spnStatusIco" );
         if ( App::_getData( "db_ready" ) == true ){
            $spnStatusIco->setAttributes( [ "class" => "glyphicon glyphicon-ok-circle",
                                            "style" => "color:green" ] );
         }
         else{
            $spnStatusIco->setAttributes( [ "class" => "glyphicon glyphicon-ban-circle",
                                            "style" => "color:red" ] );
         }

      $aStatus->addObjects( [ $spnStatusIco, $spnStatusVal ] );

      return $aStatus;
   } // private static function _loadBsWidget_DbReady(){

   /**
    * Bootstrap based form for database test connection
    *
    * @return \HtmlObject
    */
   private static function _loadBsForm_TestDatabaseConnData(){

      // FORM
      $formWidget = new HtmlObject( "form", "formTestConnectionDb" );
      $formWidget->setAttributes( [ "name"     => "formTestConnectionDb",
                                    "action"   => "",
                                    "method"   => "",
                                    "onsubmit" => "return false;",
                                    "style"    => "margin-top:25px;" ] );

         // GRID
         $divTestConnectionDbGrid = new HtmlObject( "div", "divTestConnectionDbGrid" );
         $divTestConnectionDbGrid->setAttributes( [ "class" => "ui equal width centered stackable grid",
                                                   "style" => "margin:auto" ] );

            // ROW 1 ********** ********** ********** ********** ********** **********
            $divTestConnectionDbRow1 = new HtmlObject( "div", "divTestConnectionDbRow1" );
            $divTestConnectionDbRow1->setAttributes( [ "class" => "equal width row",
                                                       "style" => "padding-top:0" ] );

               // CONTROLS
               $selDbDrvr = new HtmlSelectControl( "selDbDrvr", "Driver" );
               $selDbDrvr->setStyles( "column form-group", "", "form-control input-sm" );
               $selDbDrvr->setControlAttributes( [ "required"    => "",
                                                   "placeholder" => "select database driver" ] );

               $_asMAV = [ "m" => "database",
                           "a" => "get_drivers",
                           "v" => "drivers_array" ];
               $_asArgv = [];
               $asDrivers = MasterController::_run( $_asMAV, $_asArgv );
               $selDbDrvr->setOptions( $asDrivers[ "drivers_array" ] );

               $numDbPort = new HtmlInputControl( "number", "numDbPort", "Port" );
               $numDbPort->setStyles( "column form-group", "", "form-control input-sm" );
               $numDbPort->setControlAttributes( [ "required"     => "",
                                                   "placeholder" => "enter port number",
                                                   "value" => "" ] );
            // ADD CONTROLS TO ROW 1
            $divTestConnectionDbRow1->addObjects( [ $selDbDrvr, $numDbPort ] );

            // ROW 2 ********** ********** ********** ********** ********** **********
            $divTestConnectionDbRow2 = new HtmlObject( "div", "divTestConnectionDbRow2" );
            $divTestConnectionDbRow2->setAttributes( [ "class" => "equal width row",
                                                       "style" => "padding-top:0" ] );

               // CONTROLS
               $txtDbHost = new HtmlInputControl( "text", "txtDbHost", "Host" );
               $txtDbHost->setStyles( "column form-group", "", "form-control input-sm" );
               $txtDbHost->setControlAttributes( [ "required"     => "",
                                                   "placeholder" => "enter host name",
                                                   "value" => "localhost" ] );

               $txtDbName = new HtmlInputControl( "text", "txtDbName", "Database" );
               $txtDbName->setStyles( "column form-group", "", "form-control input-sm" );
               $txtDbName->setControlAttributes( [ "placeholder" => "enter database name",
                                                   "value" => "u729172951_ap" ] );
            // ADD CONTROLS TO ROW 2
            $divTestConnectionDbRow2->addObjects( [ $txtDbHost, $txtDbName ] );

            // ROW 3 ********** ********** ********** ********** ********** **********
            $divTestConnectionDbRow3 = new HtmlObject( "div", "divTestConnectionDbRow3" );
            $divTestConnectionDbRow3->setAttributes( [ "class" => "equal width row",
                                                       "style" => "padding-top:0" ] );

               // CONTROLS
               $txtDbUser = new HtmlInputControl( "text", "txtDbUser", "User" );
               $txtDbUser->setStyles( "column form-group", "", "form-control input-sm" );
               $txtDbUser->setControlAttributes( [ "required"     => "",
                                                   "placeholder" => "enter user name",
                                                   "value" => "root" ] );

               $pwdDbPass = new HtmlInputControl( "password", "pwdDbPass", "Password" );
               $pwdDbPass->setStyles( "column form-group", "", "form-control input-sm" );
               $pwdDbPass->setControlAttributes( [ "required"    => "",
                                                   "placeholder" => "enter the password",
                                                   "value" => "123" ] );
            // ADD CONTROLS TO ROW 3
            $divTestConnectionDbRow3->addObjects( [ $txtDbUser, $pwdDbPass ] );

            // ROW 4 ********** ********** ********** ********** ********** **********
            $divTestConnectionDbRow4 = new HtmlObject( "div", "divTestConnectionDbRow4" );
            $divTestConnectionDbRow4->setAttributes( [ "class" => "equal width row",
                                                       "style" => "padding-top:0" ] );

               // CONTROLS
               $submitTestConnection = new HtmlObject( "input", "submitTestConnection", true );
               $submitTestConnection->setAttributes( [ "value"    => "Test connection",
                                                       "class"    => "btn btn-primary btn-sm",
                                                       "onclick"  => "submitTestConnection_onclick();" ] );
            // ADD CONTROLS TO ROW 4
            $divTestConnectionDbRow4->addObjects( [ $submitTestConnection ] );

         // ADD ROWS TO GRID
         $divTestConnectionDbGrid->addObjects( [ $divTestConnectionDbRow1, $divTestConnectionDbRow2, $divTestConnectionDbRow3, $divTestConnectionDbRow4 ] );

         // ADD GRID TO FORM
         $formWidget->addObjects( [ $divTestConnectionDbGrid ] );

      return $formWidget;

   } // private static function _loadBsForm_TestDatabaseConnData(){

   /**
    * Setup Connection Data for Access Point Database
    *
    * @return \HtmlObject
    */
   private static function _loadBsForm_SetupApDatabaseConnData(){

      // FORM
      $formWidget = new HtmlObject( "form", "formSetupApDatabaseConnData" );
      $formWidget->setAttributes( [ "name"     => "formSetupApDatabaseConnData",
                                    "action"   => "",
                                    "method"   => "",
                                    "onsubmit" => "return false;",
                                    "style"    => "margin-top:25px;" ] );

         // GRID
         $divSetupApDatabaseConnDataGrid = new HtmlObject( "div", "divSetupApDatabaseConnDataGrid" );
         $divSetupApDatabaseConnDataGrid->setAttributes( [ "class" => "ui equal width centered stackable grid",
                                                           "style" => "margin:auto" ] );

            // ROW 1 ********** ********** ********** ********** ********** **********
            $divSetupApDatabaseConnDataRow1 = new HtmlObject( "div", "divSetupApDatabaseConnDataRow1" );
            $divSetupApDatabaseConnDataRow1->setAttributes( [ "class" => "equal width row",
                                                              "style" => "padding-top:0" ] );

               // CONTROLS
               $selDbDrvr = new HtmlSelectControl( "selDbDrvr_apdb", "Driver" );
               $selDbDrvr->setStyles( "column form-group", "", "form-control input-sm" );
               $selDbDrvr->setControlAttributes( [ "required"    => "",
                                                   "placeholder" => "select database driver" ] );

               $_asMAV = [ "m" => "database",
                           "a" => "get_drivers",
                           "v" => "drivers_array" ];
               $_asArgv = [];
               $asDrivers = MasterController::_run( $_asMAV, $_asArgv );
               $selDbDrvr->setOptions( $asDrivers[ "drivers_array" ] );

               $numDbPort = new HtmlInputControl( "number", "numDbPort_apdb", "Port" );
               $numDbPort->setStyles( "column form-group", "", "form-control input-sm" );
               $numDbPort->setControlAttributes( [ "required"     => "",
                                                   "placeholder" => "enter port number",
                                                   "value" => "" ] );
            // ADD CONTROLS TO ROW 1
            $divSetupApDatabaseConnDataRow1->addObjects( [ $selDbDrvr, $numDbPort ] );

            // ROW 2 ********** ********** ********** ********** ********** **********
            $divSetupApDatabaseConnDataRow2 = new HtmlObject( "div", "divSetupApDatabaseConnDataRow2" );
            $divSetupApDatabaseConnDataRow2->setAttributes( [ "class" => "equal width row",
                                                              "style" => "padding-top:0" ] );

               // CONTROLS
               $txtDbHost = new HtmlInputControl( "text", "txtDbHost_apdb", "Host" );
               $txtDbHost->setStyles( "column form-group", "", "form-control input-sm" );
               $txtDbHost->setControlAttributes( [ "required"     => "",
                                                   "placeholder" => "enter host name",
                                                   "value" => "localhost" ] );

               $txtDbName = new HtmlInputControl( "text", "txtDbName_apdb", "Database" );
               $txtDbName->setStyles( "column form-group", "", "form-control input-sm" );
               $txtDbName->setControlAttributes( [ "placeholder" => "enter database name",
                                                   "value" => "u729172951_ap" ] );
            // ADD CONTROLS TO ROW 2
            $divSetupApDatabaseConnDataRow2->addObjects( [ $txtDbHost, $txtDbName ] );

            // ROW 3 ********** ********** ********** ********** ********** **********
            $divSetupApDatabaseConnDataRow3 = new HtmlObject( "div", "divSetupApDatabaseConnDataRow3" );
            $divSetupApDatabaseConnDataRow3->setAttributes( [ "class" => "equal width row",
                                                              "style" => "padding-top:0" ] );

               // CONTROLS
               $txtDbUser = new HtmlInputControl( "text", "txtDbUser_apdb", "User" );
               $txtDbUser->setStyles( "column form-group", "", "form-control input-sm" );
               $txtDbUser->setControlAttributes( [ "required"     => "",
                                                   "placeholder" => "enter user name",
                                                   "value" => "root" ] );

               $pwdDbPass = new HtmlInputControl( "password", "pwdDbPass_apdb", "Password" );
               $pwdDbPass->setStyles( "column form-group", "", "form-control input-sm" );
               $pwdDbPass->setControlAttributes( [ "required"    => "",
                                                   "placeholder" => "enter the password",
                                                   "value" => "123" ] );
            // ADD CONTROLS TO ROW 3
            $divSetupApDatabaseConnDataRow3->addObjects( [ $txtDbUser, $pwdDbPass ] );

         // ADD ROWS TO GRID
         $divSetupApDatabaseConnDataGrid->addObjects( [ $divSetupApDatabaseConnDataRow1,
                                                        $divSetupApDatabaseConnDataRow2,
                                                        $divSetupApDatabaseConnDataRow3 ] );

         // ADD GRID TO FORM
         $formWidget->addObjects( [ $divSetupApDatabaseConnDataGrid ] );

      return $formWidget;

   } // private static function _loadBsForm_SetupApDatabaseConnData(){

   /**
    * Setup Connection Data for Main Database.
    * These data will be stored in access point database
    *
    * @return \HtmlObject
    */
   private static function _loadBsForm_SetupMainDatabaseConnData(){

      $formWidget = new HtmlObject( "form", "formSetupMainDatabaseAP" );
      $formWidget->setAttributes( [ "name"     => "formSetupMainDatabaseAP",
                                    "action"   => "",
                                    "method"   => "",
                                    "onsubmit" => "return false;",
                                    "style"    => "margin-top:25px;" ] );

         // GRID
         $divSetupMainDatabaseAPGrid = new HtmlObject( "div", "divSetupMainDatabaseAPGrid" );
         $divSetupMainDatabaseAPGrid->setAttributes( [ "class" => "ui equal width centered stackable grid",
                                                       "style" => "margin:auto" ] );

            // ROW 1 ********** ********** ********** ********** ********** **********
            $divSetupMainDatabaseAPRow1 = new HtmlObject( "div", "divSetupMainDatabaseAPRow1" );
            $divSetupMainDatabaseAPRow1->setAttributes( [ "class" => "equal width row",
                                                          "style" => "padding-top:0" ] );

               // CONTROLS
               $selDbDrvr = new HtmlSelectControl( "selDbDrvr_maindb", "Driver" );
               $selDbDrvr->setStyles( "column form-group", "", "form-control input-sm" );
               $selDbDrvr->setControlAttributes( [ "required"    => "",
                                                   "placeholder" => "select database driver" ] );

               $_asMAV = [ "m" => "database",
                           "a" => "get_drivers",
                           "v" => "drivers_array" ];
               $_asArgv = [];
               $asDrivers = MasterController::_run( $_asMAV, $_asArgv );
               $selDbDrvr->setOptions( $asDrivers[ "drivers_array" ] );

               $numDbPort = new HtmlInputControl( "number", "numDbPort_maindb", "Port" );
               $numDbPort->setStyles( "column form-group", "", "form-control input-sm" );
               $numDbPort->setControlAttributes( [ "required"     => "",
                                                   "placeholder" => "enter port number",
                                                   "value" => "" ] );
            // ADD CONTROLS TO ROW 1
            $divSetupMainDatabaseAPRow1->addObjects( [ $selDbDrvr, $numDbPort ] );

            // ROW 2 ********** ********** ********** ********** ********** **********
            $divSetupMainDatabaseAPRow2 = new HtmlObject( "div", "divSetupMainDatabaseAPRow2" );
            $divSetupMainDatabaseAPRow2->setAttributes( [ "class" => "equal width row",
                                                          "style" => "padding-top:0" ] );

               // CONTROLS
               $txtDbHost = new HtmlInputControl( "text", "txtDbHost_maindb", "Host" );
               $txtDbHost->setStyles( "column form-group", "", "form-control input-sm" );
               $txtDbHost->setControlAttributes( [ "required"    => "",
                                                   "placeholder" => "enter host name",
                                                   "value"       => "localhost" ] );

               $txtDbName = new HtmlInputControl( "text", "txtDbName_maindb", "Database" );
               $txtDbName->setStyles( "column form-group", "", "form-control input-sm" );
               $txtDbName->setControlAttributes( [ "required"    => "",
                                                   "placeholder" => "enter database name",
                                                   "value"       => "u729172951_brv" ] );
            // ADD CONTROLS TO ROW 2
            $divSetupMainDatabaseAPRow2->addObjects( [ $txtDbHost, $txtDbName ] );

            // ROW 3 ********** ********** ********** ********** ********** **********
            $divSetupMainDatabaseAPRow3 = new HtmlObject( "div", "divSetupMainDatabaseAPRow3" );
            $divSetupMainDatabaseAPRow3->setAttributes( [ "class" => "equal width row",
                                                          "style" => "padding-top:0" ] );

               // CONTROLS
               $txtDbUser = new HtmlInputControl( "text", "txtDbUser_maindb", "User" );
               $txtDbUser->setStyles( "column form-group", "", "form-control input-sm" );
               $txtDbUser->setControlAttributes( [ "required"    => "",
                                                   "placeholder" => "enter user name",
                                                   "value"       => "root" ] );

               $txtDbCo = new HtmlInputControl( "text", "txtDbCo_maindb", "" );
               $txtDbCo->setStyles( "column form-group", "", "form-control input-sm" );
               $txtDbCo->setControlAttributes( [ "required"    => "",
                                                 "placeholder" => "select company",
                                                 "style"       => "display:none",
                                                 "value"       => "1" ] );

            // ADD CONTROLS TO ROW 3
            $divSetupMainDatabaseAPRow3->addObjects( [ $txtDbUser, $txtDbCo ] );

            // ROW 4 ********** ********** ********** ********** ********** **********
            $divSetupMainDatabaseAPRow4 = new HtmlObject( "div", "divSetupMainDatabaseAPRow4" );
            $divSetupMainDatabaseAPRow4->setAttributes( [ "class" => "equal width row",
                                                          "style" => "padding-top:0" ] );

               // CONTROLS
               $pwdDbPass = new HtmlInputControl( "password", "pwdDbPass_maindb", "Password" );
               $pwdDbPass->setStyles( "column form-group", "", "form-control input-sm" );
               $pwdDbPass->setControlAttributes( [ "required"    => "",
                                                   "placeholder" => "enter the password",
                                                   "value"       => "123" ] );

               $pwdConfDbPass = new HtmlInputControl( "password", "pwdConfDbPass_maindb", "Confirm Password" );
               $pwdConfDbPass->setStyles( "column form-group", "", "form-control input-sm" );
               $pwdConfDbPass->setControlAttributes( [ "required"    => "",
                                                       "placeholder" => "confirm the password",
                                                       "value"       => "123" ] );
            // ADD CONTROLS TO ROW 4
            $divSetupMainDatabaseAPRow4->addObjects( [ $pwdDbPass, $pwdConfDbPass ] );

            // ROW 5 ********** ********** ********** ********** ********** **********
            $divSetupMainDatabaseAPRow5 = new HtmlObject( "div", "divSetupMainDatabaseAPRow5" );
            $divSetupMainDatabaseAPRow5->setAttributes( [ "class" => "equal width row",
                                                          "style" => "padding-top:0" ] );

               // CONTROLS
               $inpSubmitAccessPoint = new HtmlObject( "input", "submitSetupAccessPoint", true );
               $inpSubmitAccessPoint->setAttributes( [ "value"    => "Create Access Point",
                                                       "class"    => "btn btn-danger btn-sm",
                                                       "onclick"  => "submitSetupAccessPoint_onclick();" ] );

            // ADD CONTROLS TO ROW 5
            $divSetupMainDatabaseAPRow5->addObjects( [ $inpSubmitAccessPoint ] );

         // ADD ROWS TO GRID
         $divSetupMainDatabaseAPGrid->addObjects( [ $divSetupMainDatabaseAPRow1,
                                                    $divSetupMainDatabaseAPRow2,
                                                    $divSetupMainDatabaseAPRow3,
                                                    $divSetupMainDatabaseAPRow4,
                                                    $divSetupMainDatabaseAPRow5 ] );

      $formWidget->addObjects( [ $divSetupMainDatabaseAPGrid ] );

      return $formWidget;
   } // private static function _loadBsForm_SetupMainDatabaseConnData(){

   /**
    *
    * @return \HtmlObject
    */
   private static function _loadBsForm_Login(){

      $formWidget = new HtmlObject( "form", "formLogin" );
      $formWidget->setAttributes( [ "name"     => "formLogin",
                                    "action"   => "",
                                    "method"   => "",
                                    "onsubmit" => "return false;" ] );


         $emlUsrMail = new HtmlInputControl( "email", "emlUsrMail", "e-mail:" );
         $emlUsrMail->setStyles( "form-group", "", "form-control input-sm" );
         $emlUsrMail->setControlAttributes( [ "required" => "",
                                              "placeholder" => "digite o email" ] );

         $pwdUsrPass = new HtmlInputControl( "password", "pwdUsrPass", "password" );
         $pwdUsrPass->setStyles( "form-group", "", "form-control input-sm" );
         $pwdUsrPass->setControlAttributes( [ "required" => "",
                                              "placeholder" => "digite a senha" ] );

         /* ********** */
         $submitLogin = new HtmlObject( "input", "submitLogin", true );
         $submitLogin->setAttributes( [ "value"    => "Login",
                                        "type"     => "submit",
                                        "class"    => "btn btn-primary",
                                        "required" => "required",
                                        "onclick"  => "submitLogin_onclick();" ] );

         $spnNBSP = new HtmlObject( "span" );
         $spnNBSP->setText( "&nbsp;&nbsp;&nbsp;&nbsp;" );

         $aCancelLogin = new HtmlObject( "a", "aCancelLogin" );
         $aCancelLogin->setAttributes( [ "href"    => "#",
                                         "class"   => "btn btn-warning",
                                         "onclick" => "aCancelLogin_onclick()" ] );
         $aCancelLogin->setText( App::_getText( "cancel_option" ) );

         $aReload = new HtmlObject( "a", "aReload" );
         $aReload->setAttributes( [ "href"  => "index.php?reload=1",
                                    "class" => "btn btn-danger" ] );
         $aReload->setText( "Reload" );

         $formWidget->addObjects( [ $emlUsrMail, $pwdUsrPass, $submitLogin, $spnNBSP, $aReload, $spnNBSP, $aCancelLogin ] );

      return $formWidget;

   } // private static function _loadBsForm_Login(){

   /**
    *
    * @return \HtmlObject
    */
   private static function _loadBsForm_Signup(){

      $formWidget = new HtmlObject( "form", "formSignup" );
      $formWidget->setAttributes( [ "name"     => "formSignup",
                                    "action"   => "",
                                    "method"   => "",
                                    "onsubmit" => "return false;" ] );

         // USER NAME
         $txtUsrName = new HtmlInputControl( "text", "txtUsrName", "name:" );
         $txtUsrName->setStyles( "form-group", "", "form-control input-sm" );
         $txtUsrName->setControlAttributes( [ "required"    => "required",
                                              "placeholder" => "digite o nome" ] );

         // E-MAIL
         $emlUsrMail = new HtmlInputControl( "email", "emlUsrMail", "e-mail:" );
         $emlUsrMail->setStyles( "form-group", "", "form-control input-sm" );
         $emlUsrMail->setControlAttributes( [ "required"    => "required",
                                              "placeholder" => "digite o email" ] );

         // MOBILE
         $telUsrMobile = new HtmlInputControl( "tel", "telUsrMobile", "mobile:" );
         $telUsrMobile->setStyles( "form-group", "", "form-control input-sm" );
         $telUsrMobile->setControlAttributes( [ "placeholder" => "digite o número do celular" ] );

         // SITE
         $urlUsrSite = new HtmlInputControl( "url", "urlUsrSite", "site:" );
         $urlUsrSite->setStyles( "form-group", "", "form-control input-sm" );
         $urlUsrSite->setControlAttributes( [ "placeholder" => "digite o site" ] );

         // PASSWORD
         $pwdUsrPass = new HtmlInputControl( "password", "pwdUsrPass", "password:" );
         $pwdUsrPass->setStyles( "form-group", "", "form-control input-sm" );
         $pwdUsrPass->setControlAttributes( [ "required"    => "required",
                                              "placeholder" => "digite a senha" ] );

         // CONFIRM PASSWORD
         $pwdUsrConfPass = new HtmlInputControl( "password", "pwdUsrConfPass", "confirm password:" );
         $pwdUsrConfPass->setStyles( "form-group", "", "form-control input-sm" );
         $pwdUsrConfPass->setControlAttributes( [ "required"    => "required",
                                                  "placeholder" => "confirme a senha" ] );

         /* ********** */
         $submitSignup = new HtmlObject( "input", "submitSignup", true );
         $submitSignup->setAttributes( [ "value"    => "Sign Up",
                                         "type"     => "submit",
                                         "class"    => "btn btn-primary",
                                         "required" => "required",
                                         "onclick"  => "submitSignup_onclick();" ] );

         $spnNBSP = new HtmlObject("span" );
         $spnNBSP->setText( "&nbsp;&nbsp;&nbsp;&nbsp;" );

         $aCancelSignup = new HtmlObject( "a", "aCancelSignup" );
         $aCancelSignup->setAttributes( [ "href"    => "#",
                                          "class"   => "btn btn-warning",
                                          "onclick" => "aCancelSignup_onclick()" ] );
         $aCancelSignup->setText( App::_getText( "cancel_option" ) );

         $formWidget->addObjects( [ $txtUsrName,   $emlUsrMail,
                                    $telUsrMobile, $urlUsrSite,
                                    $pwdUsrPass,   $pwdUsrConfPass,
                                    $submitSignup, $spnNBSP,        $aCancelSignup ] );

      return $formWidget;
   } // private static function _loadBsForm_Signup(){

   /**
    *
    * @return \HtmlObject
    */
   private static function _loadBsForm_CustomCategories(){

      $formWidget = new HtmlObject( "form", "formCustomCategories" );
      $formWidget->setAttributes( [ "name"     => "formCustomCategories",
                                    "action"   => "",
                                    "method"   => "",
                                    "onsubmit" => "return false;" ] );

         $txtCategory = new HtmlInputControl( "text", "txtCategory", App::_getText( "workspace_category" ) );
         $txtCategory->setStyles( "form-group", "", "form-control input-sm" );
         $txtCategory->setControlAttributes( [ "required"    => "",
                                               "placeholder" => App::_getText( "workspace_categories" ) ] );

         /* ********** */
         $submitNewCategory = new HtmlObject( "input", "submitNewCategory", true );
         $submitNewCategory->setAttributes( [ "value"    => App::_getText( "send_option" ),
                                              "type"     => "submit",
                                              "class"    => "btn btn-primary",
                                              "required" => "required",
                                              "onclick"  => "alert('submitModel')" ] );

         $spnNBSP = new HtmlObject( "span" );
         $spnNBSP->setText( "&nbsp;&nbsp;&nbsp;&nbsp;" );

         $aCancelCategory = new HtmlObject( "a", "aCancelModel" );
         $aCancelCategory->setAttributes( [ "href"    => "#",
                                            "class"   => "btn btn-warning",
                                            "onclick" => "alert('aCancelModel')" ] );
         $aCancelCategory->setText( App::_getText( "cancel_option" ) );

         $formWidget->addObjects( [  $txtCategory, $submitNewCategory, $spnNBSP, $aCancelCategory ] );

      return $formWidget;

   } // private static function _loadBsForm_CustomCategories(){

   /**
    *
    * @return \HtmlObject
    */
   private static function _loadBsForm_CustomThemes(){

      $formWidget = new HtmlObject( "form", "formCustomThemes" );
      $formWidget->setAttributes( [ "name"     => "formCustomThemes",
                                    "action"   => "",
                                    "method"   => "",
                                    "onsubmit" => "return false;" ] );

         $txtTheme = new HtmlInputControl( "text", "txtTheme", App::_getText( "workspace_theme" ) );
         $txtTheme->setStyles( "form-group", "", "form-control input-sm" );
         $txtTheme->setControlAttributes( [ "required"    => "",
                                               "placeholder" => App::_getText( "workspace_themes" ) ] );

         /* ********** */
         $submitNewTheme = new HtmlObject( "input", "submitNewTheme", true );
         $submitNewTheme->setAttributes( [ "value"    => App::_getText( "send_option" ),
                                              "type"     => "submit",
                                              "class"    => "btn btn-primary",
                                              "required" => "required",
                                              "onclick"  => "alert('submitModel')" ] );

         $spnNBSP = new HtmlObject( "span" );
         $spnNBSP->setText( "&nbsp;&nbsp;&nbsp;&nbsp;" );

         $aCancelTheme = new HtmlObject( "a", "aCancelModel" );
         $aCancelTheme->setAttributes( [ "href"    => "#",
                                            "class"   => "btn btn-warning",
                                            "onclick" => "alert('aCancelModel')" ] );
         $aCancelTheme->setText( App::_getText( "cancel_option" ) );

         $formWidget->addObjects( [  $txtTheme, $submitNewTheme, $spnNBSP, $aCancelTheme ] );

      return $formWidget;

   } // private static function _loadBsForm_CustomThemes(){

   /**
    *
    * @return \HtmlObject
    */
   private static function _loadBsForm_CustomSubjects(){

      $formWidget = new HtmlObject( "form", "formCustomSubjects" );
      $formWidget->setAttributes( [ "name"     => "formCustomSubjects",
                                    "action"   => "",
                                    "method"   => "",
                                    "onsubmit" => "return false;" ] );

         $txtSubject = new HtmlInputControl( "text", "txtSubject", App::_getText( "workspace_subject" ) );
         $txtSubject->setStyles( "form-group", "", "form-control input-sm" );
         $txtSubject->setControlAttributes( [ "required"    => "",
                                               "placeholder" => App::_getText( "workspace_subjects" ) ] );

         /* ********** */
         $submitNewSubject = new HtmlObject( "input", "submitNewSubject", true );
         $submitNewSubject->setAttributes( [ "value"    => App::_getText( "send_option" ),
                                              "type"     => "submit",
                                              "class"    => "btn btn-primary",
                                              "required" => "required",
                                              "onclick"  => "alert('submitModel')" ] );

         $spnNBSP = new HtmlObject( "span" );
         $spnNBSP->setText( "&nbsp;&nbsp;&nbsp;&nbsp;" );

         $aCancelSubject = new HtmlObject( "a", "aCancelModel" );
         $aCancelSubject->setAttributes( [ "href"    => "#",
                                            "class"   => "btn btn-warning",
                                            "onclick" => "alert('aCancelModel')" ] );
         $aCancelSubject->setText( App::_getText( "cancel_option" ) );

         $formWidget->addObjects( [  $txtSubject, $submitNewSubject, $spnNBSP, $aCancelSubject ] );

      return $formWidget;

   } // private static function _loadBsForm_CustomSubjects(){

   /**
    *
    * @return \HtmlObject
    */
   private static function _loadBsForm_CustomTopics(){

      $formWidget = new HtmlObject( "form", "formCustomTopics" );
      $formWidget->setAttributes( [ "name"     => "formCustomTopics",
                                    "action"   => "",
                                    "method"   => "",
                                    "onsubmit" => "return false;" ] );

         $txtTopic = new HtmlInputControl( "text", "txtTopic", App::_getText( "workspace_topic" ) );
         $txtTopic->setStyles( "form-group", "", "form-control input-sm" );
         $txtTopic->setControlAttributes( [ "required"    => "",
                                               "placeholder" => App::_getText( "workspace_topics" ) ] );

         /* ********** */
         $submitNewTopic = new HtmlObject( "input", "submitNewTopic", true );
         $submitNewTopic->setAttributes( [ "value"    => App::_getText( "send_option" ),
                                              "type"     => "submit",
                                              "class"    => "btn btn-primary",
                                              "required" => "required",
                                              "onclick"  => "alert('submitModel')" ] );

         $spnNBSP = new HtmlObject( "span" );
         $spnNBSP->setText( "&nbsp;&nbsp;&nbsp;&nbsp;" );

         $aCancelTopic = new HtmlObject( "a", "aCancelModel" );
         $aCancelTopic->setAttributes( [ "href"    => "#",
                                            "class"   => "btn btn-warning",
                                            "onclick" => "alert('aCancelModel')" ] );
         $aCancelTopic->setText( App::_getText( "cancel_option" ) );

         $formWidget->addObjects( [  $txtTopic, $submitNewTopic, $spnNBSP, $aCancelTopic ] );

      return $formWidget;

   } // private static function _loadBsForm_CustomTopics(){


} // class WidgetsLibrary{
