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

use Sorters\SorterRetentionCurve;
use Strategy\CsvDataManager;

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
        
        $rest = new RestRetentionCurve($endpoint);
        
        /**
         *
         *  @todo Auth (AppID and DevID)
         *
         */
        
        if (!$rest->isValidCall()) {
            
            /* I use the dispatcher as a controller since UI and backend are on the same domain */
            require MAIN_DIR . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'default.php';
            
        } else {
            
            $csvDataManager = new CsvDataManager();
            $csvDataManager->setConnection(array(
                'filename' => 'data/export.csv',
                'delimiter' => ';'
            ));
            
            $resultSet = $csvDataManager->select(array('SELECT * FROM Onboarding'));
            
            $sorter = new SorterRetentionCurve();
            $sorter->process($resultSet);
            $retentionWeeks = (array)$sorter->getData();
            
            echo $rest->processAPI($retentionWeeks);
        }
    }
}