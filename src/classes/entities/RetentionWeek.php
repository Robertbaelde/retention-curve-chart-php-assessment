<?php
/**
 * RetentionWeek
 *
 *
 * @package Retention
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace Entities;

if(!class_exists('RetentionWeek'))
{
    /**
     * @name RetentionWeek
     * @description RetentionWeek
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class RetentionWeek
    {   
        public $days = array();
        
        /**
         * @name __construct
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        public function __construct()
        {
            
        }
        
        /**
         * @name addDay
         *
         * @param RetentionDay $retentionDay
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return void
         */
        public function addDay(RetentionDay $retentionDay) : void
        {
            array_push($this->days, $retentionDay);
        }
        
        /**
         * @name getDays
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return array
         */
        public function getDays() : array 
        {
            return $this->days;
        }
    }
}