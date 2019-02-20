/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
'use strict';

var m_iDebugMode = 1;
function debugMsg( sMsg )
{
    switch ( m_iDebugMode )
    {
        case 0:
            return;

        case 1:
            console.log( sMsg );
            break;

        case 2:
            console.log( sMsg );
            alert( sMsg );

    } /* switch ( m_iDebugMode ) */
} /* function debugMsg( sMsg ) */
