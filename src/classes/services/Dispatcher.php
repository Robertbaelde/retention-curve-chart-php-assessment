<?php
/**
 * Dispatcher
 *
 * @description
 * @package Retention
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace Services;

/**
 * Dispatcher
 *
 * @description
 * @package Retention
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

class Dispatcher
{
    /**
     * @name dispatch
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return void
     */
    public function dispatch() : void
    {
        $endpoint = $_SERVER['REQUEST_URI'];
        
        if ('/' == $endpoint) {
            
            /* I use the dispatcher as a controller since UI and backend are on the same domain */
            require MAIN_DIR . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'default.php';
            
        } else {
            
            /**
             *
             *  @todo Auth Not Implemented
             *
             */

            $rest = new RestRetentionCurve($endpoint);
            echo $rest->processAPI(array(
                'filename' => 'data/export.csv',
                'delimiter' => ';'
            ));
        }
    }
}