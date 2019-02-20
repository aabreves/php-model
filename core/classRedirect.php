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
 * /var/www/html/maktub/core/classRedirect.php
 */
$sRequestURI = filter_input( INPUT_SERVER, "REQUEST_URI", FILTER_SANITIZE_FULL_SPECIAL_CHARS ); //$_SERVER['REQUEST_URI'];

$urlTarget   = substr( $sRequestURI, 0, strpos( $sRequestURI, "/", 2 ) + 1);
$urlRedirect = ( isset($_SERVER['HTTPS']) ? "https" : "http" ).
                 "://$_SERVER[HTTP_HOST]$urlTarget";

define( "REDIRECT_URL", $urlRedirect );

/**
 * <h4>Definition of class Redirect</h4>
 * <p></p>
 *
 * @author aabreves
 */
class Redirect{
    static function redirect_($urlRedirectTo, $iStatusCode = 303){
        if (headers_sent()){
            die('<script type="text/javascript">window.location.href="' . $urlRedirectTo . '";</script>');
        } // if (headers_sent()){
        else{
            header("Location: $urlRedirectTo", true, $iStatusCode);
            die();
        } // if (headers_sent()){ .. else
    } // function redirect($urlRedirectTo, $iStatusCode = 303)
} // class Redirect

Redirect::redirect_( REDIRECT_URL );