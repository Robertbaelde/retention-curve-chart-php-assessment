<?php
/**
 * RestRetentionCurve
 *
 * @description
 * @package Retention
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace Services;

use Strategy\Context;
use Strategy\CsvDataManager;
use Sorters\SorterWeeklyRetentionCurve;

if(!class_exists('RestRetentionCurve'))
{
    /**
     * RestRetentionCurve
     *
     * @description
     * @package Retention
     * @author Giuseppe Maccario <g_maccario@hotmail.com>
     * @version 1.0
     * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
     */
    class RestRetentionCurve extends Rest
    {
        /**
         * @name getRetentionCurveWeeklyCohorts
         *
         * @param array $params
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return array
         */
        public function getRetentionCurveWeeklyCohorts(array $params) : array
        {
            if($this->isValidCall() && $this->auth->isActiveToken()) {
                
                /* Data Context */
                $context = new Context(new CsvDataManager($params));
                
                $data = $context->getData(array('SELECT * FROM Onboarding'));
                
                /* Specific sorting */
                $sorter = new SorterWeeklyRetentionCurve();
                $sorter->process($data);
                
                return (array)$sorter->getData();
            }
            
            return array();
        }
    }
}