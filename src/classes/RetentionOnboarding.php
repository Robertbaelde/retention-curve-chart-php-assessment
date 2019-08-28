<?php
/**
 * RetentionOnboarding
 *
 *
 * @package Retention
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace Entities;

if(!class_exists('RetentionOnboarding'))
{
    /**
     * @name RetentionOnboarding
     * @description RetentionOnboarding
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class RetentionOnboarding
    {   
        protected $userId = 0;
        protected $percentage = 0;
        
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
         * @name setUserId
         *
         * @param string $userId
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return void
         */
        public function setUserId(string $userId) : void
        {
            $this->userId = intval($userId);
        }
        
        /**
         * @name getUserId
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return int 
         */
        public function getUserId() : int 
        {
            return $this->userId;
        }
        
        /**
         * @name setPercentage
         *
         * @param string $percentage
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return void
         */
        public function setPercentage(string $percentage) : void
        {
            $this->percentage = intval($percentage);
        }
        
        /**
         * @name getPercentage
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return int
         */
        public function getPercentage() : int
        {
            return $this->percentage;
        }
    }
}