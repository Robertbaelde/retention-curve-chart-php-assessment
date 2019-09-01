<?php
/**
 * RetentionWeeks
 *
 *
 * @package Retention
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace Entities;

if(!class_exists('RetentionWeeks'))
{
    /**
     * @name RetentionWeeks
     * @description RetentionWeeks
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class RetentionWeeks
    {   
        public $weeks = array();
        
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
         * @name addWeek
         *
         * @param RetentionWeek $retentionWeek
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return void
         */
        public function addWeek(RetentionWeek $retentionWeek) : void
        {
            array_push($this->weeks, $retentionWeek);
        }
        
        /**
         * @name getWeeks
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return array
         */
        public function getWeeks() : array 
        {
            return $this->weeks;
        }
        
        /**
         * @name getWeekByArrayIndex
         *
         * @param int $index
         * 
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return ?RetentionWeek
         */
        public function getWeekByArrayIndex(int $index) : ?RetentionWeek
        {
            if ($index > -1 && $index <= count($this->weeks) - 1) {
                return $this->weeks[$index];
            }
            
            return null;
        }
    }
}