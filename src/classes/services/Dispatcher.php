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
     * @param string $mainDir
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return void
     */
    public function dispatch(string $mainDir) : void
    {        
        $endpoint = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);
        
        if ('/' == $endpoint) {
            
            /* I use the dispatcher as a controller since UI and backend are on the same domain */
            require $mainDir . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'default.php';
            
        } else {
            
            $auth = new Auth();
            $auth->setToken($token);
            
            $rest = new RestRetentionCurve($auth, $endpoint);
            echo $rest->processAPI(array(
                'filename' => 'data/export.csv',
                'delimiter' => ';'
            ));
        }
    }
}