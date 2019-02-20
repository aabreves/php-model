<?php
require_once "classHtmlObject.php";

/*
 * Copyright (C) 2017 aabreves
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
 */

/**
 * Definition of classCarousel
 *
 * @author aabreves
 */
class HtmlCarousel extends HtmlObject{
    private $sId;
    private $sLabel;
    private $asSlides = [];

    private $idFirstSlide = "";

    /**
     *
     * @param type $sId
     * @param type $sLabel
     */
    function __construct( $sId, $sLabel = "" ){
        parent::__construct( "div", $sId );

        $this->sId = $sId;
        $this->sLabel = $sLabel;
    } // function __construct( $sId, $sLabel = "" )

    /**
     *
     * @param type $sContent
     */
    function addSlide( $sContent ){
        $this->asSlides[] = $sContent;
    } // function addSlide( $sContent )

    /**
     *
     * @return type
     */
    function getIdFirstSlide(){
        return $this->idFirstSlide;
    } // function getIdFirstSlide()

    /**
     *
     */
    function buildSlides(){
        $iSlideCount = count($this->asSlides);
        $sId = substr( $this->sId, strlen( $this->sTag ) );

        $this->setAttribute( "class", "slide-container" );
        foreach ( $this->asSlides as $iIndex => $sSlide ){

            list( $sContent, $sContentType ) = explode(";", $sSlide);

            $iPrev = ($iIndex === 0) ? $iSlideCount - 1 : $iIndex - 1;
            $iNext = ($iIndex === $iSlideCount - 1) ? 0 : $iIndex + 1;

            $idSlide = "div$sId"."Slide";

            if ( $iIndex === 0 ){
                $this->idFirstSlide = "$idSlide$iIndex";
            } // if ( $iIndex === 0 )

            $divSlide = new HtmlObject( "div", "$idSlide$iIndex" );
            $divSlide->setAttribute( "class", "slide" );

                $divPrev = new HtmlObject( "div", "div$sId"."Prev$iIndex" );
                $divPrev->setAttribute( "class", "divPrev" );

                $divNext = new HtmlObject( "div", "div$sId"."Next$iIndex" );
                $divNext->setAttribute( "class", "divNext" );

                $divCont = new HtmlObject( "div", "div$sId"."Cont$iIndex" );
                $divCont->setAttribute( "class", "divCont" );

                    $cmdPrev = new HtmlObject( "button", "cmd$sId"."Prev$iIndex" );
                    $cmdPrev->setAttribute( "onclick", "gotoSlide('$idSlide$iIndex','$idSlide$iPrev')" );
                    $cmdPrev->setAttribute( "class", "cmdPrev" );
                    $cmdPrev->setText( "<<" );
                    $divPrev->addObject( $cmdPrev );

                    $cmdNext = new HtmlObject( "button", "cmd$sId"."Next$iIndex" );
                    $cmdNext->setAttribute( "onclick", "gotoSlide('$idSlide$iIndex','$idSlide$iNext')" );
                    $cmdNext->setAttribute( "class", "cmdNext" );
                    $cmdNext->setText( ">>" );
                    $divNext->addObject( $cmdNext );

                    switch ( $sContentType ){
                        case "text":
                            $divCont->setText( $sContent );
                            break;

                        case "bgimg":
                        default:
                            $sImg = "<img src='$sContent' alt='Mountain View' style='width:100%;height:auto;'>";
                            //$divCont->setAttribute("style", "background-image:url($sContent);");
                            $divCont->setText( $sImg );
                    } // switch ( $sContentType )

                $divSlide->addObjects( array( $divPrev, $divCont, $divNext ) );

            $this->addObject( $divSlide );
        } // foreach ( $this->asSlides as $iIndex => $sContent )
    } // function buildSlides()

} // class HtmlCarousel extends HtmlObject
